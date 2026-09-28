<?php
// HDR / EXR da equipe (luz de foto), guardados no banco: valem para todo mundo e não
// dependem do navegador. O arquivo vai em pedaços (cada um cabe no limite de envio do
// servidor e no max_allowed_packet do MySQL) e volta inteiro, em sequência.
require __DIR__ . '/_lib.php';
start_session();
$u = need_user();
session_write_close(); // download longo não trava as outras requisições da sessão
$a = $_GET['a'] ?? '';
const HDR_MAX = 150 * 1024 * 1024; // 150 MB
const HDR_CHUNK = 1024 * 1024;     // limite de cada pedaço (o cliente manda menos)

// As tabelas nascem no primeiro uso (instalações antigas não precisam rodar o setup de novo).
db()->exec('CREATE TABLE IF NOT EXISTS hdr_files (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(190) NOT NULL,
  size INT UNSIGNED NOT NULL,
  chunks INT UNSIGNED NOT NULL,
  complete TINYINT(1) NOT NULL DEFAULT 0,
  user_id INT UNSIGNED NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
db()->exec('CREATE TABLE IF NOT EXISTS hdr_chunks (
  file_id INT UNSIGNED NOT NULL,
  idx INT UNSIGNED NOT NULL,
  data MEDIUMBLOB NOT NULL,
  PRIMARY KEY (file_id, idx)
) ENGINE=InnoDB');

function hdr_name(string $n): string {
  $n = trim(preg_replace('/[\x00-\x1f\/\\\\]/u', '', $n));
  if ($n === '' || mb_strlen($n) > 190 || !preg_match('/\.(hdr|exr)$/i', $n)) out(['error' => 'name'], 400);
  return $n;
}
function hdr_drop(int $id): void {
  db()->prepare('DELETE FROM hdr_chunks WHERE file_id = ?')->execute([$id]);
  db()->prepare('DELETE FROM hdr_files WHERE id = ?')->execute([$id]);
}

if ($a === 'list') {
  // envios abandonados há mais de um dia saem
  $old = db()->query('SELECT id FROM hdr_files WHERE complete = 0 AND created_at < NOW() - INTERVAL 1 DAY')->fetchAll();
  foreach ($old as $r) hdr_drop((int)$r['id']);
  $rows = db()->query('SELECT id, name, size FROM hdr_files WHERE complete = 1 ORDER BY name')->fetchAll();
  out(['files' => array_map(fn($r) => ['id' => (int)$r['id'], 'name' => $r['name'], 'size' => (int)$r['size']], $rows)]);
}

// Arquivo inteiro, pedaço por pedaço. O id muda a cada envio, então o navegador pode
// guardar no cache dele por muito tempo sem risco de ficar com uma versão velha.
if ($a === 'file') {
  $id = (int)($_GET['id'] ?? 0);
  $s = db()->prepare('SELECT name, size, chunks FROM hdr_files WHERE id = ? AND complete = 1');
  $s->execute([$id]);
  $f = $s->fetch();
  if (!$f) out(['error' => 'not found'], 404);
  header('Content-Type: application/octet-stream');
  header('Content-Length: ' . $f['size']);
  header('Cache-Control: private, max-age=31536000, immutable');
  $q = db()->prepare('SELECT data FROM hdr_chunks WHERE file_id = ? AND idx = ?');
  for ($i = 0; $i < (int)$f['chunks']; $i++) { $q->execute([$id, $i]); echo $q->fetchColumn(); flush(); }
  exit;
}

// Começa um envio: reserva o id (o arquivo só aparece na lista quando todos os pedaços chegarem).
if ($a === 'start') {
  $in = need_post();
  $name = hdr_name((string)($in['name'] ?? ''));
  $size = (int)($in['size'] ?? 0);
  $chunks = (int)($in['chunks'] ?? 0);
  if ($size < 1 || $size > HDR_MAX) out(['error' => 'size'], 400);
  if ($chunks < 1 || $chunks > (int)ceil($size / 65536) + 1 || $chunks < (int)ceil($size / HDR_CHUNK)) out(['error' => 'chunks'], 400);
  db()->prepare('INSERT INTO hdr_files (name, size, chunks, user_id) VALUES (?, ?, ?, ?)')->execute([$name, $size, $chunks, $u['id']]);
  out(['id' => (int)db()->lastInsertId()]);
}

if ($a === 'chunk') {
  $in = need_post();
  $id = (int)($in['id'] ?? 0);
  $i = (int)($in['i'] ?? -1);
  $s = db()->prepare('SELECT chunks FROM hdr_files WHERE id = ? AND user_id = ? AND complete = 0');
  $s->execute([$id, $u['id']]);
  $n = $s->fetchColumn();
  if ($n === false || $i < 0 || $i >= (int)$n) out(['error' => 'chunk'], 400);
  $data = base64_decode((string)($in['data'] ?? ''), true);
  if ($data === false || $data === '' || strlen($data) > HDR_CHUNK) out(['error' => 'data'], 400);
  db()->prepare('REPLACE INTO hdr_chunks (file_id, idx, data) VALUES (?, ?, ?)')->execute([$id, $i, $data]);
  out(['ok' => true]);
}

// Fecha o envio: confere pedaços e tamanho; um arquivo de mesmo nome é substituído.
if ($a === 'finish') {
  $in = need_post();
  $id = (int)($in['id'] ?? 0);
  $s = db()->prepare('SELECT name, size, chunks FROM hdr_files WHERE id = ? AND user_id = ? AND complete = 0');
  $s->execute([$id, $u['id']]);
  $f = $s->fetch();
  if (!$f) out(['error' => 'upload'], 400);
  $c = db()->prepare('SELECT COUNT(*) n, COALESCE(SUM(LENGTH(data)), 0) b FROM hdr_chunks WHERE file_id = ?');
  $c->execute([$id]);
  $got = $c->fetch();
  if ((int)$got['n'] !== (int)$f['chunks'] || (int)$got['b'] !== (int)$f['size']) { hdr_drop($id); out(['error' => 'incomplete'], 400); }
  $old = db()->prepare('SELECT id FROM hdr_files WHERE name = ? AND complete = 1');
  $old->execute([$f['name']]);
  foreach ($old->fetchAll() as $r) hdr_drop((int)$r['id']);
  db()->prepare('UPDATE hdr_files SET complete = 1 WHERE id = ?')->execute([$id]);
  out(['id' => $id, 'name' => $f['name'], 'size' => (int)$f['size']]);
}

if ($a === 'delete') {
  $in = need_post();
  $s = db()->prepare('SELECT id FROM hdr_files WHERE name = ?');
  $s->execute([hdr_name((string)($in['name'] ?? ''))]);
  foreach ($s->fetchAll() as $r) hdr_drop((int)$r['id']);
  out(['ok' => true]);
}

out(['error' => 'action'], 404);

<?php
// Uploads da equipe (peças STL, texturas de relevo e materiais), guardados no banco para reuso em qualquer projeto:
// aparecem na aba "Uploads" da galeria de modelos. Mesmo esquema dos HDR: o arquivo vai
// em pedaços (cabe no limite de envio do servidor e no max_allowed_packet do MySQL).
require __DIR__ . '/_lib.php';
start_session();
$u = need_user();
session_write_close();
$a = $_GET['a'] ?? '';
const UP_MAX = 100 * 1024 * 1024; // 100 MB
const UP_CHUNK = 1024 * 1024;
const UP_KINDS = ['stl', 'relief', 'material'];

db()->exec('CREATE TABLE IF NOT EXISTS upload_files (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  kind VARCHAR(16) NOT NULL,
  name VARCHAR(190) NOT NULL,
  size INT UNSIGNED NOT NULL,
  chunks INT UNSIGNED NOT NULL,
  thumb MEDIUMTEXT NULL,
  complete TINYINT(1) NOT NULL DEFAULT 0,
  user_id INT UNSIGNED NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY (kind, name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');
db()->exec('CREATE TABLE IF NOT EXISTS upload_chunks (
  file_id INT UNSIGNED NOT NULL,
  idx INT UNSIGNED NOT NULL,
  data MEDIUMBLOB NOT NULL,
  PRIMARY KEY (file_id, idx)
) ENGINE=InnoDB');

// Lixeira: excluir só marca a data; some de vez depois de 30 dias.
if (!db()->query("SHOW COLUMNS FROM upload_files LIKE 'deleted_at'")->fetch()) db()->exec('ALTER TABLE upload_files ADD COLUMN deleted_at DATETIME NULL');

function up_name(string $n): string {
  $n = trim(preg_replace('/[\x00-\x1f\/\\\\]/u', '', $n));
  if ($n === '' || mb_strlen($n) > 190) out(['error' => 'name'], 400);
  return $n;
}
function up_kind(string $k): string {
  if (!in_array($k, UP_KINDS, true)) out(['error' => 'kind'], 400);
  return $k;
}
function up_drop(int $id): void {
  db()->prepare('DELETE FROM upload_chunks WHERE file_id = ?')->execute([$id]);
  db()->prepare('DELETE FROM upload_files WHERE id = ?')->execute([$id]);
}

if ($a === 'list') {
  $old = db()->query('SELECT id FROM upload_files WHERE (complete = 0 AND created_at < NOW() - INTERVAL 1 DAY) OR (deleted_at IS NOT NULL AND deleted_at < NOW() - INTERVAL 30 DAY)')->fetchAll();
  foreach ($old as $r) up_drop((int)$r['id']);
  $s = db()->prepare('SELECT id, name, size, thumb FROM upload_files WHERE complete = 1 AND deleted_at IS NULL AND kind = ? ORDER BY created_at DESC');
  $s->execute([up_kind((string)($_GET['kind'] ?? 'stl'))]);
  out(['files' => array_map(fn($r) => ['id' => (int)$r['id'], 'name' => $r['name'], 'size' => (int)$r['size'], 'thumb' => $r['thumb'] ?: ''], $s->fetchAll())]);
}

// Arquivo inteiro (o id muda a cada envio: o navegador pode guardar em cache).
if ($a === 'file') {
  $id = (int)($_GET['id'] ?? 0);
  $s = db()->prepare('SELECT size, chunks FROM upload_files WHERE id = ? AND complete = 1');
  $s->execute([$id]);
  $f = $s->fetch();
  if (!$f) out(['error' => 'not found'], 404);
  header('Content-Type: application/octet-stream');
  header('Content-Length: ' . $f['size']);
  header('Cache-Control: private, max-age=31536000, immutable');
  $q = db()->prepare('SELECT data FROM upload_chunks WHERE file_id = ? AND idx = ?');
  for ($i = 0; $i < (int)$f['chunks']; $i++) { $q->execute([$id, $i]); echo $q->fetchColumn(); flush(); }
  exit;
}

if ($a === 'start') {
  $in = need_post();
  $kind = up_kind((string)($in['kind'] ?? ''));
  $name = up_name((string)($in['name'] ?? ''));
  $size = (int)($in['size'] ?? 0);
  $chunks = (int)($in['chunks'] ?? 0);
  $thumb = (string)($in['thumb'] ?? '');
  if ($size < 1 || $size > UP_MAX) out(['error' => 'size'], 400);
  if ($chunks < 1 || $chunks > (int)ceil($size / 65536) + 1 || $chunks < (int)ceil($size / UP_CHUNK)) out(['error' => 'chunks'], 400);
  if ($thumb !== '' && (strlen($thumb) > 300000 || !str_starts_with($thumb, 'data:image/'))) $thumb = '';
  db()->prepare('INSERT INTO upload_files (kind, name, size, chunks, thumb, user_id) VALUES (?, ?, ?, ?, ?, ?)')->execute([$kind, $name, $size, $chunks, $thumb, $u['id']]);
  out(['id' => (int)db()->lastInsertId()]);
}

if ($a === 'chunk') {
  $in = need_post();
  $id = (int)($in['id'] ?? 0);
  $i = (int)($in['i'] ?? -1);
  $s = db()->prepare('SELECT chunks FROM upload_files WHERE id = ? AND user_id = ? AND complete = 0');
  $s->execute([$id, $u['id']]);
  $n = $s->fetchColumn();
  if ($n === false || $i < 0 || $i >= (int)$n) out(['error' => 'chunk'], 400);
  $data = base64_decode((string)($in['data'] ?? ''), true);
  if ($data === false || $data === '' || strlen($data) > UP_CHUNK) out(['error' => 'data'], 400);
  db()->prepare('REPLACE INTO upload_chunks (file_id, idx, data) VALUES (?, ?, ?)')->execute([$id, $i, $data]);
  out(['ok' => true]);
}

// Fecha o envio; um upload do mesmo tipo e nome é substituído.
if ($a === 'finish') {
  $in = need_post();
  $id = (int)($in['id'] ?? 0);
  $s = db()->prepare('SELECT kind, name, size, chunks FROM upload_files WHERE id = ? AND user_id = ? AND complete = 0');
  $s->execute([$id, $u['id']]);
  $f = $s->fetch();
  if (!$f) out(['error' => 'upload'], 400);
  $c = db()->prepare('SELECT COUNT(*) n, COALESCE(SUM(LENGTH(data)), 0) b FROM upload_chunks WHERE file_id = ?');
  $c->execute([$id]);
  $got = $c->fetch();
  if ((int)$got['n'] !== (int)$f['chunks'] || (int)$got['b'] !== (int)$f['size']) { up_drop($id); out(['error' => 'incomplete'], 400); }
  $old = db()->prepare('SELECT id FROM upload_files WHERE kind = ? AND name = ? AND complete = 1 AND deleted_at IS NULL');
  $old->execute([$f['kind'], $f['name']]);
  foreach ($old->fetchAll() as $r) up_drop((int)$r['id']);
  db()->prepare('UPDATE upload_files SET complete = 1 WHERE id = ?')->execute([$id]);
  out(['id' => $id, 'name' => $f['name'], 'size' => (int)$f['size']]);
}

if ($a === 'delete') {
  $in = need_post();
  db()->prepare('UPDATE upload_files SET deleted_at = NOW() WHERE id = ?')->execute([(int)($in['id'] ?? 0)]);
  out(['ok' => true]);
}

if ($a === 'trash') {
  $rows = db()->query('SELECT id, kind, name, thumb, deleted_at FROM upload_files WHERE complete = 1 AND deleted_at IS NOT NULL ORDER BY deleted_at DESC')->fetchAll();
  out(['files' => array_map(fn($r) => ['id' => (int)$r['id'], 'kind' => $r['kind'], 'name' => $r['name'], 'thumb' => $r['thumb'] ?: '', 'deleted' => $r['deleted_at']], $rows)]);
}

if ($a === 'restore') {
  $in = need_post();
  db()->prepare('UPDATE upload_files SET deleted_at = NULL WHERE id = ?')->execute([(int)($in['id'] ?? 0)]);
  out(['ok' => true]);
}

if ($a === 'purge') {
  $in = need_post();
  $s = db()->prepare('SELECT id FROM upload_files WHERE id = ? AND deleted_at IS NOT NULL');
  $s->execute([(int)($in['id'] ?? 0)]);
  if ($r = $s->fetch()) up_drop((int)$r['id']);
  out(['ok' => true]);
}

out(['error' => 'action'], 404);

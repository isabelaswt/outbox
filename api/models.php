<?php
// Modelos salvos: cada pessoa só lista, grava e apaga os próprios.
require __DIR__ . '/_lib.php';
start_session();
$u = need_user();
$a = $_GET['a'] ?? '';
$MAX = 12 * 1024 * 1024; // logos em SVG vão dentro do modelo

function clean_name($n): string {
  $n = trim((string)$n);
  if ($n === '' || mb_strlen($n) > 190) out(['error' => 'name'], 400);
  return $n;
}

// Miniatura de cada modelo (a lista mostra só nome, data e miniatura; o modelo inteiro
// só desce quando é aberto). A coluna nasce no primeiro uso em instalações antigas.
if (!db()->query("SHOW COLUMNS FROM models LIKE 'thumb'")->fetch()) db()->exec('ALTER TABLE models ADD COLUMN thumb MEDIUMTEXT NULL');

if ($a === 'list') {
  $s = db()->prepare('SELECT name, thumb, updated_at FROM models WHERE user_id = ? ORDER BY updated_at DESC');
  $s->execute([$u['id']]);
  $rows = array_map(fn($r) => ['name' => $r['name'], 'thumb' => $r['thumb'] ?: '', 'updated' => $r['updated_at']], $s->fetchAll());
  out(['models' => $rows]);
}

if ($a === 'get') {
  $s = db()->prepare('SELECT data FROM models WHERE user_id = ? AND name = ?');
  $s->execute([$u['id'], clean_name($_GET['name'] ?? '')]);
  $d = $s->fetchColumn();
  if ($d === false) out(['error' => 'not found'], 404);
  out(['data' => json_decode($d, true)]);
}

if ($a === 'save') {
  $in = need_post();
  $name = clean_name($in['name'] ?? '');
  $data = json_encode($in['data'] ?? null, JSON_UNESCAPED_UNICODE);
  if (!is_array($in['data'] ?? null) || strlen($data) > $MAX) out(['error' => 'data'], 400);
  $thumb = (string)($in['thumb'] ?? '');
  if ($thumb !== '' && (strlen($thumb) > 400000 || !str_starts_with($thumb, 'data:image/'))) $thumb = '';
  // sem miniatura nova (autosave), fica a que já estava
  db()->prepare('INSERT INTO models (user_id, name, data, thumb) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE data = VALUES(data), thumb = COALESCE(VALUES(thumb), thumb), updated_at = NOW()')
    ->execute([$u['id'], $name, $data, $thumb !== '' ? $thumb : null]);
  out(['ok' => true]);
}

if ($a === 'delete') {
  $in = need_post();
  db()->prepare('DELETE FROM models WHERE user_id = ? AND name = ?')->execute([$u['id'], clean_name($in['name'] ?? '')]);
  out(['ok' => true]);
}

// Primeiro login: leva os modelos salvos só no navegador para a conta (sem sobrescrever).
if ($a === 'import') {
  $in = need_post();
  $items = is_array($in['items'] ?? null) ? $in['items'] : [];
  $s = db()->prepare('INSERT IGNORE INTO models (user_id, name, data) VALUES (?, ?, ?)');
  $n = 0;
  foreach ($items as $name => $data) {
    $name = trim((string)$name);
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);
    if ($name === '' || mb_strlen($name) > 190 || !is_array($data) || strlen($json) > $MAX) continue;
    $s->execute([$u['id'], $name, $json]);
    $n += $s->rowCount();
  }
  out(['imported' => $n]);
}

out(['error' => 'action'], 404);

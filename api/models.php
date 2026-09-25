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

if ($a === 'list') {
  $s = db()->prepare('SELECT name, data FROM models WHERE user_id = ? ORDER BY updated_at DESC');
  $s->execute([$u['id']]);
  $rows = array_map(fn($r) => ['name' => $r['name'], 'data' => json_decode($r['data'], true)], $s->fetchAll());
  out(['models' => $rows]);
}

if ($a === 'save') {
  $in = need_post();
  $name = clean_name($in['name'] ?? '');
  $data = json_encode($in['data'] ?? null, JSON_UNESCAPED_UNICODE);
  if (!is_array($in['data'] ?? null) || strlen($data) > $MAX) out(['error' => 'data'], 400);
  db()->prepare('INSERT INTO models (user_id, name, data) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE data = VALUES(data), updated_at = NOW()')
    ->execute([$u['id'], $name, $data]);
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

<?php
// Equipe (só administradores): lista, convida, gera link de senha e remove.
require __DIR__ . '/_lib.php';
start_session();
$me = need_admin();
$a = $_GET['a'] ?? '';

if ($a === 'list') {
  $rows = db()->query('SELECT id, email, name, is_admin, pass_hash IS NOT NULL AS active FROM users ORDER BY name, email')->fetchAll();
  foreach ($rows as &$r) { $r['id'] = (int)$r['id']; $r['is_admin'] = (bool)$r['is_admin']; $r['active'] = (bool)$r['active']; }
  out(['users' => $rows]);
}

if ($a === 'add') {
  $in = need_post();
  $email = strtolower(trim((string)($in['email'] ?? '')));
  $name = trim((string)($in['name'] ?? ''));
  if (!valid_email($email)) out(['error' => 'email'], 400);
  if (mb_strlen($name) > 120) out(['error' => 'name'], 400);
  $s = db()->prepare('SELECT id FROM users WHERE email = ?');
  $s->execute([$email]);
  if ($s->fetch()) out(['error' => 'exists'], 409);
  db()->prepare('INSERT INTO users (email, name) VALUES (?, ?)')->execute([$email, $name]);
  $id = (int)db()->lastInsertId();
  out(['id' => $id, 'token' => new_pass_token($id)]);
}

if ($a === 'link') {
  $in = need_post();
  $id = (int)($in['id'] ?? 0);
  $s = db()->prepare('SELECT id FROM users WHERE id = ?');
  $s->execute([$id]);
  if (!$s->fetch()) out(['error' => 'user'], 404);
  out(['token' => new_pass_token($id)]);
}

if ($a === 'remove') {
  $in = need_post();
  $id = (int)($in['id'] ?? 0);
  if ($id === $me['id']) out(['error' => 'self'], 400);
  db()->prepare('DELETE FROM users WHERE id = ?')->execute([$id]);
  out(['ok' => true]);
}

out(['error' => 'action'], 404);

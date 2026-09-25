<?php
// Login: quem sou, entrar, sair, conferir link de senha e criar senha.
require __DIR__ . '/_lib.php';
start_session();
$a = $_GET['a'] ?? '';

if ($a === 'me') out(['user' => me()]);

if ($a === 'login') {
  $in = need_post();
  $email = strtolower(trim((string)($in['email'] ?? '')));
  $pass = (string)($in['password'] ?? '');
  // Trava por 15 minutos: 5 erros no mesmo e-mail, ou 30 no mesmo IP (a equipe
  // pode dividir o IP do escritório; um erro de alguém não trava todo mundo).
  $keys = ['e:' . $email => 5, 'ip:' . ($_SERVER['REMOTE_ADDR'] ?? '') => 30];
  $q = db()->prepare('SELECT n FROM login_fails WHERE k = ? AND last_at > DATE_SUB(NOW(), INTERVAL 15 MINUTE)');
  foreach ($keys as $k => $max) { $q->execute([$k]); if ((int)$q->fetchColumn() >= $max) out(['error' => 'wait'], 429); }
  $s = db()->prepare('SELECT id, pass_hash FROM users WHERE email = ?');
  $s->execute([$email]);
  $u = $s->fetch();
  if (!$u || !$u['pass_hash'] || !password_verify($pass, $u['pass_hash'])) {
    $f = db()->prepare('INSERT INTO login_fails (k, n, last_at) VALUES (?, 1, NOW())
      ON DUPLICATE KEY UPDATE n = IF(last_at > DATE_SUB(NOW(), INTERVAL 15 MINUTE), n + 1, 1), last_at = NOW()');
    foreach (array_keys($keys) as $k) $f->execute([$k]);
    out(['error' => 'invalid'], 401);
  }
  db()->prepare('DELETE FROM login_fails WHERE k = ?')->execute(['e:' . $email]);
  if (password_needs_rehash($u['pass_hash'], PASSWORD_DEFAULT))
    db()->prepare('UPDATE users SET pass_hash = ? WHERE id = ?')->execute([password_hash($pass, PASSWORD_DEFAULT), $u['id']]);
  session_regenerate_id(true);
  $_SESSION['uid'] = (int)$u['id'];
  out(['user' => me()]);
}

if ($a === 'logout') {
  need_post();
  $_SESSION = [];
  session_destroy();
  out(['ok' => true]);
}

if ($a === 'token') {
  $u = token_user((string)($_GET['t'] ?? ''));
  if (!$u) out(['error' => 'token'], 404);
  out(['email' => $u['email']]);
}

if ($a === 'set_password') {
  $in = need_post();
  $u = token_user((string)($in['token'] ?? ''));
  if (!$u) out(['error' => 'token'], 404);
  $pass = (string)($in['password'] ?? '');
  if (strlen($pass) < 8) out(['error' => 'short'], 400);
  db()->prepare('UPDATE users SET pass_hash = ? WHERE id = ?')->execute([password_hash($pass, PASSWORD_DEFAULT), $u['id']]);
  db()->prepare('DELETE FROM pass_tokens WHERE user_id = ?')->execute([$u['id']]);
  session_regenerate_id(true);
  $_SESSION['uid'] = (int)$u['id'];
  out(['user' => me()]);
}

out(['error' => 'action'], 404);

<?php
// Primeira configuração: cria as tabelas e a primeira pessoa administradora.
// Só funciona enquanto não existe nenhuma pessoa cadastrada; depois disso se desliga.
require __DIR__ . '/_lib.php';
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-store');

foreach (preg_split('/;\s*\n/', file_get_contents(__DIR__ . '/schema.sql')) as $sql) {
  $sql = trim(preg_replace('/^--.*$/m', '', $sql));
  if ($sql !== '') db()->exec($sql);
}
$has = (int)db()->query('SELECT COUNT(*) FROM users')->fetchColumn() > 0;
$msg = '';
if (!$has && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = strtolower(trim((string)($_POST['email'] ?? '')));
  $name = trim((string)($_POST['name'] ?? ''));
  $pass = (string)($_POST['password'] ?? '');
  if (!valid_email($email)) $msg = 'E-mail inválido.';
  elseif (strlen($pass) < 8) $msg = 'A senha precisa ter pelo menos 8 caracteres.';
  else {
    db()->prepare('INSERT INTO users (email, name, pass_hash, is_admin) VALUES (?, ?, ?, 1)')
      ->execute([$email, mb_substr($name, 0, 120), password_hash($pass, PASSWORD_DEFAULT)]);
    $has = true;
    $msg = 'Pronto! Conta criada. Entre pelo OUTBOX.';
  }
}
$h = fn($s) => htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
?><!doctype html>
<html lang="pt-BR"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>OUTBOX · configuração</title>
<style>
body{margin:0;min-height:100vh;display:grid;place-items:center;background:#050505;color:#f4f0e8;font:14px/1.4 -apple-system,BlinkMacSystemFont,"Inter",sans-serif;padding:24px}
form,div.box{width:min(360px,100%);display:grid;gap:12px}
h1{font-size:13px;letter-spacing:1.6px;text-transform:uppercase;color:#8f867a;text-align:center;margin:0 0 6px}
input{border:1px solid #2d2a26;background:#111;color:#f4f0e8;border-radius:9px;padding:11px 12px;font:inherit}
button,a.btn{padding:11px;border-radius:9px;border:0;background:#f4f0e8;color:#050505;font-weight:650;text-align:center;text-decoration:none;cursor:pointer}
p{margin:0;text-align:center;color:#c9c1b4}
</style></head><body>
<?php if ($has): ?>
  <div class="box"><h1>OUTBOX</h1><p><?= $h($msg ?: 'O OUTBOX já está configurado.') ?></p><a class="btn" href="../">Abrir o OUTBOX</a></div>
<?php else: ?>
  <form method="post">
    <h1>OUTBOX · primeira configuração</h1>
    <p>Crie a conta de quem vai administrar a equipe.</p>
    <?php if ($msg): ?><p style="color:#ff6b6b"><?= $h($msg) ?></p><?php endif; ?>
    <input name="name" placeholder="Nome" autocomplete="name">
    <input name="email" type="email" placeholder="E-mail" autocomplete="email" required>
    <input name="password" type="password" placeholder="Senha (mín. 8 caracteres)" autocomplete="new-password" required minlength="8">
    <button type="submit">Criar conta</button>
  </form>
<?php endif; ?>
</body></html>

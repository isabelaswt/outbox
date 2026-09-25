<?php
// Base da API do OUTBOX: conexão com o MySQL, sessão e respostas JSON.
declare(strict_types=1);

function out($data, int $code = 200): void {
  http_response_code($code);
  header('Content-Type: application/json; charset=utf-8');
  header('Cache-Control: no-store');
  echo json_encode($data, JSON_UNESCAPED_UNICODE);
  exit;
}

$cfgFile = __DIR__ . '/config.php';
if (!is_file($cfgFile)) out(['error' => 'config'], 503);
$CFG = require $cfgFile;

function db(): PDO {
  static $pdo = null;
  global $CFG;
  if (!$pdo) {
    $pdo = new PDO($CFG['dsn'], $CFG['user'], $CFG['pass'], [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
    ]);
  }
  return $pdo;
}

function input(): array {
  $j = json_decode(file_get_contents('php://input') ?: '{}', true);
  return is_array($j) ? $j : [];
}

// Sessão em cookie só do site (httponly, SameSite=Strict), válida por 30 dias.
function start_session(): void {
  $days = 60 * 60 * 24 * 30;
  ini_set('session.gc_maxlifetime', (string)$days);
  session_set_cookie_params([
    'lifetime' => $days, 'path' => '/', 'httponly' => true, 'samesite' => 'Strict',
    'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
  ]);
  session_name('outbox');
  session_start();
}

function me(): ?array {
  if (empty($_SESSION['uid'])) return null;
  $s = db()->prepare('SELECT id, email, name, is_admin FROM users WHERE id = ?');
  $s->execute([$_SESSION['uid']]);
  $u = $s->fetch();
  if (!$u) return null;
  $u['id'] = (int)$u['id'];
  $u['is_admin'] = (bool)$u['is_admin'];
  return $u;
}

function need_user(): array {
  $u = me();
  if (!$u) out(['error' => 'login'], 401);
  return $u;
}

function need_admin(): array {
  $u = need_user();
  if (!$u['is_admin']) out(['error' => 'admin'], 403);
  return $u;
}

// Escritas só por POST com JSON: um formulário de outro site não consegue mandar
// application/json sem passar pelo CORS, então isso barra requisições forjadas.
function need_post(): array {
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') out(['error' => 'method'], 405);
  if (stripos($_SERVER['CONTENT_TYPE'] ?? '', 'application/json') !== 0) out(['error' => 'content-type'], 415);
  return input();
}

// Link de senha (convite ou nova senha): só o hash fica no banco.
function new_pass_token(int $uid, int $days = 7): string {
  $t = bin2hex(random_bytes(24));
  db()->prepare('DELETE FROM pass_tokens WHERE user_id = ?')->execute([$uid]);
  db()->prepare('INSERT INTO pass_tokens (token_hash, user_id, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL ? DAY))')
    ->execute([hash('sha256', $t), $uid, $days]);
  return $t;
}

function token_user(string $t): ?array {
  if (!preg_match('/^[a-f0-9]{48}$/', $t)) return null;
  $s = db()->prepare('SELECT u.id, u.email FROM pass_tokens p JOIN users u ON u.id = p.user_id WHERE p.token_hash = ? AND p.expires_at > NOW()');
  $s->execute([hash('sha256', $t)]);
  return $s->fetch() ?: null;
}

function valid_email(string $e): bool {
  return strlen($e) <= 190 && filter_var($e, FILTER_VALIDATE_EMAIL) !== false;
}

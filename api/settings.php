<?php
// Configurações da equipe (valem para todo mundo que entra no OUTBOX).
// Hoje: em que aba da galeria fica cada modelo base ("galAba": nome → aba).
require __DIR__ . '/_lib.php';
start_session();
need_user();
$a = $_GET['a'] ?? '';
$KEYS = ['galAba'];

// A tabela nasce no primeiro uso (instalações feitas antes dela não precisam rodar o setup de novo).
db()->exec('CREATE TABLE IF NOT EXISTS team_settings (
  k VARCHAR(64) PRIMARY KEY,
  v MEDIUMTEXT NOT NULL,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

function read_key(string $k, bool $lock = false): array {
  $s = db()->prepare('SELECT v FROM team_settings WHERE k = ?' . ($lock ? ' FOR UPDATE' : ''));
  $s->execute([$k]);
  $v = $s->fetchColumn();
  $j = $v === false ? [] : json_decode($v, true);
  return is_array($j) ? $j : [];
}

if ($a === 'get') {
  $k = (string)($_GET['k'] ?? '');
  if (!in_array($k, $KEYS, true)) out(['error' => 'key'], 400);
  out(['value' => (object)read_key($k)]);
}

// Muda uma entrada só (nome → aba; aba vazia apaga), sem sobrescrever o que outra pessoa mudou.
if ($a === 'setEntry') {
  $in = need_post();
  $k = (string)($in['k'] ?? '');
  $name = trim((string)($in['name'] ?? ''));
  $val = trim((string)($in['value'] ?? ''));
  if (!in_array($k, $KEYS, true)) out(['error' => 'key'], 400);
  if ($name === '' || mb_strlen($name) > 190 || mb_strlen($val) > 64) out(['error' => 'entry'], 400);
  $pdo = db();
  $pdo->beginTransaction();
  $map = read_key($k, true);
  if ($val === '') unset($map[$name]); else $map[$name] = $val;
  $json = json_encode((object)$map, JSON_UNESCAPED_UNICODE);
  if (strlen($json) > 256 * 1024) { $pdo->rollBack(); out(['error' => 'size'], 400); }
  $pdo->prepare('INSERT INTO team_settings (k, v) VALUES (?, ?) ON DUPLICATE KEY UPDATE v = VALUES(v)')->execute([$k, $json]);
  $pdo->commit();
  out(['value' => (object)$map]);
}

out(['error' => 'action'], 404);

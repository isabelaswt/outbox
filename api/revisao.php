<?php
// Aprovação Incom (revisao.html): para cada modelo Incom, a situação (aprovado / ajustar / ajustado para rever)
// e a conversa (comentários da equipe e as respostas de quem ajustou), com a versão do OUTBOX avaliada.
require __DIR__ . '/_lib.php';
start_session();
$u = need_user();
$a = $_GET['a'] ?? '';
$STATUS = ['', 'ok', 'ajustar', 'feito']; // feito = ajustado, aguardando nova avaliação

// A tabela nasce no primeiro uso (instalações antigas não precisam rodar o setup de novo).
db()->exec('CREATE TABLE IF NOT EXISTS incom_revisao (
  k VARCHAR(190) PRIMARY KEY,
  status VARCHAR(12) NOT NULL DEFAULT \'\',
  thread MEDIUMTEXT NOT NULL,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

if ($a === 'list') {
  $rows = db()->query('SELECT k, status, thread, updated_at FROM incom_revisao')->fetchAll();
  $out = [];
  foreach ($rows as $r) {
    $t = json_decode($r['thread'], true);
    $out[$r['k']] = ['status' => $r['status'], 'thread' => is_array($t) ? $t : [], 'updated_at' => $r['updated_at']];
  }
  out(['itens' => (object)$out, 'eu' => $u['name'] ?: $u['email']]);
}

// Muda a situação e/ou acrescenta um comentário a um item, sem apagar o que já foi dito.
if ($a === 'set') {
  $in = need_post();
  $k = trim((string)($in['k'] ?? ''));
  $status = isset($in['status']) ? (string)$in['status'] : null;
  $texto = trim((string)($in['texto'] ?? ''));
  $build = substr(trim((string)($in['build'] ?? '')), 0, 40);
  $autor = substr(trim((string)($in['autor'] ?? '')), 0, 40); // ex.: "Claude", quando a resposta é de quem ajustou
  if ($k === '' || mb_strlen($k) > 190) out(['error' => 'k'], 400);
  if ($status !== null && !in_array($status, $STATUS, true)) out(['error' => 'status'], 400);
  if (mb_strlen($texto) > 4000) out(['error' => 'texto'], 400);
  if ($status === null && $texto === '') out(['error' => 'vazio'], 400);
  $pdo = db();
  $pdo->beginTransaction();
  $s = $pdo->prepare('SELECT status, thread FROM incom_revisao WHERE k = ? FOR UPDATE');
  $s->execute([$k]);
  $row = $s->fetch();
  $thread = $row ? (json_decode($row['thread'], true) ?: []) : [];
  $cur = $row ? $row['status'] : '';
  $novo = $status ?? $cur;
  $thread[] = array_filter([
    'quem' => $autor !== '' ? $autor . ' (pela conta de ' . ($u['name'] ?: $u['email']) . ')' : ($u['name'] ?: $u['email']),
    'texto' => $texto, 'status' => $status !== null && $status !== $cur ? $status : null,
    'build' => $build, 'em' => date('c'),
  ], fn($v) => $v !== null && $v !== '');
  $json = json_encode($thread, JSON_UNESCAPED_UNICODE);
  if (strlen($json) > 1024 * 1024) { $pdo->rollBack(); out(['error' => 'size'], 400); }
  $pdo->prepare('INSERT INTO incom_revisao (k, status, thread) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE status = VALUES(status), thread = VALUES(thread)')
    ->execute([$k, $novo, $json]);
  $pdo->commit();
  out(['status' => $novo, 'thread' => $thread]);
}

out(['error' => 'action'], 404);

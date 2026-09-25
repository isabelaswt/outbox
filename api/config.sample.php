<?php
// Copie para api/config.php (no servidor) e preencha com os dados do banco
// criado no hPanel da Hostinger (Bancos de dados → MySQL).
// O config.php fica fora do git: a senha do banco nunca vai para o repositório.
return [
  'dsn'  => 'mysql:host=localhost;dbname=NOME_DO_BANCO;charset=utf8mb4',
  'user' => 'USUARIO_DO_BANCO',
  'pass' => 'SENHA_DO_BANCO',
];

<?php
require_once __DIR__ . '/../env.php';
date_default_timezone_set('America/Sao_Paulo');

// Carrega variáveis do .env
$env = loadEnv(__DIR__ . '/../.env');

// Monta conexão PostgreSQL
$conn = pg_connect(sprintf(
    "host=%s port=%s dbname=%s user=%s password=%s",
    $env['DB_HOST'],
    $env['DB_PORT'],
    $env['DB_NAME'],
    $env['DB_USER'],
    $env['DB_PASS']
));

// Verifica conexão
if (!$conn) {
    die("❌ Erro ao conectar ao PostgreSQL: " . pg_last_error());
}

// Define URLs globais do sistema
if (!defined('BASE_URL')) {
    define('BASE_URL', rtrim($env['BASE_URL'], '/'));
}
if (!defined('API_URL')) {
    define('API_URL', rtrim($env['API_URL'], '/'));
}

<?php
// Conexão PostgreSQL local no Laragon


date_default_timezone_set('America/Sao_Paulo');

$conn = pg_connect("host=127.0.0.1 port=5432 dbname=blumar_teste user=postgres password=");

// Verifica se conectou
if (!$conn) {
    die("❌ Erro ao conectar ao PostgreSQL: " . pg_last_error());
}

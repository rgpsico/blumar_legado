<?php
ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

$pk_blognacional = isset($_POST['pk_blognacional']) ? intval($_POST['pk_blognacional']) : 0;

if ($pk_blognacional > 0) {
    $sql = "DELETE FROM conteudo_internet.blog_nacional WHERE pk_blognacional = $1";
    $result = pg_query_params($conn, $sql, [$pk_blognacional]);

    if ($result) {
        echo '<div class="alert alert-success">✅ Post excluído com sucesso!</div>';
    } else {
        echo '<div class="alert alert-danger">❌ Erro ao excluir post.</div>';
    }
} else {
    echo '<div class="alert alert-warning">ID inválido.</div>';
}

// recarrega a listagem após exclusão
include 'miolo_blognacional.php';

<?php
ini_set('display_errors', 1);
error_reporting(~0);

if (isset($_SESSION)) {
} else {
    session_start();
}

require_once '../util/connection.php';

header('Content-Type: application/json');

$response = array('success' => false, 'message' => '');

if (isset($_POST['ids']) && is_array($_POST['ids'])) {
    $ids = $_POST['ids'];
    $ids_limpos = array();

    // Sanitizar IDs
    foreach ($ids as $id) {
        if (is_numeric($id)) {
            $ids_limpos[] = (int)$id;
        }
    }

    if (count($ids_limpos) > 0) {
        $ids_string = implode(',', $ids_limpos);

        // Query de exclusão
        $query = "DELETE FROM banco_imagem.bco_img WHERE pk_bco_img IN ($ids_string)";
        $result = pg_exec($conn, $query);

        if ($result) {
            $linhas_afetadas = pg_affected_rows($result);
            $response['success'] = true;
            $response['message'] = $linhas_afetadas . ' imagem(ns) excluída(s) com sucesso!';
        } else {
            $response['message'] = 'Erro ao executar a exclusão no banco de dados: ' . pg_last_error($conn);
        }
    } else {
        $response['message'] = 'IDs inválidos fornecidos.';
    }
} else {
    $response['message'] = 'Nenhuma imagem selecionada para exclusão.';
}

echo json_encode($response);

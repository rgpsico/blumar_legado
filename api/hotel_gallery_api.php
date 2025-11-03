<?php

/**
 * API para gerenciamento da tabela conteudo_internet.hotel_gallery_image
 *
 * Endpoints:
 * - ?action=list&hotel_id=151
 * - ?action=create  (POST: hotel_id, image_url, title, description, ordem)
 * - ?action=update  (POST: id, title, description, ordem)
 * - ?action=delete  (POST: id)
 */

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../util/connection.php';

if (!isset($_GET['action']) || empty(trim($_GET['action']))) {
    http_response_code(400);
    echo json_encode(['error' => 'Parâmetro "action" é obrigatório']);
    exit;
}

$action = strtolower(trim($_GET['action']));

switch ($action) {

    // 🔹 LISTAR IMAGENS DE UM HOTEL
    case 'list':
        if (!isset($_GET['hotel_id']) || empty(trim($_GET['hotel_id']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetro "hotel_id" é obrigatório']);
            exit;
        }

        $hotel_id = (int) $_GET['hotel_id'];
        $sql = "SELECT id, hotel_id, image_url, title, description, ordem, created_at, updated_at
                FROM conteudo_internet.hotel_gallery_image
                WHERE hotel_id = $hotel_id
                ORDER BY ordem, id";

        $result = pg_query($conn, $sql);
        if (!$result) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao listar imagens: ' . pg_last_error($conn)]);
            exit;
        }

        $data = [];
        while ($row = pg_fetch_assoc($result)) {
            $data[] = $row;
        }

        echo json_encode([
            'action' => 'list',
            'hotel_id' => $hotel_id,
            'total' => count($data),
            'images' => $data
        ]);
        break;

    // 🔹 CRIAR NOVA IMAGEM
    case 'create':
        $input = $_POST;

        if (empty($input['hotel_id']) || empty($input['image_url'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros obrigatórios: hotel_id, image_url']);
            exit;
        }

        $hotel_id = (int) $input['hotel_id'];
        $image_url = pg_escape_string($input['image_url']);
        $title = isset($input['title']) ? pg_escape_string($input['title']) : null;
        $description = isset($input['description']) ? pg_escape_string($input['description']) : null;
        $ordem = isset($input['ordem']) ? (int) $input['ordem'] : 0;

        $sql = "INSERT INTO conteudo_internet.hotel_gallery_image (hotel_id, image_url, title, description, ordem)
                VALUES ($hotel_id, '$image_url', " . ($title ? "'$title'" : "NULL") . ", " . ($description ? "'$description'" : "NULL") . ", $ordem)
                RETURNING id";

        $result = pg_query($conn, $sql);

        if (!$result) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar imagem: ' . pg_last_error($conn)]);
            exit;
        }

        $new_id = pg_fetch_result($result, 0, 'id');

        echo json_encode([
            'action' => 'create',
            'message' => 'Imagem adicionada com sucesso',
            'id' => $new_id
        ]);
        break;

    // 🔹 ATUALIZAR IMAGEM
    case 'update':
        $input = $_POST;

        if (empty($input['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetro "id" é obrigatório']);
            exit;
        }

        $id = (int) $input['id'];
        $title = isset($input['title']) ? pg_escape_string($input['title']) : null;
        $description = isset($input['description']) ? pg_escape_string($input['description']) : null;
        $ordem = isset($input['ordem']) ? (int) $input['ordem'] : 0;

        $sql = "UPDATE conteudo_internet.hotel_gallery_image
                SET 
                    title = " . ($title ? "'$title'" : "NULL") . ",
                    description = " . ($description ? "'$description'" : "NULL") . ",
                    ordem = $ordem,
                    updated_at = NOW()
                WHERE id = $id";

        $result = pg_query($conn, $sql);

        if (!$result) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao atualizar imagem: ' . pg_last_error($conn)]);
            exit;
        }

        echo json_encode([
            'action' => 'update',
            'message' => 'Imagem atualizada com sucesso',
            'id' => $id
        ]);
        break;

    // 🔹 EXCLUIR IMAGEM
    case 'delete':
        $input = $_POST;

        if (empty($input['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetro "id" é obrigatório']);
            exit;
        }

        $id = (int) $input['id'];
        $sql = "DELETE FROM conteudo_internet.hotel_gallery_image WHERE id = $id";

        $result = pg_query($conn, $sql);

        if (!$result) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao excluir imagem: ' . pg_last_error($conn)]);
            exit;
        }

        echo json_encode([
            'action' => 'delete',
            'message' => 'Imagem removida com sucesso',
            'id' => $id
        ]);
        break;

    // 🔹 AÇÃO INVÁLIDA
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Ação inválida. Use list, create, update ou delete']);
        break;
}

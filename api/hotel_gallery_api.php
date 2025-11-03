<?php

/**
 * API para gerenciamento da tabela conteudo_internet.hotel_gallery_image
 *
 * Descrição:
 * Gerencia as imagens da galeria de hotéis, permitindo listar, criar,
 * atualizar e excluir registros relacionados a cada hotel.
 * Cada imagem é vinculada a um hotel específico através do campo `hotel_id`
 * (ou `mneu_for`, no contexto do legado).
 *
 * Endpoints:
 * - GET  ?action=list&hotel_id=151  
 *         → Lista todas as imagens cadastradas para o hotel informado.
 *
 * - POST ?action=create  
 *         → Cria uma nova imagem vinculada a um hotel.  
 *           Body JSON:
 *           {
 *              "hotel_id": 151,
 *              "image_url": "uploads/hoteis/151/fachada.jpg",
 *              "title": "Fachada principal",
 *              "description": "Vista frontal do hotel",
 *              "ordem": 1
 *           }
 *
 * - POST ?action=update  
 *         → Atualiza os dados de uma imagem existente.  
 *           Body JSON:
 *           {
 *              "id": 45,
 *              "title": "Piscina aquecida",
 *              "description": "Área de lazer renovada",
 *              "ordem": 2
 *           }
 *
 * - POST ?action=delete  
 *         → Exclui uma imagem da galeria.  
 *           Body JSON:
 *           {
 *              "id": 45
 *           }
 *
 * Métodos suportados:
 * - GET: list
 * - POST: create, update, delete
 *
 * Tabelas relacionadas:
 * - conteudo_internet.hotel_gallery_image
 * - sbd95.fornec (para referência cruzada de hotel)
 *
 * Retornos:
 * - 200: Sucesso
 * - 201: Registro criado com sucesso
 * - 400: Parâmetro obrigatório ausente
 * - 404: Registro não encontrado
 * - 405: Método HTTP não permitido
 * - 500: Erro interno no servidor
 *
 * Exemplo de resposta (GET ?action=list&hotel_id=151):
 * [
 *   {
 *     "id": 45,
 *     "hotel_id": 151,
 *     "image_url": "https://www.blumar.com.br/uploads/hoteis/151/fachada.jpg",
 *     "title": "Fachada principal",
 *     "description": "Vista frontal do hotel",
 *     "ordem": 1
 *   },
 *   {
 *     "id": 46,
 *     "hotel_id": 151,
 *     "image_url": "https://www.blumar.com.br/uploads/hoteis/151/piscina.jpg",
 *     "title": "Piscina",
 *     "description": "Área de lazer com piscina aquecida",
 *     "ordem": 2
 *   }
 * ]
 */

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../util/connection.php';

if (!isset($_REQUEST['action']) || empty(trim($_REQUEST['action']))) {
    http_response_code(400);
    echo json_encode(['error' => 'Parâmetro "action" é obrigatório']);
    exit;
}

$action = strtolower(trim($_REQUEST['action']));

switch ($action) {
    case 'upload':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido. Use POST.']);
            exit;
        }

        if (!isset($_POST['hotel_id']) || empty(trim($_POST['hotel_id']))) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Parâmetro "hotel_id" é obrigatório']);
            exit;
        }

        $hotel_id = (int) $_POST['hotel_id'];

        if (!isset($_FILES['images']) || empty($_FILES['images']['name'][0])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'error' => 'Nenhum arquivo selecionado']);
            exit;
        }

        // Caminho físico base: sobe um nível saindo da pasta /api
        $base_dir = dirname(__DIR__);

        // Caminho da pasta de upload (em C:\laragon\www\blumar_legado\blumar\uploads\hotel_gallery\<id>\)
        $upload_dir = $base_dir . '/uploads/hotel_gallery/' . $hotel_id . '/';

        // Caminho web base (para gerar a URL pública)
        $base_url = BASE_URL;

        // Garante que o diretório exista
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $uploaded = [];
        $errors = [];

        foreach ($_FILES['images']['name'] as $key => $name) {
            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
                $file_tmp = $_FILES['images']['tmp_name'][$key];
                $file_ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

                if (!in_array($file_ext, $allowed_exts)) {
                    $errors[] = "Arquivo $name: extensão não permitida.";
                    continue;
                }

                // Novo nome único
                $new_name = uniqid() . '.' . $file_ext;
                $dest_path = $upload_dir . $new_name;

                // Move o arquivo
                if (move_uploaded_file($file_tmp, $dest_path)) {

                    // Gera o caminho relativo (sem C:\laragon\www...)
                    $relative_path = str_replace($base_dir . '/', '', $dest_path);

                    // Gera URL pública correta
                    $image_url = $base_url . '/' . str_replace('\\', '/', $relative_path);

                    // Insere no banco
                    $sql = "INSERT INTO conteudo_internet.hotel_gallery_image 
                        (hotel_id, image_url, title, description, ordem, created_at) 
                        VALUES ($1, $2, $3, $4, $5, NOW()) RETURNING id";

                    $title = pathinfo($name, PATHINFO_FILENAME);
                    $ordem = 0;

                    $result = pg_query_params($conn, $sql, [$hotel_id, $image_url, $title, '', $ordem]);

                    if ($result && pg_num_rows($result) > 0) {
                        $new_id = pg_fetch_result($result, 0, 'id');
                        $uploaded[] = [
                            'id' => $new_id,
                            'title' => $title,
                            'url' => $image_url
                        ];
                    } else {
                        $errors[] = "Erro ao salvar no banco: " . pg_last_error($conn);
                        unlink($dest_path);
                    }
                } else {
                    $errors[] = "Erro ao mover arquivo $name.";
                }
            } else {
                $errors[] = "Erro no upload de $name: " . $_FILES['images']['error'][$key];
            }
        }

        if (count($uploaded) > 0) {
            echo json_encode([
                'success' => true,
                'uploaded_total' => count($uploaded),
                'uploaded_files' => $uploaded,
                'errors' => $errors
            ]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => implode('; ', $errors)]);
        }
        break;

    // 🔹 LISTAR IMAGENS DE UM HOTEL
    case 'list':
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido. Use GET.']);
            exit;
        }

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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido. Use POST.']);
            exit;
        }

        $input = $_POST;

        if (empty($input['hotel_id']) || empty($input['image_url'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros obrigatórios: hotel_id, image_url']);
            exit;
        }

        $hotel_id = (int) $input['hotel_id'];
        $image_url = pg_escape_literal($conn, $input['image_url']);
        $title = !empty($input['title']) ? pg_escape_literal($conn, $input['title']) : 'NULL';
        $description = !empty($input['description']) ? pg_escape_literal($conn, $input['description']) : 'NULL';
        $ordem = isset($input['ordem']) ? (int) $input['ordem'] : 0;

        $sql = "INSERT INTO conteudo_internet.hotel_gallery_image (hotel_id, image_url, title, description, ordem)
                VALUES ($hotel_id, $image_url, $title, $description, $ordem)
                RETURNING id";

        $result = pg_query($conn, $sql);

        if (!$result) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao criar imagem: ' . pg_last_error($conn)]);
            exit;
        }

        $new_id = pg_fetch_result($result, 0, 'id');

        http_response_code(201);
        echo json_encode([
            'action' => 'create',
            'message' => 'Imagem adicionada com sucesso',
            'id' => $new_id
        ]);
        break;

    // 🔹 ATUALIZAR IMAGEM
    case 'update':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido. Use POST.']);
            exit;
        }

        $input = $_POST;

        if (empty($input['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetro "id" é obrigatório']);
            exit;
        }

        $id = (int) $input['id'];
        $title = !empty($input['title']) ? pg_escape_literal($conn, $input['title']) : 'NULL';
        $description = !empty($input['description']) ? pg_escape_literal($conn, $input['description']) : 'NULL';
        $ordem = isset($input['ordem']) ? (int) $input['ordem'] : 0;

        $sql = "UPDATE conteudo_internet.hotel_gallery_image
                SET 
                    title = $title,
                    description = $description,
                    ordem = $ordem,
                    updated_at = NOW()
                WHERE id = $id
                RETURNING id";

        $result = pg_query($conn, $sql);

        if (!$result || pg_num_rows($result) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Imagem não encontrada ou erro ao atualizar: ' . pg_last_error($conn)]);
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Método não permitido. Use POST.']);
            exit;
        }

        $input = $_POST;

        if (empty($input['id'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetro "id" é obrigatório']);
            exit;
        }

        $id = (int) $input['id'];
        $sql = "DELETE FROM conteudo_internet.hotel_gallery_image WHERE id = $id RETURNING id";

        $result = pg_query($conn, $sql);

        if (!$result || pg_num_rows($result) === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Imagem não encontrada.']);
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
        echo json_encode(['error' => 'Ação inválida. Use list, create, update, delete ou upload']);
        break;
}

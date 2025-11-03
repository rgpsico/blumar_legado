<?php

/**
 * API Única para Busca de Hotéis e Imagens
 *
 * Descrição:
 * Essa API unifica consultas de hotéis e imagens em um único endpoint.
 * Ela permite buscar hotéis por nome ou cidade, recuperar as imagens
 * associadas a um hotel específico e listar as cidades disponíveis.
 * Todos os retornos são em JSON.
 *
 * Endpoints:
 * - GET  ?action=search_hotels&query=rio
 *         → Busca hotéis por nome, produto ou palavra-chave.
 *
 * - GET  ?action=hotels_by_city&city=sao paulo
 *         → Retorna todos os hotéis de uma cidade específica.
 *
 * - GET  ?action=hotel_images&hotel_id=123
 *         → Retorna as imagens associadas a um hotel com base no campo mneu_for.
 *
 * - GET  ?action=list_cities
 *         → Lista todas as cidades com hotéis cadastrados.
 *
 * - GET  ?action=search_images&query=palavra
 *         → Busca imagens por legenda ou palavras-chave associadas.
 *
 * Métodos suportados:
 * - GET: search_hotels, hotels_by_city, hotel_images, list_cities, search_images
 *
 * Tabelas relacionadas:
 * - sbd95.fornec (dados cadastrais do hotel)
 * - conteudo_internet.ci_hotel (descrições e mídias)
 * - banco_imagem.bco_img (imagens associadas a hotéis e cidades)
 * - sbd95.cidades (lista de cidades)
 *
 * Retornos:
 * - 200: Sucesso
 * - 400: Parâmetro obrigatório ausente
 * - 404: Nenhum resultado encontrado
 * - 500: Erro interno do servidor
 *
 * Exemplo de resposta (GET ?action=search_hotels&query=rio):
 * [
 *   {
 *     "codigo": "HOTEL_RIO_PALACE",
 *     "nome": "Rio Palace Hotel",
 *     "cidade": "Rio de Janeiro",
 *     "categoria": "Hotel",
 *     "estrelas": 5,
 *     "descricao": "Hotel 5 estrelas próximo à praia de Copacabana.",
 *     "imagem_principal": "https://www.blumar.com.br/uploads/hoteis/fachadas/rio_palace.jpg"
 *   }
 * ]
 *
 * Exemplo de resposta (GET ?action=hotel_images&hotel_id=123):
 * [
 *   {
 *     "image_url": "https://www.blumar.com.br/uploads/hoteis/rio_palace_1.jpg",
 *     "legenda": "Vista da piscina",
 *     "palavras_chave": "piscina, luxo, lazer",
 *     "autor": "Gabriel Paiva"
 *   }
 * ]
 */

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../util/connection.php';

if (!isset($_GET['action']) || empty(trim($_GET['action']))) {
    http_response_code(400);
    echo json_encode(['error' => 'Parâmetro "action" é obrigatório (search_hotels, hotels_by_city, hotel_images, list_cities, search_images)']);
    exit;
}

$action = strtolower(trim($_GET['action']));

switch ($action) {
    case 'search_hotels':
        if (!isset($_GET['query']) || empty(trim($_GET['query']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetro "query" é obrigatório']);
            exit;
        }

        $busca = pg_escape_string(strtolower(trim($_GET['query'])));

        $pega_htls = "SELECT DISTINCT banco_imagem.bco_img.mneu_for,
            sbd95.fornec.nome_for as nome_for,
            nome_produto
        FROM banco_imagem.bco_img
        INNER JOIN sbd95.fornec ON banco_imagem.bco_img.mneu_for = sbd95.fornec.mneu_for
        WHERE nome_produto ILIKE LOWER('%" . $busca . "%')
        ORDER BY nome_for";

        $result_htls = pg_exec($conn, $pega_htls);

        if (!$result_htls) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro na consulta: ' . pg_last_error($conn)]);
            exit;
        }

        $hotels = [];
        for ($row = 0; $row < pg_numrows($result_htls); $row++) {
            $hotels[] = [
                'mneu_for' => pg_result($result_htls, $row, 'mneu_for'),
                'nome_for' => pg_result($result_htls, $row, 'nome_for'),
                'nome_produto' => pg_result($result_htls, $row, 'nome_produto')
            ];
        }

        echo json_encode([
            'action' => 'search_hotels',
            'total' => count($hotels),
            'query' => $busca,
            'hotels' => $hotels
        ]);
        break;

    case 'hotels_by_city':
        if (!isset($_GET['city']) || empty(trim($_GET['city']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetro "city" é obrigatório']);
            exit;
        }

        $cidade_busca = pg_escape_string(strtolower(trim($_GET['city'])));

        // Passo 1: Buscar fk_cidcod da cidade
        $pega_cidade = "SELECT DISTINCT cidade_cod
        FROM tarifario.cidade_tpo
        WHERE nome_en ILIKE LOWER('%" . $cidade_busca . "%')
        LIMIT 1";

        $result_cidade = pg_exec($conn, $pega_cidade);
        if (!$result_cidade || pg_numrows($result_cidade) == 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Cidade não encontrada']);
            exit;
        }

        $fk_cidcod = pg_result($result_cidade, 0, 'cidade_cod');

        // Passo 2: Buscar hotéis associados à cidade
        $pega_htls_cidade = "SELECT DISTINCT b.mneu_for,
            f.nome_for,
            b.nome_produto
        FROM banco_imagem.bco_img b
        INNER JOIN sbd95.fornec f ON b.mneu_for = f.mneu_for
        WHERE b.fk_cidcod = '" . $fk_cidcod . "'
        AND b.tp_produto != '10'  -- Assumindo que '10' é para cidades/imagens genéricas; ajuste se necessário
        ORDER BY f.nome_for";

        $result_htls = pg_exec($conn, $pega_htls_cidade);

        if (!$result_htls) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro na consulta: ' . pg_last_error($conn)]);
            exit;
        }

        $hotels = [];
        for ($row = 0; $row < pg_numrows($result_htls); $row++) {
            $hotels[] = [
                'mneu_for' => pg_result($result_htls, $row, 'mneu_for'),
                'nome_for' => pg_result($result_htls, $row, 'nome_for'),
                'nome_produto' => pg_result($result_htls, $row, 'nome_produto'),
                'cidade_cod' => $fk_cidcod
            ];
        }

        echo json_encode([
            'action' => 'hotels_by_city',
            'total' => count($hotels),
            'city' => $cidade_busca,
            'cidade_cod' => $fk_cidcod,
            'hotels' => $hotels
        ]);
        break;

    case 'hotel_images':
        if (!isset($_GET['hotel_id']) || empty(trim($_GET['hotel_id']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetro "hotel_id" (mneu_for) é obrigatório']);
            exit;
        }

        $mneu_for = pg_escape_string(trim($_GET['hotel_id']));

        $pega_img_htl = "SELECT pk_bco_img, tam_1, tam_2, tam_3, tam_4, fachada
        FROM banco_imagem.bco_img
        WHERE mneu_for = '" . $mneu_for . "' 
        LIMIT 5";  // Limite para múltiplas imagens; ajuste

        $result_img_htl = pg_exec($conn, $pega_img_htl);

        if (!$result_img_htl) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro na consulta: ' . pg_last_error($conn)]);
            exit;
        }

        $images = [];
        for ($row = 0; $row < pg_numrows($result_img_htl); $row++) {
            $tam_1 = pg_result($result_img_htl, $row, 'tam_1');
            $tam_2 = pg_result($result_img_htl, $row, 'tam_2');
            $tam_3 = pg_result($result_img_htl, $row, 'tam_3');
            $tam_4 = pg_result($result_img_htl, $row, 'tam_4');

            // Processa URLs (como no seu código)
            $base_url = 'https://www.blumar.com.br/';
            $img_data = [
                'pk_bco_img' => pg_result($result_img_htl, $row, 'pk_bco_img'),
                'urls' => []
            ];

            if (!empty($tam_4)) {
                $tam_4_clean = str_replace(' ', '%20', $tam_4);
                $img_data['urls']['tam_4'] = $base_url . $tam_4_clean;
            }
            if (!empty($tam_3)) {
                $tam_3_clean = str_replace(' ', '%20', $tam_3);
                $img_data['urls']['tam_3'] = $base_url . $tam_3_clean;
            }
            if (!empty($tam_2)) {
                $tam_2_clean = str_replace(' ', '%20', $tam_2);
                $img_data['urls']['tam_2'] = $base_url . $tam_2_clean;
            }
            if (!empty($tam_1)) {
                $tam_1_clean = str_replace(' ', '%20', $tam_1);
                $img_data['urls']['tam_1'] = $base_url . $tam_1_clean;
            }

            $images[] = $img_data;
        }

        echo json_encode([
            'action' => 'hotel_images',
            'hotel_id' => $mneu_for,
            'total_images' => count($images),
            'images' => $images
        ]);
        break;

    case 'list_cities':
        $pega_cidades = "SELECT cidade_cod, nome_en
        FROM tarifario.cidade_tpo
        ORDER BY nome_en";

        $result_cidades = pg_exec($conn, $pega_cidades);

        if (!$result_cidades) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro na consulta: ' . pg_last_error($conn)]);
            exit;
        }

        $cities = [];
        for ($row = 0; $row < pg_numrows($result_cidades); $row++) {
            $cities[] = [
                'cidade_cod' => pg_result($result_cidades, $row, 'cidade_cod'),
                'nome_en' => pg_result($result_cidades, $row, 'nome_en')
            ];
        }

        echo json_encode([
            'action' => 'list_cities',
            'total' => count($cities),
            'cities' => $cities
        ]);
        break;

    case 'search_images':
        if (!isset($_GET['query']) || empty(trim($_GET['query']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetro "query" é obrigatório']);
            exit;
        }

        $busca = pg_escape_string(strtolower(trim($_GET['query'])));

        // Busca em legenda OU palavras_chave (ILIKE para case-insensitive e partial match)
        $pega_img_general = "SELECT pk_bco_img, tam_1, tam_2, tam_3, tam_4, legenda, palavras_chave, tp_produto
        FROM banco_imagem.bco_img
        WHERE (legenda ILIKE LOWER('%" . $busca . "%') OR palavras_chave ILIKE LOWER('%" . $busca . "%'))
        ORDER BY legenda
        LIMIT 20";  // Limite para resultados; ajuste se necessário

        $result_img_general = pg_exec($conn, $pega_img_general);

        if (!$result_img_general) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro na consulta: ' . pg_last_error($conn)]);
            exit;
        }

        $images = [];
        for ($row = 0; $row < pg_numrows($result_img_general); $row++) {
            $tam_1 = pg_result($result_img_general, $row, 'tam_1');
            $tam_2 = pg_result($result_img_general, $row, 'tam_2');
            $tam_3 = pg_result($result_img_general, $row, 'tam_3');
            $tam_4 = pg_result($result_img_general, $row, 'tam_4');
            $legenda = pg_result($result_img_general, $row, 'legenda');
            $palavras_chave = pg_result($result_img_general, $row, 'palavras_chave');
            $tp_produto = pg_result($result_img_general, $row, 'tp_produto');

            // Processa URLs (similar ao hotel_images)
            $base_url = 'https://www.blumar.com.br/';
            $img_data = [
                'pk_bco_img' => pg_result($result_img_general, $row, 'pk_bco_img'),
                'legenda' => $legenda,
                'palavras_chave' => $palavras_chave,
                'tp_produto' => $tp_produto,
                'urls' => []
            ];

            if (!empty($tam_4)) {
                $tam_4_clean = str_replace(' ', '%20', $tam_4);
                $img_data['urls']['tam_4'] = $base_url . $tam_4_clean;
            }
            if (!empty($tam_3)) {
                $tam_3_clean = str_replace(' ', '%20', $tam_3);
                $img_data['urls']['tam_3'] = $base_url . $tam_3_clean;
            }
            if (!empty($tam_2)) {
                $tam_2_clean = str_replace(' ', '%20', $tam_2);
                $img_data['urls']['tam_2'] = $base_url . $tam_2_clean;
            }
            if (!empty($tam_1)) {
                $tam_1_clean = str_replace(' ', '%20', $tam_1);
                $img_data['urls']['tam_1'] = $base_url . $tam_1_clean;
            }

            $images[] = $img_data;
        }

        echo json_encode([
            'action' => 'search_images',
            'total_images' => count($images),
            'query' => $busca,
            'images' => $images
        ]);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Ação inválida: ' . $action . '. Use: search_hotels, hotels_by_city, hotel_images, list_cities, search_images']);
        break;
}

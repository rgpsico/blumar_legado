<?php

/**
 * API para Busca e Listagem de Logs de Downloads de Imagens
 *
 * Descrição:
 * Essa API permite consultar e listar logs de downloads de imagens realizadas
 * pelos usuários do sistema, incluindo buscas por login, cliente, tipo de imagem
 * e períodos específicos. Todos os retornos são em formato JSON e incluem
 * paginação, total de registros e metadados da ação.
 *
 * Endpoints:
 * - GET  ?action=search_logs&query=sistema  
 *         → Busca logs por login, cliente, ou termo genérico.
 *
 * - GET  ?action=search_logs_by_date&date_from=2025-10-01&date_to=2025-10-31  
 *         → Busca logs dentro de um intervalo de datas específico.
 *
 * - GET  ?action=search_logs&query=sistema&date_from=2025-10-01&date_to=2025-10-31&field=login  
 *         → Combina busca por campo (ex: login) e período de data.
 *
 * - GET  ?action=list_logs&page=1&limit=20  
 *         → Lista todos os logs com paginação.
 *
 * Parâmetros comuns:
 * - page: Página atual (default: 1)
 * - limit: Quantidade de registros por página (default: 10, máximo: 100)
 * - query: Palavra-chave para busca (login, cliente, ação, etc.)
 * - date_from: Data inicial do filtro (YYYY-MM-DD)
 * - date_to: Data final do filtro (YYYY-MM-DD)
 * - field: Campo específico de busca (ex: login, cliente, hotel_nome)
 *
 * Métodos suportados:
 * - GET: list_logs, search_logs, search_logs_by_date
 *
 * Tabelas relacionadas:
 * - conteudo_internet.log_imagem_download
 * - banco_imagem.bco_img
 * - sbd95.fornec (dados do hotel)
 * - sbd95.cidades (dados da cidade)
 *
 * Retornos:
 * - 200: Sucesso
 * - 400: Parâmetro obrigatório ausente
 * - 404: Nenhum log encontrado
 * - 405: Método HTTP não permitido
 * - 500: Erro interno no servidor
 *
 * Campos retornados:
 * - id: Identificador do log
 * - user_id: ID do usuário (ou null se anônimo)
 * - login: Login do usuário
 * - cliente: Nome do cliente ou empresa
 * - acao: Tipo de ação registrada (ex: download, visualização)
 * - pk_bco_img: ID da imagem no banco de imagens
 * - tipo_imagem: Tipo de imagem (hotel, cidade, passeio)
 * - hotel_nome: Nome do hotel associado (se aplicável)
 * - cidade_nome: Nome da cidade associada (se aplicável)
 * - imagem_nome: Nome ou legenda da imagem
 * - imagem_url: URL pública da imagem
 * - motivo_acao: Texto informando a justificativa ou origem da ação
 * - ip: Endereço IP do usuário (mascarado para privacidade)
 * - data_hora: Data e hora da ação
 *
 * Exemplo de resposta (GET ?action=list_logs&page=1&limit=2):
 * {
 *   "total": 128,
 *   "page": 1,
 *   "limit": 2,
 *   "results": [
 *     {
 *       "id": 452,
 *       "user_id": 21,
 *       "login": "joao.silva",
 *       "cliente": "Agência Brasil Tour",
 *       "acao": "download",
 *       "pk_bco_img": 9332,
 *       "tipo_imagem": "hotel",
 *       "hotel_nome": "Copacabana Palace",
 *       "cidade_nome": "Rio de Janeiro",
 *       "imagem_nome": "fachada_copacabana.jpg",
 *       "imagem_url": "https://www.blumar.com.br/uploads/hoteis/9332/fachada_copacabana.jpg",
 *       "motivo_acao": "Download realizado via portal do cliente",
 *       "ip": "201.52.xxx.xxx",
 *       "data_hora": "2025-10-21 15:23:48"
 *     },
 *     {
 *       "id": 453,
 *       "user_id": 44,
 *       "login": "ana.turismo",
 *       "cliente": "Latam Operadora",
 *       "acao": "download",
 *       "pk_bco_img": 8211,
 *       "tipo_imagem": "cidade",
 *       "hotel_nome": null,
 *       "cidade_nome": "Salvador",
 *       "imagem_nome": "salvador_pelourinho.jpg",
 *       "imagem_url": "https://www.blumar.com.br/uploads/cidades/salvador_pelourinho.jpg",
 *       "motivo_acao": "Download via área restrita",
 *       "ip": "187.29.xxx.xxx",
 *       "data_hora": "2025-10-21 16:04:10"
 *     }
 *   ]
 * }
 */


header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../util/connection.php';

if (!isset($_GET['action']) || empty(trim($_GET['action']))) {
    http_response_code(400);
    echo json_encode(['error' => 'Parâmetro "action" é obrigatório (search_logs, search_logs_by_date, list_logs)']);
    exit;
}

$action = strtolower(trim($_GET['action']));

// Parâmetros de paginação comuns
$page = max(1, (int) ($_GET['page'] ?? 1));
$limit = min(100, max(1, (int) ($_GET['limit'] ?? 10)));
$offset = ($page - 1) * $limit;

switch ($action) {
    case 'list_logs':
        // Lista todos os logs com paginação
        $count_query = "SELECT COUNT(*) as total FROM conteudo_internet.log_usuario_img";
        $result_count = pg_exec($conn, $count_query);
        if (!$result_count) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro na consulta de contagem: ' . pg_last_error($conn)]);
            exit;
        }
        $total = pg_result($result_count, 0, 'total');

        $pega_logs = "SELECT id, user_id, login, cliente, imagem_url, acao, pk_bco_img, tipo_imagem, 
                             hotel_nome, cidade_nome, 
                             CASE 
                                 WHEN LENGTH(ip) > 0 THEN SUBSTRING(ip FROM 1 FOR 7) || '***' 
                                 ELSE ip 
                             END as ip_mascarado,
                             data_hora, imagem_nome, motivo_acao
                      FROM conteudo_internet.log_usuario_img
                      ORDER BY data_hora DESC
                      LIMIT $limit OFFSET $offset";

        $result_logs = pg_exec($conn, $pega_logs);

        if (!$result_logs) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro na consulta: ' . pg_last_error($conn)]);
            exit;
        }

        $logs = [];
        for ($row = 0; $row < pg_numrows($result_logs); $row++) {
            $logs[] = [
                'id' => (int) pg_result($result_logs, $row, 'id'),
                'user_id' => (int) pg_result($result_logs, $row, 'user_id'),
                'login' => pg_result($result_logs, $row, 'login'),
                'cliente' => pg_result($result_logs, $row, 'cliente'),
                'acao' => pg_result($result_logs, $row, 'acao'),
                'imagem_url' => pg_result($result_logs, $row, 'imagem_url'),
                'pk_bco_img' => (int) pg_result($result_logs, $row, 'pk_bco_img'),
                'tipo_imagem' => pg_result($result_logs, $row, 'tipo_imagem'),
                'hotel_nome' => pg_result($result_logs, $row, 'hotel_nome'),
                'cidade_nome' => pg_result($result_logs, $row, 'cidade_nome'),
                'ip' => pg_result($result_logs, $row, 'ip_mascarado'), // Mascarado para privacidade
                'data_hora' => pg_result($result_logs, $row, 'data_hora'),
                'imagem_nome' => pg_result($result_logs, $row, 'imagem_nome'),
                'motivo_acao' => pg_result($result_logs, $row, 'motivo_acao')
            ];
        }

        echo json_encode([
            'action' => 'list_logs',
            'total' => (int) $total,
            'page' => $page,
            'limit' => $limit,
            'pages' => ceil($total / $limit),
            'logs' => $logs
        ]);
        break;

    case 'search_logs':
        if (!isset($_GET['query']) || empty(trim($_GET['query']))) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetro "query" é obrigatório para busca por nome/login/cliente']);
            exit;
        }

        $busca = pg_escape_string(strtolower(trim($_GET['query'])));
        $field = strtolower(trim($_GET['field'] ?? 'login')); // Default: login; opções: login, cliente

        // Valida campo de busca
        if (!in_array($field, ['login', 'cliente'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Campo inválido. Use: login ou cliente']);
            exit;
        }

        // Contagem com filtro
        $count_query = "SELECT COUNT(*) as total 
                        FROM conteudo_internet.log_usuario_img 
                        WHERE LOWER($field) ILIKE '%$busca%'";
        $result_count = pg_exec($conn, $count_query);
        if (!$result_count) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro na consulta de contagem: ' . pg_last_error($conn)]);
            exit;
        }
        $total = pg_result($result_count, 0, 'total');

        // Query principal (corrigida: sem espaço extra em imagem_url)
        $pega_logs = "SELECT id, user_id, login, cliente, imagem_url, acao, pk_bco_img, tipo_imagem, 
                             hotel_nome, cidade_nome, 
                             CASE 
                                 WHEN LENGTH(ip) > 0 THEN SUBSTRING(ip FROM 1 FOR 7) || '***' 
                                 ELSE ip 
                             END as ip_mascarado,
                             data_hora, imagem_nome, motivo_acao
                      FROM conteudo_internet.log_usuario_img
                      WHERE LOWER($field) ILIKE '%$busca%'
                      ORDER BY data_hora DESC
                      LIMIT $limit OFFSET $offset";

        $result_logs = pg_exec($conn, $pega_logs);

        if (!$result_logs) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro na consulta: ' . pg_last_error($conn)]);
            exit;
        }

        $logs = [];
        for ($row = 0; $row < pg_numrows($result_logs); $row++) {
            $logs[] = [
                'id' => (int) pg_result($result_logs, $row, 'id'),
                'user_id' => (int) pg_result($result_logs, $row, 'user_id'),
                'login' => pg_result($result_logs, $row, 'login'),
                'cliente' => pg_result($result_logs, $row, 'cliente'),
                'acao' => pg_result($result_logs, $row, 'acao'),
                'imagem_url' => pg_result($result_logs, $row, 'imagem_url'),
                'pk_bco_img' => (int) pg_result($result_logs, $row, 'pk_bco_img'),
                'tipo_imagem' => pg_result($result_logs, $row, 'tipo_imagem'),
                'hotel_nome' => pg_result($result_logs, $row, 'hotel_nome'),
                'cidade_nome' => pg_result($result_logs, $row, 'cidade_nome'),
                'ip' => pg_result($result_logs, $row, 'ip_mascarado'),
                'data_hora' => pg_result($result_logs, $row, 'data_hora'),
                'imagem_nome' => pg_result($result_logs, $row, 'imagem_nome'),
                'motivo_acao' => pg_result($result_logs, $row, 'motivo_acao')
            ];
        }

        echo json_encode([
            'action' => 'search_logs',
            'total' => (int) $total,
            'query' => $busca,
            'field' => $field,
            'page' => $page,
            'limit' => $limit,
            'pages' => ceil($total / $limit),
            'logs' => $logs
        ]);
        break;

    case 'search_logs_by_date':
        $date_from = trim($_GET['date_from'] ?? '');
        $date_to = trim($_GET['date_to'] ?? '');

        if (empty($date_from) || empty($date_to)) {
            http_response_code(400);
            echo json_encode(['error' => 'Parâmetros "date_from" e "date_to" (formato YYYY-MM-DD) são obrigatórios']);
            exit;
        }

        // Valida datas
        if (!DateTime::createFromFormat('Y-m-d', $date_from) || !DateTime::createFromFormat('Y-m-d', $date_to)) {
            http_response_code(400);
            echo json_encode(['error' => 'Datas inválidas. Use formato YYYY-MM-DD']);
            exit;
        }

        $date_from_escaped = pg_escape_string($date_from . ' 00:00:00');
        $date_to_escaped = pg_escape_string($date_to . ' 23:59:59');

        // Contagem com filtro de data
        $count_query = "SELECT COUNT(*) as total 
                        FROM conteudo_internet.log_usuario_img 
                        WHERE data_hora BETWEEN '$date_from_escaped' AND '$date_to_escaped'";
        $result_count = pg_exec($conn, $count_query);
        if (!$result_count) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro na consulta de contagem: ' . pg_last_error($conn)]);
            exit;
        }
        $total = pg_result($result_count, 0, 'total');

        // Query principal (adicionada imagem_url)
        $pega_logs = "SELECT id, user_id, login, cliente, imagem_url, acao, pk_bco_img, tipo_imagem, 
                             hotel_nome, cidade_nome, 
                             CASE 
                                 WHEN LENGTH(ip) > 0 THEN SUBSTRING(ip FROM 1 FOR 7) || '***' 
                                 ELSE ip 
                             END as ip_mascarado,
                             data_hora, imagem_nome, motivo_acao
                      FROM conteudo_internet.log_usuario_img
                      WHERE data_hora BETWEEN '$date_from_escaped' AND '$date_to_escaped'
                      ORDER BY data_hora DESC
                      LIMIT $limit OFFSET $offset";

        $result_logs = pg_exec($conn, $pega_logs);

        if (!$result_logs) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro na consulta: ' . pg_last_error($conn)]);
            exit;
        }

        $logs = [];
        for ($row = 0; $row < pg_numrows($result_logs); $row++) {
            $logs[] = [
                'id' => (int) pg_result($result_logs, $row, 'id'),
                'user_id' => (int) pg_result($result_logs, $row, 'user_id'),
                'login' => pg_result($result_logs, $row, 'login'),
                'cliente' => pg_result($result_logs, $row, 'cliente'),
                'acao' => pg_result($result_logs, $row, 'acao'),
                'imagem_url' => pg_result($result_logs, $row, 'imagem_url'),
                'pk_bco_img' => (int) pg_result($result_logs, $row, 'pk_bco_img'),
                'tipo_imagem' => pg_result($result_logs, $row, 'tipo_imagem'),
                'hotel_nome' => pg_result($result_logs, $row, 'hotel_nome'),
                'cidade_nome' => pg_result($result_logs, $row, 'cidade_nome'),
                'ip' => pg_result($result_logs, $row, 'ip_mascarado'),
                'data_hora' => pg_result($result_logs, $row, 'data_hora'),
                'imagem_nome' => pg_result($result_logs, $row, 'imagem_nome'),
                'motivo_acao' => pg_result($result_logs, $row, 'motivo_acao')
            ];
        }

        echo json_encode([
            'action' => 'search_logs_by_date',
            'total' => (int) $total,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'page' => $page,
            'limit' => $limit,
            'pages' => ceil($total / $limit),
            'logs' => $logs
        ]);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Ação inválida: ' . $action . '. Use: list_logs, search_logs, search_logs_by_date']);
        break;
}

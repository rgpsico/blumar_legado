<?php

/**
 * API para gerenciamento da tabela conteudo_internet.abt
 *
 * Descrição:
 * Controla a listagem, criação, atualização e exclusão de tours ABT (Around Brazil Tours),
 * incluindo informações sobre nome, datas, fotos, estilos, destinos e conteúdo diário.
 *
 * Endpoints:
 * - GET  ?request=listar_abt&nome=Rio&cidade=1001&lang=1&ativo=true&limit=100
 *         → Lista todos os ABTs filtrando por nome, cidade, idioma e status ativo.
 *
 * - GET  ?request=buscar_abt&id=123
 *         → Busca os detalhes completos de um ABT específico, incluindo tours, destinos e estilos relacionados.
 *
 * - POST ?request=criar_abt
 *         → Cria um novo ABT. 
 *           Body JSON:
 *           {
 *              "nome": "Rio Discovery Tour",
 *              "titulo": "Discover Rio in 5 Days",
 *              "data": "2025-11-15",
 *              "lang": 1,
 *              "ativo": true,
 *              "preco_abt": 1500.00,
 *              "fk_cidade_cod": 1001,
 *              "tempo_abt": "5 days",
 *              "imagens": [
 *                  {"image_url": "/images/rio_topo.jpg", "is_primary": true, "alt_text": "Foto topo"}
 *              ],
 *              "estilos": [1, 2, 3],  // Códigos de estilos
 *              "destinos": [1001]     // Códigos de cidades
 *           }
 *
 * - PUT  ?request=atualizar_abt&id=123
 *         → Atualiza campos específicos de um ABT existente.
 *           Body JSON (exemplo parcial):
 *           {
 *              "nome": "Rio Discovery Tour Atualizado",
 *              "ativo": false,
 *              "estilos": [1, 4],  // Atualiza estilos
 *              "destinos": [1001, 1002]
 *           }
 *
 * - DELETE ?request=excluir_abt&id=123
 *           → Remove o ABT e registros relacionados (tours, destinos, estilos).
 *
 * - GET ?request=listar_cidades
 *         → Lista todas as cidades disponíveis para destinos ABT (de tarifario.cidade_tpo).
 *
 * - GET ?request=listar_estilos
 *         → Lista estilos disponíveis (assumindo tabela separada ou códigos fixos).
 *
 * Métodos suportados:
 * - GET: listar_abt, buscar_abt, listar_cidades, listar_estilos
 * - POST: criar_abt
 * - PUT: atualizar_abt
 * - DELETE: excluir_abt
 *
 * Tabelas relacionadas:
 * - conteudo_internet.abt
 * - conteudo_internet.abt_conteudo (tours/dias)
 * - conteudo_internet.abt_destinos
 * - conteudo_internet.abt_estilos
 * - tarifario.cidade_tpo (cidades)
 *
 * Retornos:
 * - 200: Sucesso
 * - 201: Criado
 * - 400: Erro de parâmetro
 * - 404: Registro não encontrado
 * - 405: Método não permitido
 * - 500: Erro interno
 */

// ========================================
// 🔧 CONFIGURAÇÕES INICIAIS
// ========================================
date_default_timezone_set('America/Sao_Paulo');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../util/connection.php';

$BASE_URL_IMAGEM = "https://www.blumar.com.br/"; // Ajuste se necessário para ABT

// Função padrão de resposta JSON
function response($data, $code = 200)
{
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

// Função auxiliar para montar array de imagens (foto1-4 como array)
function montarImagensAbt(&$row, $baseUrl)
{
    $row['imagens'] = [];
    $fotoCampos = ['foto1', 'foto2', 'foto3', 'foto4'];
    foreach ($fotoCampos as $index => $campo) {
        if (!empty($row[$campo])) {
            $row['imagens'][] = [
                'image_url' => $baseUrl . $row[$campo],
                'is_primary' => $index === 0,
                'alt_text' => $index === 0 ? 'Foto principal' : 'Foto secundária'
            ];
        }
    }
    // Limpa campos legados se quiser (opcional)
    // unset($row['foto1'], $row['foto2'], $row['foto3'], $row['foto4']);
}

// Função para montar URLs extras (ex: foto_topo, foto_campo)
function montarUrlsExtras(&$row, $baseUrl)
{
    $urlCampos = ['foto_topo', 'foto_campo', 'foto_topo_bpass'];
    foreach ($urlCampos as $campo) {
        if (!empty($row[$campo])) {
            $row[$campo] = $baseUrl . $row[$campo];
        }
    }
}

// Função para buscar tours relacionados (abt_conteudo)
function buscarToursAbt($conn, $pk_abt)
{
    $sql = "SELECT * FROM conteudo_internet.abt_conteudo WHERE fk_abt = $1 ORDER BY dia_conteudo";
    $result = pg_query_params($conn, $sql, [$pk_abt]);
    $tours = [];
    while ($row = pg_fetch_assoc($result)) {
        $tours[] = $row;
    }
    return $tours;
}

// Função para buscar destinos (abt_destinos)
function buscarDestinosAbt($conn, $pk_abt)
{
    $sql = "
        SELECT ad.*, ct.nome_en AS city_name
        FROM conteudo_internet.abt_destinos ad
        LEFT JOIN tarifario.cidade_tpo ct ON ct.cidade_cod = ad.fk_cidade_cod
        WHERE ad.fk_abt = $1
    ";
    $result = pg_query_params($conn, $sql, [$pk_abt]);
    $destinos = [];
    while ($row = pg_fetch_assoc($result)) {
        $destinos[] = $row;
    }
    return $destinos;
}

// Função para buscar estilos (abt_estilos)
function buscarEstilosAbt($conn, $pk_abt)
{
    $sql = "SELECT * FROM conteudo_internet.abt_estilos WHERE fk_abt = $1";
    $result = pg_query_params($conn, $sql, [$pk_abt]);
    $estilos = [];
    while ($row = pg_fetch_assoc($result)) {
        $estilos[] = $row;
    }
    return $estilos;
}

// Helper para formatar strings (NULL se vazio)
function formatString($value)
{
    if ($value === null || $value === '') return 'NULL';
    return "'" . pg_escape_string($value) . "'";
}

// Helper para formatar inteiros (NULL se inválido)
function formatInt($value)
{
    if ($value === null || $value === '' || !is_numeric($value)) return 'NULL';
    return (int)$value;
}

// Helper para formatar numéricos (float)
function formatNumeric($value)
{
    if ($value === null || $value === '' || !is_numeric($value)) return 'NULL';
    return (float)$value;
}

// Helper para tratar booleanos
function tratarBoolean($valor)
{
    if ($valor === '' || $valor === null) {
        return 'NULL';
    }
    if (in_array(strtolower($valor), ['true', '1', 's', 'sim', 'yes', 't'])) {
        return 'TRUE';
    }
    return 'FALSE';
}

// Helper para escapar strings para SQL
function escapeStringSql($conn, $value)
{
    $raw = $value ?? '';
    return pg_escape_literal($conn, $raw);
}

// Helper para formatar text or null
function formatTextOrNull($conn, $str)
{
    $raw = $str ?? '';
    return (strlen($raw) === 0) ? 'NULL' : escapeStringSql($conn, $raw);
}

// Helper para formatar int or null
function formatIntOrNull($str)
{
    $raw = $str ?? '';
    return (strlen($raw) === 0) ? 'NULL' : (int)$raw;
}

// Helper para formatar numeric or null
function formatNumericOrNull($str)
{
    $raw = $str ?? '';
    return (strlen($raw) === 0) ? 'NULL' : (float)$raw;
}

$request = isset($_GET['request']) ? $_GET['request'] : null;
if (!$request) {
    response(["error" => "Parâmetro 'request' é obrigatório"], 400);
}

// Verificação de método HTTP
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true) ?? []; // Para POST/PUT

try {
    switch ($request) {

        // =========================================================
        // 🔹 ROTA 1: Listar ABTs (GET)
        // =========================================================
        case 'listar_abt':
            if ($method !== 'GET') response(["error" => "Método não permitido. Use GET."], 405);

            $nome = isset($_GET['nome']) ? $_GET['nome'] : null;
            $cidade = isset($_GET['cidade']) ? $_GET['cidade'] : null;
            $lang = isset($_GET['lang']) ? $_GET['lang'] : null;
            $ativo = isset($_GET['ativo']) ? $_GET['ativo'] : null;
            $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 200;

            $params = [];
            $idx = 1;
            $where = [];

            if ($nome) {
                $where[] = "a.nome ILIKE $" . $idx++;
                $params[] = "%$nome%";
            }
            if ($cidade) {
                $where[] = "ad.fk_cidade_cod = $" . $idx++;
                $params[] = (int)$cidade;
            }
            if ($lang) {
                $where[] = "a.lang = $" . $idx++;
                $params[] = (int)$lang;
            }
            if ($ativo !== null) {
                $where[] = "a.ativo = $" . $idx++;
                $params[] = $ativo === 'true' ? 't' : 'f';
            }

            $join_destinos = !empty($cidade) ? "LEFT JOIN conteudo_internet.abt_destinos ad ON ad.fk_abt = a.pk_abt" : "";
            $where_sql = count($where) ? "WHERE " . implode(" AND ", $where) : "";
            $params[] = $limit;

            $sql = "
                SELECT DISTINCT a.* 
                FROM conteudo_internet.abt a
                $join_destinos
                {$where_sql}
                ORDER BY a.nome
                LIMIT $" . $idx . "
            ";

            $result = pg_query_params($conn, $sql, $params);
            if (!$result) throw new Exception(pg_last_error($conn));

            $abts = [];
            while ($row = pg_fetch_assoc($result)) {
                // Mapeamentos para frontend
                $row['name'] = $row['nome'];
                $row['description'] = $row['campo_livre'];
                $row['is_active'] = $row['ativo'] == 't';

                // Montar imagens e extras
                montarImagensAbt($row, $BASE_URL_IMAGEM);
                montarUrlsExtras($row, $BASE_URL_IMAGEM);

                $abts[] = $row;
            }

            response($abts);
            break;

        // =========================================================
        // 🔹 ROTA 2: Buscar ABT específico por ID (GET)
        // =========================================================
        case 'buscar_abt':
            if ($method !== 'GET') response(["error" => "Método não permitido. Use GET."], 405);

            $id = isset($_GET['id']) ? $_GET['id'] : null;
            if (!$id) response(["error" => "ID é obrigatório"], 400);

            $sql = "
                SELECT a.*, ct.nome_en AS city_name
                FROM conteudo_internet.abt a
                LEFT JOIN tarifario.cidade_tpo ct ON ct.cidade_cod = a.fk_cidade_cod
                WHERE a.pk_abt = $1
                LIMIT 1
            ";
            $result = pg_query_params($conn, $sql, [$id]);
            if (!$result || pg_num_rows($result) === 0) {
                response(["error" => "ABT não encontrado"], 404);
            }

            $abt = pg_fetch_assoc($result);

            // Mapeamentos para frontend
            $abt['name'] = $abt['nome'];
            $abt['description'] = $abt['campo_livre'];
            $abt['is_active'] = $abt['ativo'] == 't';
            $abt['city'] = $abt['city_name'] ?: $abt['fk_cidade_cod'];
            $abt['price'] = (float)$abt['preco_abt'];
            $abt['capacity'] = (int)$abt['tempo_abt']; // Adaptado, se aplicável

            // Buscar relacionados
            $abt['tours'] = buscarToursAbt($conn, $id);
            $abt['destinos'] = buscarDestinosAbt($conn, $id);
            $abt['estilos'] = buscarEstilosAbt($conn, $id);

            // Montar imagens e extras
            montarImagensAbt($abt, $BASE_URL_IMAGEM);
            montarUrlsExtras($abt, $BASE_URL_IMAGEM);

            response($abt);
            break;

        // =========================================================
        // 🔹 ROTA 3: Criar ABT (POST)
        // =========================================================
        case 'criar_abt':
            if ($method !== 'POST') response(["error" => "Método não permitido. Use POST."], 405);

            if (empty($input)) response(["error" => "Dados do ABT são obrigatórios no body JSON"], 400);

            // Campos principais (baseado no schema de abt)
            $campos = [
                'nome',
                'data',
                'foto_topo',
                'titulo',
                'campo_livre',
                'foto_campo',
                'foto_topo_bpass',
                'foto1',
                'foto2',
                'foto3',
                'foto4',
                'ativo',
                'ativo_home',
                'topo_brasil_pass',
                'ativo_riolife',
                'lang',
                'preco_abt',
                'fk_cidade_cod',
                'tempo_abt',
                'new_mod',
                'link_quotes',
                'link_quotes_be',
                'classic',
                'romantic',
                'family',
                'beach',
                'boat',
                'special_interest',
                'adventure',
                'cultural',
                'active',
                'nature',
                'food_drinks',
                'night_out'
            ];

            $params = [];
            $placeholders = [];
            $idx = 1;

            foreach ($campos as $campo) {
                $valor = $input[$campo] ?? null;
                // Mapeamentos de entrada
                if ($campo === 'nome' && isset($input['name'])) $valor = $input['name'];
                if ($campo === 'campo_livre' && isset($input['description'])) $valor = $input['description'];
                if ($campo === 'titulo' && isset($input['titulo'])) $valor = $input['titulo'];
                if ($campo === 'ativo' && isset($input['is_active'])) $valor = (bool)$input['is_active'];
                if ($campo === 'tempo_abt' && isset($input['duration'])) $valor = $input['duration'];

                // Casts
                if (in_array($campo, ['ativo', 'ativo_home', 'topo_brasil_pass', 'ativo_riolife', 'classic', 'romantic', 'family', 'beach', 'boat', 'special_interest', 'adventure', 'cultural', 'active', 'nature', 'food_drinks', 'night_out', 'new_mod'])) {
                    $params[] = !empty($valor) ? 't' : 'f';
                } elseif (in_array($campo, ['lang', 'fk_cidade_cod'])) {
                    $params[] = !empty($valor) ? (int)$valor : null;
                } elseif (in_array($campo, ['preco_abt'])) {
                    $params[] = !empty($valor) ? (float)$valor : null;
                } else {
                    $params[] = $valor;
                }
                $placeholders[] = '$' . $idx++;
            }

            $sql = "
                INSERT INTO conteudo_internet.abt (" . implode(',', $campos) . ")
                VALUES (" . implode(',', $placeholders) . ")
                RETURNING pk_abt
            ";

            $result = pg_query_params($conn, $sql, $params);
            if (!$result) {
                throw new Exception("Erro ao inserir ABT: " . pg_last_error($conn));
            }

            $row = pg_fetch_assoc($result);
            $abt_id = $row['pk_abt'];

            // Inserção de destinos (array)
            if (!empty($input['destinos']) && is_array($input['destinos'])) {
                foreach ($input['destinos'] as $dest_cod) {
                    if (!is_numeric($dest_cod)) continue;
                    $sql_dest = "
                        INSERT INTO conteudo_internet.abt_destinos (fk_cidade_cod, fk_abt)
                        VALUES ($1, $2)
                    ";
                    pg_query_params($conn, $sql_dest, [(int)$dest_cod, $abt_id]);
                }
            }

            // Inserção de estilos (array)
            if (!empty($input['estilos']) && is_array($input['estilos'])) {
                foreach ($input['estilos'] as $estilo_cod) {
                    if (!is_numeric($estilo_cod)) continue;
                    $sql_est = "
                        INSERT INTO conteudo_internet.abt_estilos (fk_abt, cod_estilo)
                        VALUES ($1, $2)
                    ";
                    pg_query_params($conn, $sql_est, [$abt_id, (int)$estilo_cod]);
                }
            }

            // Inserção de imagens (priorize 'imagens' array, fallback foto1-4)
            if (!empty($input['imagens']) && is_array($input['imagens'])) {
                // Assumindo tabela venue_images-like para abt, ou atualize foto1-4 diretamente
                // Para simplicidade, atualize foto1-4 se não houver tabela separada
                $fotoMapping = ['foto1', 'foto2', 'foto3', 'foto4'];
                foreach ($input['imagens'] as $index => $img) {
                    if ($index >= count($fotoMapping)) break;
                    if (empty($img['image_url'])) continue;
                    $update_sql = "UPDATE conteudo_internet.abt SET " . $fotoMapping[$index] . " = $1 WHERE pk_abt = $2";
                    pg_query_params($conn, $update_sql, [$img['image_url'], $abt_id]);
                }
            }

            response([
                'success' => true,
                'message' => 'ABT inserido com sucesso!',
                'abt_id' => $abt_id
            ], 201);
            break;

        // =========================================================
        // 🔹 ROTA 4: Atualizar ABT (PUT)
        // =========================================================
        case 'atualizar_abt':
            if ($method !== 'PUT') response(["error" => "Método não permitido. Use PUT."], 405);

            $id = isset($_GET['id']) ? $_GET['id'] : null;
            if (!$id) response(["error" => "ID é obrigatório"], 400);

            if (empty($input)) response(["error" => "Dados do ABT são obrigatórios no body JSON"], 400);

            // Mapeamento de campos
            $mapeamentos = [
                'name' => 'nome',
                'description' => 'campo_livre',
                'titulo' => 'titulo',
                'is_active' => 'ativo',
                'duration' => 'tempo_abt',
                'price' => 'preco_abt',
                'foto1' => 'foto1',
                'foto2' => 'foto2',
                'foto3' => 'foto3',
                'foto4' => 'foto4',
                'foto_topo' => 'foto_topo',
                'foto_campo' => 'foto_campo'
            ];

            $tipos_campos = [
                'ativo' => 'boolean',
                'ativo_home' => 'boolean',
                'topo_brasil_pass' => 'boolean',
                'ativo_riolife' => 'boolean',
                'lang' => 'integer',
                'fk_cidade_cod' => 'integer',
                'preco_abt' => 'numeric',
                'classic' => 'boolean',
                // ... todos booleans de estilos
            ];

            $campos_invalidos = ['rating', 'images', 'tours', 'destinos', 'estilos']; // Não atualizar via main

            $set = [];
            $params = [];
            $idx = 1;
            $usedFields = [];

            foreach ($input as $chave_original => $valor) {
                if (in_array($chave_original, ['id', 'pk_abt'])) continue;
                if (in_array($chave_original, $campos_invalidos)) continue;
                if (is_array($valor)) continue;

                $campo = $mapeamentos[$chave_original] ?? $chave_original;
                if (in_array($campo, $usedFields)) continue;
                $usedFields[] = $campo;

                $tipo = $tipos_campos[$campo] ?? null;
                if ($tipo === 'boolean') {
                    $valor_cast = (!empty($valor) && $valor !== 'false' && $valor !== '0') ? 't' : 'f';
                } elseif (in_array($tipo, ['numeric', 'integer'])) {
                    $valor_cast = ($valor !== '' && $valor !== null) ? ($tipo === 'integer' ? (int)$valor : (float)$valor) : null;
                } else {
                    $valor_cast = $valor;
                }

                $set[] = "$campo = $" . $idx++;
                $params[] = $valor_cast;
            }

            // Atualização de destinos e estilos (arrays)
            if (!empty($input['destinos']) && is_array($input['destinos'])) {
                // Limpa antigos
                pg_query_params($conn, "DELETE FROM conteudo_internet.abt_destinos WHERE fk_abt = $1", [$id]);
                // Insere novos
                foreach ($input['destinos'] as $dest_cod) {
                    if (!is_numeric($dest_cod)) continue;
                    $sql_dest = "
                        INSERT INTO conteudo_internet.abt_destinos (fk_cidade_cod, fk_abt)
                        VALUES ($1, $2)
                    ";
                    pg_query_params($conn, $sql_dest, [(int)$dest_cod, $id]);
                }
            }

            if (!empty($input['estilos']) && is_array($input['estilos'])) {
                // Limpa antigos
                pg_query_params($conn, "DELETE FROM conteudo_internet.abt_estilos WHERE fk_abt = $1", [$id]);
                // Insere novos
                foreach ($input['estilos'] as $estilo_cod) {
                    if (!is_numeric($estilo_cod)) continue;
                    $sql_est = "
                        INSERT INTO conteudo_internet.abt_estilos (fk_abt, cod_estilo)
                        VALUES ($1, $2)
                    ";
                    pg_query_params($conn, $sql_est, [$id, (int)$estilo_cod]);
                }
            }

            // Manipulação de imagens
            $imagesUpdated = false;
            if (!empty($input['imagens']) && is_array($input['imagens'])) {
                $fotoMapping = ['foto1', 'foto2', 'foto3', 'foto4'];
                foreach ($input['imagens'] as $index => $img) {
                    if ($index >= count($fotoMapping)) break;
                    if (empty($img['image_url'])) continue;
                    if (!in_array($fotoMapping[$index], $usedFields)) {
                        $set[] = $fotoMapping[$index] . " = $" . $idx++;
                        $params[] = $img['image_url'];
                        $usedFields[] = $fotoMapping[$index];
                    }
                }
                $imagesUpdated = true;
            }

            if (empty($set) && !$imagesUpdated) {
                response(["success" => false, "message" => "Nenhuma alteração realizada"], 200);
            }

            $params[] = $id;
            $sql = "
                UPDATE conteudo_internet.abt
                SET " . implode(', ', $set) . "
                WHERE pk_abt = $" . $idx . "
            ";

            $result = pg_query_params($conn, $sql, $params);
            if (!$result) {
                throw new Exception("Database update failed: " . pg_last_error($conn));
            }

            $affected_rows = pg_affected_rows($result);
            if ($affected_rows > 0 || $imagesUpdated) {
                response([
                    'success' => true,
                    'message' => 'ABT atualizado com sucesso! Linhas afetadas: ' . $affected_rows
                ]);
            } else {
                response([
                    'success' => false,
                    'message' => 'Nenhuma linha atualizada',
                    'affected_rows' => $affected_rows
                ], 200);
            }
            break;

        // =========================================================
        // 🔹 ROTA 5: Excluir ABT (DELETE)
        // =========================================================
        case 'excluir_abt':
            if ($method !== 'DELETE') response(["error" => "Método não permitido. Use DELETE."], 405);

            $id = isset($_GET['id']) ? $_GET['id'] : null;
            if (!$id) response(["error" => "ID é obrigatório"], 400);

            // Deleta relacionados (cascade ou manual)
            pg_query_params($conn, "DELETE FROM conteudo_internet.abt_conteudo WHERE fk_abt = $1", [$id]);
            pg_query_params($conn, "DELETE FROM conteudo_internet.abt_destinos WHERE fk_abt = $1", [$id]);
            pg_query_params($conn, "DELETE FROM conteudo_internet.abt_estilos WHERE fk_abt = $1", [$id]);

            $sql = "DELETE FROM conteudo_internet.abt WHERE pk_abt = $1";
            $result = pg_query_params($conn, $sql, [$id]);
            if (!$result) {
                throw new Exception(pg_last_error($conn));
            }

            $affected_rows = pg_affected_rows($result);
            if ($affected_rows > 0) {
                response(["success" => true, "message" => "ABT excluído com sucesso"]);
            } else {
                response(["error" => "ABT não encontrado"], 404);
            }
            break;

        // =========================================================
        // 🔹 ROTA AUX: Listar cidades para destinos (GET)
        // =========================================================
        case 'listar_cidades':
            if ($method !== 'GET') response(["error" => "Método não permitido. Use GET."], 405);

            $sql = "SELECT cidade_cod AS id, nome_en AS name, nome_pt AS name_pt FROM tarifario.cidade_tpo ORDER BY nome_en ASC";
            $result = pg_query($conn, $sql);
            $cidades = [];
            if ($result) {
                while ($row = pg_fetch_assoc($result)) {
                    $cidades[] = $row;
                }
            }

            response($cidades);
            break;

        // =========================================================
        // 🔹 ROTA AUX: Listar estilos (GET) - Assumindo códigos fixos ou tabela separada
        // =========================================================
        case 'listar_estilos':
            if ($method !== 'GET') response(["error" => "Método não permitido. Use GET."], 405);

            // Exemplo: estilos fixos (ajuste para query real se houver tabela)
            $estilos = [
                ['id' => 1, 'name' => 'Classic'],
                ['id' => 2, 'name' => 'Beach'],
                ['id' => 3, 'name' => 'Family'],
                // Adicione mais
            ];

            response($estilos);
            break;

        default:
            response(["error" => "Rota inválida"], 400);
    }
} catch (Exception $e) {
    error_log("Erro na API de ABT: " . $e->getMessage());
    response(["error" => "Erro no servidor: " . $e->getMessage()], 500);
}

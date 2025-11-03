<?php

/**
 * API para gerenciamento da tabela conteudo_internet.ci_hotel
 *
 * Descrição:
 * Fornece endpoints para listagem, busca, criação, atualização e exclusão de hotéis
 * cadastrados na base de dados da Blumar. Essa API unifica informações das tabelas
 * `sbd95.fornec` e `conteudo_internet.ci_hotel`, incluindo imagens, vídeos, tour 360,
 * descrições multilíngues e metadados associados.
 *
 * Endpoints:
 * - GET  ?request=listar_hoteis&cidade=Rio de Janeiro&nome=Copacabana&limit=50  
 *         → Lista hotéis filtrando por cidade e/ou nome.
 *
 * - GET  ?request=buscar_hotel&id=123  
 *         → Retorna os dados completos de um hotel (nome, endereço, imagens, descrições, etc).
 *
 * - POST ?request=criar_hotel  
 *         → Cria um novo registro de hotel.
 *           Body JSON (exemplo simplificado):
 *           {
 *              "mneu_for": "HOTEL_COPA",
 *              "descricao_pt": "Hotel localizado em Copacabana com vista para o mar.",
 *              "descricao_en": "Hotel located in Copacabana with sea view.",
 *              "foto_fachada": "uploads/hoteis/fachada.jpg",
 *              "url_video": "uploads/videos/copa.mp4",
 *              "flaghtl": true,
 *              "resort": false,
 *              "facilities": "pool,spa,restaurant"
 *           }
 *
 * - PUT  ?request=atualizar_hotel&id=123  
 *         → Atualiza um hotel existente.  
 *           Body JSON (exemplo):
 *           {
 *              "mneu_for": "HOTEL_COPA",
 *              "descricao_pt": "Descrição atualizada",
 *              "foto_fachada": "uploads/hoteis/nova_fachada.jpg",
 *              "luxury": true
 *           }
 *
 * - DELETE ?request=excluir_hotel&id=123  
 *           → Remove o hotel informado (por frncod ou mneu_for) e seus dados relacionados.
 *
 * Métodos suportados:
 * - GET: listar_hoteis, buscar_hotel
 * - POST: criar_hotel
 * - PUT: atualizar_hotel
 * - DELETE: excluir_hotel
 *
 * Tabelas relacionadas:
 * - conteudo_internet.ci_hotel (principal)
 * - sbd95.fornec (dados de cadastro e cidade)
 * - conteudo_internet.ci_apartamento (tipos de apartamentos)
 * - conteudo_internet.ci_hotel_facilidade (facilidades)
 * - conteudo_internet.log_adm_conteudo (logs administrativos)
 *
 * Retornos:
 * - 200: Sucesso
 * - 201: Criado com sucesso
 * - 400: Requisição inválida (parâmetros obrigatórios ausentes)
 * - 404: Registro não encontrado
 * - 405: Método HTTP não permitido
 * - 409: Conflito (registro duplicado)
 * - 500: Erro interno no servidor
 *
 * Exemplo de resposta (GET buscar_hotel):
 * {
 *   "codigo": "HOTEL_COPA",
 *   "nome": "Copacabana Palace",
 *   "cidade": "Rio de Janeiro",
 *   "uf": "RJ",
 *   "quartos": 239,
 *   "estrelas": 5,
 *   "descricao": "Hotel de luxo icônico no Rio de Janeiro.",
 *   "imagem_fachada": "https://www.blumar.com.br/uploads/fachadas/copa.jpg",
 *   "video_url": "https://www.blumar.com.br/uploads/videos/copa.mp4",
 *   "tour_360_url": "https://www.blumar.com.br/uploads/tour360/copa.html"
 * }
 */


// ========================================
// 🔧 CONFIGURAÇÕES INICIAIS
// ========================================

date_default_timezone_set('America/Sao_Paulo');

// Configuração de CORS - Adicione isso no topo do arquivo
header('Access-Control-Allow-Origin: https://webdeveloper.blumar.com.br');  // Origem específica do frontend (mude para '*' em dev se precisar)
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
header('Access-Control-Allow-Credentials: true');  // Se precisar de cookies/sessões

// Lidar com preflight (OPTIONS) - retorna 200 sem processar o resto
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit(0);
}
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../util/connection.php';

$BASE_URL_IMAGEM = "https://www.blumar.com.br/";

// Função padrão de resposta JSON
function response($data, $code = 200)
{
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

// Função auxiliar para montar URLs completas de imagens
function montarUrlsImagens(&$row, $baseUrl)
{
    $campos_imagem = [
        'imagem_fachada' => 'htlimgfotofachada',
        'imagem_piscina' => 'htlfotopiscina',
        'fotoextra' => 'fotoextra',
        'fotoextra_recep' => 'fotoextra_recep',
        'ft_resort1' => 'ft_resort1',
        'ft_resort2' => 'ft_resort2',
        'ft_resort3' => 'ft_resort3',
        'fotofachada_tbn' => 'fotofachada_tbn',
        'map_eco' => 'map_eco'
    ];

    foreach ($campos_imagem as $campo_json => $campo_banco) {
        if (!empty($row[$campo_banco])) {
            $row[$campo_json] = $baseUrl . $row[$campo_banco];
        } else {
            $row[$campo_json] = null;
        }
    }

    // Também montar URL para vídeo e tour 360 (se armazenados no banco)
    if (!empty($row['url_video'])) {
        $row['video_url'] = $baseUrl . $row['url_video'];
    } else {
        $row['video_url'] = null;
    }

    if (!empty($row['url_htl_360'])) {
        $row['tour_360_url'] = $baseUrl . $row['url_htl_360'];
    } else {
        $row['tour_360_url'] = null;
    }
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

// Helper para tratar booleanos
function tratarBoolean($valor)
{
    if ($valor === '' || $valor === null) {
        return 'NULL';
    }
    // Aceita: true, 'true', 1, '1', 'S', 's', 'sim', 'yes'
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
        // 🔹 ROTA 1: Buscar hotel específico (GET)
        // =========================================================
        case 'buscar_hotel':
            if ($method !== 'GET') response(["error" => "Método não permitido. Use GET."], 405);

            $id = isset($_GET['id']) ? $_GET['id'] : null;
            if (!$id) response(["error" => "ID é obrigatório"], 400);

            $sql = "
                SELECT 
                    f.mneu_for AS codigo,
                    f.nome_for AS nome,
                    f.razao_soc AS razao,
                    f.endereco,
                    f.bairro,
                    f.cidade,
                    f.estado AS uf,
                    f.pais,
                    f.cep,
                    f.tel1,
                    f.mail AS email,
                    f.categ AS categoria,
                    f.classif AS classificacao,
                    f.tot_rooms AS quartos,
                    f.web_blumar,
                    f.web_nac,
                    f.status,
                    ci.htlurl as googlemapa,
                    ci.htlestrelablumar AS estrelas,
                    ci.htldsc AS descricao,
                    ci.htldscing AS descricao_ingles,
                    ci.htldscesp AS descricao_espanhol,
                    ci.htlimgfotofachada,
                    ci.htlfotopiscina,
                    ci.url_video,
                    ci.url_htl_360,
                    ci.fotoextra,
                    ci.fotoextra_recep,
                    ci.ft_resort1,
                    ci.ft_resort2,
                    ci.ft_resort3,
                    ci.fotofachada_tbn,
                    ci.map_eco,
                    ci.htlendrua AS rua,
                    ci.htlendnum AS numero,
                    ci.htlendbairro AS bairro_endereco,
                    ci.htlendcep AS cep_endereco
                FROM sbd95.fornec f
                LEFT JOIN conteudo_internet.ci_hotel ci 
                    ON f.mneu_for = ci.mneu_for
                WHERE f.mneu_for = $1
                LIMIT 1
            ";

            $result = pg_query_params($conn, $sql, [$id]);
            if (!$result || pg_num_rows($result) === 0) {
                response(["error" => "Hotel não encontrado"], 404);
            }

            $hotel = pg_fetch_assoc($result);
            $hotel['estrelas'] = (int)$hotel['estrelas'];
            $hotel['quartos'] = (int)$hotel['quartos'];
            $hotel['status'] = ($hotel['status'] === 't' || $hotel['status'] === true);

            // 🔸 Montar URLs de imagens
            montarUrlsImagens($hotel, $BASE_URL_IMAGEM);

            response($hotel);
            break;

        // =========================================================
        // 🔹 ROTA 2: Listar hotéis (GET)
        // =========================================================
        case 'listar_hoteis':
            if ($method !== 'GET') response(["error" => "Método não permitido. Use GET."], 405);

            $cidade = isset($_GET['cidade']) ? $_GET['cidade'] : null;
            $nome = isset($_GET['nome']) ? $_GET['nome'] : null;
            $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 200;

            $params = [];
            $param_index = 1;
            $where = ["f.categ = 'Hotel'", "f.status = true"];

            if ($cidade) {
                $where[] = "f.cidade ILIKE $" . $param_index++;
                $params[] = "%$cidade%";
            }

            if ($nome) {
                $where[] = "f.nome_for ILIKE $" . $param_index++;
                $params[] = "%$nome%";
            }

            $where_sql = "WHERE " . implode(" AND ", $where);
            $limit_sql = "LIMIT $" . $param_index++;
            $params[] = $limit;

            $sql = "
                SELECT 
                    f.mneu_for AS codigo,
                    f.nome_for AS nome,
                    f.cidade,
                    f.estado AS uf,
                    ci.htl_num_quartos AS quartos,
                    f.mail AS email,
                    f.categ AS categoria,
                    f.classif AS classificacao,
                    f.web_blumar,
                    f.web_nac,
                    f.status,
                    ci.htlestrelablumar AS estrelas,
                    ci.htlurl as googlemapa,
                    -- 👇 Campos de descrição adicionados
                    ci.htldsc AS descricao,
                    ci.htldscing AS descricao_ingles,
                    ci.htldscesp AS descricao_espanhol,
                    -- 👇 Campos de imagens
                    ci.htlimgfotofachada,
                    ci.htlfotopiscina,
                    ci.url_video,
                    ci.url_htl_360,
                    ci.fotoextra,
                    ci.fotoextra_recep,
                    ci.ft_resort1,
                    ci.ft_resort2,
                    ci.ft_resort3,
                    ci.fotofachada_tbn,
                    ci.map_eco
                FROM sbd95.fornec f
                LEFT JOIN conteudo_internet.ci_hotel ci 
                    ON f.mneu_for = ci.mneu_for
                {$where_sql}
                ORDER BY f.nome_for
                {$limit_sql}
            ";

            $result = pg_query_params($conn, $sql, $params);
            if (!$result) throw new Exception(pg_last_error($conn));

            $hoteis = [];
            while ($row = pg_fetch_assoc($result)) {
                $row['estrelas'] = (int)$row['estrelas'];
                $row['quartos'] = (int)$row['quartos'];
                $row['status'] = ($row['status'] === 't' || $row['status'] === true);

                // 🔸 Montar URLs de imagens
                montarUrlsImagens($row, $BASE_URL_IMAGEM);

                $hoteis[] = $row;
            }

            response($hoteis);
            break;

        // =========================================================
        // 🔹 ROTA 3: Criar hotel (POST)
        // =========================================================
        case 'criar_hotel':
            if ($method !== 'POST') response(["error" => "Método não permitido. Use POST."], 405);

            if (empty($input)) response(["error" => "Dados do hotel são obrigatórios no body JSON"], 400);

            $mneu_for = $input["mneu_for"] ?? '';
            if (empty($mneu_for)) response(["error" => "mneu_for é obrigatório"], 400);

            // Verificar se já existe
            $check_sql = "SELECT EXISTS(SELECT 1 FROM conteudo_internet.ci_hotel WHERE mneu_for = $1)";
            $check_result = pg_query_params($conn, $check_sql, [$mneu_for]);
            $exists = pg_fetch_row($check_result)[0] === 't';
            if ($exists) {
                response(["error" => "Hotel com mneu_for já existe"], 409);
            }

            // Campos de texto
            $nome_htl = $mneu_for;
            $descricao_pt = formatString($input["descricao_pt"] ?? null);
            $descricao_en = formatString($input["descricao_en"] ?? null);
            $descricao_esp = formatString($input["descricao_esp"] ?? null);
            $descesp_grpfit = formatString($input["descesp_grpfit"] ?? null);
            $regime_hotel_pt = formatString($input["regime_hotel_pt"] ?? null);
            $regime_hotel_en = formatString($input["regime_hotel_en"] ?? null);
            $regime_hotel_esp = formatString($input["regime_hotel_esp"] ?? null);
            $rec_entret_pt = formatString($input["rec_entret_pt"] ?? null);
            $rec_entret_en = formatString($input["rec_entret_en"] ?? null);
            $rec_entret_esp = formatString($input["rec_entret_esp"] ?? null);
            $otras_ativ_pt = formatString($input["otras_ativ_pt"] ?? null);
            $otras_ativ_en = formatString($input["otras_ativ_en"] ?? null);
            $otras_ativ_esp = formatString($input["otras_ativ_esp"] ?? null);
            $alojamiento_pt = formatString($input["alojamiento_pt"] ?? null);
            $alojamiento_en = formatString($input["alojamiento_en"] ?? null);
            $alojamiento_esp = formatString($input["alojamiento_esp"] ?? null);
            $gastronomia_pt = formatString($input["gastronomia_pt"] ?? null);
            $gastronomia_en = formatString($input["gastronomia_en"] ?? null);
            $gastronomia_esp = formatString($input["gastronomia_esp"] ?? null);
            $servicios_pt = formatString($input["servicios_pt"] ?? null);
            $servicios_en = formatString($input["servicios_en"] ?? null);
            $servicios_esp = formatString($input["servicios_esp"] ?? null);
            $convenciones_pt = formatString($input["convenciones_pt"] ?? null);
            $convenciones_en = formatString($input["convenciones_en"] ?? null);
            $convenciones_esp = formatString($input["convenciones_esp"] ?? null);
            $campo_extra_pt = formatString($input["campo_extra_pt"] ?? null);
            $campo_extra_en = formatString($input["campo_extra_en"] ?? null);
            $campo_extra_esp = formatString($input["campo_extra_esp"] ?? null);
            $complemento = formatString($input["complemento"] ?? null);
            $hotel_cham = formatString($input["hotel_cham"] ?? null);
            $foto_fachada = formatString($input["foto_fachada"] ?? null);
            $fotofachada_tbn = formatString($input["fotofachada_tbn"] ?? null);
            $fotopiscina = formatString($input["fotopiscina"] ?? null);
            $fotoextra = formatString($input["fotoextra"] ?? null);
            $fotoextra_recep = formatString($input["fotoextra_recep"] ?? null);
            $ft_resort1 = formatString($input["ft_resort1"] ?? null);
            $ft_resort2 = formatString($input["ft_resort2"] ?? null);
            $ft_resort3 = formatString($input["ft_resort3"] ?? null);
            $htlurl = formatString($input["htlurl"] ?? null);
            $mapa = formatString($input["mapa"] ?? null);
            $map_eco = formatString($input["map_eco"] ?? null);
            $url_htl_360 = formatString($input["url_htl_360"] ?? null);
            $arq_htl_360 = formatString($input["arq_htl_360"] ?? null);
            $url_video = formatString($input["url_video"] ?? null);
            $arq_video = formatString($input["arq_video"] ?? null);
            $obs_pt = formatString($input["obs_pt"] ?? null);
            $obs_en = formatString($input["obs_en"] ?? null);
            $obs_esp = formatString($input["obs_esp"] ?? null);
            $historico_temp = formatString($input["historico_temp"] ?? null);
            $desc_mostrp_ing = formatString($input["desc_mostrp_ing"] ?? null);
            $classif_eco = formatInt($input["classif_eco"] ?? null);

            // Campos booleanos
            $flaghtl = tratarBoolean($input["flaghtl"] ?? null);
            $ativo_latino = tratarBoolean($input["ativo_latino"] ?? null);
            $ativo_flat = tratarBoolean($input["ativo_flat"] ?? null);
            $resort = tratarBoolean($input["resort"] ?? null);
            $ecologico = tratarBoolean($input["ecologico"] ?? null);
            $validafotopiscina = tratarBoolean($input["validafotopiscina"] ?? null);
            $bestdeal = tratarBoolean($input["bestdeal"] ?? null);
            $inet_mapa = tratarBoolean($input["inet_mapa"] ?? null);
            $luxury = tratarBoolean($input["luxury"] ?? null);
            $novo = tratarBoolean($input["novo"] ?? null);
            $favoritos = tratarBoolean($input["favoritos"] ?? null);
            $pg6fq7 = tratarBoolean($input["pg6fq7"] ?? null);
            $pg4fq5 = tratarBoolean($input["pg4fq5"] ?? null);
            $chdgratis = tratarBoolean($input["chdgratis"] ?? null);
            $blumarrecomenda = tratarBoolean($input["blumarrecomenda"] ?? null);
            $blumarreveillon = tratarBoolean($input["blumarreveillon"] ?? null);
            $allinclusive = tratarBoolean($input["allinclusive"] ?? null);
            $ativo_mostrp = tratarBoolean($input["ativo_mostrp"] ?? null);
            $ativo_bnuts = tratarBoolean($input["ativo_bnuts"] ?? null);
            $virtual_tour = tratarBoolean($input["virtual_tour"] ?? null);

            // Tratamento do campo estrela blumar
            $htlestrelablumar = $input["htlestrelablumar"] ?? null;
            $estrelablumar = formatString($htlestrelablumar);

            // Query de inserção
            $query_inserhotel = "
                INSERT INTO conteudo_internet.ci_hotel (
                    mneu_for, htldsc, htldscing, htldscesp, descesp_grpfit,
                    regime_hotel_pt, regime_hotel_en, regime_hotel,
                    rec_entret_pt, rec_entret_en, rec_entret,
                    otras_ativ_pt, otras_ativ_en, otras_ativ,
                    alojamiento_pt, alojamiento_en, alojamiento,
                    gastronomia_pt, gastronomia_en, gastronomia,
                    servicios_pt, servicios_en, servicios,
                    convenciones_pt, convenciones_en, convenciones,
                    campo_extra_pt, campo_extra_en, campo_extra,
                    complemento, hotel_cham,
                    htlimgfotofachada, fotofachada_tbn, htlfotopiscina,
                    fotoextra, fotoextra_recep,
                    ft_resort1, ft_resort2, ft_resort3,
                    htlurl, htlimgmapa, map_eco,
                    url_htl_360, arq_htl_360, url_video, arq_video,
                    htlobs, htlobsing, htlobsesp, historico_temp,
                    htlestrelablumar, desc_mostrp_ing, classif_eco,
                    flaghtl, flaglatino, flat, resort, ecologico,
                    flagfotopiscina, bestdeal, flaghtlimgmapa,
                    luxury, novo, favoritos, pg6fq7, pg4fq5,
                    chdgratis, blumarrecomenda, blumarreveillon, allinclusive,
                    ativo_mostrp, ativo_bnuts, virtual_tour
                ) VALUES (
                    " . pg_escape_literal($conn, $mneu_for) . ", $descricao_pt, $descricao_en, $descricao_esp, $descesp_grpfit,
                    $regime_hotel_pt, $regime_hotel_en, $regime_hotel_esp,
                    $rec_entret_pt, $rec_entret_en, $rec_entret_esp,
                    $otras_ativ_pt, $otras_ativ_en, $otras_ativ_esp,
                    $alojamiento_pt, $alojamiento_en, $alojamiento_esp,
                    $gastronomia_pt, $gastronomia_en, $gastronomia_esp,
                    $servicios_pt, $servicios_en, $servicios_esp,
                    $convenciones_pt, $convenciones_en, $convenciones_esp,
                    $campo_extra_pt, $campo_extra_en, $campo_extra_esp,
                    $complemento, $hotel_cham,
                    $foto_fachada, $fotofachada_tbn, $fotopiscina,
                    $fotoextra, $fotoextra_recep,
                    $ft_resort1, $ft_resort2, $ft_resort3,
                    $htlurl, $mapa, $map_eco,
                    $url_htl_360, $arq_htl_360, $url_video, $arq_video,
                    $obs_pt, $obs_en, $obs_esp, $historico_temp,
                    $estrelablumar, $desc_mostrp_ing, $classif_eco,
                    $flaghtl, $ativo_latino, $ativo_flat, $resort, $ecologico,
                    $validafotopiscina, $bestdeal, $inet_mapa,
                    $luxury, $novo, $favoritos, $pg6fq7, $pg4fq5,
                    $chdgratis, $blumarrecomenda, $blumarreveillon, $allinclusive,
                    $ativo_mostrp, $ativo_bnuts, $virtual_tour
                ) RETURNING frncod, mneu_for
            ";

            $result_insert = pg_query($conn, $query_inserhotel);
            if (!$result_insert) {
                throw new Exception("Erro ao inserir hotel: " . pg_last_error($conn));
            }

            $row = pg_fetch_assoc($result_insert);
            $frncod = $row['frncod'];
            $mneu_for_return = $row['mneu_for'];

            // Inserção dos apartamentos (até 4, se preenchidos)
            $apartamentos = [
                ['categ' => $input["categ1"] ?? '', 'loc' => $input["loc1"] ?? '', 'qtd' => $input["qtd1"] ?? '', 'foto' => $input["foto1"] ?? ''],
                ['categ' => $input["categ2"] ?? '', 'loc' => $input["loc2"] ?? '', 'qtd' => $input["qtd2"] ?? '', 'foto' => $input["foto2"] ?? ''],
                ['categ' => $input["categ3"] ?? '', 'loc' => $input["loc3"] ?? '', 'qtd' => $input["qtd3"] ?? '', 'foto' => $input["foto3"] ?? ''],
                ['categ' => $input["categ4"] ?? '', 'loc' => $input["loc4"] ?? '', 'qtd' => $input["qtd4"] ?? '', 'foto' => $input["foto4"] ?? '']
            ];

            foreach ($apartamentos as $apto) {
                if (strlen($apto['foto']) > 0) {
                    $categ = pg_escape_string($apto['categ']);
                    $loc = pg_escape_string($apto['loc']);
                    $qtd = pg_escape_string($apto['qtd']);
                    $foto = pg_escape_string($apto['foto']);

                    $query_apto = "
                        INSERT INTO conteudo_internet.ci_apartamento (aptocatcod, aptoloccod, aptqtd, aptoimgfoto, frncod)
                        VALUES ('$categ', '$loc', '$qtd', '$foto', '$frncod')
                    ";
                    $result_apto = pg_query($conn, $query_apto);
                    if (!$result_apto) {
                        error_log("Erro ao inserir apartamento: " . pg_last_error($conn));
                    }
                }
            }

            // Inserção das facilidades
            $facilities = pg_escape_string($input["facilities"] ?? '');
            if (strlen($facilities) > 0) {
                $array = explode(',', $facilities);
                foreach ($array as $tag) {
                    $tag = trim(pg_escape_string($tag));
                    if (!empty($tag)) {
                        $query_fac = "
                            INSERT INTO conteudo_internet.ci_hotel_facilidade (mneu_for, flagfacinet, tpofaccod)
                            VALUES ('$frncod', TRUE, '$tag')
                        ";
                        $result_fac = pg_query($conn, $query_fac);
                        if (!$result_fac) {
                            error_log("Erro ao inserir facilidade: " . pg_last_error($conn));
                        }
                    }
                }
            }

            // Log da ação (simulado; ajuste com $_SESSION se necessário)
            $pk_acesso = $_SESSION['user'] ?? null; // Exemplo
            if ($pk_acesso) {
                $data_now = date('Y-m-d');
                $query_log = "
                    INSERT INTO conteudo_internet.log_adm_conteudo (usuario, acao, data, fk_conteudo)
                    VALUES ('$pk_acesso', 'Inseriu o hotel - $mneu_for-$nome_htl', '$data_now', '2')
                ";
                pg_query($conn, $query_log);
            }

            response([
                'success' => true,
                'message' => 'Hotel inserido com sucesso!',
                'frncod' => $frncod,
                'mneu_for' => $mneu_for_return
            ], 201);
            break;

        // =========================================================
        // 🔹 ROTA 4: Atualizar hotel (PUT)
        // =========================================================
        case 'atualizar_hotel':
            if ($method !== 'PUT') response(["error" => "Método não permitido. Use PUT."], 405);

            $id = isset($_GET['id']) ? $_GET['id'] : null;
            if (!$id) response(["error" => "ID é obrigatório"], 400);

            if (empty($input)) response(["error" => "Dados do hotel são obrigatórios no body JSON"], 400);

            if (!isset($input['mneu_for'])) {
                throw new Exception('Missing required field: mneu_for');
            }

            $frncod_str = trim($input['frncod'] ?? $id); // Usa GET id se não no body
            if (empty($frncod_str) || !is_numeric($frncod_str)) {
                throw new Exception('Invalid or missing frncod: must be a valid integer');
            }
            $frncod = (int)$frncod_str;

            $mneu_for = $input['mneu_for'] ?? '';
            $nome_htl = $input['nome_htl'] ?? 'Update_hotel';

            // Descriptions
            $htldsc_sql = formatTextOrNull($conn, $input['descricao_pt'] ?? '');
            $htldscing_sql = formatTextOrNull($conn, $input['descricao_en'] ?? '');
            $htldscesp_sql = formatTextOrNull($conn, $input['descricao_esp'] ?? '');
            $descesp_grpfit_sql = formatTextOrNull($conn, $input['descesp_grpfit'] ?? '');

            // Resort content PT/EN/ES
            $regime_hotel_pt_sql = formatTextOrNull($conn, $input['regime_hotel_pt'] ?? '');
            $regime_hotel_en_sql = formatTextOrNull($conn, $input['regime_hotel_en'] ?? '');
            $regime_hotel_sql = formatTextOrNull($conn, $input['regime_hotel_esp'] ?? '');

            $rec_entret_pt_sql = formatTextOrNull($conn, $input['rec_entret_pt'] ?? '');
            $rec_entret_en_sql = formatTextOrNull($conn, $input['rec_entret_en'] ?? '');
            $rec_entret_sql = formatTextOrNull($conn, $input['rec_entret_esp'] ?? '');

            $otras_ativ_pt_sql = formatTextOrNull($conn, $input['otras_ativ_pt'] ?? '');
            $otras_ativ_en_sql = formatTextOrNull($conn, $input['otras_ativ_en'] ?? '');
            $otras_ativ_sql = formatTextOrNull($conn, $input['otras_ativ_esp'] ?? '');

            $alojamiento_pt_sql = formatTextOrNull($conn, $input['alojamiento_pt'] ?? '');
            $alojamiento_en_sql = formatTextOrNull($conn, $input['alojamiento_en'] ?? '');
            $alojamiento_sql = formatTextOrNull($conn, $input['alojamiento_esp'] ?? '');

            $gastronomia_pt_sql = formatTextOrNull($conn, $input['gastronomia_pt'] ?? '');
            $gastronomia_en_sql = formatTextOrNull($conn, $input['gastronomia_en'] ?? '');
            $gastronomia_sql = formatTextOrNull($conn, $input['gastronomia_esp'] ?? '');

            $servicios_pt_sql = formatTextOrNull($conn, $input['servicios_pt'] ?? '');
            $servicios_en_sql = formatTextOrNull($conn, $input['servicios_en'] ?? '');
            $servicios_sql = formatTextOrNull($conn, $input['servicios_esp'] ?? '');

            $convenciones_pt_sql = formatTextOrNull($conn, $input['convenciones_pt'] ?? '');
            $convenciones_en_sql = formatTextOrNull($conn, $input['convenciones_en'] ?? '');
            $convenciones_sql = formatTextOrNull($conn, $input['convenciones_esp'] ?? '');

            $campo_extra_pt_sql = formatTextOrNull($conn, $input['campo_extra_pt'] ?? '');
            $campo_extra_en_sql = formatTextOrNull($conn, $input['campo_extra_en'] ?? '');
            $campo_extra_sql = formatTextOrNull($conn, $input['campo_extra_esp'] ?? '');

            $complemento_sql = formatTextOrNull($conn, $input['complemento'] ?? '');
            $hotel_cham_sql = formatTextOrNull($conn, $input['hotel_cham'] ?? '');

            // Photos
            $htlimgfotofachada_sql = formatTextOrNull($conn, $input['foto_fachada'] ?? '');
            $fotofachada_tbn_sql = formatTextOrNull($conn, $input['fotofachada_tbn'] ?? '');
            $htlfotopiscina_sql = formatTextOrNull($conn, $input['fotopiscina'] ?? '');
            $fotoextra_sql = formatTextOrNull($conn, $input['fotoextra'] ?? '');
            $fotoextra_recep_sql = formatTextOrNull($conn, $input['fotoextra_recep'] ?? '');
            $ft_resort1_sql = formatTextOrNull($conn, $input['ft_resort1'] ?? '');
            $ft_resort2_sql = formatTextOrNull($conn, $input['ft_resort2'] ?? '');
            $ft_resort3_sql = formatTextOrNull($conn, $input['ft_resort3'] ?? '');

            // Maps and Videos
            $htlurl_sql = formatTextOrNull($conn, $input['htlurl'] ?? '');
            $htlimgmapa_sql = formatTextOrNull($conn, $input['mapa'] ?? '');
            $map_eco_sql = formatTextOrNull($conn, $input['map_eco'] ?? '');
            $url_htl_360_sql = formatTextOrNull($conn, $input['url_htl_360'] ?? '');
            $arq_htl_360_sql = formatTextOrNull($conn, $input['arq_htl_360'] ?? '');
            $url_video_sql = formatTextOrNull($conn, $input['url_video'] ?? '');
            $arq_video_sql = formatTextOrNull($conn, $input['arq_video'] ?? '');
            $virtual_tour_sql = formatTextOrNull($conn, $input['virtual_tour'] ?? '');

            // Observations
            $htlobs_sql = formatTextOrNull($conn, $input['obs_pt'] ?? '');
            $htlobsing_sql = formatTextOrNull($conn, $input['obs_en'] ?? '');
            $htlobsesp_sql = formatTextOrNull($conn, $input['obs_esp'] ?? '');
            $historico_temp_sql = formatTextOrNull($conn, $input['historico_temp'] ?? '');

            // Classifications
            $estrelablumar_sql = formatTextOrNull($conn, $input['htlestrelablumar']);
            $estrelas_htl_sql = formatTextOrNull($conn, $input['classif_lux']); // Assuming text
            $classif_eco_sql = formatIntOrNull($input['classif_eco']);
            $desc_mostrp_ing_sql = formatTextOrNull($conn, $input['desc_mostrp_ing'] ?? '');

            // Booleans
            $boolean_mapping = [
                'flaghtl' => $input['flaghtl'] ?? '',
                'flaglatino' => $input['ativo_latino'] ?? '',
                'flat' => $input['ativo_flat'] ?? '',
                'resort' => $input['resort'] ?? '',
                'ecologico' => $input['ecologico'] ?? '',
                'flagfotopiscina' => $input['validafotopiscina'] ?? '',
                'bestdeal' => $input['bestdeal'] ?? '',
                'ativo_bnuts' => $input['ativo_bnuts'] ?? '',
                'flaghtlimgmapa' => $input['inet_mapa'] ?? '',
                'luxury' => $input['luxury'] ?? '',
                'novo' => $input['novo'] ?? '',
                'favoritos' => $input['favoritos'] ?? '',
                'pg6fq7' => $input['pg6fq7'] ?? '',
                'pg4fq5' => $input['pg4fq5'] ?? '',
                'chdgratis' => $input['chdgratis'] ?? '',
                'blumarrecomenda' => $input['blumarrecomenda'] ?? '',
                'blumarreveillon' => $input['blumarreveillon'] ?? '',
                'allinclusive' => $input['allinclusive'] ?? '',
                'ativo_mostrp' => $input['ativo_mostrp'] ?? ''
            ];

            $flags_sql = [];
            foreach ($boolean_mapping as $db_field => $post_field) {
                $flags_sql[$db_field] = tratarBoolean($post_field);
            }

            // Assign flags
            $flaghtl_sql = $flags_sql['flaghtl'];
            $flaglatino_sql = $flags_sql['flaglatino'];
            $flat_sql = $flags_sql['flat'];
            $resort_sql = $flags_sql['resort'];
            $ecologico_sql = $flags_sql['ecologico'];
            $flagfotopiscina_sql = $flags_sql['flagfotopiscina'];
            $bestdeal_sql = $flags_sql['bestdeal'];
            $ativo_bnuts_sql = $flags_sql['ativo_bnuts'];
            $flaghtlimgmapa_sql = $flags_sql['flaghtlimgmapa'];
            $luxury_sql = $flags_sql['luxury'];
            $novo_sql = $flags_sql['novo'];
            $favoritos_sql = $flags_sql['favoritos'];
            $pg6fq7_sql = $flags_sql['pg6fq7'];
            $pg4fq5_sql = $flags_sql['pg4fq5'];
            $chdgratis_sql = $flags_sql['chdgratis'];
            $blumarrecomenda_sql = $flags_sql['blumarrecomenda'];
            $blumarreveillon_sql = $flags_sql['blumarreveillon'];
            $allinclusive_sql = $flags_sql['allinclusive'];
            $ativo_mostrp_sql = $flags_sql['ativo_mostrp'];

            // Covid and rooms
            $covid_19_pt_url_sql = formatTextOrNull($conn, $input['covid_19_pt_url'] ?? '');
            $covid_19_en_url_sql = formatTextOrNull($conn, $input['covid_19_en_url'] ?? '');
            $htl_num_quartos_sql = formatIntOrNull($input['htl_num_quartos'] ?? '0');

            // Query de atualização
            $sql_full = "
                UPDATE conteudo_internet.ci_hotel
                SET
                    htldsc = {$htldsc_sql},
                    htldscing = {$htldscing_sql},
                    htldscesp = {$htldscesp_sql},
                    descesp_grpfit = {$descesp_grpfit_sql},
                    regime_hotel_pt = {$regime_hotel_pt_sql},
                    regime_hotel_en = {$regime_hotel_en_sql},
                    regime_hotel = {$regime_hotel_sql},
                    rec_entret_pt = {$rec_entret_pt_sql},
                    rec_entret_en = {$rec_entret_en_sql},
                    rec_entret = {$rec_entret_sql},
                    otras_ativ_pt = {$otras_ativ_pt_sql},
                    otras_ativ_en = {$otras_ativ_en_sql},
                    otras_ativ = {$otras_ativ_sql},
                    alojamiento_pt = {$alojamiento_pt_sql},
                    alojamiento_en = {$alojamiento_en_sql},
                    alojamiento = {$alojamiento_sql},
                    gastronomia_pt = {$gastronomia_pt_sql},
                    gastronomia_en = {$gastronomia_en_sql},
                    gastronomia = {$gastronomia_sql},
                    servicios_pt = {$servicios_pt_sql},
                    servicios_en = {$servicios_en_sql},
                    servicios = {$servicios_sql},
                    convenciones_pt = {$convenciones_pt_sql},
                    convenciones_en = {$convenciones_en_sql},
                    convenciones = {$convenciones_sql},
                    campo_extra_pt = {$campo_extra_pt_sql},
                    campo_extra_en = {$campo_extra_en_sql},
                    campo_extra = {$campo_extra_sql},
                    complemento = {$complemento_sql},
                    hotel_cham = {$hotel_cham_sql},
                    htlimgfotofachada = {$htlimgfotofachada_sql},
                    fotofachada_tbn = {$fotofachada_tbn_sql},
                    htlfotopiscina = {$htlfotopiscina_sql},
                    fotoextra = {$fotoextra_sql},
                    fotoextra_recep = {$fotoextra_recep_sql},
                    ft_resort1 = {$ft_resort1_sql},
                    ft_resort2 = {$ft_resort2_sql},
                    ft_resort3 = {$ft_resort3_sql},
                    htlurl = {$htlurl_sql},
                    htlimgmapa = {$htlimgmapa_sql},
                    map_eco = {$map_eco_sql},
                    url_htl_360 = {$url_htl_360_sql},
                    arq_htl_360 = {$arq_htl_360_sql},
                    url_video = {$url_video_sql},
                    arq_video = {$arq_video_sql},
                    virtual_tour = {$virtual_tour_sql},
                    htlobs = {$htlobs_sql},
                    htlobsing = {$htlobsing_sql},
                    htlobsesp = {$htlobsesp_sql},
                    historico_temp = {$historico_temp_sql},
                    htlestrelablumar = {$estrelablumar_sql},
                    estrelas_htl = {$estrelas_htl_sql},
                    classif_eco = {$classif_eco_sql},
                    desc_mostrp_ing = {$desc_mostrp_ing_sql},
                    flaghtl = {$flaghtl_sql},
                    flaglatino = {$flaglatino_sql},
                    flat = {$flat_sql},
                    resort = {$resort_sql},
                    ecologico = {$ecologico_sql},
                    flagfotopiscina = {$flagfotopiscina_sql},
                    bestdeal = {$bestdeal_sql},
                    ativo_bnuts = {$ativo_bnuts_sql},
                    flaghtlimgmapa = {$flaghtlimgmapa_sql},
                    luxury = {$luxury_sql},
                    novo = {$novo_sql},
                    favoritos = {$favoritos_sql},
                    pg6fq7 = {$pg6fq7_sql},
                    pg4fq5 = {$pg4fq5_sql},
                    chdgratis = {$chdgratis_sql},
                    blumarrecomenda = {$blumarrecomenda_sql},
                    blumarreveillon = {$blumarreveillon_sql},
                    allinclusive = {$allinclusive_sql},
                    ativo_mostrp = {$ativo_mostrp_sql},
                    covid_19_en_url = {$covid_19_en_url_sql},
                    covid_19_pt_url = {$covid_19_pt_url_sql},
                    htl_num_quartos = {$htl_num_quartos_sql}
                WHERE frncod = $frncod
            ";

            $result = pg_query($conn, $sql_full);
            if (!$result) {
                throw new Exception("Database update failed: " . pg_last_error($conn));
            }

            $affected_rows = pg_affected_rows($result);

            // Log da ação (simulado)
            $pk_acesso = $_SESSION['user'] ?? null;
            if ($pk_acesso) {
                $data_now = date('Y-m-d');
                $log_message_acao = "Atualizou o hotel - " . pg_escape_string($mneu_for) . "-" . pg_escape_string($nome_htl);
                $query_log = "
                    INSERT INTO conteudo_internet.log_adm_conteudo (usuario, acao, data, fk_conteudo)
                    VALUES ('$pk_acesso', '$log_message_acao', '$data_now', '2')
                ";
                @pg_query($conn, $query_log);
            }

            if ($affected_rows > 0) {
                response([
                    'success' => true,
                    'message' => 'HOTEL ATUALIZADO COM SUCESSO! Linhas afetadas: ' . $affected_rows,
                    'mneu_for' => $mneu_for,
                    'frncod' => $frncod_str
                ]);
            } else {
                response([
                    'success' => false,
                    'message' => 'AVISO: Nenhuma linha atualizada. Verifique se o FRNCOD (' . $frncod_str . ') existe na tabela ou se os dados enviados são idênticos aos atuais. Linhas afetadas: 0',
                    'mneu_for' => $mneu_for,
                    'frncod' => $frncod_str
                ], 200); // Não é erro, só aviso
            }
            break;

        // =========================================================
        // 🔹 ROTA 5: Excluir hotel (DELETE)
        // =========================================================
        case 'excluir_hotel':
            if ($method !== 'DELETE') response(["error" => "Método não permitido. Use DELETE."], 405);

            $id = isset($_GET['id']) ? $_GET['id'] : null;
            if (!$id) response(["error" => "ID é obrigatório"], 400);

            // Detecta se o ID é numérico (frncod) ou string (mneu_for)
            if (is_numeric($id)) {
                $sql = "DELETE FROM conteudo_internet.ci_hotel WHERE frncod = $1";
                $params = [(int) $id];
            } else {
                $sql = "DELETE FROM conteudo_internet.ci_hotel WHERE mneu_for = $1";
                $params = [$id];
            }

            $result = pg_query_params($conn, $sql, $params);
            if (!$result) {
                throw new Exception(pg_last_error($conn));
            }

            $affected_rows = pg_affected_rows($result);
            if ($affected_rows > 0) {
                response(["success" => true, "message" => "Hotel excluído com sucesso"]);
            } else {
                response(["error" => "Hotel não encontrado"], 404);
            }
            break;

        default:
            response(["error" => "Rota inválida"], 400);
    }
} catch (Exception $e) {
    error_log("Erro na API de hotéis: " . $e->getMessage());
    response(["error" => "Erro no servidor: " . $e->getMessage()], 500);
}
?>
```
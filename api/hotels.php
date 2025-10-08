<?php
// ========================================
// 🔧 CONFIGURAÇÕES INICIAIS
// ========================================
date_default_timezone_set('America/Sao_Paulo');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../util/connection.php';

$BASE_URL_IMAGEM = "https://www.blumar.com.br/";

// Função padrão de resposta JSON
function response($data, $code = 200) {
    http_response_code($code);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

// Função auxiliar para montar URLs completas de imagens
function montarUrlsImagens(&$row, $baseUrl) {
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

$request = isset($_GET['request']) ? $_GET['request'] : null;
if (!$request) {
    response(["error" => "Parâmetro 'request' é obrigatório"], 400);
}

try {
    switch ($request) {

        // =========================================================
        // 🔹 ROTA 1: Buscar hotel específico
        // =========================================================
        case 'buscar_hotel':
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
        // 🔹 ROTA 2: Listar hotéis
        // =========================================================
       case 'listar_hoteis':
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

        default:
            response(["error" => "Rota inválida"], 400);
    }

} catch (Exception $e) {
    response(["error" => "Erro no servidor: " . $e->getMessage()], 500);
}
?>

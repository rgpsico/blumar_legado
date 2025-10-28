<?php
session_start();
require_once '../util/connection.php';

header('Content-Type: application/json');

$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'carregar_cidades':
        carregarCidades($conn);
        break;

    case 'carregar_cidades_por_tipo':
        $tp_produto = isset($_POST['tp_produto']) ? $_POST['tp_produto'] : '';
        carregarCidadesPorTipo($conn, $tp_produto);
        break;

    case 'carregar_inspections':
        carregarInspections($conn);
        break;

    case 'carregar_produtos':
        $cidade_cod = isset($_POST['cidade_cod']) ? $_POST['cidade_cod'] : '';
        $tp_produto = isset($_POST['tp_produto']) ? $_POST['tp_produto'] : '';
        carregarProdutos($conn, $cidade_cod, $tp_produto);
        break;

    case 'carregar_imagens_produto':
        $mneu_for = isset($_POST['mneu_for']) ? $_POST['mneu_for'] : '';
        $tp_produto = isset($_POST['tp_produto']) ? $_POST['tp_produto'] : '';
        carregarImagensProduto($conn, $mneu_for, $tp_produto);
        break;

    case 'carregar_imagens_tour_cidade':
        $cidade_cod = isset($_POST['cidade_cod']) ? $_POST['cidade_cod'] : '';
        carregarImagensTourCidade($conn, $cidade_cod);
        break;

    case 'deletar_imagem':
        $pk_bco_img = isset($_POST['pk_bco_img']) ? (int)$_POST['pk_bco_img'] : 0;
        deletarImagem($conn, $pk_bco_img);
        break;

    case 'obter_info_produto':
        $mneu_for = isset($_POST['mneu_for']) ? $_POST['mneu_for'] : '';
        obterInfoProduto($conn, $mneu_for);
        break;

    default:
        echo json_encode(['error' => 'Ação não reconhecida']);
}

/**
 * Carrega todas as cidades
 */
function carregarCidades($conn)
{
    $query_cidade = "SELECT 
                        pk_cidade_tpo,
                        nome_pt,
                        nome_en,
                        descritivo_pt,
                        descritivo_en,
                        foto1,
                        foto2,
                        tpocidcod,
                        cidade_cod
                    FROM tarifario.cidade_tpo
                    ORDER BY nome_en";

    $result = pg_query($conn, $query_cidade);

    if ($result) {
        $cidades = [];
        while ($row = pg_fetch_assoc($result)) {
            $cidades[] = $row;
        }
        echo json_encode(['success' => true, 'cidades' => $cidades]);
    } else {
        echo json_encode(['success' => false, 'error' => pg_last_error($conn)]);
    }
}

/**
 * Carrega cidades por tipo de produto
 */
function carregarCidadesPorTipo($conn, $tp_produto)
{
    $tp_produto = pg_escape_string($conn, $tp_produto);

    $query = "SELECT DISTINCT fk_cidcod,
                (SELECT nome_en FROM tarifario.cidade_tpo WHERE cidade_cod = fk_cidcod) as nome_en
              FROM banco_imagem.bco_img
              WHERE tp_produto = '$tp_produto'
              ORDER BY nome_en";

    $result = pg_query($conn, $query);

    if ($result) {
        $cidades = [];
        while ($row = pg_fetch_assoc($result)) {
            $cidades[] = $row;
        }
        echo json_encode(['success' => true, 'cidades' => $cidades]);
    } else {
        echo json_encode(['success' => false, 'error' => pg_last_error($conn)]);
    }
}

/**
 * Carrega inspections
 */
function carregarInspections($conn)
{
    $query_inspections = "SELECT DISTINCT mneu_for FROM banco_imagem.bco_img WHERE tp_produto = '11'";
    $result_inspections = pg_query($conn, $query_inspections);

    $inspections = [];

    if ($result_inspections) {
        while ($row = pg_fetch_assoc($result_inspections)) {
            $pk_inspection = $row['mneu_for'];

            $query_details = "SELECT  
                                conteudo_internet.ireport_destinations.pk_ireport_destinations,
                                conteudo_internet.ireport_destinations.destinos
                              FROM conteudo_internet.ireport_destinations
                              WHERE pk_ireport_destinations = $pk_inspection";

            $result_details = pg_query($conn, $query_details);

            if ($result_details) {
                while ($detail = pg_fetch_assoc($result_details)) {
                    $inspections[] = $detail;
                }
            }
        }

        echo json_encode(['success' => true, 'inspections' => $inspections]);
    } else {
        echo json_encode(['success' => false, 'error' => pg_last_error($conn)]);
    }
}

/**
 * Carrega produtos por cidade e tipo
 */
function carregarProdutos($conn, $cidade_cod, $tp_produto)
{
    $cidade_cod = pg_escape_string($conn, $cidade_cod);
    $tp_produto = pg_escape_string($conn, $tp_produto);

    $query = "SELECT DISTINCT
                bco_img.mneu_for,
                bco_img.nome_produto,
                (SELECT nome_for FROM sbd95.fornec WHERE mneu_for = bco_img.mneu_for) as nome_fornecedor,
                COUNT(*) as total_imagens
              FROM banco_imagem.bco_img 
              WHERE fk_cidcod = '$cidade_cod' 
              AND tp_produto = '$tp_produto'
              GROUP BY bco_img.mneu_for, bco_img.nome_produto
              ORDER BY bco_img.nome_produto";

    $result = pg_query($conn, $query);

    if ($result) {
        $produtos = [];
        while ($row = pg_fetch_assoc($result)) {
            $produtos[] = $row;
        }
        echo json_encode(['success' => true, 'produtos' => $produtos]);
    } else {
        echo json_encode(['success' => false, 'error' => pg_last_error($conn)]);
    }
}

/**
 * Carrega imagens flat de tours para a cidade (adaptado do legado) - Adicionado botão delete
 */
function carregarImagensTourCidade($conn, $cidade_cod)
{
    $cidade_cod = pg_escape_string($conn, $cidade_cod);

    // Busca o nome da cidade
    $query_nome = "SELECT nome_en FROM tarifario.cidade_tpo WHERE cidade_cod = '$cidade_cod'";
    $result_nome = pg_query($conn, $query_nome);
    $nome_cid = '';
    if ($result_nome && $row_nome = pg_fetch_assoc($result_nome)) {
        $nome_cid = $row_nome['nome_en'];
    }

    if (empty($nome_cid)) {
        echo json_encode(['success' => false, 'error' => 'Cidade não encontrada']);
        return;
    }

    // Busca todas as imagens de tours da cidade
    $query = "SELECT 
                pk_bco_img,  
                mneu_for,
                tam_1,
                tam_2,
                tam_3,
                tam_4,
                tam_5,
                zip,
                legenda
              FROM
                banco_imagem.bco_img
              WHERE
                tp_produto = 2
                AND fk_cidcod = '$cidade_cod'
              ORDER BY legenda";

    $result = pg_query($conn, $query);

    $html = '<div id="mapa-eco"></div><div id="cabeca_bancoimg"><b>' . strtoupper($nome_cid) . ' TOURS PICTURES</b></div>';

    if ($result && pg_num_rows($result) > 0) {
        while ($row = pg_fetch_assoc($result)) {
            $pk_bco_img = $row['pk_bco_img'];
            $mneu_for = $row['mneu_for'];
            $tam_1 = $row['tam_1'];
            $legenda = $row['legenda'];
            $zip = $row['zip'];
            $tam_5 = $row['tam_5'];
            $tam_4 = $row['tam_4'];
            $tam_3 = $row['tam_3'];
            $tam_2 = $row['tam_2'];

            $html .= '<div id="tumb_bancoimg"><div id="img_bancoimg"><img src="https://www.blumar.com.br/' . $tam_1 . '" width="135" height="90"></div>';
            $html .= '<div id="bt_imgstp">';

            if (strlen($tam_2) != 0) {
                $html .= '<div id="bt_zip"><a href="#" title="300 x 200" class="imgpatht2"><input type="hidden" class="imgpatht2value" value="' . $pk_bco_img . '">T2</a></div>';
            }

            if (strlen($tam_3) != 0) {
                $html .= '<div id="bt_zip"><a href="#" title="450 x 300" class="imgpatht3"><input type="hidden" class="imgpatht3value" value="' . $pk_bco_img . '">T3</a></div>';
            }

            if (strlen($tam_4) != 0) {
                $html .= '<div id="bt_zip"><a href="#" title="840 x 559" class="imgpatht4"><input type="hidden" class="imgpatht4value" value="' . $pk_bco_img . '">T4</a></div>';
            }

            if (strlen($tam_5) != 0) {
                $html .= '<div id="bt_zip"><a href="#" title="Original size" class="imgpatht5"><input type="hidden" class="imgpatht5value" value="' . $pk_bco_img . '">T5</a></div>';
            }

            if (strlen($zip) != 0) {
                $html .= '<div id="bt_zip"><a href="#" title="Compressed file">zip</a></div>';
            }

            $html .= '<div id="bt_zip2"><a href="#" class="imgpath"><input type="hidden" class="imgpathvalue" value="' . $pk_bco_img . '"><img src="../images/edit_img.png" title="edit image"></a></div>';
            $html .= '</div>';

            if (strlen($legenda) != 0) {
                $html .= '<div class="bt_download"><b>' . substr($legenda, 0, 21) . '</b></div>';
            }
            $html .= '<div class="bt_download">id: ' . $pk_bco_img . ' </div>';

            // Botão de delete (lixeirinha) para tours
            $html .= '<button class="btn-delete delete-img" data-pk="' . $pk_bco_img . '" title="Excluir do banco"><i class="fas fa-trash-alt"></i></button>';

            $html .= '</div>';
        }
    } else {
        $html .= '<p class="empty-state">Nenhuma imagem encontrada para tours nesta cidade.</p>';
    }

    echo json_encode([
        'success' => true,
        'html' => $html
    ]);
}

/**
 * Deleta imagem do banco de dados (preserva arquivo físico)
 */
function deletarImagem($conn, $pk_bco_img)
{
    if ($pk_bco_img <= 0) {
        echo json_encode(['success' => false, 'error' => 'ID inválido']);
        return;
    }

    $pk_bco_img = pg_escape_string($conn, $pk_bco_img);

    // DELETE apenas do banco
    $query = "DELETE FROM banco_imagem.bco_img WHERE pk_bco_img = '$pk_bco_img'";
    $result = pg_query($conn, $query);

    if ($result && pg_affected_rows($result) > 0) {
        echo json_encode(['success' => true, 'message' => 'Imagem excluída do banco']);
    } else {
        echo json_encode(['success' => false, 'error' => pg_last_error($conn) ?: 'Nenhuma linha afetada']);
    }
}

/**
 * Obtém informações do produto/hotel
 */
function obterInfoProduto($conn, $mneu_for)
{
    $mneu_for = pg_escape_string($conn, $mneu_for);

    // Tenta buscar na tabela de hotéis primeiro
    $query_hotel = "SELECT nome_for, nome_htl
                    FROM conteudo_internet.ci_hotel
                    LEFT OUTER JOIN sbd95.fornec
                    ON ci_hotel.mneu_for = sbd95.fornec.mneu_for
                    WHERE ci_hotel.mneu_for = '$mneu_for'";

    $result = pg_query($conn, $query_hotel);

    $nome_produto = '';

    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        if (!empty($row['nome_for'])) {
            $nome_produto = $row['nome_for'];
        } else {
            $nome_produto = $row['nome_htl'];
        }
    } else {
        // Se não encontrou no hotel, busca no banco de imagens
        $query_img = "SELECT nome_produto 
                      FROM banco_imagem.bco_img 
                      WHERE mneu_for = '$mneu_for' 
                      LIMIT 1";
        $result_img = pg_query($conn, $query_img);

        if ($result_img && pg_num_rows($result_img) > 0) {
            $row = pg_fetch_assoc($result_img);
            $nome_produto = $row['nome_produto'];
        }
    }

    if (!empty($nome_produto)) {
        echo json_encode([
            'success' => true,
            'nome_produto' => $nome_produto,
            'mneu_for' => $mneu_for
        ]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Produto não encontrado']);
    }
}

/**
 * Carrega imagens de um produto específico (agora aceita tp_produto)
 */
function carregarImagensProduto($conn, $mneu_for, $tp_produto = '')
{
    $mneu_for = pg_escape_string($conn, $mneu_for);
    $tp_produto = pg_escape_string($conn, $tp_produto);

    $where_tp = $tp_produto ? "AND tp_produto = '$tp_produto'" : "AND tp_produto = '1'";  // Default para hotel

    $query = "SELECT 
                pk_bco_img,  
                mneu_for,
                (SELECT nome_for FROM sbd95.fornec WHERE mneu_for = banco_imagem.bco_img.mneu_for) as nome_for,
                tam_1,
                tam_2,
                tam_3,
                tam_4,
                tam_5,
                zip,
                legenda,
                autor,
                ordem,
                nacional,
                fachada
              FROM banco_imagem.bco_img
              WHERE mneu_for = '$mneu_for'
              $where_tp
              ORDER BY ordem, legenda";

    $result = pg_query($conn, $query);

    if ($result) {
        $imagens = [];
        while ($row = pg_fetch_assoc($result)) {
            $imagens[] = $row;
        }
        echo json_encode(['success' => true, 'imagens' => $imagens]);
    } else {
        echo json_encode(['success' => false, 'error' => pg_last_error($conn)]);
    }
}

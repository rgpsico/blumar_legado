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
        $tp_produto = 2;
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

    $query = "SELECT * FROM banco_imagem.bco_img 
              WHERE fk_cidcod = '$cidade_cod' 
              AND tp_produto = '$tp_produto'";


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

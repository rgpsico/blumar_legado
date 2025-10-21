<?php
ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

$classif = $_POST['classif'] ?? null;
$data_post = $_POST['data_post'] ?? null;
$titulo = $_POST['titulo'] ?? '';
$ativo = isset($_POST['ativo']) && $_POST['ativo'] === 'true'; // ✅ vira booleano real
$descritivo_blumar = $_POST['descritivo_blumar'] ?? '';
$descritivo_be = $_POST['descritivo_be'] ?? '';
$foto_capa = $_POST['foto_capa'] ?? '';
$foto_topo = $_POST['foto_topo'] ?? '';
$url_video = $_POST['url_video'] ?? '';
$meta_description = $_POST['meta_description'] ?? '';
$citie = $_POST['citie'] ?? null;
$regiao = $_POST['regiao'] ?? null;

// 🔹 Corrige valores numéricos e nulos
$citie = ($citie === '' || $citie === null) ? null : (int)$citie;
$regiao = ($regiao === '' || $regiao === null) ? null : (int)$regiao;
$classif = ($classif === '' || $classif === null) ? null : (int)$classif;

// ✅ Query segura com parâmetros
if ($ativo == false) {
    $ativo = 'f';
}

$sql = "
INSERT INTO conteudo_internet.blog_nacional
(classif, data_post, titulo, descritivo_blumar, descritivo_be, foto_capa, foto_topo, url_video, meta_description, citie, regiao, ativo)
VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12)
";

$params = [
    $classif,
    $data_post,
    $titulo,
    $descritivo_blumar,
    $descritivo_be,
    $foto_capa,
    $foto_topo,
    $url_video,
    $meta_description,
    $citie,
    $regiao,
    $ativo  // ✅ boolean puro (true/false)
];

$result = pg_query_params($conn, $sql, $params);

if ($result === false) {
    echo '<div class="alert alert-danger">❌ Erro ao inserir: ' . pg_last_error($conn) . '</div>';
} else {
    echo '<div class="alert alert-success">✅ Novo post criado com sucesso!</div>';
}

include 'miolo_blognacional.php';

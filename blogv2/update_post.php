<?php
ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

$classif = pg_escape_string($_POST["classif"]);
$data_post = pg_escape_string($_POST["data_post"]);
$titulo = pg_escape_string($_POST["titulo"]);
$ativo = pg_escape_string($_POST["ativo"]);
$descritivo_blumar = pg_escape_string($_POST["descritivo_blumar"]);
$descritivo_be = pg_escape_string($_POST["descritivo_be"]);
$foto_capa = pg_escape_string($_POST["foto_capa"]);
$foto_topo = pg_escape_string($_POST["foto_topo"]);
$url_video = pg_escape_string($_POST["url_video"]);
$meta_description = pg_escape_string($_POST["meta_description"]);
$pk_blognacional = pg_escape_string($_POST["pk_blognacional"]);
$citie = pg_escape_string($_POST["citie"]);
$regiao = pg_escape_string($_POST["regiao"]);


$inseredata_post = $data_post; // ✅ já no formato YYYY-MM-DD

$sql = "
UPDATE conteudo_internet.blog_nacional
SET
    classif = '$classif',
    data_post = '$inseredata_post',
    titulo = '$titulo',
    descritivo_blumar = '$descritivo_blumar',
    descritivo_be = '$descritivo_be',
    foto_capa = '$foto_capa',
    foto_topo = '$foto_topo',
    url_video = '$url_video',
    meta_description = '$meta_description',
    citie = '$citie',
    regiao = '$regiao',
    ativo = '$ativo'
WHERE pk_blognacional = '$pk_blognacional'
";


pg_query($conn, $sql);

// Retorna sucesso
echo '<div class="alert alert-success">✅ Post alterado com sucesso!</div>';

// Recarrega a lista
include 'miolo_blognacional.php';

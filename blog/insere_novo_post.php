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
$citie = pg_escape_string($_POST["citie"]);
$regiao = pg_escape_string($_POST["regiao"]);
 
$arrayData = explode("/",$data_post);
$anoin = $arrayData[2];
$mesin = $arrayData[1];
$diain = $arrayData[0];
$inseredata_post = $anoin.'-'.$mesin.'-'.$diain;






	
$sql = "
INSERT into conteudo_internet.blog_nacional
(
    classif,
    data_post,
    titulo,
    ativo,
    descritivo_blumar,
    descritivo_be,
    foto_capa,
    foto_topo,
    url_video,
    regiao,
    citie,
    meta_description

)
    VALUES
(
    '$classif',
    '$inseredata_post',
    '$titulo',
    '$ativo',
    '$descritivo_blumar',
    '$descritivo_be',
    '$foto_capa',
    '$foto_topo',
    '$url_video',
    '$regiao',
    '$citie',
    '$meta_description' 
                
)
";
pg_query($conn, $sql);




echo'Post inserido com sucesso!!<br><br><br>
<a href="##"  onclick="javascript:novo_post();">Novo post >></a>';












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


 
$arrayData = explode("/",$data_post);
$anoin = $arrayData[2];
$mesin = $arrayData[1];
$diain = $arrayData[0];
$inseredata_post = $anoin.'-'.$mesin.'-'.$diain;


	
$sql = " 
update
conteudo_internet.blog_nacional
 set
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
 regiao =  '$regiao',
 ativo = '$ativo'
where
       pk_blognacional = '$pk_blognacional'
";
pg_query($conn, $sql);




 

$sql_posts = 
"
SELECT * FROM conteudo_internet.blog_nacional
ORDER BY pk_blognacional ASC 
";
$result_posts = pg_exec($conn, $sql_posts);

 








echo 'Post alterado com sucesso!!
<br><br><br>
<b>BLOG NACIONAL</b><br><br><br>
      <a href="##"  onclick="javascript:novo_post();">Novo post >></a>
      
      
      <br><br><br>Alteração de Posts <br>
<select name="pk_blognacional" id="pk_blognacional"   > 
<option value="0" selected>Escolha um post para alterar</option>';



if ($result_posts) {
    for ($rowcid = 0; $rowcid < pg_numrows($result_posts); $rowcid++) {
        $pk_blognacional  = pg_result($result_posts, $rowcid, 'pk_blognacional');   
        $titulo = pg_result($result_posts, $rowcid, 'titulo');

        echo '<option value="'.$pk_blognacional.'">'.$titulo.'</option> ';
     }
}

echo '</select>
   <input class="botao" type="button" name="Go" value="Alterar >>"  class="botao" onClick="javascript:altera_post();"  >
 </form>
<br>';













<?php 

ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';


$sql_posts = 
"
SELECT * FROM conteudo_internet.blog_nacional
ORDER BY pk_blognacional ASC 
";
$result_posts = pg_exec($conn, $sql_posts);

 








echo '<b>BLOG NACIONAL</b><br><br><br>
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



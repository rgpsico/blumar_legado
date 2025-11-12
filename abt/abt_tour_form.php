<?php 
require_once '../util/connection.php';
if(isset($pk_abt))
{

}
elseif(isset($_POST["pk_abt"]))
{
   $pk_abt = pg_escape_string($_POST["pk_abt"]);
}


$pega_abt = "
select
nome
from
conteudo_internet.abt
where
pk_abt = $pk_abt

";

$result_abt = pg_exec($conn, $pega_abt);


if ($result_abt) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_abt); $rowcid++) {
		$nome = pg_result($result_abt, $rowcid, 'nome');
		
	}
}

 


echo'
<b>Cadastro de descritivo Arounds Brazil Tours</b><br>
<br>
Inclusão de Dias referentes ao Tour:<b> '.$nome.'</b>
<br><br>
<div id="abt_left">
    <SELECT name="dia_conteudo" id="dia_conteudo"> 
 ';

	for ($rowsrv = 1; $rowsrv <=20; $rowsrv++) 
	{
		echo'<option value="'.$rowsrv.'">Day '.$rowsrv.'</option>';
	}

echo'
</SELECT> 
<br><br>
Título: <br>
<input name="titulo_conteudo" id="titulo_conteudo" type="text"  size="40"><br>
<br>
Descritivo:<br>
<textarea name="descritivo_conteudo" id="descritivo_conteudo" maxlenght="150" rows="10" cols="40"></textarea><br>
<br>
Foto:<br>
<input name="foto1_conteudo" id="foto1_conteudo" type="text"  size="40"><br> 
<br>
Escolha o Layout:<br>
<img src="images/foto_esq.jpg"> - <input type="radio" name="lay" id="lay" value="1" checked>Imagem à esquerda da página<br>
<img src="images/sem_foto.jpg"> - <input type="radio" name="lay" id="lay"  value="2">Não incluir imagem<br>
<img src="images/foto_dir.jpg"> - <input type="radio" name="lay" id="lay"  value="3">Imagem à direita da página<br>
<input type="hidden" name="pk_abt" id="pk_abt" value="'.$pk_abt.'"><br>
<input type="submit" name="Submit"  onClick="javascript:input_tour_abt();"  value="Inserir">
<br><br>
</div>

';

$pega_tour_abt = "
        select 
	        pk_abt_conteudo, 
		    dia_conteudo, 
		    titulo_conteudo, 
		    descritivo_conteudo, 
		    foto1_conteudo, 
		    fk_abt, 
		    layout_conteudo
        from 
			conteudo_internet.abt_conteudo
		where 
			fk_abt = $pk_abt
        order by dia_conteudo
";

$result_abt = pg_exec($conn, $pega_tour_abt);


echo'
<div id="abt_right">

<a href="#" onClick="javascript:update_cad_bt();""><b>ALTERAR CADASTRO >></b></a>
<br><br>
<b>ALTERAÇÃO DE TOUR</b><br><br>
';


if ($result_abt) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_abt); $rowcid++) {
		$pk_abt_conteudo = pg_result($result_abt, $rowcid, 'pk_abt_conteudo');
		$dia_conteudo = pg_result($result_abt, $rowcid, 'dia_conteudo');
		
        echo '<a href="#" class="pkabtconteudo">Dia '.$dia_conteudo.' <b>>></b><input type="hidden"  class="pkabtconteudoValue" value="'.$pk_abt_conteudo.'"></a> 
		      -------
              <a href="#" class="delpkabt"><input type="hidden"  class="delpkabtValue" value="'.$pk_abt_conteudo.'"><img src="images/del.png" title="Apagar Dia '.$dia_conteudo.'"></a>
			  <br>--------------<br>';
		
		
	}
}

echo'


<br><br>
<a href="##" onclick="javascript: novo_tour_abt();">+ adicionar dia <b> >></b></a>

</div>';

?>
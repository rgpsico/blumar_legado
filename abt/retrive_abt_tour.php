<?php 

require_once '../util/connection.php';

$pk_abt = pg_escape_string($_GET["pk_abt"]);
$pk_abt_conteudo = pg_escape_string($_GET["pkabttour"]);



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
	pk_abt_conteudo = $pk_abt_conteudo

";

$result_abt = pg_exec($conn, $pega_tour_abt);


 
if ($result_abt) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_abt); $rowcid++) {
		$dia_conteudo = pg_result($result_abt, $rowcid, 'dia_conteudo');
		$titulo_conteudo = pg_result($result_abt, $rowcid, 'titulo_conteudo');
		$descritivo_conteudo = pg_result($result_abt, $rowcid, 'descritivo_conteudo');
		$foto1_conteudo = pg_result($result_abt, $rowcid, 'foto1_conteudo');
		$layout_conteudo = pg_result($result_abt, $rowcid, 'layout_conteudo');
	}
}




echo'
<div id="abt_left">
ALTERAÇÃO DE TOUR ABT<br><br>
<SELECT name="dia_conteudo" id="dia_conteudo">
<option value="'.$dia_conteudo.'" selected>Day '.$dia_conteudo.'</option>
';

for ($rowsrv = 1; $rowsrv <=20; $rowsrv++)
{
echo'<option value="'.$rowsrv.'">Day '.$rowsrv.'</option>';
}

echo'
</SELECT>
<br><br>
Título: <br>
<input name="titulo_conteudo" id="titulo_conteudo" type="text"  size="40" value="'.$titulo_conteudo.'"><br>
<br>
Descritivo:<br>
<textarea name="descritivo_conteudo" id="descritivo_conteudo" maxlenght="150" rows="10" cols="40">'.$descritivo_conteudo.'</textarea><br>
<br>
Foto:<br>
<input name="foto1_conteudo" id="foto1_conteudo" type="text"  size="40" value="'.$foto1_conteudo.'"><br>
<br>
Escolha o Layout:<br>
<img src="images/foto_esq.jpg"> - <input type="radio" name="lay" id="lay" value="1" '; if ($layout_conteudo == '1')echo 'checked'; echo ' >Imagem à esquerda da página <br>
<img src="images/sem_foto.jpg"> - <input type="radio" name="lay" id="lay" value="2"'; if ($layout_conteudo == '2')echo 'checked'; echo '>Não incluir imagem<br>
<img src="images/foto_dir.jpg"> - <input type="radio" name="lay" id="lay" value="3" '; if ($layout_conteudo == '3')echo 'checked'; echo '>Imagem à direita da página<br>
<input type="hidden" name="pk_abt" id="pk_abt" value="'.$pk_abt.'">
<input type="hidden" name="pk_abt_conteudo" id="pk_abt_conteudo" value="'.$pk_abt_conteudo.'">
<br>
<input type="submit" name="Submit"  onClick="javascript:update_tour_abt();"  value="Inserir">
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
<b>ALTERAÇÃO DE TOUR</b><br><br>
<a href="#" onClick="javascript:update_cad_bt();""><b>ALTERAR CADASTRO >></b></a>
<br><br>
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
+ adicionar dia >>

</div>';






?>
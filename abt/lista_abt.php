<?php 

require_once '../util/connection.php';

$pega_abt = "
select 
 		pk_abt,
  		nome,
  		to_char(data, 'DD/MM/YY') as data,
  		titulo,
  		ativo,
  		ativo_home
		from conteudo_internet.abt
order by nome
";
 
 
echo'
<b>LISTAGEM DE CONTEUDO DE AROUND BRAZIL TOURS</b><br> 
<div id="boxabt1titulo">TITULO</div>
<div id="boxabt2titulo">DATA</div>
<div id="boxabt2titulo">WEB</div>
<div id="boxabt2titulo">HOME</div>

';

 
$result_abt = pg_exec($conn, $pega_abt);
 
 
if ($result_abt) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_abt); $rowcid++) {
		$nome = pg_result($result_abt, $rowcid, 'nome');
		$pk_abt = pg_result($result_abt, $rowcid, 'pk_abt');
		$data = pg_result($result_abt, $rowcid, 'data');
		$titulo = pg_result($result_abt, $rowcid, 'titulo');
		$ativo = pg_result($result_abt, $rowcid, 'ativo');
		$ativo_home = pg_result($result_abt, $rowcid, 'ativo_home');
		
		
		echo'
		    <div id="boxabt1">&nbsp; <a href="#" class="pkabt"><input type="hidden" class="pkabtvalue" value="'.$pk_abt.'">'.$nome.'</a></div>
		    <div id="boxabt2">'.$data.'</div>
		    <div id="boxabt2">';  if ( $ativo == 't' ){ echo "ativo"; } else { echo "inativo"; } echo ' </div>
		    <div id="boxabt2">';  if ( $ativo_home == 't' ){ echo "ativo"; } else { echo "inativo"; } echo '</div>';
	}
}
 
echo '<br><br>'; 

?>
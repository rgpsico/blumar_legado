<?php
 
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';


$fk_tpocidcod =   pg_escape_string($_POST["fk_tpocidcod"]);

$query_cid = "select  cidade_cod, tpocidcod
						from
							tarifario.cidade_tpo
						 where cidade_cod = $fk_tpocidcod";
$result_cid = pg_exec($conn, $query_cid);
for ($rowci = 0; $rowci < pg_numrows($result_cid); $rowci++) {

	$cidade_cod = pg_result($result_cid, $rowci, 'cidade_cod');
	$fk_tpocidcod = pg_result($result_cid, $rowci, 'tpocidcod');
	
	echo'<input type="hidden" id="cidade_cod" value="'.$cidade_cod.'">';
}	


$pega_tours="select 
             pk_descritivo_tours, 
			 nome_en 
			 from tarifario.descritivo_tours 
			 where 
			 fk_tpocidcod = $fk_tpocidcod 
			 and ( ativo='true' or ativo_tar = 'true') 
			 order by nome_en";



echo 'Selecione um tour<br>
<select name="mneu_for" id="mneu_for"   >
<option value="0,0">------------</option>
';

$result_tours = pg_exec($conn, $pega_tours);
if ($result_tours) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_tours); $rowcid++) {

		$pk_descritivo_tours = pg_result($result_tours, $rowcid, 'pk_descritivo_tours');
		$nome_en = pg_result($result_tours, $rowcid, 'nome_en');
 

		echo '<option value="'.$pk_descritivo_tours.',0">'.$nome_en.'</option>';

	}

}
echo'</select><br>
	ou Tour Avulso <br>
	<input type="text" id="nome_produto"  size="50">';



?>

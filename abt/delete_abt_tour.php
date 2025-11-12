<?php 
 ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

$pk_abt = pg_escape_string($_POST["pk_abt"]);
$pkabttour = pg_escape_string($_POST["pkabttour"]);



	$apaga_dia = " delete from conteudo_internet.abt_conteudo where pk_abt_conteudo = $pkabttour  ";
    pg_query($conn,$apaga_dia);



 
 
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
	
	

echo'<b>DIA APAGADO COM SUCESSO!!</b><br><br>

';

echo'<div id="tour_abt">';
require_once 'abt_tour_form.php';
echo'</div>';









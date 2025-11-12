<?php 
 ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

$pk_abt = pg_escape_string($_POST["pk_abt"]);
$pk_estilo = pg_escape_string($_POST["pk_estilo"]);



	$apaga_estilo_abt = " delete from conteudo_internet.abt_estilos where pk_estilo = $pk_estilo  ";
    pg_query($conn,$apaga_estilo_abt);





$pega_estilos="
	select
		cod_estilo, pk_estilo
	from
		conteudo_internet.abt_estilos
	where
		fk_abt = $pk_abt";


$result_tour = pg_exec($conn, $pega_estilos);


if ($result_tour) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_tour); $rowcid++) {
		$cod_estilo = pg_result($result_tour, $rowcid, 'cod_estilo');
        $pk_estilo = pg_result($result_tour, $rowcid, 'pk_estilo');
		
		
		if($cod_estilo == 1) {echo'-Ecologico | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 2) {echo'-Familia  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 3) {echo'-Praia  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 4) {echo'-Spa  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 5) {echo'-Lua de mel  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 6) {echo'-Safari  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 7) {echo'-Cruzeiros  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 8) {echo'-Tudo incluido  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 9) {echo'-Gastronomia  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 10) {echo'-Aventura  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}
		if($cod_estilo == 11) {echo'-Cultural  | <a href="##" class="pkestilo" title="apagar estilo"><input type="hidden" class="pkestilovalue" value="'.$pk_estilo.'">X</a><br>';}

 

	}
}










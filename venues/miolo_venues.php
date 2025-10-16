<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
require_once '../util/connection.php';

$pega_venue = "
				select * 
				from 
					conteudo_internet.venues
				order by 
					nome
				";


echo '<b>ADMINISTRAÇÃO de CONTEÚDO de VENUES</b><br>';


/*    inicio da area de edição de conteudo   */
if ($_SESSION['consulta'] != 't') {




	echo '
<br>
<a href="#"   onclick="javascript:novo_venue();">Inserir novo Venue >></a><br>
<br> 
Alteração de venues:
<select id="cod_venue"  onChange="javascript:altera_venue();" >
<option value="0" selected>--------------------</option> 
';

	$result_venue = pg_exec($conn, $pega_venue);
	if ($result_venue) {
		for ($rowrest = 0; $rowrest < pg_numrows($result_venue); $rowrest++) {

			$cod_venues = pg_result($result_venue, $rowrest, 'cod_venues');
			$nome = pg_result($result_venue, $rowrest, 'nome');


			echo '<option value="' . $cod_venues . '">' . $nome . '</option>';
		}
	}

	echo '</select><br>';
}
/*    fim da area de edição de conteudo   */


echo '
<br>
<b>PARA CONSULTA</b>
<br>
Template dos Venues Cadastrados: 
<select id="cod_list_venue"  onChange="javascript:lista_venue();" >
<option value="0" selected>--------------------</option> 
';

$result_venue = pg_exec($conn, $pega_venue);
if ($result_venue) {
	for ($rowrest = 0; $rowrest < pg_numrows($result_venue); $rowrest++) {

		$cod_venues = pg_result($result_venue, $rowrest, 'cod_venues');
		$nome = pg_result($result_venue, $rowrest, 'nome');


		echo '<option value="' . $cod_venues . '">' . $nome . '</option>';
	}
}

echo '</select><br><br>
<div id="template_restaurantes"></div>
';

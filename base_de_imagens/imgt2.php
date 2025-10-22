<?php
//funcao para pegar a oto tamnho 2
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';

$pk_bco_img =   pg_escape_string($_POST["pk_bco_img"]);

$pegat1= "select tam_2, nome_produto, legenda, pk_bco_img from banco_imagem.bco_img where pk_bco_img = $pk_bco_img";
$result_pegat1 = pg_exec($conn, $pegat1);
 
	for ($row = 0; $row < pg_numrows($result_pegat1); $row++) 
	     {
	     	$tam_2 = pg_result($result_pegat1, $row, 'tam_2');
	     	$nome_produto = pg_result($result_pegat1, $row, 'nome_produto');
	     	$legenda = pg_result($result_pegat1, $row, 'legenda');
	     	$pk_bco_img = pg_result($result_pegat1, $row, 'pk_bco_img');
	     }

	     
	     echo'<div id="fundo_t2">
	     		<div id="linha1_t2">'.$nome_produto.' - id:'.$pk_bco_img.' </div>
	     		<div id="linha2_t2"><img src="http://www.blumar.com.br/'.$tam_2.'"></div>
	     		<div id="linha3_t2"><b>T2 - 300x200 pixels</b><br>'.$legenda.'</div>
	     		</div>';
	     
	     

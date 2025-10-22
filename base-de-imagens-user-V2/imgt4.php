<?php

ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';

$pk_bco_img =   pg_escape_string($_POST["pk_bco_img"]);

$pegat4= "select tam_4, nome_produto, legenda, pk_bco_img from banco_imagem.bco_img where pk_bco_img = $pk_bco_img";
$result_pegat4 = pg_exec($conn, $pegat4);
 
	for ($row = 0; $row < pg_numrows($result_pegat4); $row++) 
	     {
	     	$tam_4 = pg_result($result_pegat4, $row, 'tam_4');
	     	$nome_produto = pg_result($result_pegat4, $row, 'nome_produto');
	     	$legenda = pg_result($result_pegat4, $row, 'legenda');
	     	$pk_bco_img = pg_result($result_pegat4, $row, 'pk_bco_img');
	     }

	     $img= 'https://www.blumar.com.br/'.$tam_4;
	     list($width, $height) = getimagesize($img);
	     
	     echo'<div id="fundo_t4">
	     		<div id="linha1_t4">'.$nome_produto.' - id:'.$pk_bco_img.'  </div>
	     		<div id="linha2_t4"><img src="https://www.blumar.com.br/'.$tam_4.'"></div>
	     		<div id="linha3_t4"><b>T4 - '.$width.'x'.$height.' pixels </b><br>'.$legenda.'</div>
	     		</div>';
	     
	     

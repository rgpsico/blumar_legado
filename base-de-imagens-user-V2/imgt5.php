<?php

ini_set('display_errors', 1);
error_reporting(~0);





If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';

$pk_bco_img =   pg_escape_string($_POST["pk_bco_img"]);

$pegat5= "select tam_5, nome_produto, legenda, pk_bco_img from banco_imagem.bco_img where pk_bco_img = $pk_bco_img";
$result_pegat5 = pg_exec($conn, $pegat5);
 
	for ($row = 0; $row < pg_numrows($result_pegat5); $row++) 
	     {
	     	$tam_5 = pg_result($result_pegat5, $row, 'tam_5');
	     	$nome_produto = pg_result($result_pegat5, $row, 'nome_produto');
	     	$legenda = pg_result($result_pegat5, $row, 'legenda');
	     	$pk_bco_img = pg_result($result_pegat5, $row, 'pk_bco_img');
	     }

	     $img= 'https://www.blumar.com.br/'.$tam_5;
	     list($width, $height) = getimagesize($img);
	     
	     
	     
	     echo'<div id="fundo_t5">
	     		<div id="linha1_t4">'.$nome_produto.'   - id:'.$pk_bco_img.' ';
	     		if(strlen($legenda) != 0)
					{
						echo' '.substr($legenda, 0, 21).' ';
					} 
		        echo'<b> '.$width.' x '.$height.' pixels</b> </div>
	     		<div id="linha2_t5"><img src="https://www.blumar.com.br/'.$tam_5.'"></div>
	     		</div>';
	     
	     

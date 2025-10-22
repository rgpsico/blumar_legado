<?php

ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';

$pk_bco_img =   pg_escape_string($_POST["pk_bco_img"]);

$pegat3= "select tam_3, nome_produto, legenda, pk_bco_img  from banco_imagem.bco_img where pk_bco_img = $pk_bco_img";
$result_pegat3 = pg_exec($conn, $pegat3);
 
	for ($row = 0; $row < pg_numrows($result_pegat3); $row++) 
	     {
	     	$tam_3 = pg_result($result_pegat3, $row, 'tam_3');
	     	$nome_produto = pg_result($result_pegat3, $row, 'nome_produto');
	     	$legenda = pg_result($result_pegat3, $row, 'legenda');
	     	$pk_bco_img = pg_result($result_pegat3, $row, 'pk_bco_img');
	     }

	     $img= 'https://www.blumar.com.br/'.$tam_3;
	     list($width, $height) = getimagesize($img);
	     
			     if($height > '400')
			     {
			     	echo'<div id="fundo_t32">';
			     }
			     else {
			     	echo'<div id="fundo_t3">';
			     }
	     
	     echo' <div id="linha1_t2">'.$nome_produto.'  - id:'.$pk_bco_img.'  </div>';
			     if($height > '400')
			     {
			     	echo'<div id="linha2_t23">';
			     }
			     else {
			     	echo'<div id="linha2_t2">';
			     }
	     
	     		echo'<img src="https://www.blumar.com.br/'.$tam_3.'"></div>
	     		<div id="linha3_t2"><b>T3 - '.$width.'x'.$height.' pixels</b><br>  '.$legenda.'</div>
	     		</div>';
	     
	     

<?php
//inseção de novo cliente
ini_set('display_errors', 1);
error_reporting(~0);
 
If (isSet($_SESSION)) {} else {session_start();}


require_once '../util/connection.php';


$mneu_for = pg_escape_string($_POST["mneu_for"]);



//modulo de form de cidade
$query_cidade = "select
							pk_cidade_tpo,
							nome_pt,
							nome_en,
							descritivo_pt,
							descritivo_en,
							foto1,
							foto2,
							tpocidcod,
							cidade_cod
						from
							tarifario.cidade_tpo
						order by
							nome_en";
$result_cidade = pg_exec($conn, $query_cidade);
$select_cidade=' <select name="cidade_cod" id="cidade_cod"  >
             <option value="0" selected>Escolha uma cidade</option>';
for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) {
	$nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
	$cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
	$select_cidade= $select_cidade.'<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';
}
$select_cidade= $select_cidade.' </select>';



$pega_rest = "
 		select
 		fk_cod_cidade,
 		cod_rest,
 		(select nome_en from tarifario.cidade_tpo where cidade_cod = fk_cod_cidade) as nome_en
 		from
 		conteudo_internet.restaurante
 		where cod_rest = '$mneu_for' ";
$result_rest = pg_exec($conn, $pega_rest);
for ($rowcid2 = 0; $rowcid2 < pg_numrows($result_rest); $rowcid2++)
{
	$unocidade_cod = pg_result($result_rest, $rowcid2, 'fk_cod_cidade');
	$unonome_en = pg_result($result_rest, $rowcid2, 'nome_en');		
	$sected='<option value="'.$unocidade_cod .'" selected>'.$unonome_en .'</option>';
}
 


echo' <select name="cidade_cod" id="cidade_cod"  >';
echo'<option value="0" >Escolha uma cidade</option>';
echo$sected;
for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++)
{
	$nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
	$cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
	$select_cidade= $select_cidade.'<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';
}
echo' </select>';
<?php
//inseção de novo cliente
ini_set('display_errors', 1);
error_reporting(~0);


If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';

$mneu_for = pg_escape_string($_POST["mneu_for"]);







$pega_cid_venue="select fk_cod_cidade,
                 (select nome_en from tarifario.cidade_tpo where cidade_cod = fk_cod_cidade) as unonome_en
                 
                 from conteudo_internet.venues where cod_venues = '$mneu_for'";
   $result_cid_venue = pg_exec($conn, $pega_cid_venue);
	for ($rowcidt = 0; $rowcidt < pg_numrows($result_cid_venue); $rowcidt++)
		{
			$fk_cod_cidade = pg_result($result_cid_venue, $rowcidt, 'fk_cod_cidade');
			$unonome_en = pg_result($result_cid_venue, $rowcidt, 'unonome_en');
			
			$sected='<option value="'.$fk_cod_cidade.'" selected>'.$unonome_en.'</option>';
		}

		
		
		//modulo de escolha de cidade
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
		$select_cidade=' <select name="cidade_cod" id="cidade_cod"  >';
		
		if(strlen($sected) != 0)
		{
			$select_cidade= $select_cidade.$sected;
		}
		else
		{
			$select_cidade= $select_cidade.'<option value="0" selected>Escolha uma cidade</option>';
		}
		for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) {
			$nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
			$cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
			$select_cidade= $select_cidade.'<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';
		}
		$select_cidade= $select_cidade.' </select>';



		echo'	Escolha uma cidade<br>
	           '.$select_cidade.'';
		
		
		


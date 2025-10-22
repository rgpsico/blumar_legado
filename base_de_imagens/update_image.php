<?php

ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';
 

$pk_bco_img =   pg_escape_string($_POST["pk_bco_img"]);
$mneu_for =   pg_escape_string($_POST["mneu_for"]);
$nome_produto =   pg_escape_string($_POST["nome_produto"]);
$ativo_cli =   pg_escape_string($_POST["ativo_cli"]);
$cidade_cod =   pg_escape_string($_POST["cidade_cod"]);
$tam_1 =   pg_escape_string($_POST["tam_1"]);
$tam_2 =   pg_escape_string($_POST["tam_2"]);
$tam_3 =   pg_escape_string($_POST["tam_3"]);
$tam_4 =   pg_escape_string($_POST["tam_4"]);
$tam_5 =   pg_escape_string($_POST["tam_5"]);
$zip =   pg_escape_string($_POST["zip"]);
$legenda =   pg_escape_string($_POST["legenda"]);
$legenda_pt = pg_escape_string($_POST["legenda_pt"]);
$legenda_esp = pg_escape_string($_POST["legenda_esp"]);
$autor =   pg_escape_string($_POST["autor"]);
$palavras_chave =   pg_escape_string($_POST["palavras_chave"]);
$autorizacao =   pg_escape_string($_POST["autorizacao"]);
$tp_produto =   pg_escape_string($_POST["tp_produto"]);
$navega_cidade_cod = pg_escape_string($_POST["cidade_cod"]);
$fachada =   pg_escape_string($_POST["fachada"]);
$nacional =   pg_escape_string($_POST["nacional"]);
$ordem =   pg_escape_string($_POST["ordem"]);

$update_img="
		update banco_imagem.bco_img
		set
		 mneu_for = '$mneu_for',
         fk_cidcod = '$cidade_cod',
         tam_1 = '$tam_1',
  		 tam_2 = '$tam_2',  
         tam_3 = '$tam_3', 
         tam_4 = '$tam_4',  
         tam_5 = '$tam_5', 
         zip = '$zip',
         legenda = '$legenda',
         legenda_pt = '$legenda_pt',
         legenda_esp = '$legenda_esp',
         autor  = '$autor',
         autorizacao = '$autorizacao',
         palavras_chave = '$palavras_chave',
         tp_produto = '$tp_produto',
         ativo_cli ='$ativo_cli',
         nome_produto =  '$nome_produto',
		 fachada = '$fachada',
		 nacional = '$nacional',
		 ordem = '$ordem'
         where
          pk_bco_img = $pk_bco_img 
	 ";
pg_query($conn, $update_img);


 




if($tp_produto == '1')
{
	


	$pegaumhtl="select nome_for, nome_htl
	FROM
	conteudo_internet.ci_hotel
	left outer JOIN
	sbd95.fornec
	ON
	ci_hotel.mneu_for = sbd95.fornec.mneu_for
	where ci_hotel.mneu_for = '$mneu_for'";
	$result_umhtl = pg_exec($conn, $pegaumhtl);
	if( pg_numrows($result_umhtl) != 0)
	{
		for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++) {
	
			$nome_htl = pg_result($result_umhtl, $rowhtl, 'nome_htl');
			$nome_for = pg_result($result_umhtl, $rowhtl, 'nome_for');
	
	
			if  (strlen($nome_for) != '0')
			{
				$umhtl=  $nome_for;
			}
			else
			{
				$umhtl =  $nome_htl;
			}
	
	
		}
	}
	else
	{
		$pega_nome= "select  nome_produto from banco_imagem.bco_img where mneu_for = '$mneu_for' ";
		$result_nome = pg_exec($conn, $pega_nome);
		for ($row = 0; $row < pg_numrows($result_nome); $row++)
		{
			$umhtl = pg_result($result_nome, $row, 'nome_produto');
		}
	
	}
	
	
 
 
 
 
 
 
}
elseif ($tp_produto == '2')
{

	
	
	$trat_mneu = substr($mneu_for, 0 , 6);
	
	if($trat_mneu == 'avulso')
	{
		$pegaumhtl="select
		nome_produto
		from
		banco_imagem.bco_img
		where
		mneu_for =  '$mneu_for'";
		$result_umhtl = pg_exec($conn, $pegaumhtl);
		for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++)
		{
			$umhtl = pg_result($result_umhtl, $rowhtl, 'nome_produto');
		}
	}
	else
	{
		$pegaumhtl2="select nome_en from tarifario.descritivo_tours where pk_descritivo_tours = '$mneu_for'";
		$result_umhtl2 = pg_exec($conn, $pegaumhtl2);
		for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl2); $rowhtl++)
		{
			$umhtl = pg_result($result_umhtl2, $rowhtl, 'nome_en');
		}
	}
	
	
	 
	 
	
	
}
elseif ($tp_produto == '10')
{

 $pegaumhtl="select  
          		nome_en
			from
			    tarifario.cidade_tpo
			where
			 cidade_cod  = $cidade_cod";
		$result_umhtl = pg_exec($conn, $pegaumhtl);
		for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++) 
				{
					 $umhtl = pg_result($result_umhtl, $rowhtl, 'nome_en');
				 }

 $umhtl = $umhtl.' - '.$legenda;
}
elseif ($tp_produto == '11')
{
$umhtl = 'inspection report';
}
//crio a data now
$ano = date("Y");
$mes = date("m");
$dia =  date("d");
$data_now =  $ano . '-' . $mes . '-' . $dia;

$pk_acesso = $_SESSION['user'];
 
$query_log =
"
INSERT INTO
conteudo_internet.log_adm_conteudo
(
usuario,
acao,
data,
fk_conteudo
)
values
(
'$pk_acesso',
'Atualizou uma imagem  - $umhtl - $mneu_for',
'$data_now',
'36'
)
";
pg_query($conn, $query_log);






echo'<b>ATUALIZADO COM SUCESSO!!</b><br>';


if($tp_produto == '1')
{
	require_once 'pega_htl.php';
}
elseif ($tp_produto == '2')
{
	require_once 'pega_galeria_tour.php';	
}
elseif ($tp_produto == '10')
{
	require_once 'pega_cid_tp10.php';	
}
elseif ($tp_produto == '11')
{
	require_once 'pega_galeria_inspection.php';	
}




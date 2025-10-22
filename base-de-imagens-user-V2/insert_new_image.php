<?php
//inseção de novo cliente
 
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}


require_once '../util/connection.php';

$tp_produto = pg_escape_string($_POST["tp_produto"]);
$mneu_for = pg_escape_string($_POST["mneu_for"]);
$nome_produto = pg_escape_string($_POST["nome_produto"]);
$ativo_cli = pg_escape_string($_POST["ativo_cli"]);
$cidade_cod = pg_escape_string($_POST["cidade_cod"]);
$tam_1 = pg_escape_string($_POST["tam_1"]);
$tam_2 = pg_escape_string($_POST["tam_2"]);
$tam_3 = pg_escape_string($_POST["tam_3"]);
$tam_4 = pg_escape_string($_POST["tam_4"]);
$tam_5 = pg_escape_string($_POST["tam_5"]);
$zip = pg_escape_string($_POST["zip"]);
$legenda = pg_escape_string($_POST["legenda"]);
$legenda_pt = pg_escape_string($_POST["legenda_pt"]);
$legenda_esp = pg_escape_string($_POST["legenda_esp"]);
$autor = pg_escape_string($_POST["autor"]);
$palavras_chave = pg_escape_string($_POST["palavras_chave"]);
$autorizacao = pg_escape_string($_POST["autorizacao"]);
$fachada = pg_escape_string($_POST["fachada"]);
//tratamento do menu for para cada caso!



//tratamento para o tipo
 


$arraymneu_for = pg_escape_string($_POST["mneu_for"]);

$arraymneu = explode(",",$arraymneu_for);

$frncod = $arraymneu[1];
$mneu_for = $arraymneu[0];






//$mneu_for = str_replace(",","", $mneu_for);

if($mneu_for == '')
{
	if($frncod != '0')
	{
		$mneu_for = $frncod;
	}
	else 
	{
	    $mneu_for = 0;
	}

}






//fim do tratamento do menu for para cada caso!





// tratameno da informação para inserir um nome no produto caso nao tenham preenchido nada
if($tp_produto == '1' and strlen($nome_produto) == 0)
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
	
	if(pg_numrows($result_umhtl) != 0)
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
	
	$nome_produto = $umhtl;
	}
	else
	{
		//se não achar o nome do produto na tabela de fornec vejo se não é um avulso
		$select_umavulso = "select distinct nome_produto, mneu_for from banco_imagem.bco_img where mneu_for = '$mneu_for'";
		$result_umavulso = pg_exec($conn, $select_umavulso);
		if(pg_numrows($result_umavulso) != 0)
		{
			for ($rowuav = 0; $rowuav < pg_numrows($result_umavulso); $rowuav++)
			{
				 $nome_produto = pg_result($result_umavulso, $rowuav, 'nome_produto');
			 }
		}
		
		
	}
	
	
	
}

elseif ($tp_produto == '2' and $mneu_for != '0')
{
	
	$pegaumhtl="select nome_en from tarifario.descritivo_tours where pk_descritivo_tours = '$mneu_for'  ";
	$result_umhtl = pg_exec($conn, $pegaumhtl);
	for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++)
		{
			$nome_produto = pg_result($result_umhtl, $rowhtl, 'nome_for');
		 }
	
}
elseif ($tp_produto == '3' and $mneu_for != '0')
{ 

	$pegaumhtl="select  nome from conteudo_internet.venues where cod_venues =  '$mneu_for'";
	$result_umhtl = pg_exec($conn, $pegaumhtl);
	for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++)
		{
			$nome_produto = pg_result($result_umhtl, $rowhtl, 'nome');
		 }


}
elseif ($tp_produto == '11' and $mneu_for != '0')
{ 

 
			$nome_produto = 'Inspection report numero '.$mneu_for;
		 


}




 



//tratamento de mneu_for para produtos avulso
if($mneu_for == '0' )
{
	

$numavulso = array(); 
	
	//$pegaavulso="select max(split_part(mneu_for, 'avulso',2)) as num  from banco_imagem.bco_img";
	$pegaavulso="select distinct split_part(mneu_for, 'avulso',2) as num  from banco_imagem.bco_img";
	
	$result_num = pg_exec($conn, $pegaavulso);
	if(pg_numrows($result_num) != 0)
	{
		for ($row = 0; $row < pg_numrows($result_num); $row++)
		{
			
			$num = pg_result($result_num, $row, 'num');
			if(strlen($num) != 0)
					{
					    array_push($numavulso, $num );
					}
		}
		sort ( $numavulso );
		$valores = count($numavulso);
		$valfin = $valores - 1;
		
		    $next = $numavulso[$valfin] + 1;
			$mneu_for = 'avulso'.$next;
	 }
   else 
	{ 
		$mneu_for = 'avulso1'; 
	}
 
	$av = 'true';
}
else 
{
	  $av = 'false';
 } 

 
 

$_SESSION['cidade_cod'] =  $cidade_cod;
$_SESSION['mneu_for'] =  $mneu_for;
$_SESSION['tp_produto'] =  $tp_produto;



//crio a data now
$ano = date("Y");
$mes = date("m");
$dia =  date("d");
$data_now =  $ano . '-' . $mes . '-' . $dia;
 
 

$insert_imagem="
		insert into  banco_imagem.bco_img
		(
		  mneu_for,
		  fk_cidcod,
		  tam_1,
		  tam_2,
		  tam_3,
		  tam_4,
		  tam_5, 
		  zip,
		  legenda,
		  legenda_esp,
		  legenda_pt,
		  autor,
		  autorizacao,
		  data_cadastro,
		  palavras_chave,
		  tp_produto,
		  ativo_cli,
		  nome_produto,
		  av,
		  fachada
		 )
		values
		(
		'$mneu_for',	
		'$cidade_cod',	
		'$tam_1',	
		'$tam_2',	
		'$tam_3',	
		'$tam_4',	
		'$tam_5',	
		'$zip',	
		'$legenda',	
		'$legenda_esp',	
		'$legenda_pt',	
		'$autor',	
		'$autorizacao',	
		'$data_now',	
		'$palavras_chave',	
		'$tp_produto',	
		'$ativo_cli',	
		'$nome_produto',
		'$av',
		'$fachada'
		) ";
pg_query($conn, $insert_imagem);


 

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
'Inseriu uma nova imagem  - $nome_produto',
'$data_now',
'36'
)
";
pg_query($conn, $query_log);


 


echo'<b>CADASTRO DE IMAGEM REALIZADO COM SUCESSO!</b><br><br>';



require_once 'form_new_img.php';



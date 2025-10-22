<?php
 
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';

if (isset($_POST["tpmneu_for"]))
{
$mneu_for =   pg_escape_string($_POST["tpmneu_for"]);
} 


//echo$mneu_for;

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
					 $nome_for = pg_result($result_umhtl, $rowhtl, 'nome_produto');
				 }
 }
else 
{
	$pegaumhtl2="select nome from conteudo_internet.venues where cod_venues = '$mneu_for'";
    $result_umhtl2 = pg_exec($conn, $pegaumhtl2);
    for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl2); $rowhtl++)
			{
				$nome_for = pg_result($result_umhtl2, $rowhtl, 'nome');
			}
 }


	 


echo'<div id="cabeca_bancoimg"><b>  '.strtoupper($nome_for).' PICTURES</b></div>';



$pega_cidadestp= "select 
				pk_bco_img,  
				mneu_for,
		        tam_1,
				legenda
				from
				banco_imagem.bco_img
				where
				mneu_for = '$mneu_for'";
				$result_cidadestp = pg_exec($conn, $pega_cidadestp);

 //echo pg_numrows($result_cidadestp);

for ($rowcid = 0; $rowcid < pg_numrows($result_cidadestp); $rowcid++)
{
	$pk_bco_img = pg_result($result_cidadestp, $rowcid, 'pk_bco_img');
	$mneu_for = pg_result($result_cidadestp, $rowcid, 'mneu_for');
	$tam_1 = pg_result($result_cidadestp, $rowcid, 'tam_1');
	$legenda = pg_result($result_cidadestp, $rowcid, 'legenda');
	
	 echo'<div id="tumb_bancoimg"><div id="img_bancoimg"><a href="#" class="imgpath"><input type="hidden" class="imgpathvalue" value="'.$pk_bco_img.'"><img src="http://www.blumar.com.br/'.$tam_1.'" width="135" height="90"></a></div>
		<div class="bt_download"> '.$legenda.'</div></div>';	
			
			
}

 




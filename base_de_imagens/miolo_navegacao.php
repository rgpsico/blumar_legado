<?php

ini_set('display_errors', 1);
error_reporting(~0);  


If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';

$pega_tipos="select distinct tp_produto from banco_imagem.bco_img order by tp_produto";
$result_tipos = pg_exec($conn, $pega_tipos);


if(isset($_SESSION['cidade_cod']) && $_SESSION['cidade_cod'] != '0')
{
    $unocidade_cod = $_SESSION['cidade_cod'];

	//monto o select com o codigo da cidade
	$select_unocidade="select cidade_cod, nome_en from tarifario.cidade_tpo where cidade_cod = '$unocidade_cod'";
	$result_unocidade = pg_exec($conn, $select_unocidade);
	if($result_unocidade)
	{
		for ($rowcid2 = 0; $rowcid2 < pg_numrows($result_unocidade); $rowcid2++)
		{
			$ucidade_cod = pg_result($result_unocidade, $rowcid2, 'cidade_cod');
			$unonome_en = pg_result($result_unocidade, $rowcid2, 'nome_en');
			$sected='<option value="'.$ucidade_cod .'" selected>'.$unonome_en .'</option>';
		}
	}

}
else
{
	$sected= '';
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



//echo pg_numrows($result_tipos);

for ($rowtp = 0; $rowtp < pg_numrows($result_tipos); $rowtp++) {

	$tp_produto = pg_result($result_tipos, $rowtp, 'tp_produto');
	// echo$tp_produto.'<br>';

	if($tp_produto == '1') {    echo'Hotel'; }
	elseif($tp_produto == '2') {    echo'Tour'; }
	elseif($tp_produto == '3') {    echo'Venue'; }
	elseif($tp_produto == '4') {    echo'Restaurante'; }
	elseif($tp_produto == '5') {    echo'Gifts'; }
	elseif($tp_produto == '6') {    echo'Transportes'; }
	elseif($tp_produto == '7') {    echo'Various'; }
	elseif($tp_produto == '8') {    echo'Tours for incentives'; }
	elseif($tp_produto == '9') {    echo'Tours technical'; }
	elseif($tp_produto == '10') {    echo'Cidade'; }
	elseif($tp_produto == '11') {    echo'Inspection Report'; }


	echo'<br>';

	$pega_cidadestp= "select distinct fk_cidcod,
	(select nome_en from tarifario.cidade_tpo where cidade_cod = fk_cidcod) as nome_en
	from
	banco_imagem.bco_img
	where
	tp_produto = $tp_produto 
	order by nome_en";
	$result_cidadestp = pg_exec($conn, $pega_cidadestp);

	echo'<select name="navega_cidade_cod'.$tp_produto.'" id="navega_cidade_cod'.$tp_produto.'" ';



	if($tp_produto == '1') {      echo' onChange="javascript:pega_cid_tp1();" '; }
	elseif($tp_produto == '2') {  echo' onChange="javascript:pega_cid_tp2();" ';  }
	elseif($tp_produto == '3') {  echo' onChange="javascript:pega_cid_tp3();" ';  }
	elseif($tp_produto == '4') {  echo' onChange="javascript:pega_cid_tp4();" ';  }
	elseif($tp_produto == '5') {  echo' onChange="javascript:pega_cid_tp5();" '; }
	elseif($tp_produto == '6') {  echo' onChange="javascript:pega_cid_tp6();" '; }
	elseif($tp_produto == '7') {  echo' onChange="javascript:pega_cid_tp7();" '; }
	elseif($tp_produto == '8') {  echo' onChange="javascript:pega_cid_tp8();" ';  }
	elseif($tp_produto == '9') {  echo' onChange="javascript:pega_cid_tp9();" ';  }
	elseif($tp_produto == '10') {  echo' onChange="javascript:pega_cid_tp10();" ';  }
    elseif($tp_produto == '11') {  echo' onChange="javascript:pega_galeria_inspection();" ';  }

		
	echo'>';
  

    if($tp_produto == '11') 
   { 
           echo'<option value="0" selected>Escolha um inspection</option>';
			  $pega_tipo_inspection="select distinct mneu_for from banco_imagem.bco_img where tp_produto = '11'";
			  $result_tipo_inspection = pg_exec($conn, $pega_tipo_inspection);
			
			   for ($rowtip = 0; $rowtip < pg_numrows($result_tipo_inspection); $rowtip++)
				{
					$pk_inpection = pg_result($result_tipo_inspection, $rowtip, 'mneu_for');
					 
					$pega_inpections= "
							SELECT  
								conteudo_internet.ireport_destinations.pk_ireport_destinations as pk_ireport_destinations,
								 conteudo_internet.ireport_destinations.destinos as destinos
							FROM
								conteudo_internet.ireport_destinations
							 where pk_ireport_destinations = $pk_inpection";
					 $result_experts = pg_exec($conn, $pega_inpections);
			
			
				  for ($rowcidi = 0; $rowcidi < pg_numrows($result_experts); $rowcidi++) {
						$destinos = pg_result($result_experts, $rowcidi, 'destinos');
						$pk_ireport_destinations = pg_result($result_experts, $rowcidi, 'pk_ireport_destinations');
						  echo'<option value="'.$pk_ireport_destinations.'">'.$pk_ireport_destinations.' - '.$destinos.'</option>';
					}
			
			   }


   }
else
{

   echo'<option value="0" selected>Escolha uma cidade</option>';
	for ($rowcids = 0; $rowcids < pg_numrows($result_cidadestp); $rowcids++)
	{
		$nome_en = pg_result($result_cidadestp, $rowcids, 'nome_en');
		$fk_cidcod = pg_result($result_cidadestp, $rowcids, 'fk_cidcod');
		echo'<option value="'.$fk_cidcod.'">'.$nome_en.'</option> ';
	}

}



echo'</select>';

	if($tp_produto == '1') {      echo'<div id="miolo_prod1"></div> '; }
	elseif($tp_produto == '2') {  echo'<div id="miolo_prod2"></div> ';  }
	elseif($tp_produto == '3') {  echo'<div id="miolo_prod3"></div>';  }
	elseif($tp_produto == '4') {  echo'<div id="miolo_prod4"></div>';  }
	elseif($tp_produto == '5') {  echo'<div id="miolo_prod5"></div> '; }
	elseif($tp_produto == '6') {  echo'<div id="miolo_prod6"></div> '; }
	elseif($tp_produto == '7') {  echo'<div id="miolo_prod7"></div> '; }
	elseif($tp_produto == '8') {  echo'<div id="miolo_prod8"></div>';  }
	elseif($tp_produto == '9') {  echo'<div id="miolo_prod9"></div> ';  }
	elseif($tp_produto == '10') {  echo'<div id="miolo_prod10"></div> ';  }
	elseif($tp_produto == '11') {  echo'<div id="miolo_prod11"></div> ';  } echo'<br>';	
}

echo'<br><br><a href="relatorio_hoteis.php"  >Relatorio de hoteis</a>';

 















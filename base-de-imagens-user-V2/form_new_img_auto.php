<?php
 
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';


echo'<div id="miolo_autoimage">
<b>CADASTRO AUTOMÁTICO DE IMAGEM</b><br>
		<br>
		Tipo <select id="tp_produto" onchange=" javascript:pega_tp_produto();  	"> 
		    <option value="1" ';  if (isset($_SESSION['tp_produto']) and $_SESSION['tp_produto']=='1' ) { echo 'selected'; } echo'>Hotel</option>			
			<option value="2" ';  if (isset($_SESSION['tp_produto']) &&  $_SESSION['tp_produto']=='2' ) { echo 'selected'; } echo'>Tour</option>
			<option value="3" ';  if (isset($_SESSION['tp_produto']) &&  $_SESSION['tp_produto']=='3' ) { echo 'selected'; } echo'>Venue</option>
		    <option value="4" ';  if (isset($_SESSION['tp_produto']) &&  $_SESSION['tp_produto']=='4' ) { echo 'selected'; } echo'>Restaurante</option>
		    <option value="5" ';  if (isset($_SESSION['tp_produto']) &&  $_SESSION['tp_produto']=='5' ) { echo 'selected'; } echo'>Gifts</option>
		    <option value="6" ';  if (isset($_SESSION['tp_produto']) &&  $_SESSION['tp_produto']=='6' ) { echo 'selected'; } echo'>Transportes</option>
		    <option value="7" ';  if (isset($_SESSION['tp_produto']) &&  $_SESSION['tp_produto']=='7' ) { echo 'selected'; } echo'>Various</option>
		    <option value="8" ';  if (isset($_SESSION['tp_produto']) &&  $_SESSION['tp_produto']=='8' ) { echo 'selected'; } echo'>Tours for incentives</option>
		    <option value="9" ';  if (isset($_SESSION['tp_produto']) &&  $_SESSION['tp_produto']=='9' ) { echo 'selected'; } echo'>Tours technical</option> 
            <option value="10" ';  if (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto']=='10' ) { echo 'selected'; } echo'>Cidade</option> 
            <option value="11" ';  if (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto']=='11' ) { echo 'selected'; } echo'>Inspection Report</option> 
            <option value="0" ';   if (!isset($_SESSION['tp_produto'])   ) { echo 'selected'; } echo'>Selecione um</option>
	 </select>
	<br>	
	<div id="miolo_produto">';
	






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


 


//==================================================================================
// Hotel selection module
if (isset($_SESSION['tp_produto']) and $_SESSION['tp_produto'] == '1' ) { 
	
 

		
			if(isset($_SESSION['mneu_for']))
			{
			
				$lista_umhtl='';
				$mneu_for = $_SESSION['mneu_for'];
				$pegaumhtl="select nome_for,  frncod, nome_htl
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
							$frncod = pg_result($result_umhtl, $rowhtl, 'frncod');
							
							
							$lista_umhtl= $lista_umhtl.'<option value="'.$mneu_for.','.$frncod.'" selected>';
							if  (strlen($nome_for) != '0')
							{
								$lista_umhtl= $lista_umhtl.$nome_for;
							}
							else
							{
								$lista_umhtl =  $lista_umhtl.$nome_htl;
							}
							$lista_umhtl = $lista_umhtl.'</option> ';
					
						}
				}
				else 
				{
					
					
					$select_umavulso = "select distinct nome_produto, mneu_for from banco_imagem.bco_img where mneu_for = '$mneu_for'";
					$result_umavulso = pg_exec($conn, $select_umavulso);
					if(pg_numrows($result_umavulso) != 0)
					{
						for ($rowuav = 0; $rowuav < pg_numrows($result_umavulso); $rowuav++) 
						{
							$mneu_for = pg_result($result_umavulso, $rowuav, 'mneu_for');
							$nome_produto = pg_result($result_umavulso, $rowuav, 'nome_produto');
						       $lista_umhtl= $lista_umhtl.'<option value="'.$mneu_for.',0" selected>'.$nome_produto.'</option>';
						}
					}
					else 
					{
						$lista_umhtl='';
					}
			  }
		}
		else
		{
			$lista_umhtl='';
		}
	
	
	
	
	
					$lista_htl='';
					$query_htl =
					"
						    SELECT
						        conteudo_internet.ci_hotel.nome_htl,
								conteudo_internet.ci_hotel.frncod,
							    sbd95.fornec.nome_for,
							    sbd95.fornec.mneu_for
							FROM
								conteudo_internet.ci_hotel
							left outer JOIN
							    sbd95.fornec
							ON
							    ci_hotel.mneu_for = sbd95.fornec.mneu_for
							order by nome_for
						     ";
					
					$result_htl = pg_exec($conn, $query_htl);
					if ($result_htl) {
						for ($rowhtl = 0; $rowhtl < pg_numrows($result_htl); $rowhtl++) {
					
							$nome_htl = pg_result($result_htl, $rowhtl, 'nome_htl');
							$mneu_for1 = pg_result($result_htl, $rowhtl, 'mneu_for');
							$nome_for = pg_result($result_htl, $rowhtl, 'nome_for');
							$frncod = pg_result($result_htl, $rowhtl, 'frncod');
							
							
							$lista_htl= $lista_htl.'<option value="'.$mneu_for1.','.$frncod.'">';
							if  (strlen($nome_for) != '0')
							{
								$lista_htl= $lista_htl.$nome_for;
							}
							else
							{
								$lista_htl= $lista_htl.$nome_htl;
							}
							$lista_htl= $lista_htl.'</option> ';
						}
					}
	
	
	
	$select_avulso = "select distinct nome_produto, mneu_for from banco_imagem.bco_img where av = 't'  and tp_produto = '1'  order by nome_produto ";
	$result_avulso = pg_exec($conn, $select_avulso);
	
	if (pg_numrows($result_avulso) != 0) {
		for ($rowav = 0; $rowav < pg_numrows($result_avulso); $rowav++) {
	
			$nome_produtoav = pg_result($result_avulso, $rowav, 'nome_produto');
			$mneu_for = pg_result($result_avulso, $rowav, 'mneu_for');
			
			$lista_htl= $lista_htl.'<option value="'.$mneu_for.',0">'.$nome_produtoav.'</option>';
			
		}
	}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	echo' <select name="mneu_for" id="mneu_for"  onChange="javascript:pega_cid_htl();" > ';
	
	if(pg_numrows($result_avulso) != 0)
	{
		echo$lista_umhtl.'<option value="0,0"  >Escolha um hotel / Hotel Avulso</option>';
	}
	else
	{
		echo'<option value="0,0" selected>Escolha um hotel</option>';
	}
	
	
	echo$lista_htl;
	echo' </select> 
	<div id="cidcod">
	ou Hotel Avulso<br>';
		
	if(isset($nome_produto))
	{
		echo'<input type="text" id="nome_produto"  size="50" value="'.$nome_produto.'"><br>';
	}
	else 
	{
		echo'<input type="text" id="nome_produto"  size="50"><br>';
	}
	
	
		
	
	
	echo'Escolha uma cidade<br>
	'.$select_cidade.'<br>
	</div>';
	

}



//==================================================================================
// Tours selection module
if (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '2' ) 
{ 
	if(isset($_SESSION['cidade_cod']))
	{
	 $tourcidade_cod = $_SESSION['cidade_cod'];
	
	 //pego o codigo de cidade certo para tours   
	$query_tpocidcod = "select tpocidcod, nome_en from tarifario.cidade_tpo where cidade_cod = $tourcidade_cod";
	$result_tpocidcod = pg_exec($conn, $query_tpocidcod);	
	for ($rowcidt = 0; $rowcidt < pg_numrows($result_tpocidcod); $rowcidt++) 
	   {
	       $fk_tpocidcod = pg_result($result_tpocidcod, $rowcidt, 'tpocidcod');
	       $nome_en = pg_result($result_tpocidcod, $rowcidt, 'nome_en');
	       
	       $selected=' <option value="'.$fk_tpocidcod.'" selected>'.$nome_en.'</option>';
	   }

	   
	   //pego os tours da mesma cidade
	   $pega_tour="select pk_descritivo_tours, nome_en from tarifario.descritivo_tours where fk_tpocidcod = $fk_tpocidcod";
	   $result_tour = pg_exec($conn, $pega_tour);
 
	
	   
	   
	   
//pego as cidade com tours
	$query_cidade = "
select distinct fk_tpocidcod,
(select nome_en from tarifario.cidade_tpo where tpocidcod::integer = fk_tpocidcod) as nome_cid
 from tarifario.descritivo_tours
 order by nome_cid";
	
	echo'<select name="pegatour"  id="pegatour" onChange="javascript:pega_tour();">';
	echo$selected;
	echo'<option value="0"> Escolha uma cidade para escolher o tour</option>';
	
	$result_cid = pg_exec($conn, $query_cidade);
	if ($result_cid) {
		for ($rowcid = 0; $rowcid < pg_numrows($result_cid); $rowcid++) 
		{
			$nome_cid = pg_result($result_cid, $rowcid, 'nome_cid');
			$fk_tpocidcod = pg_result($result_cid, $rowcid, 'fk_tpocidcod');
			echo '<option value="'.$fk_tpocidcod.'">'.$nome_cid.'</option>' ;
		}
	}
	
	
	

	
	
	
	
	echo'</select><br>
	ou Tour Avulso <br>
	<input type="text" id="nome_produto"  size="50">
			<br><div id="formalteratour"> 
			<input type="hidden" id="cidade_cod" value="'.$tourcidade_cod.'">
	 		Selecione um tour<br>
			<select name="mneu_for" id="mneu_for"   >
			<option value="0,0">------------</option>';
	
		 //mostro os tours da cidade já inserida
			if ($result_tour) {
				for ($rowcid = 0; $rowcid < pg_numrows($result_tour); $rowcid++) {
			
					$pk_descritivo_tours = pg_result($result_tour, $rowcid, 'pk_descritivo_tours');
					$nome_en = pg_result($result_tour, $rowcid, 'nome_en');
			
			
					echo '<option value="'.$pk_descritivo_tours.',0">'.$nome_en.'</option>';
			
				}
			
			}
	 		
	 		
	 		
	 		echo'</select></div><br>';
	
	
	}

}
//==================================================================================
// Tours selection module
if (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '3' )
{
	
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
	

	
	if(isset($_SESSION['cidade_cod']))
	{
		
		$unocidade_cod = $_SESSION['cidade_cod'];
		
		$pega_cid_venue="
				select
					nome_en 
				from 
					tarifario.cidade_tpo 
				where 
					cidade_cod = '$unocidade_cod'";
		$result_cid_venue = pg_exec($conn, $pega_cid_venue);
		for ($rowcidt = 0; $rowcidt < pg_numrows($result_cid_venue); $rowcidt++)
		{
		    $unonome_en = pg_result($result_cid_venue, $rowcidt, 'nome_en');
			$sected='<option value="'.$unocidade_cod.'" selected>'.$unonome_en.'</option>';
		}
		
		
	
		
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
		
	 }
	else
	{
		$select_cidade= '<option value="0" selected>Escolha uma cidade</option>';
	 
		for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) {
			$nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
			$cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
			$select_cidade= $select_cidade.'<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';
		}
		$select_cidade= $select_cidade.' </select>';
		
		
	}
	 
	
	
	
	
	if(isset($_SESSION['mneu_for']))
	{
		
		$ummneu_for = $_SESSION['mneu_for'];
		$pega_umvenue = "
				select *
				from
					conteudo_internet.venues
				 where
				cod_venues = $ummneu_for";
		
 
		
		$result_umvenue = pg_exec($conn, $pega_umvenue);
		if ($result_umvenue) {
			for ($rowv = 0; $rowv < pg_numrows($result_umvenue); $rowv++) 
			{
				$umcod_venues = pg_result($result_umvenue, $rowv, 'cod_venues');
				$umnome = pg_result($result_umvenue, $rowv, 'nome');
                $selected_venue = '<option value="'.$umcod_venues.'" selected>'.$umnome.'</option>';
			 }
		}
		
		
		$pega_venue = "
				select *
				from
					conteudo_internet.venues
				order by
					nome
				";
		
		$select_venue= '<select id="mneu_for" onChange="javascript:pega_cid_venue();" >';
		$select_venue = $select_venue.$selected_venue;
		$select_venue = $select_venue.'<option value="0" >--------------------</option>';
		$result_venue = pg_exec($conn, $pega_venue);
		if ($result_venue) {
			for ($rowrest = 0; $rowrest < pg_numrows($result_venue); $rowrest++) {
				$cod_venues = pg_result($result_venue, $rowrest, 'cod_venues');
				$nome = pg_result($result_venue, $rowrest, 'nome');
				$select_venue= $select_venue.'<option value="'.$cod_venues.'">'.$nome.'</option>';
			}
		}
		
		
		$select_venue = $select_venue.'</select>';
		
	}
	
	 
	
	
	
		echo$select_venue.'<br>	Escolha uma cidade<br>
	           '.$select_cidade.'<br>
	           ou Venue Avulso<br>
	           <input type="text" id="nome_produto"  size="50"><br>';
	
	
}
 
// =========================================================================================
// cidade selection module  numero 10

if (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '10' )
{

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

	$select_cidade='<select name="cidade_cod" id="cidade_cod"  >';

 


		$select_cidade= $select_cidade.'<option value="0" selected>Escolha uma cidade</option>';
	 
		for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) {
			$nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
			$cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
			$select_cidade= $select_cidade.'<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';
		}
		$select_cidade= $select_cidade.' </select>';
		
		
	
	 

		echo'<br> '.$select_cidade.'
	          <br>';
 
echo'<input type="hidden" id="mneu_for" value="0,0">
<input type="hidden" id="nome_produto" value="0"> ';


}



// =========================================================================================
// Inspection Report selection module 11

if (isset($_SESSION['tp_produto']) && $_SESSION['tp_produto'] == '11' )
{
	if(isset($_SESSION['mneu_for'])) { $ummneu_for = $_SESSION['mneu_for']; } else  { $ummneu_for = ''; }

 $pega_inpections= "
				SELECT  
					conteudo_internet.ireport_destinations.pk_ireport_destinations as pk_ireport_destinations,
					conteudo_internet.ireport_destinations.fk_brazilian_experts as fk_brazilian_experts,
					conteudo_internet.ireport_destinations.destinos as destinos,
					conteudo_internet.ireport_destinations.descricao as descricao,
					conteudo_internet.ireport_destinations.data as data,
					 ativo,
					to_char (conteudo_internet.ireport_destinations.data, 'DD/MM/YYYY') as dia_inicio 
				FROM
				    conteudo_internet.ireport_destinations
				order by 
					data desc";

echo'
	<br>Galeria de imagens para Inspection Report<br>
		<SELECT name="mneu_for" id="mneu_for"    >
		<option value="0,0" >Selecione um Inspection Report</option>';

 
 	
	$result_experts = pg_exec($conn, $pega_inpections);
	
	
	if ($result_experts) {
		for ($rowcid = 0; $rowcid < pg_numrows($result_experts); $rowcid++) {
			$destinos = pg_result($result_experts, $rowcid, 'destinos');
			$pk_ireport_destinations = pg_result($result_experts, $rowcid, 'pk_ireport_destinations');
	        $dia_inicio = pg_result($result_experts, $rowcid, 'dia_inicio');
	        $ativo = pg_result($result_experts, $rowcid, 'ativo');
	        
			echo'<option value="'.$pk_ireport_destinations.',0"'; if($ummneu_for == $pk_ireport_destinations) { echo' selected '; } echo'>'.$pk_ireport_destinations.'- '.$destinos.' - '.$dia_inicio.' - ';
					
				if($ativo == 't')
				{
					echo'Ativo';
				}
				else {echo'Inativo';}	 
							
							
					echo' </option>';
	
		}
	}
	

	
	echo'</select><br><br>
<input type="hidden" id="nome_produto" value="0"> 
<input type="hidden" id="cidade_cod" value="0">'; 

}


echo '</div> 
<br>Caminho do folder<br>
<input type="text" id="path_img"  size="80"><br>
<br>
Tamanhos<br>
<input name="med"  id="med"  type="checkbox"  checked>  med 
<input name="grd"  id="grd"  type="checkbox"  checked> grd 
<input name="orig"  id="orig"  type="checkbox"  checked> orig 
<input name="zip"  id="zip"  type="checkbox"  checked> zip<br>
<br>
Autor<br>
	<input type="text" id="autor"  size="80"><br>
	<br>	
	Autorização / Observações<br>
	<textarea cols="70" rows="7" id="autorizacao"></textarea><br>	
	<br>
	<input name="ativo_cli"  id="ativo_cli"  type="checkbox"  checked> Ativo para clientes<br>
    <br>
	<input type="submit" name="Submit"  onClick="javascript:insert_auto_image();"  value="Inserir">
	<br>
	<br>
 
';




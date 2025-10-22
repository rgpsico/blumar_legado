<?php
 
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';


$tp_produto =   pg_escape_string($_POST["tp_produto"]);
$_SESSION['tp_produto'] =  $tp_produto;





//pego a cidade se existir a variavel de sessao
if(isset($_SESSION['cidade_cod']))
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








//hoteis
if ($tp_produto == '1')
{
	
	if(isset($_SESSION['mneu_for']))
	{
		//echo$mneu_for;
		
		$lista_umhtl='';
		$mneu_for = $_SESSION['mneu_for'];
		$pegaumhtl="select nome_for, frncod, nome_htl 
			FROM
				conteudo_internet.ci_hotel
			left outer JOIN
			    sbd95.fornec
			ON
			    ci_hotel.mneu_for = sbd95.fornec.mneu_for
			 where ci_hotel.mneu_for = '$mneu_for'";
		$result_umhtl = pg_exec($conn, $pegaumhtl);
		for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++) {
		
			$nome_htl = pg_result($result_umhtl, $rowhtl, 'nome_htl');
		    $nome_for = pg_result($result_umhtl, $rowhtl, 'nome_for');
		    $frncod = pg_result($result_umhtl, $rowhtl, 'frncod');
		    
		
		    $lista_umhtl= $lista_umhtl.'<option value="'.$mneu_for.'" selected>';
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
	
 	
	$lista_htl='';
	$query_htl ="SELECT
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
			order by nome_for";
	
	$result_htl = pg_exec($conn, $query_htl);
	if ($result_htl) {
		for ($rowhtl = 0; $rowhtl < pg_numrows($result_htl); $rowhtl++) {
	
			$nome_htl = pg_result($result_htl, $rowhtl, 'nome_htl');
			$mneu_for = pg_result($result_htl, $rowhtl, 'mneu_for');
			$nome_for = pg_result($result_htl, $rowhtl, 'nome_for');
			$frncod = pg_result($result_htl, $rowhtl, 'frncod');
			
			
			$lista_htl= $lista_htl.'<option value="'.$mneu_for.','.$frncod.'">';
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
	
	
	$select_avulso = "select distinct nome_produto, mneu_for from banco_imagem.bco_img where av = 't'  and tp_produto = '1' order by nome_produto";
	$result_avulso = pg_exec($conn, $select_avulso);
	
	if (pg_numrows($result_avulso) != 0) {
		for ($rowav = 0; $rowav < pg_numrows($result_avulso); $rowav++) {
	
			$nome_produtoav = pg_result($result_avulso, $rowav, 'nome_produto');
			$mneu_for = pg_result($result_avulso, $rowav, 'mneu_for');
				
			$lista_htl= $lista_htl.'<option value="'.$mneu_for.',0">'.$nome_produtoav.'</option>';
				
		}
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	echo'<select name="mneu_for" id="mneu_for"  onChange="javascript:pega_cid_htl();" >';
		  
		if(strlen($lista_umhtl) != 0)
		{
			echo$lista_umhtl.'<option value="0,0" >Escolha um hotel</option>';
	    }
	    else 
	    {
	    	echo'<option value="0,0" selected>Escolha um hotel</option>';
	    }
 
		  
	echo$lista_htl;
	echo' </select> <br>
	ou Hotel Avulso<br>
	<input type="text" id="nome_produto"  size="50"><br>
	<div id="cidcod">	Escolha uma cidade<br>
			'.$select_cidade.'
	<br></div>';

}

//

//====================================================================================
//tours
elseif ($tp_produto == '2')
{

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
	
echo'<select name="pegatour"  id="pegatour" onChange="javascript:pega_tour();">
	 <option value="0" selected> Escolha uma cidade para escolher o tour</option>';
	
$result_cid = pg_exec($conn, $query_cidade);
if ($result_cid) {
	for ($rowcid = 0; $rowcid < pg_numrows($result_cid); $rowcid++) {
		$nome_cid = pg_result($result_cid, $rowcid, 'nome_en');
		$fk_tpocidcod = pg_result($result_cid, $rowcid, 'cidade_cod');
		echo '<option value="'.$fk_tpocidcod.'">'.$nome_cid.'</option>' ;
    }
}
echo'</select><br><div id="formalteratour"></div>';

 }
 
 
 
 //====================================================================================
 //venues
 elseif ($tp_produto == '3')
 {
 	$pega_venue = "
				select *
				from
					conteudo_internet.venues
				order by
					nome
				";
 	
echo'<select id="mneu_for" onChange="javascript:pega_cid_venue();" >
 	<option value="0" selected>--------------------</option>';
 	
$result_venue = pg_exec($conn, $pega_venue);
if ($result_venue) {
	for ($rowrest = 0; $rowrest < pg_numrows($result_venue); $rowrest++) {
		$cod_venues = pg_result($result_venue, $rowrest, 'cod_venues');
		$nome = pg_result($result_venue, $rowrest, 'nome');
		echo '<option value="'.$cod_venues.'">'.$nome.'</option>';
	}
}
 	
echo '</select><br> 
	 <div id="cidcod">
	Escolha uma cidade<br>
	'.$select_cidade.'</div>
	ou Venue Avulso<br>
	<input type="text" id="nome_produto"  size="50"><br>';
 	
 }
 
 
 
 
 //====================================================================================
 //restaurantes
 elseif ($tp_produto == '4')
 { 
 
 
 		$pega_rest = "
 		select
 		cod_rest,
 		nome
 		from
 		conteudo_internet.restaurante
 		 order
 		by nome
 		";
     $result_rest = pg_exec($conn, $pega_rest);	
     
 echo'<select id="mneu_for"   onChange="javascript:pega_cid_rest();"  >
 <option value="0" selected>--------------------</option>';
 	
 
 
 		if ($result_rest) {
 			for ($rowrest = 0; $rowrest < pg_numrows($result_rest); $rowrest++) {
 				$cod_rest = pg_result($result_rest, $rowrest, 'cod_rest');
 				$nome = pg_result($result_rest, $rowrest, 'nome');
 				echo '<option value="'.$cod_rest.'">'.$nome.'</option>';
 			}
 		}
 echo '</select><br> 
	ou Restaurante Avulso<br>
	<input type="text" id="nome_produto"  size="50"><br>
 	<div id="cidcod">	Escolha uma cidade<br>
	'.$select_cidade.'<br>';
 }
 
 
 
 
 //====================================================================================
 //gifts
 elseif ($tp_produto == '5')
 {
 echo'Nome do produto<br>
 	  <input type="text" id="nome_produto"  size="50">
 	  <input type="hidden" id="mneu_for" value="0">	<br>
	<br>
	Escolha uma cidade<br>
	'.$select_cidade.'<br>';
 }
 
 
 
 //====================================================================================
 //Transportes
 elseif ($tp_produto == '6')
 {
 	echo'Nome do produto<br>
 	  <input type="text" id="nome_produto"  size="50"> 
 	  <input type="hidden" id="mneu_for" value="0"><br>
	<br>
	Escolha uma cidade<br>
	'.$select_cidade.'<br>';
 }
 
 
 
 //====================================================================================
 //varios
 elseif ($tp_produto == '7')
 {
 	$pega_various = "select *
				from
					conteudo_internet.various
				order by
					nome";
echo' <select id="mneu_for"   >
 	<option value="0" selected>--------------------</option>';
 	
$result_various = pg_exec($conn, $pega_various);
if ($result_various) {
	for ($rowrest = 0; $rowrest < pg_numrows($result_various); $rowrest++) {
		$cod_various = pg_result($result_various, $rowrest, 'cod_various');
		$nome = pg_result($result_various, $rowrest, 'nome');
		echo '<option value="'.$cod_various.'">'.$nome.'</option>';
	}
}
echo '</select><br>
	  Varios avulso<br>
 	  <input type="text" id="nome_produto"  size="50">
 	  <input type="hidden" id="mneu_for" value="0"><br>
	  <br>
	  Escolha uma cidade<br>
	  '.$select_cidade.'<br>';
 }
 
 
 
 //====================================================================================
 //Tours for incentives
 elseif ($tp_produto == '8')
 {
 	echo'Nome do produto<br>
 	  <input type="text" id="nome_produto"  size="50">
 	  <input type="hidden" id="mneu_for" value="0"><br>
	<br>
	Escolha uma cidade<br>
	'.$select_cidade.'<br>';
 }
 
 
 
 
 //====================================================================================
 //Tours technical
 elseif ($tp_produto == '9')
 {
 	echo'Nome do produto<br>
 	  <input type="text" id="nome_produto"  size="50">
 	  <input type="hidden" id="mneu_for" value="0"><br>
	<br>
	Escolha uma cidade<br>
	'.$select_cidade.'<br>';
 }
 
 
 //====================================================================================
 //cidades
 
 elseif ($tp_produto == '10')
 {
 	echo'<input type="hidden" id="nome_produto" value="0"> 
 	  <input type="hidden" id="mneu_for" value="0,0">
	
	Escolha uma cidade<br>
	'.$select_cidade.'<br>';
 }
 
 
 //====================================================================================
//Inspection reports
elseif ($tp_produto == '11')
{
 
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
		<option value="0,0" selected>Selecione um Inspection Report</option>';

 
 	
	$result_experts = pg_exec($conn, $pega_inpections);
	
	
	if ($result_experts) {
		for ($rowcid = 0; $rowcid < pg_numrows($result_experts); $rowcid++) {
			$destinos = pg_result($result_experts, $rowcid, 'destinos');
			$pk_ireport_destinations = pg_result($result_experts, $rowcid, 'pk_ireport_destinations');
	        $dia_inicio = pg_result($result_experts, $rowcid, 'dia_inicio');
	        $ativo = pg_result($result_experts, $rowcid, 'ativo');
	        
			echo'<option value="'.$pk_ireport_destinations.',0">'.$pk_ireport_destinations.'- '.$destinos.' - '.$dia_inicio.' - ';
					
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
<input type="hidden" id="cidade_cod" value="0"> 

     ';





 }
  
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
?>
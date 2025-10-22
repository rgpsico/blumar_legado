
<?php
//nao reconhece


ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';


$pk_bco_img =   pg_escape_string($_POST["pk_bco_img"]);


$pega_cidadestp= "select
				pk_bco_img,
				  mneu_for,
				  fk_cidcod,
				  tam_1,
				  tam_2,
				  tam_3,
				  tam_4,
				  tam_5,
				  zip,
				  legenda,
				  legenda_pt,
				  legenda_esp,
				  autor,
				  origem,
				  autorizacao,
				  data_cadastro,
				  palavras_chave,
				  tp_produto,
				  ativo_cli,
				  nome_produto,
				  (select nome_for from sbd95.fornec where mneu_for = banco_imagem.bco_img.mneu_for ) as nome_for,
				  fachada,
				  nacional,
				  ordem
				 from
				banco_imagem.bco_img
				where
				pk_bco_img = $pk_bco_img";
				$result_cidadestp = pg_exec($conn, $pega_cidadestp);




for ($rowcid = 0; $rowcid < pg_numrows($result_cidadestp); $rowcid++)
{
	$pk_bco_img = pg_result($result_cidadestp, $rowcid, 'pk_bco_img');
	$mneu_for = pg_result($result_cidadestp, $rowcid, 'mneu_for');
	$fk_cidcod = pg_result($result_cidadestp, $rowcid, 'fk_cidcod');
	$tam_1 = pg_result($result_cidadestp, $rowcid, 'tam_1');
	$tam_2 = pg_result($result_cidadestp, $rowcid, 'tam_2');
	$tam_3 = pg_result($result_cidadestp, $rowcid, 'tam_3');
	$tam_4 = pg_result($result_cidadestp, $rowcid, 'tam_4');
	$tam_5 = pg_result($result_cidadestp, $rowcid, 'tam_5');
	$zip = pg_result($result_cidadestp, $rowcid, 'zip');
	$legenda = pg_result($result_cidadestp, $rowcid, 'legenda');
	$legenda_pt = pg_result($result_cidadestp, $rowcid, 'legenda_pt');
	$legenda_esp = pg_result($result_cidadestp, $rowcid, 'legenda_esp');
	$autor = pg_result($result_cidadestp, $rowcid, 'autor');
	$origem = pg_result($result_cidadestp, $rowcid, 'origem');
	$autorizacao = pg_result($result_cidadestp, $rowcid, 'autorizacao');
	$palavras_chave = pg_result($result_cidadestp, $rowcid, 'palavras_chave');
	$tp_produto = pg_result($result_cidadestp, $rowcid, 'tp_produto');
	$ativo_cli = pg_result($result_cidadestp, $rowcid, 'ativo_cli');
	$nome_produto = pg_result($result_cidadestp, $rowcid, 'nome_produto');
	$nome_for = pg_result($result_cidadestp, $rowcid, 'nome_for');
	$fachada = pg_result($result_cidadestp, $rowcid, 'fachada');
	$nacional = pg_result($result_cidadestp, $rowcid, 'nacional');
	$ordem = pg_result($result_cidadestp, $rowcid, 'ordem');
}



echo $fachada;

 

	//monto o select com o codigo da cidade
	$select_unocidade="select cidade_cod, nome_en from tarifario.cidade_tpo where cidade_cod = '$fk_cidcod'";
	$result_unocidade = pg_exec($conn, $select_unocidade);
	if(pg_numrows($result_unocidade) != '0')
	{
		for ($rowcid2 = 0; $rowcid2 < pg_numrows($result_unocidade); $rowcid2++)
		{
			$ucidade_cod = pg_result($result_unocidade, $rowcid2, 'cidade_cod');
			$unonome_en = pg_result($result_unocidade, $rowcid2, 'nome_en');
			$sected='<option value="'.$ucidade_cod .'" selected>'.$unonome_en .'</option>';
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
	

	
for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) 
	{
		$nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
		$cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
		$select_cidade= $select_cidade.'<option value="'.$cidade_cod.'">'.$nome_en.'</option>';
	}
	
	
$select_cidade= $select_cidade.' </select>';
	
	
	
	
	
	
	if($tp_produto == '1')
	{
	
				$lista_umhtl='';
				$pegaumhtl="select nome_for, nome_htl
				FROM
				conteudo_internet.ci_hotel
				left outer JOIN
				sbd95.fornec
				ON
				ci_hotel.mneu_for = sbd95.fornec.mneu_for
				where ci_hotel.mneu_for = '$mneu_for'";
				$result_umhtl = pg_exec($conn, $pegaumhtl);
				for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++) 
				{
						
					$nome_htl = pg_result($result_umhtl, $rowhtl, 'nome_htl');
					$nome_for = pg_result($result_umhtl, $rowhtl, 'nome_for');
						
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
	elseif ($tp_produto == '2')
	{
		$trat_mneu = substr($mneu_for, 0 , 6);
		
		if($trat_mneu == 'avulso')
		{
         //pego o nome do tour selecionado para alteração para montar o select
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
				$lista_umhtl= '<option value="'.$mneu_for.'" selected>'.$nome_for.'</option>';
				
			 }
		}
		 else
		 {
		 	$pegaumhtl2="select nome_en from tarifario.descritivo_tours where pk_descritivo_tours = '$mneu_for'";
		 	$result_umhtl2 = pg_exec($conn, $pegaumhtl2);
		 	for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl2); $rowhtl++)
		 	{
		 		$nome_for = pg_result($result_umhtl2, $rowhtl, 'nome_en');
		 		$lista_umhtl= '<option value="'.$mneu_for.'" selected>'.$nome_for.'</option>';
		 	}
		 }
		 	
		 
		  
	 
		 
		 //pego o cod de cidade do tour selecionado do cadastro de tour para montar o select   
		 $query_cid = "select nome_en, tpocidcod, cidade_cod
		 from
		 tarifario.cidade_tpo
		 where cidade_cod = $fk_cidcod";
		 $result_cid = pg_exec($conn, $query_cid);
		 for ($rowci = 0; $rowci < pg_numrows($result_cid); $rowci++) {
		 
		 	$tpocidcod = pg_result($result_cid, $rowci, 'tpocidcod');
		 	$nome_en= pg_result($result_cid, $rowci, 'nome_en');
		 	$selected_cidade= '<option value="'.$tpocidcod.'" selected>'.$nome_en.'</option>';
		 } 
		 
		 
		 
         //pego todos os tours da cidade do tour selecionado
		 $pega_tours="select pk_descritivo_tours, nome_en from tarifario.descritivo_tours where fk_tpocidcod = $tpocidcod";
		 
		  
	}
	elseif ($tp_produto == '10')
	{
	
	
	}
	elseif ($tp_produto == '11')
	{
    $lista_uminsp ='<option value="0" >Escolha um inspection</option>';
			 
			
			   
					 
					 
					$pega_inpections= "
							SELECT  
								pk_ireport_destinations,
								destinos
							FROM
								conteudo_internet.ireport_destinations
                             order by pk_ireport_destinations
							 ";
					 $result_experts = pg_exec($conn, $pega_inpections);
			
			
				  for ($rowcidi = 0; $rowcidi < pg_numrows($result_experts); $rowcidi++) {
						$destinos = pg_result($result_experts, $rowcidi, 'destinos');
						$pk_ireport_destinations = pg_result($result_experts, $rowcidi, 'pk_ireport_destinations');
						   $lista_uminsp =  $lista_uminsp.'<option value="'.$pk_ireport_destinations.'"'; if($mneu_for == $pk_ireport_destinations) { $lista_uminsp =  $lista_uminsp.' selected '; } $lista_uminsp =  $lista_uminsp.'>'.$pk_ireport_destinations.' - '.$destinos.'</option>';
					}
			
			   

   }
	
	
	
	
	
	





echo'
	 <input type="hidden" id="pk_bco_img" value="'.$pk_bco_img.'">
		<b>ATUALIZAÇÃO DE CADASTRO DE IMAGEM</b>  <div id="back" style=" float: right; margin: 0px 10px 0px 0px;">';
		
if($tp_produto == '1')
{
    echo'<input type="hidden" id="tpmneu_for1" value="'.$mneu_for.'">
         <input type="hidden" id="fk_cidcod" value="'.$fk_cidcod.'">
    	<a href="#" onclick="javascript: pega_htl();" >';
 }
 elseif ($tp_produto == '2')
 {
 	echo'<input type="hidden" id="fk_cidcod" value="'.$fk_cidcod.'">
 		 <a href="#" onclick="javascript: pega_galeria_tour();" >'; 	
 }
  elseif ($tp_produto == '10')
 {
 	echo'<input type="hidden" id="tpmneu_for1" value="0">
         <input type="hidden" id="fk_cidcod" value="'.$fk_cidcod.'">
 		 <a href="#"  onclick="javascript: pega_cidade();" >'; 	
 }
  elseif ($tp_produto == '11')
 {
 	echo'<input type="hidden" id="tpmneu_for1" value="'.$mneu_for.'">
         <input type="hidden" id="fk_cidcod" value="'.$fk_cidcod.'">
 		 <a href="#" onclick="javascript: pega_galeria_inspection();" >'; 	
 }
		
		echo'<b>VOLTAR >></b></a></div><br>
		<img src="https://www.blumar.com.br/'.$tam_2.'">
		<br>

		Tipo <select id="tp_produto" onchange=" javascript:pega_tp_produto();  	">
		    <option value="1" ';  if ($tp_produto  == '1' ) { echo 'selected'; } echo'>Hotel</option>
			<option value="2" ';  if ($tp_produto  == '2' ) { echo 'selected'; } echo'>Tour</option>
			<option value="3" ';  if ($tp_produto  == '3' ) { echo 'selected'; } echo'>Venue</option>
		    <option value="4" ';  if ($tp_produto  == '4' ) { echo 'selected'; } echo'>Restaurante</option>
		    <option value="5" ';  if ($tp_produto  == '5' ) { echo 'selected'; } echo'>Gifts</option>
		    <option value="6" ';  if ($tp_produto  == '6' ) { echo 'selected'; } echo'>Transportes</option>
		    <option value="7" ';  if ($tp_produto  == '7' ) { echo 'selected'; } echo'>Various</option>
		    <option value="8" ';  if ($tp_produto  == '8' ) { echo 'selected'; } echo'>Tours for incentives</option>
		    <option value="9" ';  if ($tp_produto  == '9' ) { echo 'selected'; } echo'>Tours technical</option>
            <option value="10" ';  if ($tp_produto  == '10' ) { echo 'selected'; } echo'>Cidade</option>
            <option value="11" ';  if ($tp_produto  == '11' ) { echo 'selected'; } echo'>Inspection Report</option>
		    <option value="0" >Selecione um</option>
	 </select>
	<br>
	<div id="miolo_produto">';


if($tp_produto == '1')
{

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
		$mneu_forhtl = pg_result($result_htl, $rowhtl, 'mneu_for');
		$nome_for = pg_result($result_htl, $rowhtl, 'nome_for');

		$lista_htl= $lista_htl.'<option value="'.$mneu_forhtl.'">';
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

echo' <select name="mneu_for" id="mneu_for"  onChange="javascript:pega_cid_htl();" > ';

if(strlen($lista_umhtl) != 0)
{
	echo $lista_umhtl;
}
else
{
	echo'<option value="0" selected>Escolha um hotel</option>';
}


echo $lista_htl;
echo' </select> <br>
	ou Hotel Avulso<br>
	<input type="text" id="nome_produto"  size="50" value="'.$nome_produto.'"><br>
	<div id="cidcod">	Escolha uma cidade<br>
	'.$select_cidade.'<br></div>';

}
elseif ($tp_produto == '2')
{


	


	//pego as cidade com tours
	$query_cidade = "
select distinct fk_tpocidcod,
(select nome_en from tarifario.cidade_tpo where tpocidcod::integer = fk_tpocidcod) as nome_cid
 from tarifario.descritivo_tours
 order by nome_cid";
	
	echo'<select name="pegatour"  id="pegatour" onChange="javascript:pega_tour();">';
	echo $selected_cidade;
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
	
	echo'</select>
	 <br>
	 Tour Avulso <br>
	 <input type="text" id="nome_produto"  size="50" value="'.$nome_produto.'">
			<br>
	<div id="formalteratour"> ou Selecione um tour<br>
	 	<input type="hidden" id="cidade_cod" value="'.$fk_cidcod.'">
		<select name="mneu_for" id="mneu_for"   >
		<option value="0">------------</option>';
	
	echo $lista_umhtl;
	
	$result_tours = pg_exec($conn, $pega_tours);
	if ($result_tours) {
		for ($rowcid = 0; $rowcid < pg_numrows($result_tours); $rowcid++) 
		{
			$pk_descritivo_tours = pg_result($result_tours, $rowcid, 'pk_descritivo_tours');
			$nome_en = pg_result($result_tours, $rowcid, 'nome_en');
			 echo '<option value="'.$pk_descritivo_tours.'">'.$nome_en.'</option>';
		}
			
	}
	echo'</select></div><br>';

}
	elseif ($tp_produto == '10')
{
 echo'<br>
        <input type="hidden" id="nome_produto" value="0"> 
	 	<input type="hidden" id="cidade_cod" value="'.$fk_cidcod.'">
        <input type="hidden" id="mneu_for" value="'.$mneu_for.'">';

}
	elseif ($tp_produto == '11')
{

 echo'<br>
        <input type="hidden" id="nome_produto" value="0"> 
	 	<input type="hidden" id="cidade_cod" value="'.$fk_cidcod.'">
        <select name="mneu_for" id="mneu_for"    >'.$lista_uminsp.'</select><br>';

     
}
 









	echo'</div>';
			
	
			
			
			
		echo'	<br>
	Tamanho 1 - thumbnail (135 x 90)<br>	
	<input type="text" id="tam_1"  size="70" value="'.$tam_1.'"><br>
	<br>
	Tamanho 2 - (300 x 200)<br>
	<input type="text" id="tam_2"  size="70" value="'.$tam_2.'"><br>
	<br>
	Tamanho 3 - (450 x 300)<br>
	<input type="text" id="tam_3"  size="70" value="'.$tam_3.'"><br>	
	<br>
	Tamanho 4 - (840 x 559)<br>
	<input type="text" id="tam_4"  size="70" value="'.$tam_4.'"><br>		
	<br>
	Tamanho 5 - original<br>
	<input type="text" id="tam_5"  size="70" value="'.$tam_5.'"><br>		
	<br>
	Zip - arquivo compactado<br>
	<input type="text" id="zip"  size="70" value="'.$zip.'"><br>';
	
	if($tp_produto == '1')
	{
		$pega_aptos="select 
					 apto,
					  apto_e,
					  apto_p,
					  vista,
					  vista_e,
					  vista_p 
					  from sbd95.apto_htl
					  where mneu_for = '$mneu_for'";
		$result_pega_aptos = pg_exec($conn, $pega_aptos);
		if ($result_pega_aptos) {
			
			echo'<br><b>Tipos de aptos disponiveis para '.$nome_produto.' - '.$mneu_for.'</b><br>
					<table border="1" cellspacing="0" cellpadding="0" width="600">
					<tr><td width="200" align="center"><b>Ingles</b></td><td width="200" align="center"><b>Portugues</b></td><td width="200" align="center"><b>Espanhol</b></td></tr>';
			
		 
			for ($rowa = 0; $rowa < pg_numrows($result_pega_aptos); $rowa++)
			{
				$apto = pg_result($result_pega_aptos, $rowa, 'apto');
				$apto_e = pg_result($result_pega_aptos, $rowa, 'apto_e');
				$apto_p = pg_result($result_pega_aptos, $rowa, 'apto_p');
				$vista = pg_result($result_pega_aptos, $rowa, 'vista');
				$vista_e = pg_result($result_pega_aptos, $rowa, 'vista_e');
				$vista_p = pg_result($result_pega_aptos, $rowa, 'vista_p');
				
				echo'<tr><td align="center">'.$apto.' - '.$vista.'</td><td align="center">'.$apto_p.' - '.$vista_p.'</td><td align="center">'.$apto_e.' - '.$vista_e.'</td></tr>';
			}
		
		
		echo'</table><br>';
		}
	
	
	}		
				
		
		
	echo'<br>
	Legenda<br>
	<input type="text" id="legenda"  size="70" value="'.$legenda.'"><br>	
	<br>
	Legenda em Português<br>
	<input type="text" id="legenda_pt"  size="70" value="'.$legenda_pt.'"><br>
	<br>
	Legenda em Espanhol<br>
	<input type="text" id="legenda_esp"  size="70" value="'.$legenda_esp.'"><br>	
	 <br>
	Autor<br>
	<input type="text" id="autor"  size="70" value="'.$autor.'"><br>
	<br>	
	Autorização / Observações<br>
	<textarea cols="70" rows="7" id="autorizacao">'.$autorizacao.'</textarea><br>	
	<br>
	Palavras chave<br>	
	<textarea cols="70" rows="3" id="palavras_chave">'.$palavras_chave.'</textarea><br>
	Ordem	<br>
	<select name="ordem" id="ordem"   >';
			if($ordem == '0')
			{
			echo'<option value="0" selected>0</option>';
			}
		else
		{
		echo'<option value="'.$ordem.'" selected>'.$ordem.'</option>
		<option value="0">0</option>';
		}
		
		echo'
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		 </select><br> 
	<br>
	<input name="ativo_cli"  id="ativo_cli"  type="checkbox" ';  if($ativo_cli == 't'){echo'checked';}    echo'  > Ativo para clientes<br>
	<br>
	<input name="fachada"  id="fachada"  type="checkbox" ';  if($fachada == 't'){echo'checked';}    echo'  > É Fachada<br>
	<br>
	<input name="nacional"  id="nacional"  type="checkbox" ';  if($nacional == 't'){echo'checked';}    echo'  > Ativo Nacional<br>
	<br>
	<input type="submit" name="Submit"  onClick="javascript:update_image();"  value="Inserir">
			
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="#" onclick="javascript:apaga_htl();"><img src="../images/del.png" border="0"></a>		
	<br>
	<br>';





















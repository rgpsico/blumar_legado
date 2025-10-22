<?php
//inseção de novo cliente
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}
 

require_once '../util/connection.php';

 
$arraymneu_for = pg_escape_string($_POST["mneu_for"]);

$arraymneu = explode(",",$arraymneu_for);
 
$frncod = $arraymneu[1];
$mneu_for = $arraymneu[0];


if(strlen($mneu_for) == 0)
{
	$mneu_for = 0;
}





// echo'-'.$mneu_for.'-'.$frncod;

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

//se tiver menu_for ele prossegue por aqui 
if($mneu_for != '0')
{

					//pego onome da cidade do hotel
					$select_cid="select cid,
					(select nome_cid from sbd95.cidades where cid = fornec.cid  ) as nome_cid
					from sbd95.fornec where mneu_for = '$mneu_for'";
					$result_cid = pg_exec($conn, $select_cid);
					if(pg_numrows($result_cid) != 0)
					{
					     for ($rowcid = 0; $rowcid < pg_numrows($result_cid); $rowcid++)
							{
								$nome_cid = pg_result($result_cid, $rowcid, 'nome_cid');
							}
					 }
					else 
					{
					   $pegacidav= "select distinct fk_cidcod, 
					               (select upper(nome_en) from tarifario.cidade_tpo where   cidade_cod = fk_cidcod )  as nome_cid
					               from 
					                   banco_imagem.bco_img 
					               where  
					                   mneu_for = '$mneu_for' ";
					   $result_cid = pg_exec($conn, $pegacidav);
					   for ($rowcid = 0; $rowcid < pg_numrows($result_cid); $rowcid++)
					   {
					   	$nome_cid = pg_result($result_cid, $rowcid, 'nome_cid');
					   }
						
					}
					
					
					
					
					
					//monto o select com o codigo da cidade
					$select_unocidade="select cidade_cod, nome_en from tarifario.cidade_tpo where upper(nome_en) = '$nome_cid'";
					$result_unocidade = pg_exec($conn, $select_unocidade);
					if($result_unocidade)
					{
					for ($rowcid2 = 0; $rowcid2 < pg_numrows($result_unocidade); $rowcid2++)
					{
						$unocidade_codhtl = pg_result($result_unocidade, $rowcid2, 'cidade_cod');
						$unonome_enthl = pg_result($result_unocidade, $rowcid2, 'nome_en');
						$sected='<option value="'.$unocidade_codhtl.'" selected>'.$unonome_enthl.'</option>';
					}
					}
					else
					{
						$sected='';
					}
			 
			 
			
			
			
			if (!isset($unocidade_codhtl))
			{
				
				
				$select_cidade='
	            ou Hotel Avulso<br>
	            <input type="text" id="nome_produto"  size="50"><br> 
				<select name="cidade_cod" id="cidade_cod"  >
			             <option value="0" selected>Escolha uma cidade</option>';
				for ($rowcid1 = 0; $rowcid1 < pg_numrows($result_cidade); $rowcid1++) {
					$nome_en = pg_result($result_cidade, $rowcid1, 'nome_en');
					$cidade_cod = pg_result($result_cidade, $rowcid1, 'cidade_cod');
					$select_cidade= $select_cidade.'<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';
				}
				$select_cidade= $select_cidade.' </select>';
				
				 
				
				echo' <b>ATENÇÃO:</b> a cidade deste hotel (<b>'.$nome_cid.'</b>) nao foi cadastrada ainda, você pode voltar no cadastro de cidades e acrescentar esta cidade ou prosseguir escolhendo outra cidade abaixo.<br>';
			     echo$select_cidade;
			}
			else 
			{
				         echo'
	                      ou Hotel Avulso<br>
	                     <input type="text" id="nome_produto"  size="50"><br> 
				         <select name="cidade_cod" id="cidade_cod"  >';
				      
			             echo$sected;
						 for ($rowcid2 = 0; $rowcid2 < pg_numrows($result_cidade); $rowcid2++) 
						   {
							$nome_en = pg_result($result_cidade, $rowcid2, 'nome_en');
							$cidade_cod = pg_result($result_cidade, $rowcid2, 'cidade_cod');
							echo'<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';
						   }
			              echo' </select>';
			} 
				 
 

}
else 
{
	
	
	

	//se for um hotel avulso do cadastro de hoteis seleciona a cidade de lá!
	if($frncod != 0)
	{
	//echo$frncod.'-';
	            //pego o codigo da cidade do hotel
				$pegacid= "select cidade_htl, nome_htl from conteudo_internet.ci_hotel where frncod = $frncod";
				$result_pegacid = pg_exec($conn, $pegacid);
				for ($rowcid = 0; $rowcid < pg_numrows($result_pegacid); $rowcid++)
				{
					$cidade_htl = pg_result($result_pegacid, $rowcid, 'cidade_htl');
					$nome_htl = pg_result($result_pegacid, $rowcid, 'nome_htl');
				}
				
				 
				//se ele for diferente de zero pego o nome da cidade
				if($cidade_htl != '0')
				{
					$pega_nomecid="select nome_en from tarifario.cidade_tpo where cidade_cod = $cidade_htl ";
					$result_pega_nomecid = pg_exec($conn, $pega_nomecid);
					for ($row = 0; $row < pg_numrows($result_pega_nomecid); $row++)
						{
							$unonome_en = pg_result($result_pega_nomecid, $row, 'nome_en');
							$sected='<option value="'.$cidade_htl.'" selected>'.$unonome_en.'</option>';
							
							

							echo'
	                        ou Hotel Avulso<br>
						    <input type="text" id="nome_produto"  size="50" value="'.$nome_htl.'"><br> 
						    <select name="cidade_cod" id="cidade_cod"  >';
							
							echo$sected;
							for ($rowcid2 = 0; $rowcid2 < pg_numrows($result_cidade); $rowcid2++)
							{
								$nome_en = pg_result($result_cidade, $rowcid2, 'nome_en');
								$cidade_cod = pg_result($result_cidade, $rowcid2, 'cidade_cod');
								echo'<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';
							}
							echo' </select>';
							
							
							
							
							
							
						 }
						 
						 
						 
						 
						 
						 
				 }
				 //senao monto o select para escolher a cidade
				 else
				 {
				    echo'
	                ou Hotel Avulso<br>
	                <input type="text" id="nome_produto"  size="50"><br> 
				    <select name="cidade_cod" id="cidade_cod"  >  
				    <option value="0" selected>Escolha uma cidade</option>';
				 	for ($rowcid2 = 0; $rowcid2 < pg_numrows($result_cidade); $rowcid2++)
							 	{
							 		$nome_en = pg_result($result_cidade, $rowcid2, 'nome_en');
							 		$cidade_cod = pg_result($result_cidade, $rowcid2, 'cidade_cod');
							 		echo'<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';
							 	}
				 	echo' </select>';
				 
				 }
			
	
	}
	else 
	{
		
			
	echo'
	ou Hotel Avulso<br>
	<input type="text" id="nome_produto"  size="50"><br> 
	<select name="cidade_cod" id="cidade_cod"  >  
	<option value="0" selected>Escolha uma cidade</option>';
	 for ($rowcid2 = 0; $rowcid2 < pg_numrows($result_cidade); $rowcid2++)
	{
		$nome_en = pg_result($result_cidade, $rowcid2, 'nome_en');
		$cidade_cod = pg_result($result_cidade, $rowcid2, 'cidade_cod');
		echo'<option value="'.$cidade_cod.'">'.$nome_en.'</option> ';
	}
	echo' </select>';
		
	}
	
	
	
	
	
}



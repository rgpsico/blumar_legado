 

<?php

if(session_id() == '') {
	session_start();
}
 
 require_once '../util/connection.php';

 echo '<b>ADMINISTRA&Ccedil;&Atilde;O DE CONTEUDO DE HOTEIS</b><br><br>';

 
 
 $hoteis_pendentes="select nome_for, mneu_for
			from sbd95.fornec 
			where 
			categ = 'Hotel' 
			and status = 'true'
			and sbd95.fornec.mneu_for not in (select mneu_for from conteudo_internet.ci_hotel)
			order by nome_for";
  $result_hoteis_pendentes = pg_exec($conn, $hoteis_pendentes);
 $lista_pendentes="";
 for ($htl = 0; $htl < pg_numrows($result_hoteis_pendentes); $htl++) 
      {
 	            $nome_for = pg_result($result_hoteis_pendentes, $htl, 'nome_for');
                $mneu_for = pg_result($result_hoteis_pendentes, $htl, 'mneu_for');
                
            $lista_pendentes=$lista_pendentes.' <option value="'.$mneu_for.'" >'.$nome_for.'</option>';     
       }
 
 
 
 
 
 
 
 
 
 
/*    inicio da area de edição de conteudo   */
if ($_SESSION['consulta'] != 't')
 {
 //
		 echo '	    
			    Inserir novo Hotel <br>
			    <select name="mneu_for" id="mneu_for"    onChange="javascript:novo_hotel();"> 
			    <option value="0" selected>Escolha um hotel para cadastrar</option>
			    '.$lista_pendentes.'
			    </select>
			    
			    <br><br>
			    <form name="frmcities" method="post" action="##"  >
			    <br>Altera&ccedil;&atilde;o de Hoteis<br>
			    <select name="frncod" id="frncod"    onChange="javascript:altera_hotel();"> 
			    <option value="0" selected>Escolha um hotel para alterar</option>
		     ';
		
		
		 
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
		 		$frncod = pg_result($result_htl, $rowhtl, 'frncod');
		 		$nome_for = pg_result($result_htl, $rowhtl, 'nome_for');
		 		 	
		 		echo '<option value="'.$frncod.'">';
		 		if  (strlen($nome_for) != '0') 
		 		{
		 			echo 	$nome_for;
		 		}
		 		else 
		 		{
		 			echo  $nome_htl;
		 		}  
		 		 
		 		echo '</option> ';
		 			
		 			
		 	}
		 }
		echo '</select>
		   <br> 
		   <br>Alteração de Hoteis por cidades<br>
		   <select name="frncod2" id="frncod2"  onChange="javascript:altera_hotel2();">
		   <option value="0" selected>--------------------</option>
		   ';



	echo $query_cid_htl =
	"
		select
			trim(upper(tarifario.cidade_tpo.nome_en)) as nome_cidade,
			tarifario.cidade_tpo.tpocidcod,
			sbd95.cidades.nome_cid,
			sbd95.cidades.cid
		from sbd95.cidades
			inner join tarifario.cidade_tpo on sbd95.cidades.nome_cid = trim(upper(tarifario.cidade_tpo.nome_en))
		order by nome_en
	";
	
	$result_cid_htl = pg_exec($conn, $query_cid_htl);
	if ($result_cid_htl) {
		for ($rowcidhtl = 0; $rowcidhtl < pg_numrows($result_cid_htl); $rowcidhtl++) {
	
			$nome_cidade = pg_result($result_cid_htl, $rowcidhtl, 'nome_cidade');
			$cid = pg_result($result_cid_htl, $rowcidhtl, 'cid');
			 
		   echo'
		   <option value=" "  > </option> 
		   <option value=" "    >'.$nome_cidade.'</option>
		   <option value=" "  >--------------------------------------- </option> 
		   ';
		
			   $query_cid_hoteis =
			   "
			   
			   
			      SELECT
				        conteudo_internet.ci_hotel.nome_htl,
						conteudo_internet.ci_hotel.frncod,
					    sbd95.fornec.nome_for
					FROM
						conteudo_internet.ci_hotel
					left outer JOIN 
					    sbd95.fornec 
					ON 
					    ci_hotel.mneu_for = sbd95.fornec.mneu_for
				where categ = 'Hotel' and status = 'true' and cid = '$cid' 
				   ORDER BY nome_for ASC   
				 
			
			   ";
		
			   $result_cid_hoteis = pg_exec($conn, $query_cid_hoteis);
			   if ($result_cid_hoteis) {
			   	for ($rowcidhtls = 0; $rowcidhtls < pg_numrows($result_cid_hoteis); $rowcidhtls++) {
			   
			   		$frncod = pg_result($result_cid_hoteis, $rowcidhtls, 'frncod');
			   		$nome_for = pg_result($result_cid_hoteis, $rowcidhtls, 'nome_for');
			   		$nome_htl = pg_result($result_cid_hoteis, $rowcidhtls, 'nome_htl');
			   
                   echo '<option value="'.$frncod.'">';
			 		if  (strlen($nome_for) != '0') 
			 		{
			 			echo 	$nome_for;
			 		}
			 		else 
			 		{
			 			echo  $nome_htl;
			 		}  
			 		 
			 		echo '</option> ';
 			
			   		
			   	
			   	}
			   	
			   }
		
		
		}
	}



			echo '
			</select>
			<br><br>
			<a href="##"  onclick="javascript:cadastro_fac();">Cadastro de facilidades >></a>
			';


   }
/*    fim da area de edição de conteudo   */

			
			


echo '<br>
<br>
<b>PARA CONSULTA</b>
<br>

Listagem de Cadastrados (em inglês)<br>  
  <select name="cidcod" id="cidcod"  onChange="javascript:listagem_htl_ingles();">
   <option value="0" selected>--------------------</option>';
   

		$query_cid_ing =
		"
			select
				trim(upper(tarifario.cidade_tpo.nome_en)) as nome_cidade,
				tarifario.cidade_tpo.tpocidcod,
				sbd95.cidades.nome_cid,
				sbd95.cidades.cid
			from sbd95.cidades
				inner join tarifario.cidade_tpo on sbd95.cidades.nome_cid = trim(upper(tarifario.cidade_tpo.nome_en))
			order by nome_en
		";
		
		$result_cid_ing = pg_exec($conn, $query_cid_ing);
		if ($result_cid_ing) {
			for ($rowciding = 0; $rowciding < pg_numrows($result_cid_ing); $rowciding++) {
		
				$nome_cidade = pg_result($result_cid_ing, $rowciding, 'nome_cidade');
				$cid = pg_result($result_cid_ing, $rowciding, 'cid');
		
				echo' <option value="'.$cid.'" >'.$nome_cidade.'</option> ';
		
			}
		
		}
		
   
echo '</select> 

<br><br><b>RELATORIOS</b><br>
<a href="hotel/relatorio-hoteis-nacional.php"   >- Listagem de hoteis  <b>NACIONAL</b> >></a><br> 
<a href="##"  onclick="javascript:listagem_selo_new();">- Listagem de hoteis com selo <b>"NEW"</b> >></a><br>
<a href="##"  onclick="javascript:listagem_selo_unique();">- Listagem de hoteis com selo <b>"UNIQUE"</b> >></a><br>
<a href="##"  onclick="javascript:listagem_selo_luxury();">- Listagem de hoteis com selo <b>"Eco Friendly"</b> >></a><br>   		
<a href="##"  onclick="javascript:listagem_selo_favoritos();">- Listagem de hoteis com selo <b>"FAVORITO"</b> >></a><br>  		
<a href="##"  onclick="javascript:listagem_health_safe();">- Listagem de hoteis com formulário <b>"HEALTH & SAFE"</b> >></a><br>  		
<a href="##"  onclick="javascript:listagem_shealth_safe();">- Listagem de hoteis do tarifario 172 sem formulário <b>"HEALTH & SAFE"</b> >></a><br>  		   		
   		
   		
   		
<br>Template de Hoteis<br>
<select name="consultahotel" id="consultahotel"    onChange="javascript:consulta_hotel();">
<option value="0" selected>Escolha um hotel para ver o template</option>
';


	
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
		$frncod = pg_result($result_htl, $rowhtl, 'frncod');
		$nome_for = pg_result($result_htl, $rowhtl, 'nome_for');
		$mneu_for = pg_result($result_htl, $rowhtl, 'mneu_for'); 	
		echo '<option value="'.$mneu_for.'">';
		if  (strlen($nome_for) != '0')
		{
			echo 	$nome_for;
		}
		else
		{
			echo  $nome_htl;
		}

		echo '</option> ';


	}
}
echo '</select>
<br>
 

';



?>
<br><br>

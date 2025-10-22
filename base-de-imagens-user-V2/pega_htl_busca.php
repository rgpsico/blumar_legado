<?php
 
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once 'util/connection.php';

if (isset($_POST["tpmneu_for"]))
{
$mneu_for =   pg_escape_string($_POST["tpmneu_for"]);
} 
else {$mneu_for = $mneu_for;}




//echo$mneu_for; 





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
 
echo'<div id="mapa-eco" ></div><div id="cabeca_bancoimg"><b>  '.strtoupper($umhtl).' PICTURES  </b> <strong>|</strong> <a href="https://www.blumar.com.br/client_area/rates/new_pop_hotel.php?cod_hotel='.$mneu_for.'&lang=2&hotel='.strtoupper($umhtl).'" target="_new">Check hotel page >></a>    |   <a href="#" onclick="javascript: back_search_result();" > <b>BACK TO SEARCH RESULT >></b></a></div>';
 
$pega_cidadestp= "select 
				pk_bco_img,  
				mneu_for,
				(select nome_for from sbd95.fornec where mneu_for = banco_imagem.bco_img.mneu_for ) as nome_for,
				tam_1,
				tam_2,
				tam_3,
				tam_4,
				tam_5,
				zip,
				legenda,
                autor,
				ordem,
				nacional,
				fachada
				from
				banco_imagem.bco_img
				where
				mneu_for = '$mneu_for'
                and tp_produto = '1'
				order by  ordem = 0 nulls last, legenda";
				$result_cidadestp = pg_exec($conn, $pega_cidadestp);

 //echo pg_numrows($result_cidadestp);

for ($rowcid = 0; $rowcid < pg_numrows($result_cidadestp); $rowcid++)
{
	$pk_bco_img = pg_result($result_cidadestp, $rowcid, 'pk_bco_img');
	$mneu_for = pg_result($result_cidadestp, $rowcid, 'mneu_for');
	$tam_1 = pg_result($result_cidadestp, $rowcid, 'tam_1');
	$legenda = pg_result($result_cidadestp, $rowcid, 'legenda');
	$zip = pg_result($result_cidadestp, $rowcid, 'zip');
	$tam_5 = pg_result($result_cidadestp, $rowcid, 'tam_5');
	$tam_4 = pg_result($result_cidadestp, $rowcid, 'tam_4');
	$tam_3 = pg_result($result_cidadestp, $rowcid, 'tam_3');
	$tam_2 = pg_result($result_cidadestp, $rowcid, 'tam_2');
	$autor = pg_result($result_cidadestp, $rowcid, 'autor');
	$ordem = pg_result($result_cidadestp, $rowcid, 'ordem');
	$nacional = pg_result($result_cidadestp, $rowcid, 'nacional');
	$fachada = pg_result($result_cidadestp, $rowcid, 'fachada');
	
	 echo'<div id="tumb_bancoimg">';
		if(strlen($legenda) != 0)
		{
			echo'<div class="legenda"> <b>'.ucfirst($legenda).'  | &copy; '.ucfirst($autor).'</b></div>';
		}

if(strlen($tam_4) != 0)
  {
          $tam_4 = str_replace(" ","%20",$tam_4 );	
          $img4 = "https://www.blumar.com.br/".$tam_4;
          $size = getimagesize($img4);
          $width = $size[0];
             if ( $width == '840')
                   {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca"><input type="hidden" class="imgpathvaluebusca" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="560" height="373"></a></div>';
                   }
           elseif ( $width == '450')
                   {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca"><input type="hidden" class="imgpathvaluebusca" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="450" height="300"></a></div>';
                   }
                   else
                    {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca"><input type="hidden" class="imgpathvaluebusca" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="249" height="373"> <img src="https://www.blumar.com.br/'.$tam_4.'" width="249" height="373"></a></div>';
                   }
 	}
elseif(strlen($tam_3) != 0)
		{
		  echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca"><input type="hidden" class="imgpathvaluebusca" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_3.'" width="450" height="300"></a></div>';
	    }
elseif(strlen($tam_2) != 0)
		{
		  echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca"><input type="hidden" class="imgpathvaluebusca" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_2.'" width="300" height="200"></a></div>';
	    }

  echo'</div>';	
 }

 




 <?php


ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';


if (isset($_POST["mneu_for"]))
{
$mneu_for =   pg_escape_string($_POST["mneu_for"]);
} 
else 
{
$mneu_for = $mneu_for;
}



                 $pega_inpections= "
							SELECT  
								conteudo_internet.ireport_destinations.pk_ireport_destinations as pk_ireport_destinations,
								 conteudo_internet.ireport_destinations.destinos as destinos
							FROM
								conteudo_internet.ireport_destinations
							 where pk_ireport_destinations = $mneu_for";
					 $result_experts = pg_exec($conn, $pega_inpections);
			
			
				  for ($rowcidi = 0; $rowcidi < pg_numrows($result_experts); $rowcidi++) {
						$destinos = pg_result($result_experts, $rowcidi, 'destinos');
						
					}



echo'<div id="mapa-eco" ></div><div id="cabeca_bancoimg"><b>INSPECTION REPORT PICTURES of  '.strtoupper($destinos).' </b></div>';
 
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
				legenda
				from
				banco_imagem.bco_img
				where
				mneu_for = '$mneu_for'
				order by legenda";
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
	
	
	 echo'<div id="tumb_bancoimg"><div id="img_bancoimg"><img src="https://www.blumar.com.br/'.$tam_1.'" width="135" height="90"></div>';
 	 
	 echo'<div id="bt_imgstp">';
	 
	 if(strlen($tam_2) != 0)
	 {
	 	echo'<div id="bt_zip"><a href="#" title=" 300 x 200 " class="imgpatht2"><input type="hidden" class="imgpatht2value" value="'.$pk_bco_img.'">T2</a></div>';
	 }
	 
	 if(strlen($tam_3) != 0)
	 {
	 	echo'<div id="bt_zip"><a href="#" title=" 450 x 300 " class="imgpatht3"><input type="hidden" class="imgpatht3value" value="'.$pk_bco_img.'">T3</a></div>';
	 }
	  
	 if(strlen($tam_4) != 0)
	 {
	 	echo'<div id="bt_zip"><a href="#" title=" 840 x 560 " class="imgpatht4"><input type="hidden" class="imgpatht4value" value="'.$pk_bco_img.'">T4</a></div>';
	 }
 	 
	 if(strlen($tam_5) != 0)
	 {
	 	echo'<div id="bt_zip"><a href="#" title=" Original size " class="imgpatht5"><input type="hidden" class="imgpatht5value" value="'.$pk_bco_img.'">T5</a></div>';
	 }
	 
	 if(strlen($zip) != 0)
	 {
	 	echo'<div id="bt_zip"><a href="#" title=" Compressed file ">zip</a></div>';
	 }
 	 
	 echo'<div id="bt_zip2"><a href="#" class="imgpath"><input type="hidden" class="imgpathvalue" value="'.$pk_bco_img.'"><img src="../images/edit_img.png" title="edit image" ></a></div>';
	 
		echo'</div>';
		if(strlen($legenda) != 0)
		{
			echo'<div class="bt_download"> <b>'.substr($legenda, 0, 21).'</b></div>';
		}
		echo'<div class="bt_download">id: '.$pk_bco_img.' </div>';
		  
		echo'</div>';	
 }

 



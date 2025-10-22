
<?php
//nao reconhece


ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once 'util/connection.php';


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

 
 echo'<div id="cabeca_bancoimg"> ';  
              if ($tp_produto  == '1' ) { echo 'Hotel - '; }  
			  if ($tp_produto  == '10' ) { echo 'Citie - '; } 
    
	
	if($tp_produto == '1')
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
				for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++) 
				{
						
					$nome_htl = pg_result($result_umhtl, $rowhtl, 'nome_htl');
					$nome_for = pg_result($result_umhtl, $rowhtl, 'nome_for');
						
					 
					if  (strlen($nome_for) != '0')
					{
						echo  $nome_for;
					}
					else
					{
						echo  $nome_htl;
					}
					 
						
				}
	
	}
	 
	elseif ($tp_produto == '10')
	{
	

       $pegaumhtl="select  
          		nome_en
			from
			    tarifario.cidade_tpo
			where
			 cidade_cod  = $fk_cidcod";
		$result_umhtl = pg_exec($conn, $pegaumhtl);
		for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++) 
				{
					 $nome_cid = pg_result($result_umhtl, $rowhtl, 'nome_en');
				
                    echo'<b>'.$nome_cid.'</b>' ;
                 }




	
	}
	 
			   

  
	
	echo ' - '.$legenda;
 echo'</div>
	 <input type="hidden" id="pk_bco_img" value="'.$pk_bco_img.'">
		 <div id="back" style=" float: right; margin: 0px 10px 0px 0px;">';
		
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
		
		echo'<b>BACK TO GALLERY >></b></a></div><br>

<div id="img_grd">';



if(strlen($tam_4) != 0)
         {
         echo'<img src="https://www.blumar.com.br/'.$tam_4.'" >';
        }
elseif(strlen($tam_3) != 0)
		{
		 echo'<img src="https://www.blumar.com.br/'.$tam_3.'" >';
         }
elseif(strlen($tam_2) != 0)
		{
		 echo'<img src="https://www.blumar.com.br/'.$tam_2.'" >'; 
        }







echo'</div>

		 
	<div id="img_disponiveis">
<div id="img_disponiveis3">AVAILABLE SIZES & INFOS</div>';
 if(strlen($tam_1) != 0)
	 {
	 	echo'<div id="img_disponiveis2"><a href="https://www.blumar.com.br/'.$tam_1.'"   download><strong>THUMB</strong> - 135 px X 90 px  &nbsp;&nbsp;<img src="images/download_img_bank2.png" alt="Download image in 135px X 90px"></a></div>';
	 }


 if(strlen($tam_2) != 0)
	 {
	 	echo'<div id="img_disponiveis2"><a href="https://www.blumar.com.br/'.$tam_2.'"   download><strong>SMALL</strong> - 300 px X 200 px  &nbsp;&nbsp;<img src="images/download_img_bank2.png" alt="Download image in 300px X 200px"></a></div>';
	 }
	 
	 if(strlen($tam_3) != 0)
	 {
	 	echo'<div id="img_disponiveis2"><a href="https://www.blumar.com.br/'.$tam_3.'"   download><strong>MEDIUM</strong> - 450 px X 300 px  &nbsp;&nbsp;<img src="images/download_img_bank2.png" alt="Download image in 450px X 300px"></a></div>';
	 }
	  
	 if(strlen($tam_4) != 0)
	 {
	 	echo'<div id="img_disponiveis2"><a href="https://www.blumar.com.br/'.$tam_4.'"   download><strong>BIG</strong> - 840 px X 560 px  &nbsp;&nbsp;<img src="images/download_img_bank2.png" alt="Download image in 840px X 560px"></a></div>';
	 }
 	 
	 if(strlen($tam_5) != 0)
     {
	 	   $tam_5 = str_replace(" ","%20",$tam_5 );	
           $img5 = "https://www.blumar.com.br/".$tam_5;
           $size = getimagesize($img5);
           echo'<div id="img_disponiveis2"><a href="https://www.blumar.com.br/'.$tam_5.'"   download><strong>ORIGINAL</strong> - '.$size[0].' px X '.$size[1].' px  &nbsp;&nbsp;<img src="images/download_img_bank2.png" alt="Download image in '.$size[0].'px X '.$size[1].'px"></a></div>';
	 }
	 
	 if(strlen($zip) != 0)
	 {
	 	echo'<div id="img_disponiveis2"><a  href="https://www.blumar.com.br/'.$zip.'"   download>Original Compressed file (zip)  &nbsp;&nbsp;<img src="images/download_img_bank2.png" alt="Download original image in zip format"></a></div>';
	 }
 	 
    echo'<div id="img_disponiveis2">-----------------------------------------------------------</div>';

    echo'<div id="img_disponiveis2"><strong>Author:</strong> '.$autor.' </div>';

   echo'<div id="img_disponiveis2"><strong>Authorization:</strong> '.$autorizacao.' </div>';

  // echo'<div id="img_disponiveis2">Keywords: '.$palavras_chave.' </div>';
echo' </div> ';

 

 

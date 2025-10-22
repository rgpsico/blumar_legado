<?php

 

ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once 'util/connection.php';

if (isset($_POST["navega_cidade_cod"]) && $_POST["navega_cidade_cod"] != 0)
{
    $cidade_cod =   pg_escape_string($_POST["navega_cidade_cod"]);
}
elseif(isset($cidade_cod) )
{

 } 
 else
 {
echo'nenhuma cidade selecionada';
exit();
 }
 
 
 


//echo$mneu_for;
/*
$trat_mneu = substr($mneu_for, 0 , 6);

if($trat_mneu == 'avulso')
{
	    $pegaumhtl="select  
          		nome_produto
			from
			banco_imagem.bco_img
			where
			tp_produto = 2
	        and fk_cidcod = $cidade_cod";
		$result_umhtl = pg_exec($conn, $pegaumhtl);
		for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++) 
				{
					 $nome_for = pg_result($result_umhtl, $rowhtl, 'nome_produto');
				 }
 }
else 
{
	$pegaumhtl2="select nome_en from tarifario.descritivo_tours where pk_descritivo_tours = '$mneu_for'";
    $result_umhtl2 = pg_exec($conn, $pegaumhtl2);
    for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl2); $rowhtl++)
			{
				$nome_for = pg_result($result_umhtl2, $rowhtl, 'nome_en');
			}
 }


*/



 
     $pegaumhtl="select  
          		nome_en
			from
			    tarifario.cidade_tpo
			where
			 cidade_cod  = $cidade_cod";
		$result_umhtl = pg_exec($conn, $pegaumhtl);
		for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++) 
				{
					 $nome_cid = pg_result($result_umhtl, $rowhtl, 'nome_en');
				 }


		 






$pega_cidadestp= "select 
				pk_bco_img,  
				mneu_for,
		        tam_1,
				tam_2,
				tam_3,
				tam_4,
				tam_5,
				zip,
				legenda,
                autor
				from
				banco_imagem.bco_img
				where
				tp_produto = 10
	            and fk_cidcod = '$cidade_cod'
				order by legenda";
				$result_cidadestp = pg_exec($conn, $pega_cidadestp);

 //echo pg_numrows($result_cidadestp);


echo'<div id="mapa-eco" ></div><div id="cabeca_bancoimg"><b>  '.strtoupper($nome_cid).'  PICTURES - '.pg_numrows($result_cidadestp).' images available</b></div>';



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
	
	 echo'<div id="tumb_bancoimg">';
		if(strlen($legenda) != 0)
		{
			echo'<div  class="legenda"> <b>'.ucfirst($legenda).'  | &copy; '.ucfirst($autor).'</b></div>';
		}
		  
        
if(strlen($tam_4) != 0)
  {
           $tam_4 = str_replace(" ","%20",$tam_4 );	
           $img4 = "https://www.blumar.com.br/".$tam_4;
           $size = getimagesize($img4);
          $width = $size[0];
             if ( $width == '840')
                   {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpath"><input type="hidden" class="imgpathvalue" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="560" height="373"></a></div>';
                   }
           elseif ( $width == '450')
                   {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpath"><input type="hidden" class="imgpathvalue" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="450" height="300"></a></div>';
                   }
                   else
                    {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpath"><input type="hidden" class="imgpathvalue" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="249" height="373"> <input type="hidden" class="imgpathvalue" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="249" height="373"></a></div>';
                   }
 	}
elseif(strlen($tam_3) != 0)
		{
		  echo'<div id="img_bancoimg"><a href="#" class="imgpath"><input type="hidden" class="imgpathvalue" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_3.'" width="450" height="300"></a></div>';
	    }
elseif(strlen($tam_2) != 0)
		{
		  echo'<div id="img_bancoimg"><a href="#" class="imgpath"><input type="hidden" class="imgpathvalue" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_2.'" width="300" height="200"></a></div>';
	    }




 echo'</div>';	
			
			
}





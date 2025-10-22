<?php
 
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once 'util/connection.php';


if(isSet($_POST["busca"]))
{
	$busca =   pg_escape_string(strtolower($_POST["busca"]));
 	$_SESSION['buscaargument'] =  $busca;
}
else
{
    $busca =   $_SESSION['buscaargument'];
}





//busca hotel

$pega_htls= "select distinct banco_imagem.bco_img.mneu_for,
	sbd95.fornec.nome_for as nome_for,
	nome_produto
	from
	banco_imagem.bco_img
	inner join sbd95.fornec on banco_imagem.bco_img.mneu_for = sbd95.fornec.mneu_for
	where
	nome_produto ILIKE LOWER ('%$busca%') 
	order by nome_for";
	$result_htls = pg_exec($conn,  $pega_htls);



$pega_cidades= "	select distinct fk_cidcod,
	 nome_en
	from
	banco_imagem.bco_img 
	inner join tarifario.cidade_tpo on banco_imagem.bco_img.fk_cidcod = tarifario.cidade_tpo.cidade_cod
	where
	tp_produto = '10'
    and nome_en ILIKE LOWER ('%$busca%')  
	order by nome_en";
	$result_cidades = pg_exec($conn,  $pega_cidades);




$pega_img_cidades= "select pk_bco_img,
	tam_4,
    tam_3,
    tam_2,
	legenda
	from
	banco_imagem.bco_img
	 where
	legenda ILIKE LOWER ('%$busca%') 
    and tp_produto = '10'
	order by legenda";
	$result_img_cidades = pg_exec($conn, $pega_img_cidades);



 




 echo '<div id="img_disponiveis4">'.pg_numrows($result_htls).' results in hotels  for "<b><i>'. $busca.'</i></b>"</div>';



for ($rowcid = 0; $rowcid < pg_numrows($result_htls); $rowcid++)
{
	



    $nome_for = pg_result($result_htls, $rowcid, 'nome_for');
    $mneu_for = pg_result($result_htls, $rowcid, 'mneu_for');
 


         $pega_img_htl= "select 
				pk_bco_img,  
				tam_1,
				tam_2,
				tam_3,
				tam_4,
				fachada
				from
				banco_imagem.bco_img
				where
				mneu_for = '$mneu_for' and fachada ='true' limit 1";
				$result_img_htl = pg_exec($conn, $pega_img_htl);

for ($rowimghtl = 0; $rowimghtl < pg_numrows($result_img_htl); $rowimghtl++)
      {
         $pk_bco_img = pg_result($result_img_htl, $rowimghtl, 'pk_bco_img');
         $tam_4 = pg_result($result_img_htl, $rowimghtl, 'tam_4');
         $tam_3 = pg_result($result_img_htl, $rowimghtl, 'tam_3');
         $tam_2 = pg_result($result_img_htl, $rowimghtl, 'tam_2');
     

 echo'<div id="tumb_bancoimg">';
		if(strlen($nome_for) != 0)
		{
			echo'<div  class="legenda"> <b>'.$nome_for.'</b></div>';
		}


if(strlen($tam_4) != 0)
  {
           $tam_4 = str_replace(" ","%20",$tam_4 );	
           $img4 = "https://www.blumar.com.br/".$tam_4;
           $size = getimagesize($img4);
          $width = $size[0];
             if ( $width == '840')
                   {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca_htl"><input type="hidden" class="imgpathvaluebusca_htl" value="'.$mneu_for.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="560" height="373"></a></div>';
                   }
           elseif ( $width == '450')
                   {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca_htl"><input type="hidden" class="imgpathvaluebusca_htl" value="'.$mneu_for.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="450" height="300"></a></div>';
                   }
                   else
                    {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca_htl"><input type="hidden" class="imgpathvaluebusca_htl" value="'.$mneu_for.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="249" height="373"></a></div>';
                   }
 	}
elseif(strlen($tam_3) != 0)
		{
		  echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca_htl"><input type="hidden" class="imgpathvaluebusca_htl" value="'.$mneu_for.'"><img src="https://www.blumar.com.br/'.$tam_3.'" width="450" height="300"></a></div>';
	    }
elseif(strlen($tam_2) != 0)
		{
		  echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca_htl"><input type="hidden" class="imgpathvaluebusca_htl" value="'.$mneu_for.'"><img src="https://www.blumar.com.br/'.$tam_2.'" width="300" height="200"></a></div>';
	    }




 echo'</div>';	
			
			


       }



}




 echo '<div id="img_disponiveis4">'.pg_numrows($result_cidades).' results in cities  for "<b><i>'. $busca.'</i></b>"</div>';


for ($rowc  = 0; $rowc  < pg_numrows($result_cidades); $rowc++)
{
	$nome_en = pg_result($result_cidades, $rowc, 'nome_en');
    $fk_cidcod = pg_result($result_cidades, $rowc, 'fk_cidcod');
 
 


         $pega_img_cid= "select 
				pk_bco_img,  
				tam_1,
				tam_2,
				tam_3,
				tam_4,
				fachada
				from
				banco_imagem.bco_img
				where
				fk_cidcod = '$fk_cidcod' and fachada ='true' and tp_produto = '10' limit 1";
				$result_img_cid = pg_exec($conn, $pega_img_cid);

for ($rowimgcid = 0; $rowimgcid < pg_numrows($result_img_cid); $rowimgcid++)
      {
         $pk_bco_img = pg_result($result_img_cid, $rowimgcid, 'pk_bco_img');
         $tam_4 = pg_result($result_img_cid, $rowimgcid, 'tam_4');
         $tam_3 = pg_result($result_img_cid, $rowimgcid, 'tam_3');
         $tam_2 = pg_result($result_img_cid, $rowimgcid, 'tam_2');


 echo'<div id="tumb_bancoimg">';
		if(strlen($nome_for) != 0)
		{
			echo'<div  class="legenda"> <b>'.$nome_en.'</b></div>';
		}

 
     
if(strlen($tam_4) != 0)
  {
           $tam_4 = str_replace(" ","%20",$tam_4 );	
           $img4 = "https://www.blumar.com.br/".$tam_4;
           $size = getimagesize($img4);
          $width = $size[0];
             if ( $width == '840')
                   {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca_cid"><input type="hidden" class="imgpathvaluebusca_cid" value="'.$fk_cidcod.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="560" height="373"></a></div>';
                   }
           elseif ( $width == '450')
                   {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca_cid"><input type="hidden" class="imgpathvaluebusca_cid" value="'.$fk_cidcod.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="450" height="300"></a></div>';
                   }
                   else
                    {
		              echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca_cid"><input type="hidden" class="imgpathvaluebusca_cid" value="'.$fk_cidcod.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="249" height="373"></a></div>';
                   }
 	}
elseif(strlen($tam_3) != 0)
		{
		  echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca_cid"><input type="hidden" class="imgpathvaluebusca_cid" value="'.$fk_cidcod.'"><img src="https://www.blumar.com.br/'.$tam_3.'" width="450" height="300"></a></div>';
	    }
elseif(strlen($tam_2) != 0)
		{
		  echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca_cid"><input type="hidden" class="imgpathvaluebusca_cid" value="'.$fk_cidcod.'"><img src="https://www.blumar.com.br/'.$tam_2.'" width="300" height="200"></a></div>';
	    }




 echo'</div>';	
			
			


       }






}






 echo '<div id="img_disponiveis4">'.pg_numrows($result_img_cidades).' results for  general images  for "<b><i>'. $busca.'</i></b>"</div>';




for ($row = 0; $row < pg_numrows($result_img_cidades); $row++)
{
	$tam_4 = pg_result($result_img_cidades, $row, 'tam_4');
    $tam_3 = pg_result($result_img_cidades, $row, 'tam_3');
    $tam_2 = pg_result($result_img_cidades, $row, 'tam_2');
    $legenda = pg_result($result_img_cidades, $row, 'legenda');
    $pk_bco_img = pg_result($result_img_cidades, $row, 'pk_bco_img');
    
    $tam_4 = str_replace(" ","%20",$tam_4 );	
    $tam_3 = str_replace(" ","%20",$tam_3 );
    $tam_2 = str_replace(" ","%20",$tam_2 );



 echo'<div id="tumb_bancoimg">';
		if(strlen($legenda) != 0)
		{
			echo'<div class="legenda"> <b>'.ucfirst($legenda).'</b></div>';
		}

if(strlen($tam_4) != 0)
  {

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
		              echo'<div id="img_bancoimg"><a href="#" class="imgpathbusca"><input type="hidden" class="imgpathvaluebusca" value="'.$pk_bco_img.'"><img src="https://www.blumar.com.br/'.$tam_4.'" width="249" height="373"></a></div>';
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

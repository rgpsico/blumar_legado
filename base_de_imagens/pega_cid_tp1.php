<?php
 
ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}

require_once '../util/connection.php';


$cidade_cod =   pg_escape_string($_POST["navega_cidade_cod"]);
$tp_produto =   pg_escape_string($_POST["tp"]);

//echo$cidade_cod.'<br>'.$tp_produto.'<br>';



if($tp_produto == '1')
{
	$pega_cidadestp= "select distinct mneu_for,
	(select nome_for from sbd95.fornec where mneu_for = banco_imagem.bco_img.mneu_for ) as nome_for,
	split_part(mneu_for, 'avulso',1) as mneu_for2,
	nome_produto
	from
	banco_imagem.bco_img
	where
	tp_produto = $tp_produto
	and fk_cidcod = $cidade_cod
	order by nome_for";
	$result_cidadestp = pg_exec($conn, $pega_cidadestp);
	
	
	$tp = 'Hotel';
}
elseif ($tp_produto == '2')
{
	$pega_cidadestp= "select distinct mneu_for,
	 split_part(mneu_for, 'avulso',1) as mneu_for2,
	 nome_produto
	from
	banco_imagem.bco_img
	where
	tp_produto = $tp_produto
	and fk_cidcod = $cidade_cod";
	$result_cidadestp = pg_exec($conn, $pega_cidadestp);
	
	$tp = 'Tour';
}
elseif ($tp_produto == '3')
{


	$pega_cidadestp= "select distinct mneu_for,
	split_part(mneu_for, 'avulso',1) as mneu_for2,
	nome_produto
	from
	banco_imagem.bco_img
	where
	tp_produto = $tp_produto
	and fk_cidcod = $cidade_cod";
	$result_cidadestp = pg_exec($conn, $pega_cidadestp);
	
	$tp = 'Venue';
	
 	
	
}











 //echo pg_numrows($result_cidadestp);




if($tp_produto == '1')
{
echo' <select name="tpmneu_for1" id="tpmneu_for1"  onChange="javascript:pega_htl();" > ';
}
elseif ($tp_produto == '2')
{
	echo' <select name="tpmneu_for2" id="tpmneu_for2"  onChange="javascript:pega_galeria_tour();" > ';
}
elseif ($tp_produto == '3')
{
	echo' <select name="tpmneu_for3" id="tpmneu_for3"  onChange="javascript:pega_galeria_venues();" > ';
}

$htls = array();




echo'<option value="0" selected>Escolha um '.$tp.'</option>';






for ($rowcid = 0; $rowcid < pg_numrows($result_cidadestp); $rowcid++)
{
	$nome_for = pg_result($result_cidadestp, $rowcid, 'nome_for');
	$mneu_for = pg_result($result_cidadestp, $rowcid, 'mneu_for');
	$mneu_for2 = pg_result($result_cidadestp, $rowcid, 'mneu_for2');
	$nome_produto = pg_result($result_cidadestp, $rowcid, 'nome_produto');
	//echo$mneu_for2;
	
	
	
	
	if($tp_produto == '1')
	{
	 
		if(strlen($nome_for) == 0)
			{
				 array_push($htls, array($nome_produto, $mneu_for)  );
			}
			else 
			{
				  array_push($htls, array($nome_for, $mneu_for)  );
			 }
	}
	elseif ($tp_produto == '2')
	{
		echo'<option value="'.$mneu_for.'">';
		if(strlen($mneu_for2) != '0')
		{
			//echo$mneu_for2;
		   $pega_nome="select nome_en from tarifario.descritivo_tours where pk_descritivo_tours = '$mneu_for'";
		   $result_nome = pg_exec($conn, $pega_nome);
		   for ($rown = 0; $rown < pg_numrows($result_nome); $rown++)
		   {
		   	$nome_for = pg_result($result_nome, $rown, 'nome_en');
		   	echo$nome_for;
		   }
		}
		else 
		{
			echo$nome_produto;
		}
        echo'</option> ';
	}
	elseif ($tp_produto == '3')
	{
		if(strlen($mneu_for2) != '0')
		{
			//echo$mneu_for2;
			echo'<option value="'.$mneu_for.'">';
			$pega_nome="select nome from conteudo_internet.venues where cod_venues = '$mneu_for'";
			$result_nome = pg_exec($conn, $pega_nome);
			for ($rown = 0; $rown < pg_numrows($result_nome); $rown++)
			{
				$nome_for = pg_result($result_nome, $rown, 'nome');
				echo$nome_for;
			}
		 }
		else
		{
			echo$nome_produto;
		}
        echo'</option> ';
   }
 }




//tratamento do array de hotel para ordenar por ordem alfabetica
if($tp_produto == '1')
{

foreach ($htls as $key => $row) { $nome[$key]  = $row[0];  }
array_multisort($nome, SORT_ASC, $htls);
 
 $numhtl = count($htls);
 
 $selecthtl = '';

 for ($rowxz = 0; $rowxz <  $numhtl ; $rowxz++) 
  {
     $selecthtl = $selecthtl.'<option value="'.$htls[$rowxz][1].'">'.$htls[$rowxz][0].'</option> ';	 
  }
  echo$selecthtl;
}



  echo' </select> <br>';

















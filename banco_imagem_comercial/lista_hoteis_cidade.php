<?php

ini_set('display_errors', 1);
error_reporting(~0);

$string_cidade = pg_escape_string($_POST["string_cidade_hotel"]);
$id_bank =  pg_escape_string($_POST["id_bank"]);



$pathhtl = $string_cidade; 
$htls = scandir($pathhtl);
$numhtl = count($htls);
$lista_cidades_htl ='';
for ($rowh = 0; $rowh < $numhtl ; $rowh++)
 { 
 	 if($htls[$rowh] != '.' && $htls[$rowh] != '..' && $htls[$rowh] != 'blank.gif'  && $htls[$rowh] != 'thumbs.db')
	  {
 			$lista_cidades_htl = $lista_cidades_htl. "<option value='".$pathhtl."".$htls[$rowh]."/'>".$htls[$rowh]."</option>";
	  }	 
  }	



if ($id_bank == 1)
{
echo'<select id="hotelb"   onChange="pega_hotelb();" style="width: 180px;">';
}
elseif ($id_bank == 2)
{
echo'<select id="tourb"   onChange="pega_tourb();" style="width: 180px;">';
}
elseif ($id_bank == 3)
{
echo'<select id="restb"   onChange="pega_restb();" style="width: 180px;">';
}
elseif ($id_bank == 4)
{
echo'<select id="giftsb"   onChange="pega_giftsb();" style="width: 180px;">';
}
elseif ($id_bank == 5)
{
echo'<select id="transpb"   onChange="pega_transpb();" style="width: 180px;">';
}
elseif ($id_bank == 6)
{
echo'<select id="venuesb"   onChange="pega_venuesb();" style="width: 180px;">';
}
elseif ($id_bank == 7)
{
echo'<select id="variousb"   onChange="pega_variousb();" style="width: 180px;">';
}
elseif ($id_bank == 8)
{
echo'<select id="tourib"   onChange="pega_tourib();" style="width: 180px;">';
}
elseif ($id_bank == 9)
{
echo'<select id="tourtb"   onChange="pega_tourtb();" style="width: 180px;">';
}
elseif ($id_bank == 10)
{
echo'<select id="carrosb"   onChange="pega_carrosb();" style="width: 180px;">';
}
elseif ($id_bank == 12)
{
echo'<select id="hotel"   onChange="pega_hotel();" style="width: 180px;">';
}


		echo'<option selected value="">----- Choose a Subject -----</option>
		'.$lista_cidades_htl.'
	 </select>';





















<?php
$string_cidade = pg_escape_string($_POST["string_cidade_hotel"]);

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

echo'<select id="hotel"   onChange="pega_hotel();" style="width: 180px;">
		<option selected value="">----- Choose a hotel -----</option>
		'.$lista_cidades_htl.'
	 </select>';




<?php

 ini_set('display_errors', 1);
 error_reporting(~0);
 
 If (isSet($_SESSION)) {} else {session_start();}

//script para cidades
$path = "/var/www/wwwinternet/bancoimagemfotos/cidade"; 
$files1 = scandir($path);
$num = count($files1);
$lista_cidades ='';
for ($rowf = 0; $rowf < $num ; $rowf++) { 
	 if($files1[$rowf] != '.' && $files1[$rowf] != '..' && $files1[$rowf] != 'blank.gif'  && $files1[$rowf] != 'thumbs.db')
	  {
	    $lista_cidades = $lista_cidades. "<option value='".$path."/".$files1[$rowf]."/'>".$files1[$rowf]."</option>"; 
	  }
}	
 
 
//script para hoteis
$pathhtl = "/var/www/wwwinternet/bancoimagemfotos/hotel"; 
$htls = scandir($pathhtl);
$numhtl = count($htls);
$lista_cidades_htl ='';
for ($rowh = 0; $rowh < $numhtl ; $rowh++) {
   if($htls[$rowh] != '.' && $htls[$rowh] != '..' && $htls[$rowh] != 'blank.gif'  && $htls[$rowh] != 'thumbs.db')
	  {
	    $lista_cidades_htl = $lista_cidades_htl. "<option value='".$pathhtl."/".$htls[$rowh]."/'>".$htls[$rowh]."</option>"; 
	  }
 }	




 echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Image Bank Blumar</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="X-UA-Compatible" content="IE=11" />
<meta http-equiv="Expires" content="0" />
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/jquery-1.8.2.min.js"></script> 
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.autocomplete.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.accordion.js"></script> 
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/jquery.maskedinput.js"></script> 
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/ui.datepicker.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/js/jquery.ui.dialog.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/_blumarcustomtags/boxover/boxover.js"></script>
<script type="text/javascript" src="js/banco_imagem.js"></script>
<link rel="stylesheet" type="text/css" href="css/padrao.css">
</head>
<body> 
<div id="container">
<div id="navega_bancoimg">
<b>IMAGE BANK</b><br>
<br>
<b>Cities & Tours</b><br>
                <select id="string_cidade"  onChange="submitfrmcidade();">
						<option selected value="0">----- Choose a city -----</option>
						 '.$lista_cidades.'
				</select>
<br>					
<br>
<b>Hotels</b><br>
               <select id="string_cidade_hotel"  onChange="cidade_hotel();">
						<option selected value="0">----- Choose a city -----</option>
						 '.$lista_cidades_htl.'
				</select>					
	<br><br>
	<div id="miolo_hotel">
				<select name="hotel"  >
					<option selected value="">----- Choose a hotel -----</option>
				</select>				
	  </div>
						 		
<br><br>
<b>RELATÓRIOS</b><BR>
<a href="lista_hoteis_cadastrados.php" >	Listagem de hoteis disponiveis </a><br><br>					 		
<a href="lista_imagens_cadastradas.php" >	Listagem de imagens disponiveis (por hotel)</a>							 		
						 		
 </div>

 
<div id="miolo_bancoimg">
<b>Photo Gallery</b><br>
<hr>
<b>Description and objective</b><br>
Welcome to our photo gallery. <br>
It offers our clients a wide variety of pictures in low (72dpi) and high resolution (300dpi) for several objectives. The pictures are divided into 2 (two) categories: <br>
<br>
- Cities / Tours Pictures,<br>
- Hotels Pictures.<br>
<br>
This picture data bank was mostly offered by the hotels, tourist organizations and suppliers, which work together with us. Our main objective is to offer a big quantity of selected pictures of a certain subject, so that our clients can choose which picture fits most his necessity and purpose, not restricting his choice and use. <br>
<br>
<b>Instructions</b><br>
After you have chosen one of the three categories, it will be display a catalogue with the available pictures. After you have selected the picture of your choice, a new screen will appear, where you can copy the low resolution picture, by clicking the right mouse button, and then choosing "Save picture as" and choose on your hard drive where you want the pictures to be saved. To download the pictures in high resolutions, you must download the compacted file in ZIP format, which is available with the click on the "download" button. It is necessary to unzip the file, before using it.<br> 
<br>
<b>Questions</b><br>
Any questions regarding this gallery can be resolved with our IT Department.
  </div> 
   </div>
	</body>
</html> ';	
?>
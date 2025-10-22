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
$pathhtlb = "/var/www/wwwinternet/bancoimagemfotos/hotel"; 
$htlsb = scandir($pathhtlb);
$numhtlb = count($htlsb);
$lista_cidades_htlb ='';
for ($rowhb = 0; $rowhb < $numhtlb ; $rowhb++) {
   if($htlsb[$rowhb] != '.' && $htlsb[$rowhb] != '..' && $htlsb[$rowhb] != 'blank.gif'  && $htlsb[$rowhb] != 'thumbs.db')
	  {
	    $lista_cidades_htlb = $lista_cidades_htlb. "<option value='".$pathhtlb."/".$htlsb[$rowhb]."/'>".$htlsb[$rowhb]."</option>"; 
	  }
 }	
 
 
 
 
 
 
 
//script para hoteis
$pathhtl = "/var/www/wwwinternet/bancoimagemfotos/comercial/hotel"; 
$htls = scandir($pathhtl);
$numhtl = count($htls);
$lista_cidades_htl ='';
for ($rowh = 0; $rowh < $numhtl ; $rowh++) {
   if($htls[$rowh] != '.' && $htls[$rowh] != '..' && $htls[$rowh] != 'blank.gif'  && $htls[$rowh] != 'thumbs.db')
	  {
	    $lista_cidades_htl = $lista_cidades_htl. "<option value='".$pathhtl."/".$htls[$rowh]."/'>".$htls[$rowh]."</option>"; 
	  }
 }	


//script para tours
$pathtours = "/var/www/wwwinternet/bancoimagemfotos/comercial/tours"; 
$tours = scandir($pathtours);
$numtours = count($tours);
$lista_cidades_tours ='';
for ($rowto = 0; $rowto < $numtours ; $rowto++) {
   if($tours[$rowto] != '.' && $tours[$rowto] != '..' && $tours[$rowto] != 'blank.gif'  && $tours[$rowto] != 'thumbs.db')
	  {
	    $lista_cidades_tours = $lista_cidades_tours. "<option value='".$pathtours."/".$tours[$rowto]."/'>".$tours[$rowto]."</option>"; 
	  }
 }	
 
 
 
//script para tours
$pathrest = "/var/www/wwwinternet/bancoimagemfotos/comercial/restaurantes"; 
$rest = scandir($pathrest);
$numrest = count($rest);
$lista_cidades_rest ='';
for ($rowr = 0; $rowr < $numrest ; $rowr++) {
   if($rest[$rowr] != '.' && $rest[$rowr] != '..' && $rest[$rowr] != 'blank.gif'  && $rest[$rowr] != 'thumbs.db')
	  {
	    $lista_cidades_rest = $lista_cidades_rest. "<option value='".$pathrest."/".$rest[$rowr]."/'>".$rest[$rowr]."</option>"; 
	  }
 } 
 
 
//script para gifts
$pathgifts = "/var/www/wwwinternet/bancoimagemfotos/comercial/brindes"; 
$gifts = scandir($pathgifts);
$numgifts = count($gifts);
$lista_cidades_gifts ='';
for ($rowg = 0; $rowg < $numgifts ; $rowg++) {
   if($gifts[$rowg] != '.' && $gifts[$rowg] != '..' && $gifts[$rowg] != 'blank.gif'  && $gifts[$rowg] != 'thumbs.db')
	  {
	    $lista_cidades_gifts = $lista_cidades_gifts. "<option value='".$pathgifts."/".$gifts[$rowg]."/'>".$gifts[$rowg]."</option>"; 
	  }
 } 
 
 
//script para transportes
$pathtransp = "/var/www/wwwinternet/bancoimagemfotos/comercial/transportes"; 
$transp = scandir($pathtransp);
$numtransp = count($transp);
$lista_cidades_transp ='';
for ($rowt = 0; $rowt < $numtransp ; $rowt++) {
   if($transp[$rowt] != '.' && $transp[$rowt] != '..' && $transp[$rowt] != 'blank.gif'  && $transp[$rowt] != 'thumbs.db')
	  {
	    $lista_cidades_transp = $lista_cidades_transp. "<option value='".$pathtransp."/".$transp[$rowt]."/'>".$transp[$rowt]."</option>"; 
	  }
 }
 
 
 
 
//script para venues
$pathvenues = "/var/www/wwwinternet/bancoimagemfotos/comercial/venues"; 
$venues = scandir($pathvenues);
$numvenues = count($venues);
$lista_cidades_venues ='';
for ($rowv = 0; $rowv < $numvenues ; $rowv++) {
   if($venues[$rowv] != '.' && $venues[$rowv] != '..' && $venues[$rowv] != 'blank.gif'  && $venues[$rowv] != 'thumbs.db')
	  {
	    $lista_cidades_venues = $lista_cidades_venues. "<option value='".$pathvenues."/".$venues[$rowv]."/'>".$venues[$rowv]."</option>"; 
	  }
 } 
 
 
 
 
//script para various
$pathvarious = "/var/www/wwwinternet/bancoimagemfotos/comercial/various"; 
$various = scandir($pathvarious);
$numvarious = count($various);
$lista_cidades_various ='';
for ($rowva = 0; $rowva < $numvarious ; $rowva++) {
   if($various[$rowva] != '.' && $various[$rowva] != '..' && $various[$rowva] != 'blank.gif'  && $various[$rowva] != 'thumbs.db')
	  {
	    $lista_cidades_various = $lista_cidades_various. "<option value='".$pathvarious."/".$various[$rowva]."/'>".$various[$rowva]."</option>"; 
	  }
 }
 
 
 
 
//script para touri
$pathtouri = "/var/www/wwwinternet/bancoimagemfotos/comercial/tours_incentives"; 
$touri = scandir($pathtouri);
$numtouri = count($touri);
$lista_cidades_touri ='';
for ($rowvi = 0; $rowvi < $numtouri ; $rowvi++) {
   if($touri[$rowvi] != '.' && $touri[$rowvi] != '..' && $touri[$rowvi] != 'blank.gif'  && $touri[$rowvi] != 'thumbs.db')
	  {
	    $lista_cidades_touri = $lista_cidades_touri. "<option value='".$pathtouri."/".$touri[$rowvi]."/'>".$touri[$rowvi]."</option>"; 
	  }
 }
 
 
 
//script para touri
$pathtourt = "/var/www/wwwinternet/bancoimagemfotos/comercial/tours_technicals"; 
$tourt = scandir($pathtourt);
$numtourt = count($tourt);
$lista_cidades_tourt ='';
for ($rowvt = 0; $rowvt < $numtourt ; $rowvt++) {
   if($tourt[$rowvt] != '.' && $tourt[$rowvt] != '..' && $tourt[$rowvt] != 'blank.gif'  && $tourt[$rowvt] != 'thumbs.db')
	  {
	    $lista_cidades_tourt = $lista_cidades_tourt. "<option value='".$pathtourt."/".$tourt[$rowvt]."/'>".$tourt[$rowvt]."</option>"; 
	  }
 }
 
 
 
//script para carros especiais
$pathcarros = "/var/www/wwwinternet/bancoimagemfotos/comercial/carros_especiais"; 
$carros = scandir($pathcarros);
$numcarros = count($carros);
$lista_cidades_carros ='';
for ($rowve = 0; $rowve < $numcarros ; $rowve++) {
   if($carros[$rowve] != '.' && $carros[$rowve] != '..' && $carros[$rowve] != 'blank.gif'  && $carros[$rowve] != 'thumbs.db')
	  {
	    $lista_cidades_carros = $lista_cidades_carros. "<option value='".$pathcarros."/".$carros[$rowve]."/'>".$carros[$rowve]."</option>"; 
	  }
 }
 

//script para preferidas
$pathpreferred = "/var/www/wwwinternet/bancoimagemfotos/comercial/preferred/"; 
 



 
 echo '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Image Bank Blumar</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="X-UA-Compatible" content="IE=10" />
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
<script type="text/javascript" src="js/banco_imagem.js?v=1"></script>
<link rel="stylesheet" type="text/css" href="css/padrao.css">
</head>
<body> 
<div id="container">
<div id="navega_bancoimg">
<b>COMMERCIAL IMAGE BANK</b><br>
<br>
 
<b>Beach Houses & Hotels</b><br>
               <select id="string_cidade_hotel"  onChange="cidade_hotel();">
						<option selected value="0">----- Choose a city -----</option>
						 '.$lista_cidades_htl.'
				</select>					
	 
	<div id="miolo_hotel">
				<select name="hotel"  >
					<option selected value="">----- Choose a Subject -----</option>
				</select>				
	  </div>

<br>
 
<b>Tours</b><br>	  
 <select id="string_cidade_tours"  onChange="cidade_tours();">
						<option selected value="0">----- Choose a city -----</option>
						 '. $lista_cidades_tours.'
				</select>		  
	  
	  	<div id="miolo_tours">
				<select name="tours"  >
					<option selected value="">----- Choose a Subject -----</option>
				</select>				
	    </div>
	  
	  
<br>
 
<b>Restaurants</b><br>	  
 <select id="string_cidade_rest"  onChange="cidade_rest();">
						<option selected value="0">----- Choose a city -----</option>
						 '. $lista_cidades_rest.'
				</select>		  
	  
	  	<div id="miolo_rest">
				<select name="rest"  >
					<option selected value="">----- Choose a Subject -----</option>
				</select>				
	    </div>	  
	    
<br>	    
<b>Gifts </b><br>	  
 <select id="string_cidade_gifts"  onChange="cidade_gifts();">
						<option selected value="0">----- Choose a city -----</option>
						 '. $lista_cidades_gifts.'
				</select>		  
	  
	  	<div id="miolo_gifts">
				<select name="gifts"  >
					<option selected value="">----- Choose a Subject -----</option>
				</select>				
	    </div>		    
	    
<br>	    
<b>Transports</b><br>	  
 <select id="string_cidade_transp"  onChange="cidade_transp();">
						<option selected value="0">----- Choose a city -----</option>
						 '. $lista_cidades_transp.'
				</select>		  
	  
	  	<div id="miolo_transp">
				<select name="transp"  >
					<option selected value="">----- Choose a Subject -----</option>
				</select>				
	    </div>		    
	    
	    
<br>	    
<b>Venues</b><br>	  
 <select id="string_cidade_venues"  onChange="cidade_venues();">
						<option selected value="0">----- Choose a city -----</option>
						 '. $lista_cidades_venues.'
				</select>		  
	  
	  	<div id="miolo_venues">
				<select name="venues"  >
					<option selected value="">----- Choose a Subject -----</option>
				</select>				
	    </div>		    
	    
	    
	<br>	    
<b>Various</b><br>	  
 <select id="string_cidade_various"  onChange="cidade_various();">
						<option selected value="0">----- Choose a city -----</option>
						 '. $lista_cidades_various.'
				</select>		  
	  
	  	<div id="miolo_various">
				<select name="various"  >
					<option selected value="">----- Choose a Subject -----</option>
				</select>				
	    </div>	    
 
	    
	<br>	    
<b>Tours For Incentives</b><br>	  
 <select id="string_cidade_touri"  onChange="cidade_touri();">
						<option selected value="0">----- Choose a city -----</option>
						 '. $lista_cidades_touri.'
				</select>		  
	  
	  	<div id="miolo_touri">
				<select name="touri"  >
					<option selected value="">----- Choose a Subject -----</option>
				</select>				
	    </div>		    
	    
	    
	<br>	    
<b>Tours Technicals </b><br>	  
 <select id="string_cidade_tourt"  onChange="cidade_tourt();">
						<option selected value="0">----- Choose a city -----</option>
						 '. $lista_cidades_tourt.'
				</select>		  
	  
	  	<div id="miolo_tourt">
				<select name="tourt"  >
					<option selected value="">----- Choose a Subject -----</option>
				</select>				
	    </div>		    
	    
	    
		<br>	    
<b>Carros Especiais </b><br>	  
 <select id="string_cidade_carros"  onChange="cidade_carros();">
						<option selected value="0">----- Choose a city -----</option>
						 '. $lista_cidades_carros.'
				</select>		  
	  
	  	<div id="miolo_carros">
				<select name="carros"  >
					<option selected value="">----- Choose a Subject -----</option>
				</select>				
	    </div>

	    
	    
<br>
<b>Cities & Tours</b><br>
                <select id="string_cidade"  onChange="submitfrmcidade();">
						<option selected value="0">----- Choose a city -----</option>
						 '.$lista_cidades.'
				</select>
<br>					
<br>
<b>Hotels</b><br>
               <select id="string_cidade_hotelb"  onChange="cidade_hotelb();">
						<option selected value="0">----- Choose a city -----</option>
						 '.$lista_cidades_htlb.'
				</select>					
	<br>
	<div id="miolo_hotelb">
				<select name="hotelb"  >
					<option selected value="">----- Choose a hotel -----</option>
				</select>				
	  </div>	
<br><br>
<b><a href="#"   onClick="preferred();">Preferred >></a></b> 
 <input type="hidden" id="preferred_path" value="'.$pathpreferred.'">             
<br>	    
	    
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
<?php

ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}
 
if(isset($_SESSION['user'])) { } else {  header('Location: login.php');     } 


echo '

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Image Bank Blumar</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.position.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.autocomplete.js"></script>

<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.accordion.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/jquery/jquery.maskedinput.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/util/js/jquery.ui.dialog.js"></script>
<script type="text/javascript" src="https://www.blumar.com.br/_blumarcustomtags/boxover/boxover.js"></script>
 <link rel="icon" href="images/favicon_nacional.png" type="image/png" sizes="16x16">
<script type="text/javascript" src="js/banco_imagem.js?v=1.7"></script>
<script type="text/javascript" src="js/show-layer.js"></script>
<link rel="stylesheet" type="text/css" href="https://www.blumar.com.br/util/css/jquery.ui.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="css/padrao.css?v=1.3">
<style>
.ui-autocomplete         {  margin:  25px 10px 0px 740px;   padding-right: 10px;  background-color:#F6F4E8;   border: solid 1px #C7C7C5;  position:absolute; z-index:4000 !important; }
</style>
 </head> ';






echo'<body>
 <div id="box_linha_laranja"></div>
 <div id="box_linha_azul">
		 <div id="box_topo_azul"> 
		 <div id="box_logo"><img src="images/blumar-logo.jpg"></div> 
		 <div id="box_txt1">PHOTO GALLERY</div> 
         <div id="box_txt2">
               <div id="box_busca_reserva2"><input type="text" id="busca"  name="busca" class="busca-file"  placeholder=" Search Hotels & cities" /></div>
               <div id="box_busca_reserva3"><button type="submit" name="myButton" value="foo"   onClick="javascript:busca_imagem();" ></button></div>
         </div> 
			 <div id="diplay_banco1">
					<div id="miolo_nav">'; require_once 'miolo_navegacao.php'; echo'</div>
			 </div>
		</div>
</div>

 <div id="container">
		<div id="loading"  ><img src="https://www.blumar.com.br/images/site/loadingBar.gif" /></div>
    
		<div id="diplay_banco2"> Welcome to our photo gallery.<br>
		<br>
		It provides you with various low (72dpi) and high-resolution (300dpi) pictures to use. The pictures are divided into two categories:<br>
		<br>
		- Cities and tours<br>
		<br>
		- Hotels<br>
		<br>
		This image bank was mainly offered to us by the hotels, tourist organizations and suppliers we work with. Our primary objective is to offer you a curated selection of high-quality images of specific subjects, destinations, and hotels. This allows you to choose the images that best fit your needs and purpose, without restricting your choice or use.<br>
		<br>
		<br>
		
		<b>INSTRUCTIONS</b><br>
		<br>
		Whenever the Author of the photo is informed, it is mandatory to give credit when using this photo.<br>
		<br>
		Select one of the categories: Hotels or Cities & Tours, then select the city. The hotels and city photos are displayed in alphabetical order. You can use the search engine to find a specific photo in each city. For example: #cookingclass, #church, #downtown, #pelourinho.<br>
		<br>
		After you have selected the picture, a new screen will appear where you can choose the size you want to download.<br>
		<br>
		To download a high-resolution picture, select the Original Compressed file option by clicking the “Download” button. You’ll need to unzip the file before using it.<br>
		<br>
		<br> 
		
		<b>QUESTIONS</b><br>
		<br>
		If you have any questions about this gallery, please get in touch with our Product Department: produtos@blumar.com.br. <br>
		
		
                        <br><br><br><br>
					</div>
		
		
 		
		
		
		
		
		</div>
	</div> 
</body>
</html> ';




If (isSet($_POST["joga_busca"]))  
{
 
$joga_busca = pg_escape_string($_POST["joga_busca"]);

echo'<input type="hidden" id="joga_busca" name="joga_busca" value="'.$joga_busca.'">
<script type="text/javascript">
   joga_busca_imagem();
</script> ';


}
 


If (isSet($_POST["joga_cidade_cod10"]))  
{
 
$joga_cidade_cod10 = pg_escape_string($_POST["joga_cidade_cod10"]);

echo'<input type="hidden" id="joga_cidade_cod10" name="joga_cidade_cod10" value="'.$joga_cidade_cod10.'">
<script type="text/javascript">
   joga_cidade_cod10();
</script> ';


}



If (isSet($_POST["joga_tpmneu_for1"]))  
{
 
$joga_tpmneu_for1 = pg_escape_string($_POST["joga_tpmneu_for1"]);

echo'<input type="hidden" id="joga_tpmneu_for1" name="joga_tpmneu_for1" value="'.$joga_tpmneu_for1.'">
<script type="text/javascript">
   joga_tpmneu_for1();
</script> ';


}

?>
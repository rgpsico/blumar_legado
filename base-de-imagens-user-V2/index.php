<?php

ini_set('display_errors', 1);
error_reporting(~0);

If (isSet($_SESSION)) {} else {session_start();}
  


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
<script type="text/javascript" src="js/download.js"></script>
<link rel="stylesheet" type="text/css" href="https://www.blumar.com.br/util/css/jquery.ui.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="css/padrao.css?v=1">
<style>
.ui-autocomplete         {  margin:  25px 10px 0px 740px;   padding-right: 10px;  background-color:#F6F4E8;   border: solid 1px #C7C7C5;  position:absolute; z-index:4000 !important; }
</style>
 </head> ';






echo'<body><div id="mapa-eco" ></div>
<div id="shopping_cart">'; 
    require('download_list.php'); 

echo'</div>
 <div id="box_linha_laranja"></div>
 <div id="box_linha_azul">
		 <div id="box_topo_azul"> 
		 <div id="box_logo"><img src="images/blumar-logo.jpg"></div> 
		 <div id="box_txt1">PHOTO GALLERY</div> 
         <div id="box_txt2">
               <div id="box_busca_reserva2"><input type="text" id="busca"  name="busca" class="busca-file"  placeholder=" Search Hotels & cities" /></div>
               <div id="box_busca_reserva3"><button type="submit" name="myButton" value="foo"   onClick="javascript:busca_imagem();" ></button></div>
        
			       <a href="#!" onclick="showDiv()"><div id="shopping_cart_button"><img src="images/download-icon.png" title="IMAGE BANK DOWNLOAD"></div></a> 
			   </div> 
			 <div id="diplay_banco1">
					<div id="miolo_nav">'; require_once 'miolo_navegacao.php'; echo'</div>
			 </div>
		</div>
</div>

 <div id="container">
		<div id="loading"  ><img src="https://www.blumar.com.br/images/site/loadingBar.gif" /></div>
    
		<div id="diplay_banco2"><p>Welcome to our photo gallery.<br />
	                      It provides our clients with a wide variety of low (72dpi) and high resolution (300dpi) pictures to use. The pictures are divided into two categories:<br /><br />
							- Pictures of cities and tours<br />
							- Pictures of hotels</p>

						<p>This bank of photographs was mostly offered to us by the hotels, tourist organizations and suppliers which we work with. Our main objective is to provide our clients with a large quantity of specially selected pictures of certain subjects, destinations and hotels. This allows them to choose the images that best fit their needs and purpose and doesn´t restrict their choice or use.</p>
						<p>INSTRUCTIONS<br/>
						After you have chosen from one of the three categories on the left-hand side, a catalogue of available images will be displayed. After you have selected the picture of your choice a new screen will appear where you can copy the low resolution picture by clicking the right mouse button, and then choosing "Save picture as" (selecting your desired location for the picture to be saved). To download a picture in high resolution you should download the compacted file in ZIP format which is available by clicking the "download" button. You´ll need to unzip the file before using it.</p>

						<p>QUESTIONS<br/>
						If you have any questions about this gallery please get in touch with our IT Department.</p>
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
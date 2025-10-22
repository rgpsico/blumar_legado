<?php

session_start();

 
 

if(isset($_SESSION['user'])) {  header('Location: index.php');  } else {    } 



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Blumar Image Bank </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="X-UA-Compatible" content="IE=10" />
<link href="css/style_navega_admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/padrao.css?v=1.2">
</head>

<body>
<div id="box_linha_laranja"></div>
<div id="box_linha_azul">
		 <div id="box_topo_azul"> 
		 <div id="box_logo"><img src="images/blumar-logo.jpg"></div> 
		 <div id="box_txt1_login">PHOTO GALLERY</div> 
       
			 <div id="diplay_banco1">
					<div id="miolo_nav"></div>
			 </div>
		</div>
</div>





 <div id="container">

     <div id="login_wecome">
          <div id="container_loginbx10"><img src="images/traco_general.jpg"></div> 
          <h2>Welcome to our<br> <span> Image Bank</span></h2>
          <p>Most images on this bank were offered to us by the hotels, tourist organizations, and suppliers we work with. Our primary objective is to offer you a curated selection of high-quality images of specific subjects, destinations, and hotels. It provides you with a variety of images low (72dpi) and high-resolution (300dpi)  to use. The images are divided into two categories:<br><br>

- Cities and tours<br>
- Hotels<br><br>

<strong> INSTRUCTIONS</strong><br>

Whenever the Author of the photo is informed, it is mandatory to give credit when using this photo.

Select one of the categories: Hotels or Cities & Tours, then select the city. The hotels and city photos are displayed in alphabetical order. You can use the search engine to find a specific photo in each city. For example: #cookingclass, #church, #downtown, #pelourinho

After you have selected the picture, a new screen will appear where you can choose the size you want to download

To download a high-resolution picture, select the Original Compressed file option by clicking the “Download” button. You’ll need to unzip the file before using it.<br><br>

 
<strong> INSTRUCTIONS</strong><br>
If you have any questions about this gallery, please get in touch with our Product Department: <strong> produtos@blumar.com.br</strong></p>
     </div>

 
 <div id="container_loginbx02">


 <div id="container_loginbx04"><h2><span> BLUMAR</span> IMAGE BANK LOGON</h2></div>
 <div id="container_loginbx06"> 		
   <form id="formcliente" action="libera_logon.php" method="post">
			 <input type="text" name="login" value="Login" size="10" onclick="if(this.value == 'Login') this.value='';" onfocus="if(this.value == 'Login') this.value='';"  /><BR>
				 <input type="password" name="pass" value="Senha" size="12" onclick="if(this.value == 'Senha') this.value='';" onfocus="if(this.value == 'Senha') this.value='';"  /></br>
				 <input class="submit_login" type="submit" name="logar" value="LOG ON" />
			 
		</form> 
</div>
<div id="container_loginbx10"><img src="images/traco_general.jpg"></div> 
<div id="container_loginbx08"> 
        <p>
       <span> ACCESSING OUR IMAGE BANK – <strong>IMPORTANT UPDATE</strong></span><br>
      <br>
      We’ve updated our access process to enhance security and improve the user experience.<br><br>
      
      From now on, you’ll need to log in using the same username and password you use to access our private area. <br><br>
      
      If you don’t have access yet, please don’t hesitate to contact our Product Department at<br> <strong>produtos@blumar.com.br</strong>, and we’ll be happy to help you set it up. <br>
      <br>
      <strong>Thank you for your comprehension!</strong> </p></div> 
 </div>




  <div id="container_login">
   
       <div id="login">
 <!-- -->




     </div>    
     
     
     
  </div>
 </div>
</body>
</html>


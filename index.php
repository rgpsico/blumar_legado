<?php

session_start();

$_SESSION['conteudo']=1;




?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Administração de Conteudo Blumar</title>
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
 <div id="container">
  <div id="container_login">
    <div id="texto1">Administração de Conteudo Blumar</div>
       <div id="login">
 <!-- -->
 		<form id="formcliente" action="lista_conteudo.php" method="post">
			 <input type="text" name="login" value="Login" size="10" onclick="if(this.value == 'Login') this.value='';" onfocus="if(this.value == 'Login') this.value='';" style="font-family:Tahoma; font-size: 10px;" /></td>
				 <input type="password" name="pass" value="Senha" size="12" onclick="if(this.value == 'Senha') this.value='';" onfocus="if(this.value == 'Senha') this.value='';" style="font-family:Tahoma; font-size: 10px;" /></td>
				 <input type="submit" name="logar" value="LOG ON" style="font-family: tahoma, Arial; font-size: 11px;" /></td>
			 
		</form> 
     </div>    
     
     
     
  </div>
 </div>
</body>
</html>


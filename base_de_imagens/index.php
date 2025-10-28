<?php

ini_set('display_errors', 1);
error_reporting(~0);

if (isset($_SESSION)) {
} else {
	session_start();
}

echo '

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Banco de Imagens Blumar</title>
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

<script type="text/javascript" src="../js/banco_imagem.js?v=1.3"></script>
<script type="text/javascript" src="../js/show-layer.js"></script>
<link rel="stylesheet" type="text/css" href="https://www.blumar.com.br/util/css/jquery.ui.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="css/padrao.css">
<style>
.ui-autocomplete         {  margin:  25px 10px 0px 740px;   padding-right: 10px;  background-color:#F6F4E8;   border: solid 1px #C7C7C5;  position:absolute; z-index:4000 !important; }
</style>
 </head> ';







echo '<body>
 <div id="container">
		
    <div id="container_conteudo">
		<div id="diplay_banco1">
		<font size="3">
		<b>ADMINISTRAÇÃO DO <br>BANCO DE IMAGENS</b><br>
		</font>
		<div id="loading"  ><img src="https://www.blumar.com.br/images/site/loadingBar.gif" /></div>
		<br>
		<a href="#" onclick="javascript:nova_imagem();">Cadastro de Nova Imagem >></a><br>
		<br>
        <br>
		<a href="#" onclick="javascript:nova_imagem_auto();">Cadastro de Imagem em automatico >></a><br>
		<br>
		<b>ALTERAÇÃO DE CADASTRO</b><br>
		
		<div id="miolo_nav">';


require_once 'miolo_navegacao.php';

echo '</div>
		</div>
		<div id="diplay_banco2"></div>
		
		
 		
		
		
		
		
		</div>
	</div> <br>
</body>
</html> ';

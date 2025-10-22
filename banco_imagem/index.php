<?php
ini_set('display_errors', 1);
error_reporting(~0);

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// ====================================
// FUNÇÃO PARA GERAR LISTA DE OPÇÕES
// ====================================
function gerarListaOpcoes($pasta)
{
	$lista = '';
	if (!is_dir($pasta)) {
		return $lista;
	}

	$arquivos = scandir($pasta);
	foreach ($arquivos as $arquivo) {
		if (!in_array($arquivo, ['.', '..', 'blank.gif', 'thumbs.db'])) {
			$lista .= "<option value='{$pasta}/{$arquivo}/'>{$arquivo}</option>";
		}
	}
	return $lista;
}

// ====================================
// CAMINHOS DAS PASTAS
// ====================================
$caminhoCidades = __DIR__ . '/../bancoimagemfotos/cidade';
$caminhoHoteis  = __DIR__ . '/../bancoimagemfotos/hotel';

// ====================================
// LISTAS DE OPÇÕES
// ====================================
$listaCidades = gerarListaOpcoes($caminhoCidades);
$listaHoteis  = gerarListaOpcoes($caminhoHoteis);
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Image Bank Blumar</title>
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="X-UA-Compatible" content="IE=11" />
	<meta http-equiv="Expires" content="0" />

	<!-- jQuery e plugins -->
	<script src="https://www.blumar.com.br/util/jquery/jquery-1.8.2.min.js"></script>
	<script src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.core.js"></script>
	<script src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.widget.js"></script>
	<script src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.position.js"></script>
	<script src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.autocomplete.js"></script>
	<script src="https://www.blumar.com.br/util/jquery/ui/jquery.ui.accordion.js"></script>
	<script src="https://www.blumar.com.br/util/jquery/jquery.maskedinput.js"></script>
	<script src="https://www.blumar.com.br/util/jquery/ui/ui.datepicker.js"></script>
	<script src="https://www.blumar.com.br/util/js/jquery.simplemodal.js"></script>
	<script src="https://www.blumar.com.br/util/js/jquery.ui.dialog.js"></script>
	<script src="https://www.blumar.com.br/_blumarcustomtags/boxover/boxover.js"></script>

	<!-- Script local -->
	<script src="js/banco_imagem.js"></script>

	<!-- Estilo -->
	<link rel="stylesheet" href="css/padrao.css">
</head>

<body>
	<div id="container">
		<div id="navega_bancoimg">
			<b>IMAGE BANK</b><br><br>

			<b>Cities & Tours</b><br>
			<select id="string_cidade" onChange="submitfrmcidade();">
				<option selected value="0">----- Choose a city -----</option>
				<?= $listaCidades ?>
			</select>

			<br><br>
			<b>Hotels</b><br>
			<select id="string_cidade_hotel" onChange="cidade_hotel();">
				<option selected value="0">----- Choose a city -----</option>
				<?= $listaHoteis ?>
			</select>

			<br><br>
			<div id="miolo_hotel">
				<select name="hotel">
					<option selected value="">----- Choose a hotel -----</option>
				</select>
			</div>

			<br><br>
			<b>RELATÓRIOS</b><br>
			<a href="lista_hoteis_cadastrados.php">Listagem de hotéis disponíveis</a><br><br>
			<a href="lista_imagens_cadastradas.php">Listagem de imagens disponíveis (por hotel)</a>
		</div>

		<div id="miolo_bancoimg">
			<b>Photo Gallery</b><br>
			<hr>

			<b>Description and objective</b><br>
			Welcome to our photo gallery.<br>
			It offers our clients a wide variety of pictures in low (72dpi) and high resolution (300dpi) for several objectives. The pictures are divided into two categories:<br><br>
			- Cities / Tours Pictures,<br>
			- Hotels Pictures.<br><br>

			This picture data bank was mostly offered by the hotels, tourist organizations and suppliers, which work together with us. Our main objective is to offer a big quantity of selected pictures of a certain subject, so that our clients can choose which picture fits most his necessity and purpose, not restricting his choice and use.<br><br>

			<b>Instructions</b><br>
			After you have chosen one of the three categories, a catalogue with the available pictures will be displayed. After you have selected the picture of your choice, a new screen will appear, where you can copy the low resolution picture by clicking the right mouse button and choosing "Save picture as".<br>
			To download pictures in high resolution, use the ZIP file provided via the “Download” button. It is necessary to unzip the file before using it.<br><br>

			<b>Questions</b><br>
			Any questions regarding this gallery can be resolved with our IT Department.
		</div>
	</div>
</body>

</html>
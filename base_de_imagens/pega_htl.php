<?php

ini_set('display_errors', 1);
error_reporting(~0);

if (isset($_SESSION)) {
} else {
	session_start();
}

require_once '../util/connection.php';

if (isset($_POST["tpmneu_for"])) {
	$mneu_for = pg_escape_string($_POST["tpmneu_for"]);
} else {
	$mneu_for = $mneu_for;
}

//echo$mneu_for; 

$pegaumhtl = "select nome_for, nome_htl
FROM
conteudo_internet.ci_hotel
left outer JOIN
sbd95.fornec
ON
ci_hotel.mneu_for = sbd95.fornec.mneu_for
where ci_hotel.mneu_for = '$mneu_for'";
$result_umhtl = pg_exec($conn, $pegaumhtl);
if (pg_numrows($result_umhtl) != 0) {
	for ($rowhtl = 0; $rowhtl < pg_numrows($result_umhtl); $rowhtl++) {

		$nome_htl = pg_result($result_umhtl, $rowhtl, 'nome_htl');
		$nome_for = pg_result($result_umhtl, $rowhtl, 'nome_for');

		if (strlen($nome_for) != '0') {
			$umhtl = $nome_for;
		} else {
			$umhtl = $nome_htl;
		}
	}
} else {
	$pega_nome = "select nome_produto from banco_imagem.bco_img where mneu_for = '$mneu_for' ";
	$result_nome = pg_exec($conn, $pega_nome);
	for ($row = 0; $row < pg_numrows($result_nome); $row++) {
		$umhtl = pg_result($result_nome, $row, 'nome_produto');
	}
}

echo '<div id="mapa-eco"></div>';
echo '<div id="cabeca_bancoimg">';
echo '<b>' . strtoupper($umhtl) . ' PICTURES</b> ';
echo '<a href="https://www.blumar.com.br/client_area/rates/new_pop_hotel.php?cod_hotel=' . $mneu_for . '&lang=2&hotel=' . strtoupper($umhtl) . '" target="_new">check page >></a>';
echo '</div>';

// Barra de ações para seleção e exclusão
echo '<div id="barra_acoes" style="padding: 10px; background: #f5f5f5; margin-bottom: 10px; border-radius: 4px; border: 1px solid #ddd;">';
echo '<label style="cursor: pointer; margin-right: 20px;">';
echo '<input type="checkbox" id="select_all" style="margin-right: 5px; width: 16px; height: 16px; vertical-align: middle;"> ';
echo '<span style="font-weight: bold;">Selecionar Todas</span>';
echo '</label>';
echo '<button id="btn_excluir_selecionadas" style="padding: 6px 20px; background: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 13px;">Excluir Selecionadas</button>';
echo '<span id="contador_selecionadas" style="margin-left: 15px; font-weight: bold; color: #007bff;"></span>';
echo '</div>';

$pega_cidadestp = "select 
				pk_bco_img,  
				mneu_for,
				(select nome_for from sbd95.fornec where mneu_for = banco_imagem.bco_img.mneu_for ) as nome_for,
				tam_1,
				tam_2,
				tam_3,
				tam_4,
				tam_5,
				zip,
				legenda,
                autor,
				ordem,
				nacional,
				fachada
				from
				banco_imagem.bco_img
				where
				mneu_for = '$mneu_for'
                and tp_produto = '1'
				order by ordem, legenda";
$result_cidadestp = pg_exec($conn, $pega_cidadestp);

//echo pg_numrows($result_cidadestp);

for ($rowcid = 0; $rowcid < pg_numrows($result_cidadestp); $rowcid++) {
	$pk_bco_img = pg_result($result_cidadestp, $rowcid, 'pk_bco_img');
	$mneu_for = pg_result($result_cidadestp, $rowcid, 'mneu_for');
	$tam_1 = pg_result($result_cidadestp, $rowcid, 'tam_1');
	$legenda = pg_result($result_cidadestp, $rowcid, 'legenda');
	$zip = pg_result($result_cidadestp, $rowcid, 'zip');
	$tam_5 = pg_result($result_cidadestp, $rowcid, 'tam_5');
	$tam_4 = pg_result($result_cidadestp, $rowcid, 'tam_4');
	$tam_3 = pg_result($result_cidadestp, $rowcid, 'tam_3');
	$tam_2 = pg_result($result_cidadestp, $rowcid, 'tam_2');
	$autor = pg_result($result_cidadestp, $rowcid, 'autor');
	$ordem = pg_result($result_cidadestp, $rowcid, 'ordem');
	$nacional = pg_result($result_cidadestp, $rowcid, 'nacional');
	$fachada = pg_result($result_cidadestp, $rowcid, 'fachada');

	// Início do container da imagem com data-id para referência
	echo '<div id="tumb_bancoimg" data-id="' . $pk_bco_img . '" style="position: relative;">';

	// Checkbox de seleção no canto superior esquerdo
	echo '<div style="position: absolute; top: 5px; left: 5px; z-index: 10; background: white; padding: 2px; border-radius: 3px; box-shadow: 0 1px 3px rgba(0,0,0,0.3);">';
	echo '<input type="checkbox" class="check_imagem" value="' . $pk_bco_img . '" style="width: 18px; height: 18px; cursor: pointer;">';
	echo '</div>';

	echo '<div id="img_bancoimg"><img src="https://www.blumar.com.br/' . $tam_1 . '" width="135" height="90"></div>';

	echo '<div id="bt_imgstp">';

	if (strlen($tam_2) != 0) {
		echo '<div id="bt_zip"><a href="#" title=" 300 x 200 " class="imgpatht2"><input type="hidden" class="imgpatht2value" value="' . $pk_bco_img . '">T2</a></div>';
	}

	if (strlen($tam_3) != 0) {
		echo '<div id="bt_zip"><a href="#" title=" 450 x 300 " class="imgpatht3"><input type="hidden" class="imgpatht3value" value="' . $pk_bco_img . '">T3</a></div>';
	}

	if (strlen($tam_4) != 0) {
		echo '<div id="bt_zip"><a href="#" title=" 840 x 560 " class="imgpatht4"><input type="hidden" class="imgpatht4value" value="' . $pk_bco_img . '">T4</a></div>';
	}

	if (strlen($tam_5) != 0) {
		echo '<div id="bt_zip"><a href="#" title=" Original size " class="imgpatht5"><input type="hidden" class="imgpatht5value" value="' . $pk_bco_img . '">T5</a></div>';
	}

	if (strlen($zip) != 0) {
		echo '<div id="bt_zip"><a href="#" title=" Compressed file ">zip</a></div>';
	}

	echo '<div id="bt_zip2"><a href="#" class="imgpath"><input type="hidden" class="imgpathvalue" value="' . $pk_bco_img . '"><img src="../images/edit_img.png" title="edit image" ></a></div>';

	echo '</div>';

	if (strlen($legenda) != 0) {
		echo '<div class="bt_download"> <b>' . substr($legenda, 0, 21) . '</b></div>';
	}

	echo '<div class="bt_id">id: ' . $pk_bco_img . '  ';
	if (strlen($autor) != 0) {
		echo '<a href="#" title="' . $autor . '"><b>&copy;</b></a>';
	}

	if ($fachada == 't') {
		echo ' <b>F</b> ';
	}

	if ($nacional == 't') {
		echo ' <b>N</b> ';
	}
	echo ' <b>' . $ordem . '</b>';

	echo '</div>';

	echo '</div>';
}

// CSS inline para melhorar a aparência
echo '<style>
	#tumb_bancoimg:has(.check_imagem:checked) {
		outline: 3px solid #007bff;
		background-color: #e7f3ff;
		box-shadow: 0 2px 8px rgba(0,123,255,0.3);
	}
	
	#barra_acoes button:hover {
		background: #c82333 !important;
		transform: scale(1.02);
		transition: all 0.2s;
	}
	
	#barra_acoes button:active {
		transform: scale(0.98);
	}
	
	#barra_acoes button:disabled {
		background: #6c757d !important;
		cursor: not-allowed;
		opacity: 0.6;
	}
	
	.check_imagem:hover {
		transform: scale(1.1);
		transition: all 0.2s;
	}
</style>';

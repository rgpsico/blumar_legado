<?php require_once '../util/connection.php';

$mneu_for = pg_escape_string($_POST["mneu_for"]);

$hoteis = "select nome_for 
			from sbd95.fornec 
			where 
			 mneu_for = '$mneu_for'";
$result_hoteis_pendentes = pg_exec($conn, $hoteis);
$lista_pendentes = "";
for ($htl = 0; $htl < pg_numrows($result_hoteis_pendentes); $htl++) {
	$nome_for = pg_result($result_hoteis_pendentes, $htl, 'nome_for');
}

?>


<b>CADASTRO DE NOVO HOTEL</b><br><input type="hidden" name="mneu_for" id="mneu_for" maxlength="4" value="<?php echo $mneu_for; ?>" size="4">
<div id="box10">
	Nome: <?php echo $nome_for . ' - ' . $mneu_for; ?>

</div>
<div id="box6">DESCRITIVOS</div>

<div id="box11">
	Portugu&ecirc;s<br>
	<textarea name="descricao_pt" id="descricao_pt" cols="60" rows="4"></textarea>
</div>
<div id="box11">
	ingl&ecirc;s<br>
	<textarea name="descricao_en" id="descricao_en" cols="60" rows="4"></textarea>
</div>
<div id="box11">
	espanhol (FIT e GRP)<br>
	<textarea name="descricao_esp" id="descricao_esp" cols="60" rows="4"></textarea>
</div>
<div id="box11">
	espanhol (GRP)<br>
	<textarea name="descesp_grpfit" id="descesp_grpfit" cols="60" rows="4"></textarea>
</div>


<div id="box6">CONTEUDO PARA RESORTS</div>


<div id="box4">
	R&eacute;gimen de comidas<br>
	<div id="box3">
		em Portugu&ecirc;s<br>
		<textarea name="regime_hotel_pt" id="regime_hotel_pt" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Ingl&ecirc;s<br>
		<textarea name="regime_hotel_en" id="regime_hotel_en" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Espanhol<br>
		<textarea name="regime_hotel_esp" id="regime_hotel_esp" rows="5" cols="22"></textarea>
	</div>
</div>

<div id="box4">
	Recreaci&oacute;n & Entretenimiento<br>
	<div id="box3">
		em Portugu&ecirc;s<br>
		<textarea name="rec_entret_pt" id="rec_entret_pt" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Ingl&ecirc;s<br>
		<textarea name="rec_entret_en" id="rec_entret_en" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Espanhol<br>
		<textarea name="rec_entret_esp" id="rec_entret_esp" rows="5" cols="22"></textarea>
	</div>
</div>

<div id="box4">
	Otras Actividades<br>
	<div id="box3">
		em Portugu&ecirc;s<br>
		<textarea name="otras_ativ_pt" id="otras_ativ_pt" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Ingl&ecirc;s<br>
		<textarea name="otras_ativ_en" id="otras_ativ_en" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Espanhol<br>
		<textarea name="otras_ativ_esp" id="otras_ativ_esp" rows="5" cols="22"></textarea>
	</div>
</div>

<div id="box4">
	Alojamiento<br>
	<div id="box3">
		em Portugu&ecirc;s<br>
		<textarea name="alojamiento_pt" id="alojamiento_pt" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Ingl&ecirc;s<br>
		<textarea name="alojamiento_en" id="alojamiento_en" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Espanhol<br>
		<textarea name="alojamiento_esp" id="alojamiento_esp" rows="5" cols="22"></textarea>
	</div>
</div>

<div id="box4">
	Gastronomia<br>
	<div id="box3">
		em Portugu&ecirc;s<br>
		<textarea name="gastronomia_pt" id="gastronomia_pt" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Ingl&ecirc;s<br>
		<textarea name="gastronomia_en" id="gastronomia_en" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Espanhol<br>
		<textarea name="gastronomia_esp" id="gastronomia_esp" rows="5" cols="22"></textarea>
	</div>
</div>


<div id="box4">
	Servicios<br>
	<div id="box3">
		em Portugu&ecirc;s<br>
		<textarea name="servicios_pt" id="servicios_pt" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Ingl&ecirc;s<br>
		<textarea name="servicios_en" id="servicios_en" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Espanhol<br>
		<textarea name="servicios_esp" id="servicios_esp" rows="5" cols="22"></textarea>
	</div>
</div>


<div id="box4">
	Convenciones<br>
	<div id="box3">
		em Portugu&ecirc;s<br>
		<textarea name="convenciones_pt" id="convenciones_pt" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Ingl&ecirc;s<br>
		<textarea name="convenciones_en" id="convenciones_en" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Espanhol<br>
		<textarea name="convenciones_esp" id="convenciones_esp" rows="5" cols="22"></textarea>
	</div>
</div>

<div id="box4">
	Servicios Adicionales<br>
	<div id="box3">
		em Portugu&ecirc;s<br>
		<textarea name="campo_extra_pt" id="campo_extra_pt" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Ingl&ecirc;s<br>
		<textarea name="campo_extra_en" id="campo_extra_en" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">
		em Espanhol<br>
		<textarea name="campo_extra_esp" id="campo_extra_esp" rows="5" cols="22"></textarea>
	</div>
</div>


<div id="box4">
	Conte&uacute;do Complementar Ecol&oacute;gico<br>
	<div id="box3">

		<textarea name="complemento" id="complemento" rows="5" cols="22"></textarea>
	</div>
	<div id="box3">

	</div>
	<div id="box3">

	</div>
</div>


<div id="box11">
	Chamada destaque (site nacional) <font size="1"> OBS.: No maximo 200 caracteres, incluindo espa&ccedil;os.</font><br>
	<textarea name="hotel_cham" id="hotel_cham" cols="60" rows="4"></textarea>
</div>

<div id="box6">FOTOS</div>
<div id="box5">
	Fachada<br>
	<input name="foto_fachada" id="foto_fachada" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	fachada TBN<br>
	<input name="fotofachada_tbn" id="fotofachada_tbn" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Piscina<br>
	<input name="fotopiscina" id="fotopiscina" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Foto Extra 1<br>
	<input name="fotoextra" id="fotoextra" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Foto Extra 2<br>
	<input name="fotoextra_recep" id="fotoextra_recep" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Foto Extra 3<br>
	<input name="ft_resort1" id="ft_resort1" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Foto Extra 4<br>
	<input name="ft_resort2" id="ft_resort2" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Foto Extra 5<br>
	<input name="ft_resort3" id="ft_resort3" type="text" size="60" maxlength="100">
</div>

<div id="box6">FOTOS DOS APARTAMENTOS</div>



<div id="box13">
	<div id="box14">
		categoria <br>
		<select name="categ1" id="categ1">
			<option value="0" selected>Apto categ</option>
			<?php
			$query_aptocateg =
				"
										SELECT
											 aptocatcod,
											 catdsc,
											 catdscesp,
											 catdscing
										FROM 
											conteudo_internet.apto_categoria
								     ";

			$result_aptocateg = pg_exec($conn, $query_aptocateg);
			if ($result_aptocateg) {
				for ($rowcid = 0; $rowcid < pg_numrows($result_aptocateg); $rowcid++) {

					$catdscing = pg_result($result_aptocateg, $rowcid, 'catdscing');
					$aptocatcod = pg_result($result_aptocateg, $rowcid, 'aptocatcod');


					echo '<option value="' . $aptocatcod . '">' . $catdscing . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div id="box14">
		localizacao <br>
		<select name="loc1" id="loc1">
			<option value="0" selected>Apto location</option>
			<?php
			$query_aptoloc =
				"
										SELECT
											 aptoloccod,
											 aptolocdsc,
											 aptolocdscesp,
											 aptolocdscing 
										FROM 
											conteudo_internet.apto_localizacao
								     ";

			$result_aptoloc = pg_exec($conn, $query_aptoloc);
			if ($result_aptoloc) {
				for ($rowcid = 0; $rowcid < pg_numrows($result_aptoloc); $rowcid++) {

					$aptolocdscing = pg_result($result_aptoloc, $rowcid, 'aptolocdscing');
					$aptoloccod = pg_result($result_aptoloc, $rowcid, 'aptoloccod');


					echo '<option value="' . $aptoloccod . '">' . $aptolocdscing . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div id="box15">
		Qtd.<br>
		<input name="qtd1" id="qtd1" type="text" size="2" maxlength="20">
	</div>
	<div id="box14">
		foto<br>
		<input type="text" name="foto1" id="foto1" maxlength="100" value="" size="30">
	</div>
</div>

<div id="box13">
	<div id="box14">
		categoria <br>
		<select name="categ2" id="categ2">
			<option value="0" selected>Apto categ</option>
			<?php
			$query_aptocateg =
				"
										SELECT
											 aptocatcod,
											 catdsc,
											 catdscesp,
											 catdscing
										FROM 
											conteudo_internet.apto_categoria
								     ";

			$result_aptocateg = pg_exec($conn, $query_aptocateg);
			if ($result_aptocateg) {
				for ($rowcid = 0; $rowcid < pg_numrows($result_aptocateg); $rowcid++) {

					$catdscing = pg_result($result_aptocateg, $rowcid, 'catdscing');
					$aptocatcod = pg_result($result_aptocateg, $rowcid, 'aptocatcod');


					echo '<option value="' . $aptocatcod . '">' . $catdscing . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div id="box14">
		localizacao <br>
		<select name="loc2" id="loc2">
			<option value="0" selected>Apto location</option>
			<?php
			$query_aptoloc =
				"
										SELECT
											 aptoloccod,
											 aptolocdsc,
											 aptolocdscesp,
											 aptolocdscing 
										FROM 
											conteudo_internet.apto_localizacao
								     ";

			$result_aptoloc = pg_exec($conn, $query_aptoloc);
			if ($result_aptoloc) {
				for ($rowcid = 0; $rowcid < pg_numrows($result_aptoloc); $rowcid++) {

					$aptolocdscing = pg_result($result_aptoloc, $rowcid, 'aptolocdscing');
					$aptoloccod = pg_result($result_aptoloc, $rowcid, 'aptoloccod');


					echo '<option value="' . $aptoloccod . '">' . $aptolocdscing . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div id="box15">
		Qtd.<br>
		<input name="qtd2" id="qtd2" type="text" size="2" maxlength="20">
	</div>
	<div id="box14">
		foto<br>
		<input type="text" name="foto2" id="foto2" maxlength="100" value="" size="30">
	</div>
</div>

<div id="box13">
	<div id="box14">
		categoria <br>
		<select name="categ3" id="categ3">
			<option value="0" selected>Apto categ</option>
			<?php
			$query_aptocateg =
				"
										SELECT
											 aptocatcod,
											 catdsc,
											 catdscesp,
											 catdscing
										FROM 
											conteudo_internet.apto_categoria
								     ";

			$result_aptocateg = pg_exec($conn, $query_aptocateg);
			if ($result_aptocateg) {
				for ($rowcid = 0; $rowcid < pg_numrows($result_aptocateg); $rowcid++) {

					$catdscing = pg_result($result_aptocateg, $rowcid, 'catdscing');
					$aptocatcod = pg_result($result_aptocateg, $rowcid, 'aptocatcod');


					echo '<option value="' . $aptocatcod . '">' . $catdscing . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div id="box14">
		localizacao <br>
		<select name="loc3" id="loc3">
			<option value="0" selected>Apto location</option>
			<?php
			$query_aptoloc =
				"
										SELECT
											 aptoloccod,
											 aptolocdsc,
											 aptolocdscesp,
											 aptolocdscing 
										FROM 
											conteudo_internet.apto_localizacao
								     ";

			$result_aptoloc = pg_exec($conn, $query_aptoloc);
			if ($result_aptoloc) {
				for ($rowcid = 0; $rowcid < pg_numrows($result_aptoloc); $rowcid++) {

					$aptolocdscing = pg_result($result_aptoloc, $rowcid, 'aptolocdscing');
					$aptoloccod = pg_result($result_aptoloc, $rowcid, 'aptoloccod');


					echo '<option value="' . $aptoloccod . '">' . $aptolocdscing . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div id="box15">
		Qtd.<br>
		<input name="qtd3" id="qtd3" type="text" size="2" maxlength="20">
	</div>
	<div id="box14">
		foto<br>
		<input type="text" name="foto3" id="foto3" maxlength="100" value="" size="30">
	</div>
</div>

<div id="box13">
	<div id="box14">
		categoria <br>
		<select name="categ4" id="categ4">
			<option value="0" selected>Apto categ</option>
			<?php
			$query_aptocateg =
				"
										SELECT
											 aptocatcod,
											 catdsc,
											 catdscesp,
											 catdscing
										FROM 
											conteudo_internet.apto_categoria
								     ";

			$result_aptocateg = pg_exec($conn, $query_aptocateg);
			if ($result_aptocateg) {
				for ($rowcid = 0; $rowcid < pg_numrows($result_aptocateg); $rowcid++) {

					$catdscing = pg_result($result_aptocateg, $rowcid, 'catdscing');
					$aptocatcod = pg_result($result_aptocateg, $rowcid, 'aptocatcod');


					echo '<option value="' . $aptocatcod . '">' . $catdscing . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div id="box14">
		localizacao <br>
		<select name="loc4" id="loc4">
			<option value="0" selected>Apto location</option>
			<?php
			$query_aptoloc =
				"
										SELECT
											 aptoloccod,
											 aptolocdsc,
											 aptolocdscesp,
											 aptolocdscing 
										FROM 
											conteudo_internet.apto_localizacao
								     ";

			$result_aptoloc = pg_exec($conn, $query_aptoloc);
			if ($result_aptoloc) {
				for ($rowcid = 0; $rowcid < pg_numrows($result_aptoloc); $rowcid++) {

					$aptolocdscing = pg_result($result_aptoloc, $rowcid, 'aptolocdscing');
					$aptoloccod = pg_result($result_aptoloc, $rowcid, 'aptoloccod');


					echo '<option value="' . $aptoloccod . '">' . $aptolocdscing . '</option>';
				}
			}
			?>
		</select>
	</div>
	<div id="box15">
		Qtd.<br>
		<input name="qtd4" id="qtd4" type="text" size="2" maxlength="20">
	</div>
	<div id="box14">
		foto<br>
		<input type="text" name="foto4" id="foto4" maxlength="100" value="" size="30">
	</div>
</div>




<div id="box6">MAPAS</div>
<div id="box5">
	Mapa Google<br>
	<input name="htlurl" id="htlurl" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Mapa<br>
	<input name="mapa" id="mapa" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Mapa Ecologico<br>
	<input name="map_eco" id="map_eco" type="text" size="60" maxlength="100">
</div>



<div id="box6">VIDEOS</div>
<div id="box5">
	Endere&ccedil;o foto 360<br>
	<input name="url_htl_360" id="url_htl_360" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Arquivo foto 360<br>
	<input name="arq_htl_360" id="arq_htl_360" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Endere&ccedil;o video<br>
	<input name="url_video" id="url_video" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Arquivo do video<br>
	<input name="arq_video" id="arq_video" type="text" size="60" maxlength="100">
</div>
<div id="box5">
	Tour virtual sem flash<br>
	<input name="virtual_tour" id="virtual_tour" type="text" size="60" maxlength="100">
</div>

<div id="box6">OBSERVA&Ccedil;&Otilde;ES</div>
<div id="box11">
	em portugues<br>
	<textarea name="obs_pt" id="obs_pt" cols="60" rows="4"></textarea>
</div>
<div id="box11">
	em ingles<br>
	<textarea name="obs_en" id="obs_en" cols="60" rows="4"></textarea>
</div>
<div id="box11">
	em espanhol (Blumar Opina)<br>
	<textarea name="obs_esp" id="obs_esp" cols="60" rows="4"></textarea>
</div>
<div id="box11">
	Hist&oacute;rico de Altera&ccedil;&otilde;es de Templates<br>
	<textarea name="historico_temp" id="historico_temp" cols="60" rows="4"></textarea>
</div>
<div id="box6">MARCA&Ccedil;&Atilde;O</div>
<div id="box13">
	<div id="box12">
		<input type="checkbox" id="flaghtl" name="flaghtl"> - Ativo na Internet Blumar<br>
		<font size="1">( Ir&aacute; aparecer na internet se marcado )</font>
	</div>
	<div id="box12">
		<input type="checkbox" id="ativo_latino" name="ativo_latino"> - N&atilde;o aparecer Template no Tarif&aacute;rio Latino<br>
		<font size="1">( N&atilde;o aparece o descritivo do Hotel no tarif&aacute;rio )</font>
	</div>
</div>
<div id="box13">
	<div id="box12">
		<input type="checkbox" id="ativo_flat" name="ativo_flat"> - &Eacute; Flat
	</div>
	<div id="box12">
		<input type="checkbox" id="resort" name="resort"> - &Eacute; Resort
	</div>
</div>
<div id="box13">
	<div id="box12">
		<input type="checkbox" id="ecologico" name="ecologico"> - &Eacute; Ecol&oacute;gico
	</div>
	<div id="box12">
		<input type="checkbox" id="validafotopiscina" name="validafotopiscina"> - &Eacute; destaque no tarifario Latino
	</div>
</div>
<div id="box13">
	<div id="box12">
		<input type="checkbox" id="bestdeal" name="bestdeal"> - Best Deal
	</div>
	<div id="box12">
		<input type="checkbox" id="ativo_bnuts" name="ativo_bnuts"> - Ativo site Bnuts<br>
		<font size="1">( Ir&aacute; aparecer na internet se marcado )</font>
	</div>
</div>
<div id="box6">DESTAQUES PARA O TARIFARIO FIT -> <b>SELOS</b> - <font size="1"><b> Selecionar somente 3 opcoes</b></font>
</div>
<div id="box13">
	<div id="box12">
		<input type="checkbox" id="inet_mapa" name="inet_mapa"> - Singular
	</div>
	<div id="box12">
		<input type="checkbox" id="luxury" name="luxury"> - Green
	</div>
</div>
<div id="box13">
	<div id="box12">
		<input type="checkbox" id="novo" name="novo"> - New
	</div>
	<div id="box12">
		<input type="checkbox" id="favoritos" name="favoritos"> - Loved
	</div>
</div>
<div id="box13">
	<div id="box12">
		<input type="checkbox" id="superb" name="superb"> - Superb
	</div>
	<div id="box12">

	</div>
</div>




<div id="box13">
	Classificacao de estrelas Blumar <b>Somente para hoteis </b> <input type="text" id="htlestrelablumar" name="htlestrelablumar" size="1" maxlength="1">
</div>
<div id="box13">
	Classifica&ccedil;&atilde;o eco <b>Somente para ecologico</b> <select name="classif_eco" id="classif_eco">
		<option value="0" selected>None</option>
		<option value="1">Very Rustic->Basic</option>
		<option value="2">Basic->Comfort</option>
		<option value="3">Superior->Premium</option>
		<option value="4">Friendly</option>
	</select>
</div>
<div id="box13">
	Classifica&ccedil;&atilde;o Luxury <select name="classif_lux" id="classif_lux">
		<option value="0" selected>None</option>
		<option value="1">Tropical</option>
		<option value="2">Opulence</option>
		<option value="3">Beach Front</option>
		<option value="4">Bliss</option>
		<option value="5">Barefoot Chick</option>
		<option value="6">Top Notch</option>


	</select>
</div>
<div id="box6">MARCA&Ccedil;&Atilde;O PARA O SITE NACIONAL</div>
<div id="box13">
	<div id="box12">
		<input type="checkbox" id="pg6fq7" name="pg6fq7"> - Promo especial
	</div>
	<div id="box12">
		<input type="checkbox" id="pg4fq5" name="pg4fq5"> - Bonus Blumar
	</div>
</div>
<div id="box13">
	<div id="box12">
		<input type="checkbox" id="chdgratis" name="chdgratis"> - Crian&ccedil;a Gr&aacute;tis
	</div>
	<div id="box12">
		<input type="checkbox" id="blumarrecomenda" name="blumarrecomenda"> - Blumar Recomenda
	</div>
</div>
<div id="box13">
	<div id="box12">
		<input type="checkbox" id="blumarreveillon" name="blumarreveillon"> - Reveillon
	</div>
	<div id="box12">
		<input name="allinclusive" id="allinclusive" type="checkbox" value="checkbox"> - All Inclusive
	</div>
</div>
<div id="box6">MOST RECOMMENDED PROPERTIES</div>
<div id="box11">
	Descritivo Most Recommended<br>
	<textarea name="desc_mostrp_ing" id="desc_mostrp_ing" cols="60" rows="4"></textarea>
</div>
<div id="box13">
	<div id="box12">
		<input type="checkbox" id="ativo_mostrp" name="ativo_mostrp"> - &Eacute; Most recommended properties
	</div>
	<div id="box12">

	</div>
</div>
<div id="box6">FACILIDADES DO HOTEL</div>
<div id="box16">
	<?php
	$query_fachtl =
		"
									select 
									 	tpofaccod,
										tpofacdsc 
									FROM 
										conteudo_internet.ci_tipo_facilidade
									where 
										tipo = 1
									and 
										ativo = true
									ORDER BY 
										tpofacdsc ASC
								     ";

	$result_fachtl = pg_exec($conn, $query_fachtl);
	if ($result_fachtl) {
		for ($rowcid = 0; $rowcid < pg_numrows($result_fachtl); $rowcid++) {

			$tpofaccod = pg_result($result_fachtl, $rowcid, 'tpofaccod');
			$tpofacdsc = pg_result($result_fachtl, $rowcid, 'tpofacdsc');


			echo '
											<div id="box17">
												<input type="checkbox"  name="facilities"   id="facilities"  value="' . $tpofaccod . '">' . $tpofacdsc . ' 
											</div>
											';
		}
	}


	echo '<div id="box6">FACILIDADES DO APARTAMENTO</div>
										      <div id="box6"></div>';


	$query_fachtl =
		"
									select 
									 	tpofaccod,
										tpofacdsc 
									FROM 
										conteudo_internet.ci_tipo_facilidade
									where 
										tipo = 2
									and 
										ativo = true
									ORDER BY 
										tpofacdsc ASC
								     ";

	$result_fachtl = pg_exec($conn, $query_fachtl);
	if ($result_fachtl) {
		for ($rowcid = 0; $rowcid < pg_numrows($result_fachtl); $rowcid++) {

			$tpofaccod = pg_result($result_fachtl, $rowcid, 'tpofaccod');
			$tpofacdsc = pg_result($result_fachtl, $rowcid, 'tpofacdsc');


			echo '
											<div id="box17">
												<input type="checkbox"  name="facilities"   id="facilities"  value="' . $tpofaccod . '">' . $tpofacdsc . ' 
											</div>
											';
		}
	}
	?>







</div>
<div id="box6">DADOS ADICIONAIS</div>
<div id="box13">
	<div id="box12">
		Número de Quartos/Capacidade (Ex: 220)

		<input type="text" id="htl_num_quartos" name="htl_num_quartos" size="10" maxlength="10">
	</div>
</div>

<!-- Novos campos adicionados -->
<div id="box6">SLUG E DESCRIÇÕES CURTAS</div>
<div id="box13">
	<div id="box12">
		Slug<br>
		<input type="text" name="slug" id="slug" size="50" maxlength="255">
	</div>
	<div id="box12">
		Short Description PT<br>
		<textarea name="short_description_pt" id="short_description_pt" cols="40" rows="2"></textarea>
	</div>
</div>
<div id="box13">
	<div id="box12">
		Short Description EN<br>
		<textarea name="short_description_en" id="short_description_en" cols="40" rows="2"></textarea>
	</div>
	<div id="box12">
		Short Description ES<br>
		<textarea name="short_description_es" id="short_description_es" cols="40" rows="2"></textarea>
	</div>
</div>

<div id="box6">INSIGHTS</div>
<div id="box13">
	<div id="box12">
		Insight PT<br>
		<textarea name="insight_pt" id="insight_pt" cols="40" rows="3"></textarea>
	</div>
	<div id="box12">
		Insight EN<br>
		<textarea name="insight_en" id="insight_en" cols="40" rows="3"></textarea>
	</div>
</div>
<div id="box13">
	<div id="box12">
		Insight ES<br>
		<textarea name="insight_es" id="insight_es" cols="40" rows="3"></textarea>
	</div>
	<div id="box12">
		Price Range<br>
		<input type="text" name="price_range" id="price_range" size="20" maxlength="20">
	</div>
</div>

<div id="box6">LOCALIZAÇÃO E CAPACIDADE</div>
<div id="box13">
	<div id="box12">
		City Name<br>
		<input type="text" name="city_name" id="city_name" size="30" maxlength="255">
	</div>
	<div id="box12">
		State<br>
		<input type="text" name="state" id="state" size="30" maxlength="50">
	</div>
</div>
<div id="box13">
	<div id="box12">
		Country<br>
		<input type="text" name="country" id="country" size="30" maxlength="50">
	</div>
	<div id="box12">
		Capacity Min<br>
		<input type="number" name="capacity_min" id="capacity_min" size="10">
	</div>
</div>
<div id="box13">
	<div id="box12">
		Capacity Max<br>
		<input type="number" name="capacity_max" id="capacity_max" size="10">
	</div>
	<div id="box12">
		Rating (0-5)<br>
		<input type="number" name="rating" id="rating" step="0.1" min="0" max="5" size="5">
	</div>
</div>
<div id="box13">
	<div id="box12">
		Rating Count<br>
		<input type="number" name="rating_count" id="rating_count" size="10">
	</div>
	<div id="box12">
		Latitude<br>
		<input type="number" name="latitude" id="latitude" step="0.000001" size="15">
	</div>
</div>
<div id="box13">
	<div id="box12">
		Longitude<br>
		<input type="number" name="longitude" id="longitude" step="0.000001" size="15">
	</div>
	<div id="box12">
		Map Iframe URL<br>
		<input type="text" name="map_iframe_url" id="map_iframe_url" size="50" maxlength="500">
	</div>
</div>

<div id="box6">GALERIA E IMAGENS</div>
<div id="box13">
	<div id="box12">
		Gallery Images (comma-separated URLs)<br>
		<textarea name="gallery_images" id="gallery_images" cols="60" rows="3"></textarea>
	</div>
	<div id="box12">
		Blueprint Image<br>
		<input type="text" name="blueprint_image" id="blueprint_image" size="50" maxlength="255">
	</div>
</div>

<div id="box6">CATEGORIAS DE QUARTOS E EXPERIÊNCIAS</div>
<div id="box13">
	<div id="box12">
		Room Categories (comma-separated)<br>
		<textarea name="room_categories" id="room_categories" cols="40" rows="3"></textarea>
	</div>
	<div id="box12">
		Dining Experiences<br>
		<textarea name="dining_experiences" id="dining_experiences" cols="40" rows="3"></textarea>
	</div>
</div>

<div id="box6">SALAS DE REUNIÃO E CONVENCÕES</div>
<div id="box13">
	<div id="box12">
		Meeting Rooms Count<br>
		<input type="number" name="meeting_rooms_count" id="meeting_rooms_count" size="10">
	</div>
	<div id="box12">
		Has Convention Center<br>
		<input type="checkbox" name="has_convention_center" id="has_convention_center" value="true">
	</div>
</div>
<div id="box13">
	<div id="box12">
		Meeting Rooms Detail<br>
		<textarea name="meeting_rooms_detail" id="meeting_rooms_detail" cols="60" rows="3"></textarea>
	</div>
	<div id="box12">
		URL 360 Halls<br>
		<input type="text" name="url_360_halls" id="url_360_halls" size="50" maxlength="255">
	</div>
</div>


<div id="box6"><input type="button" name="Go" value="Inserir" onclick="javascript:insere_novo_hotel();"></div>
<div id="box6"></div>
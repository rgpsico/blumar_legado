<?php

if (isset($_SESSION)) {
} else {
	session_start();
}

ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

$frncod = pg_escape_string($_POST["frncod"]);
$_SESSION['frncod'] = $frncod;




$query_htl =
	"
				SELECT
				*
				FROM
					conteudo_internet.ci_hotel
				 where 
				 	frncod = $frncod
			";

$result_htl = pg_exec($conn, $query_htl);
if ($result_htl) {
	for ($rowhtl = 0; $rowhtl < pg_numrows($result_htl); $rowhtl++) {

		$nome_htl = pg_result($result_htl, $rowhtl, 'nome_htl');
		$frncod = pg_result($result_htl, $rowhtl, 'frncod');
		//$nome_for = pg_result($result_htl, $rowhtl, 'nome_for');
		$mneu_for = pg_result($result_htl, $rowhtl, 'mneu_for');
		$htldsc = pg_result($result_htl, $rowhtl, 'htldsc');
		$htldscing = pg_result($result_htl, $rowhtl, 'htldscing');
		$htldscesp = pg_result($result_htl, $rowhtl, 'htldscesp');
		$url_htl_360 = pg_result($result_htl, $rowhtl, 'url_htl_360');
		$arq_htl_360 = pg_result($result_htl, $rowhtl, 'arq_htl_360');
		$htlimgfotofachada = pg_result($result_htl, $rowhtl, 'htlimgfotofachada');
		$htlestrelablumar = pg_result($result_htl, $rowhtl, 'htlestrelablumar');
		$htlimgmapa = pg_result($result_htl, $rowhtl, 'htlimgmapa');
		$htlfotopiscina = pg_result($result_htl, $rowhtl, 'htlfotopiscina');
		$flaghtlimgmapa = pg_result($result_htl, $rowhtl, 'flaghtlimgmapa');
		$flagfotopiscina = pg_result($result_htl, $rowhtl, 'flagfotopiscina');
		$htlurl = pg_result($result_htl, $rowhtl, 'htlurl');
		$url_video = pg_result($result_htl, $rowhtl, 'url_video');
		$arq_video = pg_result($result_htl, $rowhtl, 'arq_video');
		$htlobs = pg_result($result_htl, $rowhtl, 'htlobs');
		$htlobsing = pg_result($result_htl, $rowhtl, 'htlobsing');
		$htlobsesp = pg_result($result_htl, $rowhtl, 'htlobsesp');
		$htlendrua = pg_result($result_htl, $rowhtl, 'htlendrua');
		$hotel_cham = pg_result($result_htl, $rowhtl, 'hotel_cham');
		$flaghtl = pg_result($result_htl, $rowhtl, 'flaghtl');
		$descesp_grpfit = pg_result($result_htl, $rowhtl, 'descesp_grpfit');
		$flaglatino = pg_result($result_htl, $rowhtl, 'flaglatino');
		$flat = pg_result($result_htl, $rowhtl, 'flat');
		$historico_temp = pg_result($result_htl, $rowhtl, 'historico_temp');
		$resort = pg_result($result_htl, $rowhtl, 'resort');
		$regime_hotel = pg_result($result_htl, $rowhtl, 'regime_hotel');
		$rec_entret = pg_result($result_htl, $rowhtl, 'rec_entret');
		$otras_ativ = pg_result($result_htl, $rowhtl, 'otras_ativ');
		$alojamiento = pg_result($result_htl, $rowhtl, 'alojamiento');
		$gastronomia = pg_result($result_htl, $rowhtl, 'gastronomia');
		$servicios = pg_result($result_htl, $rowhtl, 'servicios');
		$convenciones = pg_result($result_htl, $rowhtl, 'convenciones');
		$campo_extra = pg_result($result_htl, $rowhtl, 'campo_extra');
		$ft_resort1 = pg_result($result_htl, $rowhtl, 'ft_resort1');
		$ft_resort2 = pg_result($result_htl, $rowhtl, 'ft_resort2');
		$ft_resort3 = pg_result($result_htl, $rowhtl, 'ft_resort3');
		$fotoextra = pg_result($result_htl, $rowhtl, 'fotoextra');
		$ecologico = pg_result($result_htl, $rowhtl, 'ecologico');
		$complemento = pg_result($result_htl, $rowhtl, 'complemento');
		$fotoextra_recep = pg_result($result_htl, $rowhtl, 'fotoextra_recep');
		$regime_hotel_pt = pg_result($result_htl, $rowhtl, 'regime_hotel_pt');
		$regime_hotel_en = pg_result($result_htl, $rowhtl, 'regime_hotel_en');
		$rec_entret_pt = pg_result($result_htl, $rowhtl, 'rec_entret_pt');
		$rec_entret_en = pg_result($result_htl, $rowhtl, 'rec_entret_en');
		$otras_ativ_pt = pg_result($result_htl, $rowhtl, 'otras_ativ_pt');
		$otras_ativ_en = pg_result($result_htl, $rowhtl, 'otras_ativ_en');
		$alojamiento_pt = pg_result($result_htl, $rowhtl, 'alojamiento_pt');
		$alojamiento_en = pg_result($result_htl, $rowhtl, 'alojamiento_en');
		$gastronomia_pt = pg_result($result_htl, $rowhtl, 'gastronomia_pt');
		$gastronomia_en = pg_result($result_htl, $rowhtl, 'gastronomia_en');
		$servicios_pt = pg_result($result_htl, $rowhtl, 'servicios_pt');
		$servicios_en = pg_result($result_htl, $rowhtl, 'servicios_en');
		$convenciones_pt = pg_result($result_htl, $rowhtl, 'convenciones_pt');
		$convenciones_en = pg_result($result_htl, $rowhtl, 'convenciones_en');
		$campo_extra_pt = pg_result($result_htl, $rowhtl, 'campo_extra_pt');
		$campo_extra_en = pg_result($result_htl, $rowhtl, 'campo_extra_en');
		$bestdeal = pg_result($result_htl, $rowhtl, 'bestdeal');
		$favoritos = pg_result($result_htl, $rowhtl, 'favoritos');
		$luxury = pg_result($result_htl, $rowhtl, 'luxury');
		$novo = pg_result($result_htl, $rowhtl, 'novo');
		$desc_mostrp_ing = pg_result($result_htl, $rowhtl, 'desc_mostrp_ing');
		$ativo_mostrp = pg_result($result_htl, $rowhtl, 'ativo_mostrp');
		$pg6fq7 = pg_result($result_htl, $rowhtl, 'pg6fq7');
		$pg4fq5 = pg_result($result_htl, $rowhtl, 'pg4fq5');
		$chdgratis = pg_result($result_htl, $rowhtl, 'chdgratis');
		$allinclusive = pg_result($result_htl, $rowhtl, 'allinclusive');
		$blumarrecomenda = pg_result($result_htl, $rowhtl, 'blumarrecomenda');
		$blumarreveillon = pg_result($result_htl, $rowhtl, 'blumarreveillon');
		$estrelas_htl = pg_result($result_htl, $rowhtl, 'estrelas_htl');
		$cidade_htl = pg_result($result_htl, $rowhtl, 'cidade_htl');
		$fotofachada_tbn = pg_result($result_htl, $rowhtl, 'fotofachada_tbn');
		$classif_eco = pg_result($result_htl, $rowhtl, 'classif_eco');
		$map_eco = pg_result($result_htl, $rowhtl, 'map_eco');
		$virtual_tour = pg_result($result_htl, $rowhtl, 'virtual_tour');
		$ativo_bnuts = pg_result($result_htl, $rowhtl, 'ativo_bnuts');
		$covid_19_pt = pg_result($result_htl, $rowhtl, 'covid_19_pt');
		$covid_19_en = pg_result($result_htl, $rowhtl, 'covid_19_en');

		$covid_19_pt_url = pg_result($result_htl, $rowhtl, 'covid_19_pt_url');
		$covid_19_en_url = pg_result($result_htl, $rowhtl, 'covid_19_en_url');

		$htl_num_quartos = pg_result($result_htl, $rowhtl, 'htl_num_quartos');

		// Novos campos adicionados
		$slug = pg_result($result_htl, $rowhtl, 'slug');
		$short_description_pt = pg_result($result_htl, $rowhtl, 'short_description_pt');
		$short_description_en = pg_result($result_htl, $rowhtl, 'short_description_en');
		$short_description_es = pg_result($result_htl, $rowhtl, 'short_description_es');
		$insight_pt = pg_result($result_htl, $rowhtl, 'insight_pt');
		$insight_en = pg_result($result_htl, $rowhtl, 'insight_en');
		$insight_es = pg_result($result_htl, $rowhtl, 'insight_es');
		$price_range = pg_result($result_htl, $rowhtl, 'price_range');
		$capacity_min = pg_result($result_htl, $rowhtl, 'capacity_min');
		$capacity_max = pg_result($result_htl, $rowhtl, 'capacity_max');
		$city_name = pg_result($result_htl, $rowhtl, 'city_name');
		$state = pg_result($result_htl, $rowhtl, 'state');
		$country = pg_result($result_htl, $rowhtl, 'country');
		$rating = pg_result($result_htl, $rowhtl, 'rating');
		$rating_count = pg_result($result_htl, $rowhtl, 'rating_count');
		$gallery_images = pg_result($result_htl, $rowhtl, 'gallery_images');
		$blueprint_image = pg_result($result_htl, $rowhtl, 'blueprint_image');
		$room_categories = pg_result($result_htl, $rowhtl, 'room_categories');
		$dining_experiences = pg_result($result_htl, $rowhtl, 'dining_experiences');
		$meeting_rooms_count = pg_result($result_htl, $rowhtl, 'meeting_rooms_count');
		$meeting_rooms_detail = pg_result($result_htl, $rowhtl, 'meeting_rooms_detail');
		$has_convention_center = pg_result($result_htl, $rowhtl, 'has_convention_center');
		$url_360_halls = pg_result($result_htl, $rowhtl, 'url_360_halls');
		$latitude = pg_result($result_htl, $rowhtl, 'latitude');
		$longitude = pg_result($result_htl, $rowhtl, 'longitude');
		$map_iframe_url = pg_result($result_htl, $rowhtl, 'map_iframe_url');
	}
}


if (isset($update_apto)) {
} else {

	/*   if (strlen($nome_for) == '0')
   {
   	
   }
   else
   { 
   	echo "ALTERA&Ccedil;&Atilde;O do HOTEL <b>'$nome_for'</b><br>";
   }
   */
	echo "ALTERA&Ccedil;&Atilde;O do HOTEL <b>'$nome_htl'</b><br>";
}


$hoteis = "select nome_for 
			from sbd95.fornec 
			where 
			 mneu_for = '$mneu_for'";
$result_hoteis_pendentes = pg_exec($conn, $hoteis);
$lista_pendentes = "";
for ($htl = 0; $htl < pg_numrows($result_hoteis_pendentes); $htl++) {
	$nome_for = pg_result($result_hoteis_pendentes, $htl, 'nome_for');
}



$ultimo_update_fotos = "select max( data_cadastro ) as data_cadastro   from banco_imagem.bco_img where mneu_for = '$mneu_for'";
$result_ultimo_update = pg_exec($conn, $ultimo_update_fotos);
$rows_ultimo_update = pg_numrows($result_ultimo_update);

for ($ru = 0; $ru < pg_numrows($result_ultimo_update); $ru++) {
	$ultimo_update = pg_result($result_ultimo_update, $ru, 'data_cadastro');
}

if (strlen($ultimo_update) != '0') {

	$arraydtin = explode("-", $ultimo_update);
	$diadtin = $arraydtin[2];
	$mesdtin = $arraydtin[1];
	$anodtin = $arraydtin[0];
	$dataintr = $diadtin . '/' . $mesdtin . '/' . $anodtin;


	$msg_update = '<br><b>Ultimo update de fotos realizado em: ' . $dataintr . '.</b>';
} else {
	$msg_update = '<br><b>Sem registro de uptade de fotos no novo formato.</b>';
}

?>
<div id="miolo-alteracao">
	<div id="box2"><?php echo $nome_for . ' - ' . $mneu_for; ?>
		MNEU_FOR (codigo do hotel no sistema Blumar) | <a href="https://www.blumar.com.br/client_area/rates/new_pop_hotel.php?cod_hotel=<?php echo $mneu_for; ?>&lang=2&hotel=<?php echo $nome_for; ?>" onClick="window.open('','hotelPopup','scrollbars=yes,width=960,height=750');" target="hotelPopup"><b>ver pagina >></b></a>
		<br><?php echo $msg_update; ?>
		<div id="box1"><input type="hidden" name="mneu_for" id="mneu_for" maxlength="4" value="<?php echo $mneu_for; ?>" size="4"> </div>
	</div>
	<div id="box6">DESCRITIVOS</div>

	<div id="box11">
		Portugu&ecirc;s<br>
		<textarea name="htldsc" id="htldsc" cols="60" rows="4"><?php echo $htldsc; ?></textarea>
	</div>
	<div id="box16">
		ingl&ecirc;s<br>
		<textarea name="htldscing" id="htldscing" cols="80" rows="10"><?php echo $htldscing; ?></textarea>
	</div>
	<div id="box11">
		espanhol (FIT e GRP)<br>
		<textarea name="htldscesp" id="htldscesp" cols="60" rows="4"><?php echo $htldscesp; ?></textarea>
	</div>
	<div id="box11">
		espanhol (GRP)<br>
		<textarea name="descesp_grpfit" id="descesp_grpfit" cols="60" rows="4"><?php echo $descesp_grpfit; ?></textarea>
	</div>


	<div id="box6">CONTEUDO PARA RESORTS</div>


	<div id="box4">
		R&eacute;gimen de comidas<br>
		<div id="box3">
			em Portugu&ecirc;s<br>
			<textarea name="regime_hotel_pt" id="regime_hotel_pt" rows="5" cols="22"><?php echo $regime_hotel_pt; ?></textarea>
		</div>
		<div id="box3">
			em Ingl&ecirc;s<br>
			<textarea name="regime_hotel_en" id="regime_hotel_en" rows="5" cols="22"><?php echo $regime_hotel_en; ?></textarea>
		</div>
		<div id="box3">
			em Espanhol<br>
			<textarea name="regime_hotel" id="regime_hotel" rows="5" cols="22"><?php echo $regime_hotel; ?></textarea>
		</div>
	</div>

	<div id="box4">
		Recreaci&oacute;n & Entretenimiento<br>
		<div id="box3">
			em Portugu&ecirc;s<br>
			<textarea name="rec_entret_pt" id="rec_entret_pt" rows="5" cols="22"><?php echo $rec_entret_pt; ?></textarea>
		</div>
		<div id="box3">
			em Ingl&ecirc;s<br>
			<textarea name="rec_entret_en" id="rec_entret_en" rows="5" cols="22"><?php echo $rec_entret_en; ?></textarea>
		</div>
		<div id="box3">
			em Espanhol<br>
			<textarea name="rec_entret" id="rec_entret" rows="5" cols="22"><?php echo $rec_entret; ?></textarea>
		</div>
	</div>

	<div id="box4">
		Otras Actividades<br>
		<div id="box3">
			em Portugu&ecirc;s<br>
			<textarea name="otras_ativ_pt" id="otras_ativ_pt" rows="5" cols="22"><?php echo $otras_ativ_pt; ?></textarea>
		</div>
		<div id="box3">
			em Ingl&ecirc;s<br>
			<textarea name="otras_ativ_en" id="otras_ativ_en" rows="5" cols="22"><?php echo $otras_ativ_en; ?></textarea>
		</div>
		<div id="box3">
			em Espanhol<br>
			<textarea name="otras_ativ" id="otras_ativ" rows="5" cols="22"><?php echo $otras_ativ; ?></textarea>
		</div>
	</div>

	<div id="box4">
		Alojamiento<br>

		<div id="box3">
			em Portugu&ecirc;s<br>
			<textarea name="alojamiento_pt" id="alojamiento_pt" rows="5" cols="22"><?php echo $alojamiento_pt; ?></textarea>
		</div>
		<div id="box3">
			em Ingl&ecirc;s<br>
			<textarea name="alojamiento_en" id="alojamiento_en" rows="5" cols="22"><?php echo $alojamiento_en; ?></textarea>
		</div>
		<div id="box3">
			em Espanhol<br>
			<textarea name="alojamiento" id="alojamiento" rows="5" cols="22"><?php echo $alojamiento; ?></textarea>
		</div>
	</div>

	<div id="box4">
		Gastronomia<br>
		<div id="box3">
			em Portugu&ecirc;s<br>
			<textarea name="gastronomia_pt" id="gastronomia_pt" rows="5" cols="22"><?php echo $gastronomia_pt; ?></textarea>
		</div>
		<div id="box3">
			em Ingl&ecirc;s<br>
			<textarea name="gastronomia_en" id="gastronomia_en" rows="5" cols="22"><?php echo $gastronomia_en; ?></textarea>
		</div>
		<div id="box3">
			em Espanhol<br>
			<textarea name="gastronomia" id="gastronomia" rows="5" cols="22"><?php echo $gastronomia; ?></textarea>
		</div>
	</div>


	<div id="box4">
		Servicios<br>
		<div id="box3">
			em Portugu&ecirc;s<br>
			<textarea name="servicios_pt" id="servicios_pt" rows="5" cols="22"><?php echo $servicios_pt; ?></textarea>
		</div>
		<div id="box3">
			em Ingl&ecirc;s<br>
			<textarea name="servicios_en" id="servicios_en" rows="5" cols="22"><?php echo $servicios_en; ?></textarea>
		</div>
		<div id="box3">
			em Espanhol<br>
			<textarea name="servicios" id="servicios" rows="5" cols="22"><?php echo $servicios; ?></textarea>
		</div>
	</div>


	<div id="box4">
		Convenciones<br>
		<div id="box3">
			em Portugu&ecirc;s<br>
			<textarea name="convenciones_pt" id="convenciones_pt" rows="5" cols="22"><?php echo $convenciones_pt; ?></textarea>
		</div>
		<div id="box3">
			em Ingl&ecirc;s<br>
			<textarea name="convenciones_en" id="convenciones_en" rows="5" cols="22"><?php echo $convenciones_en; ?></textarea>
		</div>
		<div id="box3">
			em Espanhol<br>
			<textarea name="convenciones" id="convenciones" rows="5" cols="22"><?php echo $convenciones; ?></textarea>
		</div>
	</div>

	<div id="box4">
		Servicios Adicionales<br>
		<div id="box3">
			em Portugu&ecirc;s<br>
			<textarea name="campo_extra_pt" id="campo_extra_pt" rows="5" cols="22"><?php echo $campo_extra_pt; ?></textarea>
		</div>
		<div id="box3">
			em Ingl&ecirc;s<br>
			<textarea name="campo_extra_en" id="campo_extra_en" rows="5" cols="22"><?php echo $campo_extra_en; ?></textarea>
		</div>
		<div id="box3">
			em Espanhol<br>
			<textarea name="campo_extra" id="campo_extra" rows="5" cols="22"><?php echo $campo_extra; ?></textarea>
		</div>
	</div>


	<div id="box4">
		Conte&uacute;do Complementar Ecol&oacute;gico<br>
		<div id="box3">

			<textarea name="complemento" id="complemento" rows="5" cols="22"><?php echo $complemento; ?></textarea>
		</div>
		<div id="box3">

		</div>
		<div id="box3">

		</div>
	</div>


	<div id="box11">
		Chamada destaque (site nacional) <font size="1"> OBS.: No maximo 200 caracteres, incluindo espa&ccedil;os.</font><br>
		<textarea name="hotel_cham" id="hotel_cham" cols="60" rows="4"><?php echo $hotel_cham; ?></textarea>
	</div>

	<div id="box6">FOTOS</div>
	<div id="box5">
		Fachada<br>
		<input name="htlimgfotofachada" id="htlimgfotofachada" type="text" size="100" maxlength="150" value="<?php echo $htlimgfotofachada; ?>">
	</div>
	<div id="box5">
		fachada TBN<br>
		<input name="fotofachada_tbn" id="fotofachada_tbn" type="text" size="100" maxlength="150" value="<?php echo $fotofachada_tbn; ?>">
	</div>
	<div id="box5">
		Piscina<br>
		<input name="htlfotopiscina" id="htlfotopiscina" type="text" size="100" maxlength="150" value="<?php echo $htlfotopiscina; ?>">
	</div>
	<div id="box5">
		Foto Extra 1<br>
		<input name="fotoextra" id="fotoextra" type="text" size="100" maxlength="150" value="<?php echo $fotoextra; ?>">
	</div>
	<div id="box5">
		Foto Extra 2<br>
		<input name="fotoextra_recep" id="fotoextra_recep" type="text" size="100" maxlength="150" value="<?php echo $fotoextra_recep; ?>">
	</div>
	<div id="box5">
		Foto Extra 3<br>
		<input name="ft_resort1" id="ft_resort1" type="text" size="100" maxlength="150" value="<?php echo $ft_resort1; ?>">
	</div>
	<div id="box5">
		Foto Extra 4<br>
		<input name="ft_resort2" id="ft_resort2" type="text" size="100" maxlength="150" value="<?php echo $ft_resort2; ?>">
	</div>
	<div id="box5">
		Foto Extra 5<br>
		<input name="ft_resort3" id="ft_resort3" type="text" size="100" maxlength="150" value="<?php echo $ft_resort3; ?>">
	</div>


	<div id="box6">APARTAMENTOS J&Aacute; CADASTRADOS</div>



	<?php
	$query_aptos =
		"
										SELECT
											frncod,
                                            aptocatcod,
                                            aptoimgfoto,
                                            aptqtd,
                                            aptoloccod,
                                            pk_aptcod
                                         FROM 
											conteudo_internet.ci_apartamento
										 where 
										     frncod = 	$frncod
										 order by     
											 pk_aptcod	
								     ";

	$result_aptos = pg_exec($conn, $query_aptos);
	if ($result_aptos) {
		for ($rowapto = 0; $rowapto < pg_numrows($result_aptos); $rowapto++) {

			$aptocatcod = pg_result($result_aptos, $rowapto, 'aptocatcod');
			$aptoimgfoto = pg_result($result_aptos, $rowapto, 'aptoimgfoto');
			$aptqtd = pg_result($result_aptos, $rowapto, 'aptqtd');
			$aptoloccod = pg_result($result_aptos, $rowapto, 'aptoloccod');


			echo ' 
										     <div id="box13">
											        <div id="box14">
														categoria <br>';

			$query_aptocateg =
				"
										     SELECT
										      catdscing
										     FROM
										       conteudo_internet.apto_categoria
										     WHERE aptocatcod = $aptocatcod 
										     
										     ";

			$result_aptocateg = pg_exec($conn, $query_aptocateg);
			if ($result_aptocateg) {
				for ($rowapcateg = 0; $rowapcateg < pg_numrows($result_aptocateg); $rowapcateg++) {

					$catdscing = pg_result($result_aptocateg, $rowapcateg, 'catdscing');

					echo '<input type="text" name="catdscing" id="catdscing" maxlength="100"   value="' . $catdscing . '" size="25">';
				}
			}


			echo '
										     </div>
										     <div id="box14">
										     localizacao <br>';


			$query_aptoloc =
				"
										     SELECT
										        aptolocdscing
										     FROM
										        conteudo_internet.apto_localizacao
										     WHERE  aptoloccod  =    $aptoloccod
										     ";

			$result_aptoloc = pg_exec($conn, $query_aptoloc);
			if ($result_aptoloc) {
				for ($rowaploc = 0; $rowaploc < pg_numrows($result_aptoloc); $rowaploc++) {

					$aptolocdscing = pg_result($result_aptoloc, $rowaploc, 'aptolocdscing');
					echo '<input type="text" name="aptolocdscing" id="aptolocdscing" maxlength="100"   value="' . $aptolocdscing . '" size="25">';
				}
			}


			echo '
											     </div>
											     <div id="box15">
													     Qtd.<br>
													     <input name="qtd1" id="qtd1"  type="text"   size="2" maxlength="20"  value="' . $aptqtd . '">
											     </div>
											     <div id="box14">
													     foto<br>
													     <input type="text" name="foto1" id="foto1" maxlength="100"   value="' . $aptoimgfoto . '" size="30">
											     </div>
										     </div>
										     ';
		}
	}
	?>

	<div id="box6">
		<A href="#" onclick="javascript:altera_apto();" title="Clique para alterar um apto">ALTERAR CONTEUDO de APARTAMENTOS >></A><BR>
		<A href="javascript:apaga_apto();" title="Clique para apagar aptos">EXCLUS&Atilde;O de APARTAMENTOS >></A><BR>
		<A href="javascript:add_apto();" title="Clique para acrescentar aptos">ACRESCENTAR APARTAMENTOS >></A>
	</div>
	<div id="box6"></div>
	<div id="box6">MAPAS</div>
	<div id="box11">
		Mapa Google<br>
		<textarea name="htlurl" id="htlurl" cols="60" rows="4"><?php echo $htlurl; ?></textarea>
	</div>
	<div id="box5">
		Mapa<br>
		<input name="htlimgmapa" id="htlimgmapa" type="text" size="100" maxlength="150" value="<?php echo $htlimgmapa; ?>">
	</div>
	<div id="box5">
		Mapa Ecologico<br>
		<input name="map_eco" id="map_eco" type="text" size="100" maxlength="150" value="<?php echo $map_eco; ?>">
	</div>



	<div id="box6">VIDEOS</div>
	<div id="box5">
		Endere&ccedil;o foto 360<br>
		<input name="url_htl_360" id="url_htl_360" type="text" size="100" maxlength="150" value="<?php echo $url_htl_360; ?>">
	</div>
	<div id="box5">
		Arquivo foto 360<br>
		<input name="arq_htl_360" id="arq_htl_360" type="text" size="100" maxlength="150" value="<?php echo $arq_htl_360; ?>">
	</div>
	<div id="box5">
		Endere&ccedil;o video<br>
		<input name="url_video" id="url_video" type="text" size="100" maxlength="150" value="<?php echo $url_video; ?>">
	</div>
	<div id="box5">
		Arquivo do video<br>
		<input name="arq_video" id="arq_video" type="text" size="100" maxlength="150" value="<?php echo $arq_video; ?>">
	</div>
	<div id="box5">
		Tour virtual sem flash<br>
		<input name="virtual_tour" id="virtual_tour" type="text" size="60" maxlength="150" value="<?php echo $virtual_tour; ?>">
	</div>
	<div id="box6">DOCUMENTOS PROCEDIMENTOS COVID-19</div>
	<div id="box5">
		Arquivo em PDF em Portugues<br>
		<div id="del_covid19pt">

			<?php if (strlen($covid_19_pt) != 0) {
				echo '<input name="covid_19_pt"  id="covid_19_pt" type="text"  size="60" maxlength="150" value="' . $covid_19_pt . '"> <a href="##" onClick="javascript: del_covid19pt();"><img src="images/del.png"></a>';
			} else {
				echo 'Nenhum arquivo inserido!';
			} ?>
		</div>
	</div>
	<div id="box5">
		Inserir novo arquivo em PDF em Portugues<br>
		<iframe src="hotel/mioloiframe1.php" height="140" width="950" frameborder="0"></iframe>
	</div>


	<div id="box5">
		Arquivo em PDF em Ingles<br>
		<div id="del_covid19en">

			<?php if (strlen($covid_19_en) != 0) {
				echo ' <input name="covid_19_en"  id="covid_19_en" type="text"  size="60" maxlength="150" value="' . $covid_19_en . '"> <a href="##" onClick="javascript: del_covid19en();"><img src="images/del.png"></a>';
			} else {
				echo 'Nenhum arquivo inserido!';
			} ?>
		</div>
	</div>
	<div id="box5">
		Inserir novo arquivo em PDF em Ingles<br>
		<iframe src="hotel/mioloiframe2.php" height="140" width="950" frameborder="0"></iframe>
	</div>



	<div id="box5">
		URL procedimento PT<br>
		<input name="covid_19_pt_url" id="covid_19_pt_url" type="text" size="60" maxlength="250" value="<?php echo $covid_19_pt_url; ?>">
	</div>


	<div id="box5">
		URL procedimento EN<br>
		<input name="covid_19_en_url" id="covid_19_en_url" type="text" size="60" maxlength="250" value="<?php echo $covid_19_en_url; ?>">
	</div>

	<div id="box6">OBSERVA&Ccedil;&Otilde;ES</div>
	<div id="box7">
		em ingles<br>
		<textarea name="htlobsing" id="htlobsing" cols="80" rows="15"><?php echo $htlobsing; ?></textarea>
	</div>
	<div id="box11">
		em portugues<br>
		<textarea name="htlobs" id="htlobs" cols="60" rows="4"><?php echo $htlobs; ?></textarea>
	</div>

	<div id="box11">
		em espanhol (Blumar Opina)<br>
		<textarea name="htlobsesp" id="htlobsesp" cols="60" rows="4"><?php echo $htlobsesp; ?></textarea>
	</div>
	<div id="box11">
		Hist&oacute;rico de Altera&ccedil;&otilde;es de Templates<br>
		<textarea name="historico_temp" id="historico_temp" cols="60" rows="4"><?php echo $historico_temp; ?></textarea>
	</div>
	<div id="box6">MARCA&Ccedil;&Atilde;O</div>
	<div id="box13">
		<div id="box12">
			<input type="checkbox" id="flaghtl" name="flaghtl" <?php if ($flaghtl == 't') {
																	echo 'checked';
																}  ?>> - Ativo na Internet Blumar<br>
			<font size="1">( Ir&aacute; aparecer na internet se marcado )</font>
		</div>
		<div id="box12">
			<input type="checkbox" id="flaglatino" name="flaglatino" <?php if ($flaglatino == 't') {
																			echo 'checked';
																		}  ?>> - N&atilde;o aparecer Template no Tarif&aacute;rio Latino<br>
			<font size="1">( N&atilde;o aparece o descritivo do Hotel no tarif&aacute;rio )</font>
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			<input type="checkbox" id="flat" name="flat" <?php if ($flat == 't') {
																echo 'checked';
															}  ?>> - &Eacute; Flat
		</div>
		<div id="box12">
			<input type="checkbox" id="resort" name="resort" <?php if ($resort == 't') {
																	echo 'checked';
																}  ?>> - &Eacute; Resort
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			<input type="checkbox" id="ecologico" name="ecologico" <?php if ($ecologico == 't') {
																		echo 'checked';
																	}  ?>> - &Eacute; Ecol&oacute;gico
		</div>
		<div id="box12">
			<input type="checkbox" id="flagfotopiscina" name="flagfotopiscina" <?php if ($flagfotopiscina == 't') {
																					echo 'checked';
																				}  ?>> - &Eacute; destaque no tarifario Latino
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			<input type="checkbox" id="bestdeal" name="bestdeal" <?php if ($bestdeal == 't') {
																		echo 'checked';
																	}  ?>> - Best Deal
		</div>
		<div id="box12">
			<input type="checkbox" id="ativo_bnuts" name="ativo_bnuts" <?php if ($ativo_bnuts == 't') {
																			echo 'checked';
																		}  ?>> - Ativo site Bnuts<br>
			<font size="1">( Ir&aacute; aparecer na internet se marcado )</font>
		</div>
	</div>
	<div id="box6">DESTAQUES PARA O TARIFARIO FIT - <font size="1"><b> Selecionar somente 3 opcoes</b></font>
	</div>
	<div id="box13">
		<div id="box12">
			<input type="checkbox" id="flaghtlimgmapa" name="flaghtlimgmapa" <?php if ($flaghtlimgmapa == 't') {
																					echo 'checked';
																				}  ?>> - Unique
		</div>
		<div id="box12">
			<input type="checkbox" id="luxury" name="luxury" <?php if ($luxury == 't') {
																	echo 'checked';
																}  ?>> - Eco Friendly
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			<input type="checkbox" id="novo" name="novo" <?php if ($novo == 't') {
																echo 'checked';
															}  ?>> - New
		</div>
		<div id="box12">
			<input type="checkbox" id="favoritos" name="favoritos" <?php if ($favoritos == 't') {
																		echo 'checked';
																	}  ?>> - Favorite
		</div>
	</div>
	<div id="box13">
		Classificacao de estrelas Blumar <b>Somente para hoteis </b> <input type="text" id="htlestrelablumar" name="htlestrelablumar" size="1" maxlength="1" value="<?php echo $htlestrelablumar; ?>">
	</div>
	<div id="box13">
		Classifica&ccedil;&atilde;o eco <b>Somente para ecologico</b> <select name="classif_eco" id="classif_eco">

			<?php

			if ($classif_eco == '0') {
				echo '<option value="0" selected>None</option>';
			} elseif ($classif_eco == '1') {
				echo '<option value="1" selected>Very Rustic</option>';
			} elseif ($classif_eco == '2') {
				echo '<option value="2" selected>Basic</option>';
			} elseif ($classif_eco == '3') {
				echo '<option value="3" selected>Superior</option>';
			} elseif ($classif_eco == '4') {
				echo '<option value="4" selected>Friendly</option>';
			}
			?>
			<option value="0">None</option>
			<option value="1">Very Rustic</option>
			<option value="2">Basic</option>
			<option value="3">Superior</option>
			<option value="4">Friendly</option>
		</select>
	</div>

	<div id="box6">MARCA&Ccedil;&Atilde;O PARA O SITE NACIONAL</div>
	<div id="box13">
		<div id="box12">
			<input type="checkbox" id="pg6fq7" name="pg6fq7" <?php if ($pg6fq7 == 't') {
																	echo 'checked';
																}  ?>> - Promo especial
		</div>
		<div id="box12">
			<input type="checkbox" id="pg4fq5" name="pg4fq5" <?php if ($pg4fq5 == 't') {
																	echo 'checked';
																}  ?>> - Bonus Blumar
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			<input type="checkbox" id="chdgratis" name="chdgratis" <?php if ($chdgratis == 't') {
																		echo 'checked';
																	}  ?>> - Crian&ccedil;a Gr&aacute;tis
		</div>
		<div id="box12">
			<input type="checkbox" id="blumarrecomenda" name="blumarrecomenda" <?php if ($blumarrecomenda == 't') {
																					echo 'checked';
																				}  ?>> - Blumar Recomenda
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			<input type="checkbox" id="blumarreveillon" name="blumarreveillon" <?php if ($blumarreveillon == 't') {
																					echo 'checked';
																				}  ?>> - Reveillon
		</div>
		<div id="box12">
			<input name="allinclusive" id="allinclusive" type="checkbox" value="checkbox" <?php if ($allinclusive == 't') {
																								echo 'checked';
																							}  ?>> - All Inclusive
		</div>
	</div>
	<div id="box6">MARCA&Ccedil;&Atilde;O DE ESTILOS PARA O SITE NACIONAL</div>
	<div id="box13">
		<div id="box12">
			Insira um estilo<br>
			<SELECT name="estilo" id="estilo" onChange="javascript:insere_estilo_htl();">
				<option value="0" selected>Selecione</option>
				<option value="1">Ecologico</option>
				<option value="2">Familia</option>
				<option value="3">Praia</option>
				<option value="4">Resort</option>
				<option value="5">Lua de mel</option>
				<option value="6">Safari</option>
				<option value="7">Cruzeiros</option>
				<option value="8">Tudo incluido</option>
				<option value="9">Gastronomia</option>
				<option value="10">Aventura</option>
				<option value="11">Cultural</option>
			</select>
			<br>

			<div id="estilos_do_htl">

				<?php

				require_once '../util/connection.php';

				$pega_estilos = "
	select
		cod_estilo, pk_estilo_htl
	from
		conteudo_internet.ci_hotel_estilo
	where
		mneu_for = '$mneu_for'";


				$result_tour = pg_exec($conn, $pega_estilos);


				if ($result_tour) {
					for ($rowcid = 0; $rowcid < pg_numrows($result_tour); $rowcid++) {
						$cod_estilo = pg_result($result_tour, $rowcid, 'cod_estilo');
						$pk_estilo = pg_result($result_tour, $rowcid, 'pk_estilo_htl');


						if ($cod_estilo == 1) {
							echo '-Ecologico | <a href="##" class="pkestilohtl" title="apagar estilo htl"><input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X</a><br>';
						}
						if ($cod_estilo == 2) {
							echo '-Familia  | <a href="##" class="pkestilohtl" title="apagar estilo htl"><input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X</a><br>';
						}
						if ($cod_estilo == 3) {
							echo '-Praia  | <a href="##" class="pkestilohtl" title="apagar estilo htl"><input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X</a><br>';
						}
						if ($cod_estilo == 4) {
							echo '-Resort  | <a href="##" class="pkestilohtl" title="apagar estilo htl"><input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X</a><br>';
						}
						if ($cod_estilo == 5) {
							echo '-Lua de mel  | <a href="##" class="pkestilohtl" title="apagar estilo htl"><input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X</a><br>';
						}
						if ($cod_estilo == 6) {
							echo '-Safari  | <a href="##" class="pkestilohtl" title="apagar estilo htl"><input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X</a><br>';
						}
						if ($cod_estilo == 7) {
							echo '-Cruzeiros  | <a href="##" class="pkestilohtl" title="apagar estilo htl"><input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X</a><br>';
						}
						if ($cod_estilo == 8) {
							echo '-Tudo incluido  | <a href="##" class="pkestilohtl" title="apagar estilo htl"><input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X</a><br>';
						}
						if ($cod_estilo == 9) {
							echo '-Gastronomia  | <a href="##" class="pkestilohtl" title="apagar estilo htl"><input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X</a><br>';
						}
						if ($cod_estilo == 10) {
							echo '-Aventura  | <a href="##" class="pkestilohtl" title="apagar estilo htl"><input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X</a><br>';
						}
						if ($cod_estilo == 11) {
							echo '-Cultural  | <a href="##" class="pkestilohtl" title="apagar estilo htl"><input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X</a><br>';
						}
					}
				}

				?>


			</div>




		</div>

	</div>





	<div id="box6">MOST RECOMMENDED PROPERTIES</div>
	<div id="box11">
		Descritivo Most Recommended<br>
		<textarea name="desc_mostrp_ing" id="desc_mostrp_ing" cols="60" rows="4"><?php echo $desc_mostrp_ing; ?></textarea>
	</div>
	<div id="box13">
		<div id="box12">
			<input type="checkbox" id="ativo_mostrp" name="ativo_mostrp" <?php if ($ativo_mostrp == 't') {
																				echo 'checked';
																			}  ?>> - &Eacute; Most recommended properties
		</div>
		<div id="box12">

		</div>
	</div>
	<div id="box6">FACILIDADES DO HOTEL J&Aacute; CADASTRADAS</div>
	<div id="box16">
		<?php

		$query_fachtl1 =
			"
				              select
					              conteudo_internet.ci_hotel_facilidade.tpofaccod,
					              tpofacdsc
				              FROM
				              	conteudo_internet.ci_hotel_facilidade
				              inner join 
				                 conteudo_internet.ci_tipo_facilidade	
				              on 
				              	 conteudo_internet.ci_hotel_facilidade.tpofaccod =  conteudo_internet.ci_tipo_facilidade.tpofaccod  
				              where
				              	tipo = 1
				              and
				             	 ativo = true
				              and 
				                 mneu_for = '$frncod'	 
				              ORDER BY
				              	 conteudo_internet.ci_hotel_facilidade.tpofaccod ASC
				              ";


		$result_fachtl1 = pg_exec($conn, $query_fachtl1);
		if ($result_fachtl1) {
			for ($rowfac1 = 0; $rowfac1 < pg_numrows($result_fachtl1); $rowfac1++) {

				$tpofaccod1 = pg_result($result_fachtl1, $rowfac1, 'tpofaccod');
				$tpofacdsc1 = pg_result($result_fachtl1, $rowfac1, 'tpofacdsc');


				echo '
											<div id="box17">
												 ' . $tpofacdsc1 . ' 
											</div>
											';
			}
		}
		?>







	</div>
	<div id="box6">
		<A href="javascript:apaga_fac_htl();" title="Clique para apagar facilidades do hotel">EXCLUS&Atilde;O de FACILIDADES DO HOTEL >></A><BR>
		<A href="javascript:add_fac_htl();" title="Clique para acrescentar facilidades do hotel">ACRESCENTAR FACILIDADES DO HOTEL >></A>
	</div>
	<div id="box6">FACILIDADES DO APARTAMENTO J&Aacute; CADASTRADAS</div>
	<div id="box16">
		<?php

		$query_fachtl2 =
			"
				              select
					              conteudo_internet.ci_hotel_facilidade.tpofaccod,
					              tpofacdsc
				              FROM
				              	conteudo_internet.ci_hotel_facilidade
				              inner join 
				                 conteudo_internet.ci_tipo_facilidade	
				              on 
				              	 conteudo_internet.ci_hotel_facilidade.tpofaccod =  conteudo_internet.ci_tipo_facilidade.tpofaccod  
				              where
				              	tipo = 2
				              and
				             	 ativo = true
				              and 
				                 mneu_for = '$frncod'	 
				              ORDER BY
				              	 conteudo_internet.ci_hotel_facilidade.tpofaccod ASC
				              ";


		$result_fachtl2 = pg_exec($conn, $query_fachtl2);
		if ($result_fachtl2) {
			for ($rowfac2 = 0; $rowfac2 < pg_numrows($result_fachtl2); $rowfac2++) {

				$tpofaccod2 = pg_result($result_fachtl2, $rowfac2, 'tpofaccod');
				$tpofacdsc2 = pg_result($result_fachtl2, $rowfac2, 'tpofacdsc');


				echo '
											<div id="box17">
												 ' . $tpofacdsc2 . ' 
											</div>
											';
			}
		}
		?>







	</div>
	<div id="box6">
		<A href="javascript:apaga_fac_apto();" title="Clique para apagar facilidades do Apartamento">EXCLUS&Atilde;O de FACILIDADES DO APARTAMENTO >></A><BR>
		<A href="javascript:add_fac_apto();" title="Clique para acrescentar facilidades do Apartamento">ACRESCENTAR FACILIDADES DO APARTAMENTO >></A>
	</div>
	<?php

	if (isset($update_apto)) {
		echo '<div id="box6">
								<hr>';
		echo "<b>HOTEL ATUALIZADO COM SUCESSO!</b>";
		echo '</div>';
	} else {
	}

	?>




	<div id="box6">DADOS ADICIONAIS</div>
	<div id="box13">
		<div id="box12">
			Número de Quartos/Capacidade (Ex: 220)

			<input type="text" id="htl_num_quartos" name="htl_num_quartos" size="10" maxlength="10" value="<?php echo $htl_num_quartos ?>">
		</div>
	</div>

	<!-- Novos campos adicionados -->
	<div id="box6">SLUG E DESCRIÇÕES CURTAS</div>
	<div id="box13">
		<div id="box12">
			Slug<br>
			<input type="text" name="slug" id="slug" size="50" maxlength="255" value="<?php echo $slug; ?>">
		</div>
		<div id="box12">
			Short Description PT<br>
			<textarea name="short_description_pt" id="short_description_pt" cols="40" rows="2"><?php echo $short_description_pt; ?></textarea>
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			Short Description EN<br>
			<textarea name="short_description_en" id="short_description_en" cols="40" rows="2"><?php echo $short_description_en; ?></textarea>
		</div>
		<div id="box12">
			Short Description ES<br>
			<textarea name="short_description_es" id="short_description_es" cols="40" rows="2"><?php echo $short_description_es; ?></textarea>
		</div>
	</div>

	<div id="box6">INSIGHTS</div>
	<div id="box13">
		<div id="box12">
			Insight PT<br>
			<textarea name="insight_pt" id="insight_pt" cols="40" rows="3"><?php echo $insight_pt; ?></textarea>
		</div>
		<div id="box12">
			Insight EN<br>
			<textarea name="insight_en" id="insight_en" cols="40" rows="3"><?php echo $insight_en; ?></textarea>
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			Insight ES<br>
			<textarea name="insight_es" id="insight_es" cols="40" rows="3"><?php echo $insight_es; ?></textarea>
		</div>
		<div id="box12">
			Price Range<br>
			<input type="text" name="price_range" id="price_range" size="20" maxlength="20" value="<?php echo $price_range; ?>">
		</div>
	</div>

	<div id="box6">LOCALIZAÇÃO E CAPACIDADE</div>
	<div id="box13">
		<div id="box12">
			City Name<br>
			<input type="text" name="city_name" id="city_name" size="30" maxlength="255" value="<?php echo $city_name; ?>">
		</div>
		<div id="box12">
			State<br>
			<input type="text" name="state" id="state" size="30" maxlength="50" value="<?php echo $state; ?>">
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			Country<br>
			<input type="text" name="country" id="country" size="30" maxlength="50" value="<?php echo $country; ?>">
		</div>
		<div id="box12">
			Capacity Min<br>
			<input type="number" name="capacity_min" id="capacity_min" size="10" value="<?php echo $capacity_min; ?>">
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			Capacity Max<br>
			<input type="number" name="capacity_max" id="capacity_max" size="10" value="<?php echo $capacity_max; ?>">
		</div>
		<div id="box12">
			Rating (0-5)<br>
			<input type="number" name="rating" id="rating" step="0.1" min="0" max="5" size="5" value="<?php echo $rating; ?>">
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			Rating Count<br>
			<input type="number" name="rating_count" id="rating_count" size="10" value="<?php echo $rating_count; ?>">
		</div>
		<div id="box12">
			Latitude<br>
			<input type="number" name="latitude" id="latitude" step="0.000001" size="15" value="<?php echo $latitude; ?>">
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			Longitude<br>
			<input type="number" name="longitude" id="longitude" step="0.000001" size="15" value="<?php echo $longitude; ?>">
		</div>
		<div id="box12">
			Map Iframe URL<br>
			<input type="text" name="map_iframe_url" id="map_iframe_url" size="50" maxlength="500" value="<?php echo $map_iframe_url; ?>">
		</div>
	</div>

	<div id="box6">GALERIA E IMAGENS</div>
	<div id="box13">
		<div id="box12">
			Gallery Images (comma-separated URLs)<br>
			<textarea name="gallery_images" id="gallery_images" cols="60" rows="3"><?php echo $gallery_images; ?></textarea>
		</div>
		<div id="box12">
			Blueprint Image<br>
			<input type="text" name="blueprint_image" id="blueprint_image" size="50" maxlength="255" value="<?php echo $blueprint_image; ?>">
		</div>
	</div>

	<div id="box6">CATEGORIAS DE QUARTOS E EXPERIÊNCIAS</div>
	<div id="box13">
		<div id="box12">
			Room Categories (comma-separated)<br>
			<textarea name="room_categories" id="room_categories" cols="40" rows="3"><?php echo $room_categories; ?></textarea>
		</div>
		<div id="box12">
			Dining Experiences<br>
			<textarea name="dining_experiences" id="dining_experiences" cols="40" rows="3"><?php echo $dining_experiences; ?></textarea>
		</div>
	</div>

	<div id="box6">SALAS DE REUNIÃO E CONVENCÕES</div>
	<div id="box13">
		<div id="box12">
			Meeting Rooms Count<br>
			<input type="number" name="meeting_rooms_count" id="meeting_rooms_count" size="10" value="<?php echo $meeting_rooms_count; ?>">
		</div>
		<div id="box12">
			Has Convention Center<br>
			<input type="checkbox" name="has_convention_center" id="has_convention_center" <?php if ($has_convention_center == 't') {
																								echo 'checked';
																							} ?> value="true">
		</div>
	</div>
	<div id="box13">
		<div id="box12">
			Meeting Rooms Detail<br>
			<textarea name="meeting_rooms_detail" id="meeting_rooms_detail" cols="60" rows="3"><?php echo $meeting_rooms_detail; ?></textarea>
		</div>
		<div id="box12">
			URL 360 Halls<br>
			<input type="text" name="url_360_halls" id="url_360_halls" size="50" maxlength="255" value="<?php echo $url_360_halls; ?>">
		</div>
	</div>

	<input type="hidden" name="frncod" id="frncod" value="<?php echo $frncod; ?>">
	<div id="box6"><input type="button" name="Go" value="Alterar" onclick="javascript:update_hotel();"></div>
	<div id="box6"></div>


</div>
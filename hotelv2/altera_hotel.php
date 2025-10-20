<?php
if (isset($_SESSION)) {
} else {
	session_start();
}

ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

$frncod = pg_escape_string($_POST["frncod"] ?? '');
$_SESSION['frncod'] = $frncod;

$query_htl = "
    SELECT *
    FROM conteudo_internet.ci_hotel
    WHERE frncod = $frncod
";

$result_htl = pg_exec($conn, $query_htl);

// Initialize variables to empty strings to avoid undefined notices
$nome_htl = $mneu_for = $htldsc = $htldscing = $htldscesp = $url_htl_360 = $arq_htl_360 = $htlimgfotofachada = $htlestrelablumar = $htlimgmapa = $htlfotopiscina = $flaghtlimgmapa = $flagfotopiscina = $htlurl = $url_video = $arq_video = $htlobs = $htlobsing = $htlobsesp = $htlendrua = $hotel_cham = $flaghtl = $descesp_grpfit = $flaglatino = $flat = $historico_temp = $resort = $regime_hotel = $rec_entret = $otras_ativ = $alojamiento = $gastronomia = $servicios = $convenciones = $campo_extra = $ft_resort1 = $ft_resort2 = $ft_resort3 = $fotoextra = $ecologico = $complemento = $fotoextra_recep = $regime_hotel_pt = $regime_hotel_en = $rec_entret_pt = $rec_entret_en = $otras_ativ_pt = $otras_ativ_en = $alojamiento_pt = $alojamiento_en = $gastronomia_pt = $gastronomia_en = $servicios_pt = $servicios_en = $convenciones_pt = $convenciones_en = $campo_extra_pt = $campo_extra_en = $bestdeal = $favoritos = $luxury = $novo = $desc_mostrp_ing = $ativo_mostrp = $pg6fq7 = $pg4fq5 = $chdgratis = $allinclusive = $blumarrecomenda = $blumarreveillon = $estrelas_htl = $cidade_htl = $fotofachada_tbn = $classif_eco = $map_eco = $virtual_tour = $ativo_bnuts = $covid_19_pt = $covid_19_en = $covid_19_pt_url = $covid_19_en_url = $htl_num_quartos = $slug = $short_description_pt = $short_description_en = $short_description_es = $insight_pt = $insight_en = $insight_es = $price_range = $capacity_min = $capacity_max = $city_name = $state = $country = $rating = $rating_count = $gallery_images = $blueprint_image = $room_categories = $dining_experiences = $meeting_rooms_count = $meeting_rooms_detail = $has_convention_center = $url_360_halls = $latitude = $longitude = $map_iframe_url = '';

if ($result_htl && pg_numrows($result_htl) > 0) {
	$nome_htl = pg_result($result_htl, 0, 'nome_htl');
	$frncod = pg_result($result_htl, 0, 'frncod');
	$mneu_for = pg_result($result_htl, 0, 'mneu_for');
	$htldsc = pg_result($result_htl, 0, 'htldsc');
	$htldscing = pg_result($result_htl, 0, 'htldscing');
	$htldscesp = pg_result($result_htl, 0, 'htldscesp');
	$url_htl_360 = pg_result($result_htl, 0, 'url_htl_360');
	$arq_htl_360 = pg_result($result_htl, 0, 'arq_htl_360');
	$htlimgfotofachada = pg_result($result_htl, 0, 'htlimgfotofachada');
	$htlestrelablumar = pg_result($result_htl, 0, 'htlestrelablumar');
	$htlimgmapa = pg_result($result_htl, 0, 'htlimgmapa');
	$htlfotopiscina = pg_result($result_htl, 0, 'htlfotopiscina');
	$flaghtlimgmapa = pg_result($result_htl, 0, 'flaghtlimgmapa');
	$flagfotopiscina = pg_result($result_htl, 0, 'flagfotopiscina');
	$htlurl = pg_result($result_htl, 0, 'htlurl');
	$url_video = pg_result($result_htl, 0, 'url_video');
	$arq_video = pg_result($result_htl, 0, 'arq_video');
	$htlobs = pg_result($result_htl, 0, 'htlobs');
	$htlobsing = pg_result($result_htl, 0, 'htlobsing');
	$htlobsesp = pg_result($result_htl, 0, 'htlobsesp');
	$htlendrua = pg_result($result_htl, 0, 'htlendrua');
	$hotel_cham = pg_result($result_htl, 0, 'hotel_cham');
	$flaghtl = pg_result($result_htl, 0, 'flaghtl');
	$descesp_grpfit = pg_result($result_htl, 0, 'descesp_grpfit');
	$flaglatino = pg_result($result_htl, 0, 'flaglatino');
	$flat = pg_result($result_htl, 0, 'flat');
	$historico_temp = pg_result($result_htl, 0, 'historico_temp');
	$resort = pg_result($result_htl, 0, 'resort');
	$regime_hotel = pg_result($result_htl, 0, 'regime_hotel');
	$rec_entret = pg_result($result_htl, 0, 'rec_entret');
	$otras_ativ = pg_result($result_htl, 0, 'otras_ativ');
	$alojamiento = pg_result($result_htl, 0, 'alojamiento');
	$gastronomia = pg_result($result_htl, 0, 'gastronomia');
	$servicios = pg_result($result_htl, 0, 'servicios');
	$convenciones = pg_result($result_htl, 0, 'convenciones');
	$campo_extra = pg_result($result_htl, 0, 'campo_extra');
	$ft_resort1 = pg_result($result_htl, 0, 'ft_resort1');
	$ft_resort2 = pg_result($result_htl, 0, 'ft_resort2');
	$ft_resort3 = pg_result($result_htl, 0, 'ft_resort3');
	$fotoextra = pg_result($result_htl, 0, 'fotoextra');
	$ecologico = pg_result($result_htl, 0, 'ecologico');
	$complemento = pg_result($result_htl, 0, 'complemento');
	$fotoextra_recep = pg_result($result_htl, 0, 'fotoextra_recep');
	$regime_hotel_pt = pg_result($result_htl, 0, 'regime_hotel_pt');
	$regime_hotel_en = pg_result($result_htl, 0, 'regime_hotel_en');
	$rec_entret_pt = pg_result($result_htl, 0, 'rec_entret_pt');
	$rec_entret_en = pg_result($result_htl, 0, 'rec_entret_en');
	$otras_ativ_pt = pg_result($result_htl, 0, 'otras_ativ_pt');
	$otras_ativ_en = pg_result($result_htl, 0, 'otras_ativ_en');
	$alojamiento_pt = pg_result($result_htl, 0, 'alojamiento_pt');
	$alojamiento_en = pg_result($result_htl, 0, 'alojamiento_en');
	$gastronomia_pt = pg_result($result_htl, 0, 'gastronomia_pt');
	$gastronomia_en = pg_result($result_htl, 0, 'gastronomia_en');
	$servicios_pt = pg_result($result_htl, 0, 'servicios_pt');
	$servicios_en = pg_result($result_htl, 0, 'servicios_en');
	$convenciones_pt = pg_result($result_htl, 0, 'convenciones_pt');
	$convenciones_en = pg_result($result_htl, 0, 'convenciones_en');
	$campo_extra_pt = pg_result($result_htl, 0, 'campo_extra_pt');
	$campo_extra_en = pg_result($result_htl, 0, 'campo_extra_en');
	$bestdeal = pg_result($result_htl, 0, 'bestdeal');
	$favoritos = pg_result($result_htl, 0, 'favoritos');
	$luxury = pg_result($result_htl, 0, 'luxury');
	$novo = pg_result($result_htl, 0, 'novo');
	$desc_mostrp_ing = pg_result($result_htl, 0, 'desc_mostrp_ing');
	$ativo_mostrp = pg_result($result_htl, 0, 'ativo_mostrp');
	$pg6fq7 = pg_result($result_htl, 0, 'pg6fq7');
	$pg4fq5 = pg_result($result_htl, 0, 'pg4fq5');
	$chdgratis = pg_result($result_htl, 0, 'chdgratis');
	$allinclusive = pg_result($result_htl, 0, 'allinclusive');
	$blumarrecomenda = pg_result($result_htl, 0, 'blumarrecomenda');
	$blumarreveillon = pg_result($result_htl, 0, 'blumarreveillon');
	$estrelas_htl = pg_result($result_htl, 0, 'estrelas_htl');
	$cidade_htl = pg_result($result_htl, 0, 'cidade_htl');
	$fotofachada_tbn = pg_result($result_htl, 0, 'fotofachada_tbn');
	$classif_eco = pg_result($result_htl, 0, 'classif_eco');
	$map_eco = pg_result($result_htl, 0, 'map_eco');
	$virtual_tour = pg_result($result_htl, 0, 'virtual_tour');
	$ativo_bnuts = pg_result($result_htl, 0, 'ativo_bnuts');
	$covid_19_pt = pg_result($result_htl, 0, 'covid_19_pt');
	$covid_19_en = pg_result($result_htl, 0, 'covid_19_en');
	$covid_19_pt_url = pg_result($result_htl, 0, 'covid_19_pt_url');
	$covid_19_en_url = pg_result($result_htl, 0, 'covid_19_en_url');
	$htl_num_quartos = pg_result($result_htl, 0, 'htl_num_quartos');
	$slug = pg_result($result_htl, 0, 'slug');
	$short_description_pt = pg_result($result_htl, 0, 'short_description_pt');
	$short_description_en = pg_result($result_htl, 0, 'short_description_en');
	$short_description_es = pg_result($result_htl, 0, 'short_description_es');
	$insight_pt = pg_result($result_htl, 0, 'insight_pt');
	$insight_en = pg_result($result_htl, 0, 'insight_en');
	$insight_es = pg_result($result_htl, 0, 'insight_es');
	$price_range = pg_result($result_htl, 0, 'price_range');
	$capacity_min = pg_result($result_htl, 0, 'capacity_min');
	$capacity_max = pg_result($result_htl, 0, 'capacity_max');
	$city_name = pg_result($result_htl, 0, 'city_name');
	$state = pg_result($result_htl, 0, 'state');
	$country = pg_result($result_htl, 0, 'country');
	$rating = pg_result($result_htl, 0, 'rating');
	$rating_count = pg_result($result_htl, 0, 'rating_count');
	$gallery_images = pg_result($result_htl, 0, 'gallery_images');
	$blueprint_image = pg_result($result_htl, 0, 'blueprint_image');
	$room_categories = pg_result($result_htl, 0, 'room_categories');
	$dining_experiences = pg_result($result_htl, 0, 'dining_experiences');
	$meeting_rooms_count = pg_result($result_htl, 0, 'meeting_rooms_count');
	$meeting_rooms_detail = pg_result($result_htl, 0, 'meeting_rooms_detail');
	$has_convention_center = pg_result($result_htl, 0, 'has_convention_center');
	$url_360_halls = pg_result($result_htl, 0, 'url_360_halls');
	$latitude = pg_result($result_htl, 0, 'latitude');
	$longitude = pg_result($result_htl, 0, 'longitude');
	$map_iframe_url = pg_result($result_htl, 0, 'map_iframe_url');
}

if (!isset($update_apto)) {
	echo "ALTERAÇÃO do HOTEL <b>'$nome_htl'</b><br>";
}

$hoteis = "SELECT nome_for FROM sbd95.fornec WHERE mneu_for = '$mneu_for'";
$result_hoteis_pendentes = pg_exec($conn, $hoteis);
$nome_for = '';
if ($result_hoteis_pendentes && pg_numrows($result_hoteis_pendentes) > 0) {
	$nome_for = pg_result($result_hoteis_pendentes, 0, 'nome_for');
}

$ultimo_update_fotos = "SELECT max(data_cadastro) AS data_cadastro FROM banco_imagem.bco_img WHERE mneu_for = '$mneu_for'";
$result_ultimo_update = pg_exec($conn, $ultimo_update_fotos);
$ultimo_update = '';
if ($result_ultimo_update && pg_numrows($result_ultimo_update) > 0) {
	$ultimo_update = pg_result($result_ultimo_update, 0, 'data_cadastro');
}

$msg_update = '<br><b>Sem registro de update de fotos no novo formato.</b>';
if (!empty($ultimo_update)) {
	$arraydtin = explode("-", $ultimo_update);
	$diadtin = $arraydtin[2];
	$mesdtin = $arraydtin[1];
	$anodtin = $arraydtin[0];
	$dataintr = $diadtin . '/' . $mesdtin . '/' . $anodtin;
	$msg_update = '<br><b>Último update de fotos realizado em: ' . $dataintr . '.</b>';
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div class="container-fluid py-4">
	<div class="row mb-4">
		<div class="col-12">
			<h2 class="text-center mb-3">Alteração de Hotel</h2>
			<div class="alert alert-info text-center">
				<strong>Nome do Hotel:</strong> <?= htmlspecialchars($nome_htl) ?> (<?= htmlspecialchars($nome_for . ' - ' . $mneu_for) ?>)<br>
				<?= $msg_update ?>
				<br><a href="https://www.blumar.com.br/client_area/rates/new_pop_hotel.php?cod_hotel=<?= htmlspecialchars($mneu_for) ?>&lang=2&hotel=<?= urlencode($nome_for) ?>" target="_blank" class="btn btn-sm btn-outline-primary mt-2">Ver Página >></a>
			</div>
			<input type="hidden" name="mneu_for" id="mneu_for" value="<?= htmlspecialchars($mneu_for) ?>">
			<input type="hidden" name="frncod" id="frncod" value="<?= htmlspecialchars($frncod) ?>">
		</div>
	</div>

	<form id="hotelEditForm">
		<!-- Seção 1: Descrições Principais -->
		<div class="accordion mb-4" id="accordionDescricoes">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDescricoes">
						Descritivos
					</button>
				</h2>
				<div id="collapseDescricoes" class="accordion-collapse collapse show" data-bs-parent="#accordionDescricoes">
					<div class="accordion-body">
						<div class="row">
							<div class="col-md-12 mb-3">
								<label class="form-label">Português</label>
								<textarea class="form-control" name="htldsc" id="htldsc" rows="4"><?= htmlspecialchars($htldsc) ?></textarea>
							</div>
							<div class="col-md-12 mb-3">
								<label class="form-label">Inglês</label>
								<textarea class="form-control" name="htldscing" id="htldscing" rows="4"><?= htmlspecialchars($htldscing) ?></textarea>
							</div>
							<div class="col-md-12 mb-3">
								<label class="form-label">Espanhol (FIT e GRP)</label>
								<textarea class="form-control" name="htldscesp" id="htldscesp" rows="4"><?= htmlspecialchars($htldscesp) ?></textarea>
							</div>
							<div class="col-md-12 mb-3">
								<label class="form-label">Espanhol (GRP)</label>
								<textarea class="form-control" name="descesp_grpfit" id="descesp_grpfit" rows="4"><?= htmlspecialchars($descesp_grpfit) ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 2: Conteúdo para Resorts -->
		<div class="accordion mb-4" id="accordionResorts">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseResorts">
						Conteúdo para Resorts
					</button>
				</h2>
				<div id="collapseResorts" class="accordion-collapse collapse" data-bs-parent="#accordionResorts">
					<div class="accordion-body">
						<div class="row g-3">
							<div class="col-md-4">
								<h6>Régimen de Comidas</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="regime_hotel_pt" id="regime_hotel_pt" rows="5"><?= htmlspecialchars($regime_hotel_pt) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="regime_hotel_en" id="regime_hotel_en" rows="5"><?= htmlspecialchars($regime_hotel_en) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="regime_hotel" id="regime_hotel" rows="5"><?= htmlspecialchars($regime_hotel) ?></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<h6>Recreación & Entretenimiento</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="rec_entret_pt" id="rec_entret_pt" rows="5"><?= htmlspecialchars($rec_entret_pt) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="rec_entret_en" id="rec_entret_en" rows="5"><?= htmlspecialchars($rec_entret_en) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="rec_entret" id="rec_entret" rows="5"><?= htmlspecialchars($rec_entret) ?></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<h6>Otras Actividades</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="otras_ativ_pt" id="otras_ativ_pt" rows="5"><?= htmlspecialchars($otras_ativ_pt) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="otras_ativ_en" id="otras_ativ_en" rows="5"><?= htmlspecialchars($otras_ativ_en) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="otras_ativ" id="otras_ativ" rows="5"><?= htmlspecialchars($otras_ativ) ?></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<h6>Alojamiento</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="alojamiento_pt" id="alojamiento_pt" rows="5"><?= htmlspecialchars($alojamiento_pt) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="alojamiento_en" id="alojamiento_en" rows="5"><?= htmlspecialchars($alojamiento_en) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="alojamiento" id="alojamiento" rows="5"><?= htmlspecialchars($alojamiento) ?></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<h6>Gastronomia</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="gastronomia_pt" id="gastronomia_pt" rows="5"><?= htmlspecialchars($gastronomia_pt) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="gastronomia_en" id="gastronomia_en" rows="5"><?= htmlspecialchars($gastronomia_en) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="gastronomia" id="gastronomia" rows="5"><?= htmlspecialchars($gastronomia) ?></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<h6>Servicios</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="servicios_pt" id="servicios_pt" rows="5"><?= htmlspecialchars($servicios_pt) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="servicios_en" id="servicios_en" rows="5"><?= htmlspecialchars($servicios_en) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="servicios" id="servicios" rows="5"><?= htmlspecialchars($servicios) ?></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<h6>Convenciones</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="convenciones_pt" id="convenciones_pt" rows="5"><?= htmlspecialchars($convenciones_pt) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="convenciones_en" id="convenciones_en" rows="5"><?= htmlspecialchars($convenciones_en) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="convenciones" id="convenciones" rows="5"><?= htmlspecialchars($convenciones) ?></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<h6>Servicios Adicionales</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="campo_extra_pt" id="campo_extra_pt" rows="5"><?= htmlspecialchars($campo_extra_pt) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="campo_extra_en" id="campo_extra_en" rows="5"><?= htmlspecialchars($campo_extra_en) ?></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="campo_extra" id="campo_extra" rows="5"><?= htmlspecialchars($campo_extra) ?></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<h6>Conteúdo Complementar Ecológico</h6>
								<textarea class="form-control" name="complemento" id="complemento" rows="5"><?= htmlspecialchars($complemento) ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 3: Destaques e Chamadas -->
		<div class="row mb-4">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h6>Chamada Destaque (Site Nacional) <small class="text-muted">Máx. 200 caracteres, incluindo espaços</small></h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="hotel_cham" id="hotel_cham" rows="4"><?= htmlspecialchars($hotel_cham) ?></textarea>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 4: Fotos e Galeria -->
		<div class="accordion mb-4" id="accordionFotos">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFotos">
						Fotos e Galeria
					</button>
				</h2>
				<div id="collapseFotos" class="accordion-collapse collapse" data-bs-parent="#accordionFotos">
					<div class="accordion-body">
						<div class="row g-3">
							<div class="col-md-6">
								<label class="form-label">Fachada</label>
								<input type="text" class="form-control" name="htlimgfotofachada" id="htlimgfotofachada" maxlength="150" value="<?= htmlspecialchars($htlimgfotofachada) ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Fachada TBN</label>
								<input type="text" class="form-control" name="fotofachada_tbn" id="fotofachada_tbn" maxlength="150" value="<?= htmlspecialchars($fotofachada_tbn) ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Piscina</label>
								<input type="text" class="form-control" name="htlfotopiscina" id="htlfotopiscina" maxlength="150" value="<?= htmlspecialchars($htlfotopiscina) ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Foto Extra 1</label>
								<input type="text" class="form-control" name="fotoextra" id="fotoextra" maxlength="150" value="<?= htmlspecialchars($fotoextra) ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Foto Extra 2 (Recepção)</label>
								<input type="text" class="form-control" name="fotoextra_recep" id="fotoextra_recep" maxlength="150" value="<?= htmlspecialchars($fotoextra_recep) ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Foto Extra 3</label>
								<input type="text" class="form-control" name="ft_resort1" id="ft_resort1" maxlength="150" value="<?= htmlspecialchars($ft_resort1) ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Foto Extra 4</label>
								<input type="text" class="form-control" name="ft_resort2" id="ft_resort2" maxlength="150" value="<?= htmlspecialchars($ft_resort2) ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Foto Extra 5</label>
								<input type="text" class="form-control" name="ft_resort3" id="ft_resort3" maxlength="150" value="<?= htmlspecialchars($ft_resort3) ?>">
							</div>
							<div class="col-md-12">
								<label class="form-label">Imagens da Galeria (URLs separadas por vírgula)</label>
								<textarea class="form-control" name="gallery_images" id="gallery_images" rows="3"><?= htmlspecialchars($gallery_images) ?></textarea>
							</div>
							<div class="col-md-12">
								<label class="form-label">Imagem da Planta Baixa</label>
								<input type="text" class="form-control" name="blueprint_image" id="blueprint_image" maxlength="255" value="<?= htmlspecialchars($blueprint_image) ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 5: Apartamentos Já Cadastrados -->
		<div class="accordion mb-4" id="accordionApartamentos">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseApartamentos">
						Apartamentos Já Cadastrados
					</button>
				</h2>
				<div id="collapseApartamentos" class="accordion-collapse collapse" data-bs-parent="#accordionApartamentos">
					<div class="accordion-body">
						<?php
						$query_aptos = "
                            SELECT frncod, aptocatcod, aptoimgfoto, aptqtd, aptoloccod, pk_aptcod
                            FROM conteudo_internet.ci_apartamento
                            WHERE frncod = $frncod
                            ORDER BY pk_aptcod
                        ";
						$result_aptos = pg_exec($conn, $query_aptos);
						if ($result_aptos && pg_numrows($result_aptos) > 0) {
							for ($rowapto = 0; $rowapto < pg_numrows($result_aptos); $rowapto++) {
								$aptocatcod = pg_result($result_aptos, $rowapto, 'aptocatcod');
								$aptoimgfoto = pg_result($result_aptos, $rowapto, 'aptoimgfoto');
								$aptqtd = pg_result($result_aptos, $rowapto, 'aptqtd');
								$aptoloccod = pg_result($result_aptos, $rowapto, 'aptoloccod');
								$pk_aptcod = pg_result($result_aptos, $rowapto, 'pk_aptcod');

								$catdscing = '';
								$query_aptocateg = "SELECT catdscing FROM conteudo_internet.apto_categoria WHERE aptocatcod = $aptocatcod";
								$result_aptocateg = pg_exec($conn, $query_aptocateg);
								if ($result_aptocateg && pg_numrows($result_aptocateg) > 0) {
									$catdscing = pg_result($result_aptocateg, 0, 'catdscing');
								}

								$aptolocdscing = '';
								$query_aptoloc = "SELECT aptolocdscing FROM conteudo_internet.apto_localizacao WHERE aptoloccod = $aptoloccod";
								$result_aptoloc = pg_exec($conn, $query_aptoloc);
								if ($result_aptoloc && pg_numrows($result_aptoloc) > 0) {
									$aptolocdscing = pg_result($result_aptoloc, 0, 'aptolocdscing');
								}
						?>
								<div class="row mb-3 border-bottom pb-3">
									<div class="col-md-3">
										<label class="form-label">Categoria</label>
										<input type="text" class="form-control-plaintext" value="<?= htmlspecialchars($catdscing) ?>" readonly>
									</div>
									<div class="col-md-3">
										<label class="form-label">Localização</label>
										<input type="text" class="form-control-plaintext" value="<?= htmlspecialchars($aptolocdscing) ?>" readonly>
									</div>
									<div class="col-md-2">
										<label class="form-label">Qtd.</label>
										<input type="text" class="form-control-plaintext" value="<?= htmlspecialchars($aptqtd) ?>" readonly>
									</div>
									<div class="col-md-4">
										<label class="form-label">Foto</label>
										<input type="text" class="form-control-plaintext" value="<?= htmlspecialchars($aptoimgfoto) ?>" readonly>
									</div>
								</div>
						<?php
							}
						} else {
							echo '<div class="col-12"><p class="text-muted">Nenhum apartamento cadastrado.</p></div>';
						}
						?>
						<div class="row mt-3">
							<div class="col-12 text-center">
								<a href="#" class="btn btn-outline-primary me-2" onclick="javascript:altera_apto();">Alterar Conteúdo de Apartamentos >></a>
								<a href="javascript:apaga_apto();" class="btn btn-outline-danger me-2">Exclusão de Apartamentos >></a>
								<a href="javascript:add_apto();" class="btn btn-outline-success">Acrescentar Apartamentos >></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 6: Mapas e Vídeos -->
		<div class="row mb-4">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h6>Mapas</h6>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">Mapa Google</label>
							<textarea class="form-control" name="htlurl" id="htlurl" rows="4"><?= htmlspecialchars($htlurl) ?></textarea>
						</div>
						<div class="mb-3">
							<label class="form-label">Mapa</label>
							<input type="text" class="form-control" name="htlimgmapa" id="htlimgmapa" maxlength="150" value="<?= htmlspecialchars($htlimgmapa) ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">Mapa Ecológico</label>
							<input type="text" class="form-control" name="map_eco" id="map_eco" maxlength="150" value="<?= htmlspecialchars($map_eco) ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">URL do Iframe do Mapa</label>
							<input type="text" class="form-control" name="map_iframe_url" id="map_iframe_url" maxlength="500" value="<?= htmlspecialchars($map_iframe_url) ?>">
						</div>
						<div class="row g-2">
							<div class="col-6">
								<label class="form-label">Latitude</label>
								<input type="number" class="form-control" name="latitude" id="latitude" step="0.000001" value="<?= htmlspecialchars($latitude) ?>">
							</div>
							<div class="col-6">
								<label class="form-label">Longitude</label>
								<input type="number" class="form-control" name="longitude" id="longitude" step="0.000001" value="<?= htmlspecialchars($longitude) ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h6>Vídeos e 360°</h6>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">Endereço Foto 360</label>
							<input type="text" class="form-control" name="url_htl_360" id="url_htl_360" maxlength="150" value="<?= htmlspecialchars($url_htl_360) ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">Arquivo Foto 360</label>
							<input type="text" class="form-control" name="arq_htl_360" id="arq_htl_360" maxlength="150" value="<?= htmlspecialchars($arq_htl_360) ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">Endereço Vídeo</label>
							<input type="text" class="form-control" name="url_video" id="url_video" maxlength="150" value="<?= htmlspecialchars($url_video) ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">Arquivo do Vídeo</label>
							<input type="text" class="form-control" name="arq_video" id="arq_video" maxlength="150" value="<?= htmlspecialchars($arq_video) ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">Tour Virtual sem Flash</label>
							<input type="text" class="form-control" name="virtual_tour" id="virtual_tour" maxlength="150" value="<?= htmlspecialchars($virtual_tour) ?>">
						</div>
						<div class="mb-3">
							<label class="form-label">URL 360 das Salas</label>
							<input type="text" class="form-control" name="url_360_halls" id="url_360_halls" maxlength="255" value="<?= htmlspecialchars($url_360_halls) ?>">
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 7: Documentos COVID-19 -->
		<div class="accordion mb-4" id="accordionCovid">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCovid">
						Documentos Procedimentos COVID-19
					</button>
				</h2>
				<div id="collapseCovid" class="accordion-collapse collapse" data-bs-parent="#accordionCovid">
					<div class="accordion-body">
						<div class="row g-3">
							<div class="col-md-6">
								<h6>Arquivo em PDF em Português</h6>
								<div id="del_covid19pt">
									<?php if (!empty($covid_19_pt)): ?>
										<input type="text" class="form-control mb-2" name="covid_19_pt" id="covid_19_pt" maxlength="150" value="<?= htmlspecialchars($covid_19_pt) ?>">
										<a href="#" onclick="javascript: del_covid19pt();" class="btn btn-sm btn-outline-danger">Excluir</a>
									<?php else: ?>
										<p class="text-muted">Nenhum arquivo inserido!</p>
									<?php endif; ?>
								</div>
								<label class="form-label">Inserir novo arquivo em PDF em Português</label>
								<iframe src="hotel/mioloiframe1.php" height="140" width="100%" frameborder="0"></iframe>
							</div>
							<div class="col-md-6">
								<h6>Arquivo em PDF em Inglês</h6>
								<div id="del_covid19en">
									<?php if (!empty($covid_19_en)): ?>
										<input type="text" class="form-control mb-2" name="covid_19_en" id="covid_19_en" maxlength="150" value="<?= htmlspecialchars($covid_19_en) ?>">
										<a href="#" onclick="javascript: del_covid19en();" class="btn btn-sm btn-outline-danger">Excluir</a>
									<?php else: ?>
										<p class="text-muted">Nenhum arquivo inserido!</p>
									<?php endif; ?>
								</div>
								<label class="form-label">Inserir novo arquivo em PDF em Inglês</label>
								<iframe src="hotel/mioloiframe2.php" height="140" width="100%" frameborder="0"></iframe>
							</div>
							<div class="col-md-6">
								<label class="form-label">URL Procedimento PT</label>
								<input type="text" class="form-control" name="covid_19_pt_url" id="covid_19_pt_url" maxlength="250" value="<?= htmlspecialchars($covid_19_pt_url) ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">URL Procedimento EN</label>
								<input type="text" class="form-control" name="covid_19_en_url" id="covid_19_en_url" maxlength="250" value="<?= htmlspecialchars($covid_19_en_url) ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 8: Observações -->
		<div class="accordion mb-4" id="accordionObservacoes">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObservacoes">
						Observações
					</button>
				</h2>
				<div id="collapseObservacoes" class="accordion-collapse collapse" data-bs-parent="#accordionObservacoes">
					<div class="accordion-body">
						<div class="row g-3">
							<div class="col-md-12 mb-3">
								<label class="form-label">Em Inglês</label>
								<textarea class="form-control" name="htlobsing" id="htlobsing" rows="15"><?= htmlspecialchars($htlobsing) ?></textarea>
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Em Português</label>
								<textarea class="form-control" name="htlobs" id="htlobs" rows="4"><?= htmlspecialchars($htlobs) ?></textarea>
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Em Espanhol (Blumar Opina)</label>
								<textarea class="form-control" name="htlobsesp" id="htlobsesp" rows="4"><?= htmlspecialchars($htlobsesp) ?></textarea>
							</div>
							<div class="col-md-12 mb-3">
								<label class="form-label">Histórico de Alterações de Templates</label>
								<textarea class="form-control" name="historico_temp" id="historico_temp" rows="4"><?= htmlspecialchars($historico_temp) ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 9: Marcações e Checkboxes -->
		<div class="accordion mb-4" id="accordionMarcacoes">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMarcacoes">
						Marcações e Flags
					</button>
				</h2>
				<div id="collapseMarcacoes" class="accordion-collapse collapse" data-bs-parent="#accordionMarcacoes">
					<div class="accordion-body">
						<div class="row">
							<div class="col-md-6">
								<h6>Marcações Gerais</h6>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="flaghtl" id="flaghtl" <?= ($flaghtl == 't' ? 'checked' : '') ?>>
									<label class="form-check-label small" for="flaghtl">Ativo na Internet Blumar <small>(Aparecerá na internet se marcado)</small></label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="flaglatino" id="flaglatino" <?= ($flaglatino == 't' ? 'checked' : '') ?>>
									<label class="form-check-label small" for="flaglatino">Não aparecer Template no Tarifário Latino <small>(Não aparece o descritivo do Hotel no tarifário)</small></label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="flat" id="flat" <?= ($flat == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="flat">É Flat</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="resort" id="resort" <?= ($resort == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="resort">É Resort</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="ecologico" id="ecologico" <?= ($ecologico == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="ecologico">É Ecológico</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="flagfotopiscina" id="flagfotopiscina" <?= ($flagfotopiscina == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="flagfotopiscina">É destaque no tarifário Latino</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="bestdeal" id="bestdeal" <?= ($bestdeal == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="bestdeal">Best Deal</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="ativo_bnuts" id="ativo_bnuts" <?= ($ativo_bnuts == 't' ? 'checked' : '') ?>>
									<label class="form-check-label small" for="ativo_bnuts">Ativo site Bnuts <small>(Aparecerá na internet se marcado)</small></label>
								</div>
							</div>
							<div class="col-md-6">
								<h6>Destaques para o Tarifário FIT (Selos - Selecionar somente 3 opções)</h6>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="flaghtlimgmapa" id="flaghtlimgmapa" <?= ($flaghtlimgmapa == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="flaghtlimgmapa">Unique</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="luxury" id="luxury" <?= ($luxury == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="luxury">Eco Friendly</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="novo" id="novo" <?= ($novo == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="novo">New</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="favoritos" id="favoritos" <?= ($favoritos == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="favoritos">Favorite</label>
								</div>
								<h6 class="mt-3">Marcações para o Site Nacional</h6>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="pg6fq7" id="pg6fq7" <?= ($pg6fq7 == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="pg6fq7">Promo especial</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="pg4fq5" id="pg4fq5" <?= ($pg4fq5 == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="pg4fq5">Bonus Blumar</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="chdgratis" id="chdgratis" <?= ($chdgratis == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="chdgratis">Criança Grátis</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="blumarrecomenda" id="blumarrecomenda" <?= ($blumarrecomenda == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="blumarrecomenda">Blumar Recomenda</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="blumarreveillon" id="blumarreveillon" <?= ($blumarreveillon == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="blumarreveillon">Reveillon</label>
								</div>
								<div class="form-check mb-2">
									<input class="form-check-input" type="checkbox" name="allinclusive" id="allinclusive" <?= ($allinclusive == 't' ? 'checked' : '') ?>>
									<label class="form-check-label" for="allinclusive">All Inclusive</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 10: Classificações -->
		<div class="row mb-4 g-3">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Classificação de Estrelas Blumar <small>Somente para hotéis</small></h6>
					</div>
					<div class="card-body text-center">
						<input type="text" class="form-control" name="htlestrelablumar" id="htlestrelablumar" maxlength="1" value="<?= htmlspecialchars($htlestrelablumar) ?>">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Classificação Eco <small>Somente para ecológico</small></h6>
					</div>
					<div class="card-body">
						<select class="form-select" name="classif_eco" id="classif_eco">
							<option value="0" <?= ($classif_eco == '0' ? 'selected' : '') ?>>None</option>
							<option value="1" <?= ($classif_eco == '1' ? 'selected' : '') ?>>Very Rustic</option>
							<option value="2" <?= ($classif_eco == '2' ? 'selected' : '') ?>>Basic</option>
							<option value="3" <?= ($classif_eco == '3' ? 'selected' : '') ?>>Superior</option>
							<option value="4" <?= ($classif_eco == '4' ? 'selected' : '') ?>>Friendly</option>
						</select>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 11: Marcações de Estilos -->
		<div class="row mb-4">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h6>Marcações de Estilos para o Site Nacional</h6>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">Inserir um estilo</label>
							<select class="form-select" name="estilo" id="estilo" onchange="javascript:insere_estilo_htl();">
								<option value="0">Selecione</option>
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
						</div>
						<div id="estilos_do_htl" class="list-group list-group-flush">
							<?php
							$pega_estilos = "SELECT cod_estilo, pk_estilo_htl FROM conteudo_internet.ci_hotel_estilo WHERE mneu_for = '$mneu_for'";
							$result_tour = pg_exec($conn, $pega_estilos);
							if ($result_tour && pg_numrows($result_tour) > 0) {
								for ($rowcid = 0; $rowcid < pg_numrows($result_tour); $rowcid++) {
									$cod_estilo = pg_result($result_tour, $rowcid, 'cod_estilo');
									$pk_estilo = pg_result($result_tour, $rowcid, 'pk_estilo_htl');
									$estilo_text = '';
									switch ($cod_estilo) {
										case 1:
											$estilo_text = 'Ecologico';
											break;
										case 2:
											$estilo_text = 'Familia';
											break;
										case 3:
											$estilo_text = 'Praia';
											break;
										case 4:
											$estilo_text = 'Resort';
											break;
										case 5:
											$estilo_text = 'Lua de mel';
											break;
										case 6:
											$estilo_text = 'Safari';
											break;
										case 7:
											$estilo_text = 'Cruzeiros';
											break;
										case 8:
											$estilo_text = 'Tudo incluido';
											break;
										case 9:
											$estilo_text = 'Gastronomia';
											break;
										case 10:
											$estilo_text = 'Aventura';
											break;
										case 11:
											$estilo_text = 'Cultural';
											break;
									}
									echo '<div class="list-group-item d-flex justify-content-between align-items-center">
                                            ' . htmlspecialchars($estilo_text) . '
                                            <a href="#" class="pkestilohtl btn btn-sm btn-outline-danger" title="Apagar estilo htl">
                                                <input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X
                                            </a>
                                          </div>';
								}
							} else {
								echo '<p class="text-muted">Nenhum estilo cadastrado.</p>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 12: Most Recommended Properties -->
		<div class="row mb-4">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h6>Descritivo Most Recommended (Inglês)</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="desc_mostrp_ing" id="desc_mostrp_ing" rows="4"><?= htmlspecialchars($desc_mostrp_ing) ?></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Flag Most Recommended</h6>
					</div>
					<div class="card-body">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="ativo_mostrp" id="ativo_mostrp" <?= ($ativo_mostrp == 't' ? 'checked' : '') ?>>
							<label class="form-check-label" for="ativo_mostrp">É Most Recommended Properties</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 13: Facilidades do Hotel Já Cadastradas -->
		<div class="accordion mb-4" id="accordionFacHotel">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFacHotel">
						Facilidades do Hotel Já Cadastradas
					</button>
				</h2>
				<div id="collapseFacHotel" class="accordion-collapse collapse" data-bs-parent="#accordionFacHotel">
					<div class="accordion-body">
						<div class="list-group list-group-flush">
							<?php
							$query_fachtl1 = "
                                SELECT ci_hotel_facilidade.tpofaccod, tpofacdsc
                                FROM conteudo_internet.ci_hotel_facilidade
                                INNER JOIN conteudo_internet.ci_tipo_facilidade ON ci_hotel_facilidade.tpofaccod = ci_tipo_facilidade.tpofaccod
                                WHERE tipo = 1 AND ativo = true AND mneu_for = '$frncod'
                                ORDER BY ci_hotel_facilidade.tpofaccod ASC
                            ";
							$result_fachtl1 = pg_exec($conn, $query_fachtl1);
							if ($result_fachtl1 && pg_numrows($result_fachtl1) > 0) {
								for ($rowfac1 = 0; $rowfac1 < pg_numrows($result_fachtl1); $rowfac1++) {
									$tpofaccod1 = pg_result($result_fachtl1, $rowfac1, 'tpofaccod');
									$tpofacdsc1 = pg_result($result_fachtl1, $rowfac1, 'tpofacdsc');
									echo '<div class="list-group-item d-flex justify-content-between align-items-center">
                                            ' . htmlspecialchars($tpofacdsc1) . '
                                            <a href="javascript:apaga_fac_htl(' . $tpofaccod1 . ');" class="btn btn-sm btn-outline-danger" title="Excluir">X</a>
                                          </div>';
								}
							} else {
								echo '<div class="list-group-item text-muted">Nenhuma facilidade cadastrada.</div>';
							}
							?>
						</div>
						<div class="row mt-3">
							<div class="col-12 text-center">
								<a href="javascript:apaga_fac_htl();" class="btn btn-outline-danger me-2">Exclusão de Facilidades do Hotel >></a>
								<a href="javascript:add_fac_htl();" class="btn btn-outline-success">Acrescentar Facilidades do Hotel >></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 14: Facilidades do Apartamento Já Cadastradas -->
		<div class="accordion mb-4" id="accordionFacApto">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFacApto">
						Facilidades do Apartamento Já Cadastradas
					</button>
				</h2>
				<div id="collapseFacApto" class="accordion-collapse collapse" data-bs-parent="#accordionFacApto">
					<div class="accordion-body">
						<div class="list-group list-group-flush">
							<?php
							$query_fachtl2 = "
                                SELECT ci_hotel_facilidade.tpofaccod, tpofacdsc
                                FROM conteudo_internet.ci_hotel_facilidade
                                INNER JOIN conteudo_internet.ci_tipo_facilidade ON ci_hotel_facilidade.tpofaccod = ci_tipo_facilidade.tpofaccod
                                WHERE tipo = 2 AND ativo = true AND mneu_for = '$frncod'
                                ORDER BY ci_hotel_facilidade.tpofaccod ASC
                            ";
							$result_fachtl2 = pg_exec($conn, $query_fachtl2);
							if ($result_fachtl2 && pg_numrows($result_fachtl2) > 0) {
								for ($rowfac2 = 0; $rowfac2 < pg_numrows($result_fachtl2); $rowfac2++) {
									$tpofaccod2 = pg_result($result_fachtl2, $rowfac2, 'tpofaccod');
									$tpofacdsc2 = pg_result($result_fachtl2, $rowfac2, 'tpofacdsc');
									echo '<div class="list-group-item d-flex justify-content-between align-items-center">
                                            ' . htmlspecialchars($tpofacdsc2) . '
                                            <a href="javascript:apaga_fac_apto(' . $tpofaccod2 . ');" class="btn btn-sm btn-outline-danger" title="Excluir">X</a>
                                          </div>';
								}
							} else {
								echo '<div class="list-group-item text-muted">Nenhuma facilidade cadastrada.</div>';
							}
							?>
						</div>
						<div class="row mt-3">
							<div class="col-12 text-center">
								<a href="javascript:apaga_fac_apto();" class="btn btn-outline-danger me-2">Exclusão de Facilidades do Apartamento >></a>
								<a href="javascript:add_fac_apto();" class="btn btn-outline-success">Acrescentar Facilidades do Apartamento >></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php if (isset($update_apto)): ?>
			<div class="row mb-4">
				<div class="col-12">
					<div class="alert alert-success">
						<h5>HOTEL ATUALIZADO COM SUCESSO!</h5>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<!-- Seção 15: Dados Adicionais e Novos Campos -->
		<div class="row mb-4">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h6>Dados Adicionais</h6>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">Número de Quartos/Capacidade (Ex: 220)</label>
							<input type="text" class="form-control" name="htl_num_quartos" id="htl_num_quartos" maxlength="10" value="<?= htmlspecialchars($htl_num_quartos) ?>">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4 g-3">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Slug</h6>
					</div>
					<div class="card-body">
						<input type="text" class="form-control" name="slug" id="slug" maxlength="255" value="<?= htmlspecialchars($slug) ?>">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Short Description PT</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="short_description_pt" id="short_description_pt" rows="2"><?= htmlspecialchars($short_description_pt) ?></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Short Description EN</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="short_description_en" id="short_description_en" rows="2"><?= htmlspecialchars($short_description_en) ?></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Short Description ES</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="short_description_es" id="short_description_es" rows="2"><?= htmlspecialchars($short_description_es) ?></textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4 g-3">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Insight PT</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="insight_pt" id="insight_pt" rows="3"><?= htmlspecialchars($insight_pt) ?></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Insight EN</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="insight_en" id="insight_en" rows="3"><?= htmlspecialchars($insight_en) ?></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Insight ES</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="insight_es" id="insight_es" rows="3"><?= htmlspecialchars($insight_es) ?></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h6>Price Range</h6>
					</div>
					<div class="card-body">
						<input type="text" class="form-control" name="price_range" id="price_range" maxlength="20" value="<?= htmlspecialchars($price_range) ?>">
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h6>Localização e Capacidade</h6>
					</div>
					<div class="card-body">
						<div class="row g-3">
							<div class="col-md-3">
								<label class="form-label">City Name</label>
								<input type="text" class="form-control" name="city_name" id="city_name" maxlength="255" value="<?= htmlspecialchars($city_name) ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label">State</label>
								<input type="text" class="form-control" name="state" id="state" maxlength="50" value="<?= htmlspecialchars($state) ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label">Country</label>
								<input type="text" class="form-control" name="country" id="country" maxlength="50" value="<?= htmlspecialchars($country) ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label">Capacity Min</label>
								<input type="number" class="form-control" name="capacity_min" id="capacity_min" value="<?= htmlspecialchars($capacity_min) ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label">Capacity Max</label>
								<input type="number" class="form-control" name="capacity_max" id="capacity_max" value="<?= htmlspecialchars($capacity_max) ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label">Rating (0-5)</label>
								<input type="number" class="form-control" name="rating" id="rating" step="0.1" min="0" max="5" value="<?= htmlspecialchars($rating) ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label">Rating Count</label>
								<input type="number" class="form-control" name="rating_count" id="rating_count" value="<?= htmlspecialchars($rating_count) ?>">
							</div>
							<div class="col-md-3">
								<label class="form-label">Has Convention Center</label>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="has_convention_center" id="has_convention_center" <?= ($has_convention_center == 't' ? 'checked' : '') ?> value="true">
									<label class="form-check-label">Sim</label>
								</div>
							</div>
						</div>
						<div class="row g-3 mt-3">
							<div class="col-md-4">
								<label class="form-label">Meeting Rooms Count</label>
								<input type="number" class="form-control" name="meeting_rooms_count" id="meeting_rooms_count" value="<?= htmlspecialchars($meeting_rooms_count) ?>">
							</div>
							<div class="col-md-8">
								<label class="form-label">Meeting Rooms Detail</label>
								<textarea class="form-control" name="meeting_rooms_detail" id="meeting_rooms_detail" rows="3"><?= htmlspecialchars($meeting_rooms_detail) ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h6>Experiências Culinárias</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="dining_experiences" id="dining_experiences" rows="3"><?= htmlspecialchars($dining_experiences) ?></textarea>
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<div class="col-12 text-center">
				<input type="button" class="btn btn-primary btn-lg me-2" name="Go" value="Alterar" onclick="javascript:update_hotel();">
				<button type="button" class="btn btn-secondary btn-lg me-2" id="saveDraft">Salvar Rascunho</button>
				<button type="button" class="btn btn-info btn-lg" id="loadDraft">Carregar Rascunho</button>
			</div>
		</div>
	</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
	// Função para serializar o form
	function getFormData() {
		return $('#hotelEditForm').serialize();
	}

	// Salvar rascunho no localStorage (específico para este hotel)
	$('#saveDraft').click(function() {
		const formData = $('#hotelEditForm').serialize();
		const hotelKey = 'hotelDraft_' + <?= json_encode($mneu_for) ?>;
		localStorage.setItem(hotelKey, formData);
		alert('Rascunho salvo com sucesso!');
	});

	// Carregar rascunho do localStorage
	$('#loadDraft').click(function() {
		const hotelKey = 'hotelDraft_' + <?= json_encode($mneu_for) ?>;
		const savedData = localStorage.getItem(hotelKey);
		if (savedData) {
			$('#hotelEditForm')[0].reset();
			const pairs = savedData.split('&');
			const checkboxValues = {};

			pairs.forEach(function(pair) {
				const [name, value] = pair.split('=');
				const decodedName = decodeURIComponent(name.replace(/%5B%5D/g, '[]'));
				const decodedValue = decodeURIComponent(value || '');

				if (decodedName.endsWith('[]') && $('[name="' + decodedName + '"]').is(':checkbox')) {
					const baseName = decodedName.replace('[]', '');
					if (!checkboxValues[baseName]) checkboxValues[baseName] = [];
					checkboxValues[baseName].push(decodedValue);
				} else {
					const $elements = $('[name="' + decodedName + '"]');
					if ($elements.length === 0) return;

					if ($elements.is(':checkbox')) {
						const isChecked = (decodedValue === 'on' || $elements.val() === decodedValue);
						$elements.prop('checked', isChecked);
					} else if ($elements.is('select')) {
						$elements.val(decodedValue);
					} else {
						$elements.val(decodedValue);
					}
				}
			});

			Object.keys(checkboxValues).forEach(function(baseName) {
				const values = checkboxValues[baseName];
				values.forEach(function(val) {
					$('[name="' + baseName + '[]"][value="' + val + '"]').prop('checked', true);
				});
			});

			$('#hotelEditForm select, #hotelEditForm textarea').trigger('change');
			alert('Rascunho carregado com sucesso!');
		} else {
			alert('Nenhum rascunho encontrado para este hotel.');
		}
	});

	// Auto-save a cada 5 minutos
	setInterval(function() {
		const formData = $('#hotelEditForm').serialize();
		const hotelKey = 'hotelDraft_' + <?= json_encode($mneu_for) ?>;
		localStorage.setItem(hotelKey, formData);
	}, 300000);
</script>
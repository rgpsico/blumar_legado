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

// Verifica se o valor é numérico e não vazio
if (empty($frncod) || !is_numeric($frncod)) {
	echo '<div class="alert alert-warning">Código do hotel inválido ou não informado.</div>';
	exit;
}

$query_htl = "
    SELECT *
    FROM conteudo_internet.ci_hotel
    WHERE frncod = $1
";

$result_htl = pg_query_params($conn, $query_htl, [$frncod]);

if (!$result_htl || pg_num_rows($result_htl) === 0) {
	echo '<div class="alert alert-info">Hotel não encontrado.</div>';
	exit;
}

// Se chegou aqui, pode exibir o formulário
$hotel = pg_fetch_assoc($result_htl);


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

<style>
	.wizard-container {
		max-width: 1200px;
		margin: 0 auto;
	}

	.wizard-steps {
		display: flex;
		justify-content: space-between;
		margin-bottom: 30px;
		position: relative;
		padding: 0 20px;
	}

	.wizard-steps::before {
		content: '';
		position: absolute;
		top: 20px;
		left: 0;
		right: 0;
		height: 2px;
		background: #e0e0e0;
		z-index: 0;
	}

	.wizard-step {
		position: relative;
		text-align: center;
		flex: 1;
		z-index: 1;
		cursor: pointer;
	}

	.wizard-step-circle {
		width: 40px;
		height: 40px;
		border-radius: 50%;
		background: #e0e0e0;
		color: #666;
		display: flex;
		align-items: center;
		justify-content: center;
		margin: 0 auto 8px;
		font-weight: bold;
		transition: all 0.3s;
		border: 3px solid #fff;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	}

	.wizard-step.active .wizard-step-circle {
		background: #0d6efd;
		color: white;
	}

	.wizard-step.completed .wizard-step-circle {
		background: #198754;
		color: white;
	}

	.wizard-step-label {
		font-size: 12px;
		color: #666;
		font-weight: 500;
	}

	.wizard-step.active .wizard-step-label {
		color: #0d6efd;
		font-weight: 600;
	}

	.wizard-content {
		background: white;
		border-radius: 8px;
		padding: 30px;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
		min-height: 400px;
	}

	.step-content {
		display: none;
	}

	.step-content.active {
		display: block;
		animation: fadeIn 0.3s;
	}

	@keyframes fadeIn {
		from {
			opacity: 0;
			transform: translateY(10px);
		}

		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	.wizard-actions {
		display: flex;
		justify-content: space-between;
		margin-top: 30px;
		padding-top: 20px;
		border-top: 1px solid #e0e0e0;
	}

	.progress-bar-container {
		height: 6px;
		background: #e0e0e0;
		border-radius: 3px;
		margin-bottom: 30px;
		overflow: hidden;
	}

	.progress-bar-fill {
		height: 100%;
		background: linear-gradient(90deg, #0d6efd, #0dcaf0);
		transition: width 0.3s ease;
		border-radius: 3px;
	}

	.form-section-title {
		font-size: 20px;
		font-weight: 600;
		color: #333;
		margin-bottom: 20px;
		padding-bottom: 10px;
		border-bottom: 2px solid #0d6efd;
	}

	.language-tabs {
		display: flex;
		gap: 10px;
		margin-bottom: 15px;
	}

	.language-tab {
		padding: 8px 16px;
		border: 1px solid #dee2e6;
		border-radius: 6px;
		background: white;
		cursor: pointer;
		transition: all 0.3s;
		font-size: 14px;
	}

	.language-tab.active {
		background: #0d6efd;
		color: white;
		border-color: #0d6efd;
	}

	.language-content {
		display: none;
	}

	.language-content.active {
		display: block;
	}

	.draft-buttons {
		display: flex;
		gap: 10px;
		margin-bottom: 20px;
	}

	.hotel-info-header {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		padding: 20px;
		border-radius: 8px;
		margin-bottom: 30px;
	}
</style>

<div class="container-fluid py-4">
	<div class="wizard-container">
		<!-- Header do Hotel -->
		<div class="hotel-info-header">
			<h2 class="mb-2"><?= htmlspecialchars($nome_htl) ?></h2>
			<p class="mb-0"><?= htmlspecialchars($nome_for . ' - ' . $mneu_for) ?></p>
			<small><?= $msg_update ?></small>
			<div class="mt-2">
				<a href="https://www.blumar.com.br/client_area/rates/new_pop_hotel.php?cod_hotel=<?= htmlspecialchars($mneu_for) ?>&lang=2&hotel=<?= urlencode($nome_for) ?>" target="_blank" class="btn btn-sm btn-light">Ver Página</a>
			</div>
		</div>

		<!-- Botões de Rascunho -->
		<div class="draft-buttons">
			<button type="button" class="btn btn-outline-secondary" id="saveDraft">
				<i class="bi bi-save"></i> Salvar Rascunho
			</button>
			<button type="button" class="btn btn-outline-info" id="loadDraft">
				<i class="bi bi-upload"></i> Carregar Rascunho
			</button>
		</div>

		<!-- Barra de Progresso -->
		<div class="progress-bar-container">
			<div class="progress-bar-fill" id="progressBar" style="width: 9%"></div>
		</div>

		<!-- Indicador de Passos -->
		<div class="wizard-steps">
			<div class="wizard-step active" data-step="1">
				<div class="wizard-step-circle">1</div>
				<div class="wizard-step-label">Descrições</div>
			</div>
			<div class="wizard-step" data-step="2">
				<div class="wizard-step-circle">2</div>
				<div class="wizard-step-label">Resort</div>
			</div>
			<div class="wizard-step" data-step="3">
				<div class="wizard-step-circle">3</div>
				<div class="wizard-step-label">Fotos</div>
			</div>
			<div class="wizard-step" data-step="4">
				<div class="wizard-step-circle">4</div>
				<div class="wizard-step-label">Apartamentos</div>
			</div>
			<div class="wizard-step" data-step="5">
				<div class="wizard-step-circle">5</div>
				<div class="wizard-step-label">Mídia</div>
			</div>
			<div class="wizard-step" data-step="6">
				<div class="wizard-step-circle">6</div>
				<div class="wizard-step-label">COVID-19</div>
			</div>
			<div class="wizard-step" data-step="7">
				<div class="wizard-step-circle">7</div>
				<div class="wizard-step-label">Observações</div>
			</div>
			<div class="wizard-step" data-step="8">
				<div class="wizard-step-circle">8</div>
				<div class="wizard-step-label">Marcações</div>
			</div>
			<div class="wizard-step" data-step="9">
				<div class="wizard-step-circle">9</div>
				<div class="wizard-step-label">Classificações</div>
			</div>
			<div class="wizard-step" data-step="10">
				<div class="wizard-step-circle">10</div>
				<div class="wizard-step-label">Facilidades</div>
			</div>
			<div class="wizard-step" data-step="11">
				<div class="wizard-step-circle">11</div>
				<div class="wizard-step-label">Extras</div>
			</div>
		</div>

		<form id="hotelEditForm">
			<input type="hidden" name="mneu_for" id="mneu_for" value="<?= htmlspecialchars($mneu_for) ?>">
			<input type="hidden" name="frncod" id="frncod" value="<?= htmlspecialchars($frncod) ?>">

			<div class="wizard-content">
				<!-- Passo 1: Descrições -->
				<div class="step-content active" data-step="1">
					<h3 class="form-section-title">Descrições do Hotel</h3>
					<div class="row g-3">
						<div class="col-md-12">
							<label class="form-label fw-bold">Português</label>
							<textarea class="form-control" name="htldsc" id="htldsc" rows="4"><?= htmlspecialchars($htldsc) ?></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label fw-bold">Inglês</label>
							<textarea class="form-control" name="htldscing" id="htldscing" rows="4"><?= htmlspecialchars($htldscing) ?></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label fw-bold">Espanhol (FIT e GRP)</label>
							<textarea class="form-control" name="htldscesp" id="htldscesp" rows="4"><?= htmlspecialchars($htldscesp) ?></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label fw-bold">Espanhol (GRP)</label>
							<textarea class="form-control" name="descesp_grpfit" id="descesp_grpfit" rows="4"><?= htmlspecialchars($descesp_grpfit) ?></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label fw-bold">Chamada Destaque (Site Nacional) <small class="text-muted">Máx. 200 caracteres</small></label>
							<textarea class="form-control" name="hotel_cham" id="hotel_cham" rows="3"><?= htmlspecialchars($hotel_cham) ?></textarea>
						</div>
					</div>
				</div>

				<!-- Passo 2: Conteúdo para Resorts -->
				<div class="step-content" data-step="2">
					<h3 class="form-section-title">Conteúdo para Resorts</h3>
					<div class="row g-4">
						<?php
						$resort_fields = [
							['name' => 'regime_hotel', 'label' => 'Régimen de Comidas', 'pt' => 'regime_hotel_pt', 'en' => 'regime_hotel_en', 'es' => 'regime_hotel'],
							['name' => 'rec_entret', 'label' => 'Recreación & Entretenimiento', 'pt' => 'rec_entret_pt', 'en' => 'rec_entret_en', 'es' => 'rec_entret'],
							['name' => 'otras_ativ', 'label' => 'Otras Actividades', 'pt' => 'otras_ativ_pt', 'en' => 'otras_ativ_en', 'es' => 'otras_ativ'],
							['name' => 'alojamiento', 'label' => 'Alojamiento', 'pt' => 'alojamiento_pt', 'en' => 'alojamiento_en', 'es' => 'alojamiento'],
							['name' => 'gastronomia', 'label' => 'Gastronomia', 'pt' => 'gastronomia_pt', 'en' => 'gastronomia_en', 'es' => 'gastronomia'],
							['name' => 'servicios', 'label' => 'Servicios', 'pt' => 'servicios_pt', 'en' => 'servicios_en', 'es' => 'servicios'],
							['name' => 'convenciones', 'label' => 'Convenciones', 'pt' => 'convenciones_pt', 'en' => 'convenciones_en', 'es' => 'convenciones'],
							['name' => 'campo_extra', 'label' => 'Servicios Adicionales', 'pt' => 'campo_extra_pt', 'en' => 'campo_extra_en', 'es' => 'campo_extra'],
						];

						foreach ($resort_fields as $field):
							// Obter os valores das variáveis corretamente usando variáveis variáveis
							$value_pt = ${$field['pt']};
							$value_en = ${$field['en']};
							$value_es = ${$field['es']};
						?>
							<div class="col-md-6">
								<div class="card">
									<div class="card-header">
										<h6 class="mb-0"><?= htmlspecialchars($field['label']) ?></h6>
									</div>
									<div class="card-body">
										<div class="language-tabs">
											<button type="button" class="language-tab active" data-lang="pt" data-group="<?= htmlspecialchars($field['name']) ?>">PT</button>
											<button type="button" class="language-tab" data-lang="en" data-group="<?= htmlspecialchars($field['name']) ?>">EN</button>
											<button type="button" class="language-tab" data-lang="es" data-group="<?= htmlspecialchars($field['name']) ?>">ES</button>
										</div>
										<div class="language-content active" data-lang="pt" data-group="<?= htmlspecialchars($field['name']) ?>">
											<textarea class="form-control" name="<?= htmlspecialchars($field['pt']) ?>" rows="4"><?= htmlspecialchars($value_pt) ?></textarea>
										</div>
										<div class="language-content" data-lang="en" data-group="<?= htmlspecialchars($field['name']) ?>">
											<textarea class="form-control" name="<?= htmlspecialchars($field['en']) ?>" rows="4"><?= htmlspecialchars($value_en) ?></textarea>
										</div>
										<div class="language-content" data-lang="es" data-group="<?= htmlspecialchars($field['name']) ?>">
											<textarea class="form-control" name="<?= htmlspecialchars($field['es']) ?>" rows="4"><?= htmlspecialchars($value_es) ?></textarea>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
						<div class="col-md-12">
							<label class="form-label fw-bold">Conteúdo Complementar Ecológico</label>
							<textarea class="form-control" name="complemento" id="complemento" rows="4"><?= htmlspecialchars($complemento) ?></textarea>
						</div>
					</div>
				</div>

				<!-- Passo 3: Fotos e Galeria -->
				<div class="step-content" data-step="3">
					<h3 class="form-section-title">Fotos e Galeria</h3>
					<div class="row g-3">
						<div class="col-md-6">
							<label class="form-label">Fachada</label>
							<input type="text" class="form-control" name="htlimgfotofachada" maxlength="150" value="<?= htmlspecialchars($htlimgfotofachada) ?>">
						</div>
						<div class="col-md-6">
							<label class="form-label">Fachada TBN</label>
							<input type="text" class="form-control" name="fotofachada_tbn" maxlength="150" value="<?= htmlspecialchars($fotofachada_tbn) ?>">
						</div>
						<div class="col-md-6">
							<label class="form-label">Piscina</label>
							<input type="text" class="form-control" name="htlfotopiscina" maxlength="150" value="<?= htmlspecialchars($htlfotopiscina) ?>">
						</div>
						<div class="col-md-6">
							<label class="form-label">Foto Extra 1</label>
							<input type="text" class="form-control" name="fotoextra" maxlength="150" value="<?= htmlspecialchars($fotoextra) ?>">
						</div>
						<div class="col-md-6">
							<label class="form-label">Foto Extra 2 (Recepção)</label>
							<input type="text" class="form-control" name="fotoextra_recep" maxlength="150" value="<?= htmlspecialchars($fotoextra_recep) ?>">
						</div>
						<div class="col-md-6">
							<label class="form-label">Foto Extra 3</label>
							<input type="text" class="form-control" name="ft_resort1" maxlength="150" value="<?= htmlspecialchars($ft_resort1) ?>">
						</div>
						<div class="col-md-6">
							<label class="form-label">Foto Extra 4</label>
							<input type="text" class="form-control" name="ft_resort2" maxlength="150" value="<?= htmlspecialchars($ft_resort2) ?>">
						</div>
						<div class="col-md-6">
							<label class="form-label">Foto Extra 5</label>
							<input type="text" class="form-control" name="ft_resort3" maxlength="150" value="<?= htmlspecialchars($ft_resort3) ?>">
						</div>
						<div class="col-md-12">
							<label class="form-label">Imagens da Galeria <small class="text-muted">(URLs separadas por vírgula)</small></label>
							<textarea class="form-control" name="gallery_images" rows="3"><?= htmlspecialchars($gallery_images) ?></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label">Imagem da Planta Baixa</label>
							<input type="text" class="form-control" name="blueprint_image" maxlength="255" value="<?= htmlspecialchars($blueprint_image) ?>">
						</div>
					</div>
				</div>

				<!-- Passo 4: Apartamentos -->
				<div class="step-content" data-step="4">
					<h3 class="form-section-title">Apartamentos Cadastrados</h3>
					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Categoria</th>
									<th>Localização</th>
									<th>Qtd.</th>
									<th>Foto</th>
								</tr>
							</thead>
							<tbody>
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
										<tr>
											<td><?= htmlspecialchars($catdscing) ?></td>
											<td><?= htmlspecialchars($aptolocdscing) ?></td>
											<td><?= htmlspecialchars($aptqtd) ?></td>
											<td><small><?= htmlspecialchars($aptoimgfoto) ?></small></td>
										</tr>
								<?php
									}
								} else {
									echo '<tr><td colspan="4" class="text-center text-muted">Nenhum apartamento cadastrado</td></tr>';
								}
								?>
							</tbody>
						</table>
					</div>
					<div class="text-center mt-3">
						<a href="#" class="btn btn-outline-primary me-2" onclick="javascript:altera_apto();">Alterar Apartamentos</a>
						<a href="javascript:apaga_apto();" class="btn btn-outline-danger me-2">Excluir Apartamentos</a>
						<a href="javascript:add_apto();" class="btn btn-success">Adicionar Apartamentos</a>
					</div>
				</div>

				<!-- Passo 5: Mapas e Vídeos -->
				<div class="step-content" data-step="5">
					<h3 class="form-section-title">Mídia e Localização</h3>
					<div class="row g-4">
						<div class="col-md-6">
							<div class="card h-100">
								<div class="card-header bg-primary text-white">
									<h6 class="mb-0">Mapas</h6>
								</div>
								<div class="card-body">
									<div class="mb-3">
										<label class="form-label">Mapa Google</label>
										<textarea class="form-control" name="htlurl" rows="3"><?= htmlspecialchars($htlurl) ?></textarea>
									</div>
									<div class="mb-3">
										<label class="form-label">Imagem do Mapa</label>
										<input type="text" class="form-control" name="htlimgmapa" maxlength="150" value="<?= htmlspecialchars($htlimgmapa) ?>">
									</div>
									<div class="mb-3">
										<label class="form-label">Mapa Ecológico</label>
										<input type="text" class="form-control" name="map_eco" maxlength="150" value="<?= htmlspecialchars($map_eco) ?>">
									</div>
									<div class="mb-3">
										<label class="form-label">URL do Iframe do Mapa</label>
										<input type="text" class="form-control" name="map_iframe_url" maxlength="500" value="<?= htmlspecialchars($map_iframe_url) ?>">
									</div>
									<div class="row">
										<div class="col-6">
											<label class="form-label">Latitude</label>
											<input type="number" class="form-control" name="latitude" step="0.000001" value="<?= htmlspecialchars($latitude) ?>">
										</div>
										<div class="col-6">
											<label class="form-label">Longitude</label>
											<input type="number" class="form-control" name="longitude" step="0.000001" value="<?= htmlspecialchars($longitude) ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card h-100">
								<div class="card-header bg-info text-white">
									<h6 class="mb-0">Vídeos e 360°</h6>
								</div>
								<div class="card-body">
									<div class="mb-3">
										<label class="form-label">Endereço Foto 360</label>
										<input type="text" class="form-control" name="url_htl_360" maxlength="150" value="<?= htmlspecialchars($url_htl_360) ?>">
									</div>
									<div class="mb-3">
										<label class="form-label">Arquivo Foto 360</label>
										<input type="text" class="form-control" name="arq_htl_360" maxlength="150" value="<?= htmlspecialchars($arq_htl_360) ?>">
									</div>
									<div class="mb-3">
										<label class="form-label">Endereço Vídeo</label>
										<input type="text" class="form-control" name="url_video" maxlength="150" value="<?= htmlspecialchars($url_video) ?>">
									</div>
									<div class="mb-3">
										<label class="form-label">Arquivo do Vídeo</label>
										<input type="text" class="form-control" name="arq_video" maxlength="150" value="<?= htmlspecialchars($arq_video) ?>">
									</div>
									<div class="mb-3">
										<label class="form-label">Tour Virtual sem Flash</label>
										<input type="text" class="form-control" name="virtual_tour" maxlength="150" value="<?= htmlspecialchars($virtual_tour) ?>">
									</div>
									<div class="mb-3">
										<label class="form-label">URL 360 das Salas</label>
										<input type="text" class="form-control" name="url_360_halls" maxlength="255" value="<?= htmlspecialchars($url_360_halls) ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Passo 6: COVID-19 -->
				<div class="step-content" data-step="6">
					<h3 class="form-section-title">Documentos COVID-19</h3>
					<div class="row g-4">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Arquivo em PDF - Português</h6>
								</div>
								<div class="card-body">
									<div id="del_covid19pt">
										<?php if (!empty($covid_19_pt)): ?>
											<input type="text" class="form-control mb-2" name="covid_19_pt" maxlength="150" value="<?= htmlspecialchars($covid_19_pt) ?>">
											<a href="#" onclick="javascript: del_covid19pt();" class="btn btn-sm btn-danger">Excluir</a>
										<?php else: ?>
											<p class="text-muted">Nenhum arquivo inserido</p>
										<?php endif; ?>
									</div>
									<label class="form-label mt-3">Inserir novo arquivo PDF</label>
									<iframe src="hotel/mioloiframe1.php" height="140" width="100%" frameborder="0"></iframe>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Arquivo em PDF - Inglês</h6>
								</div>
								<div class="card-body">
									<div id="del_covid19en">
										<?php if (!empty($covid_19_en)): ?>
											<input type="text" class="form-control mb-2" name="covid_19_en" maxlength="150" value="<?= htmlspecialchars($covid_19_en) ?>">
											<a href="#" onclick="javascript: del_covid19en();" class="btn btn-sm btn-danger">Excluir</a>
										<?php else: ?>
											<p class="text-muted">Nenhum arquivo inserido</p>
										<?php endif; ?>
									</div>
									<label class="form-label mt-3">Inserir novo arquivo PDF</label>
									<iframe src="hotel/mioloiframe2.php" height="140" width="100%" frameborder="0"></iframe>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<label class="form-label">URL Procedimento PT</label>
							<input type="text" class="form-control" name="covid_19_pt_url" maxlength="250" value="<?= htmlspecialchars($covid_19_pt_url) ?>">
						</div>
						<div class="col-md-6">
							<label class="form-label">URL Procedimento EN</label>
							<input type="text" class="form-control" name="covid_19_en_url" maxlength="250" value="<?= htmlspecialchars($covid_19_en_url) ?>">
						</div>
					</div>
				</div>

				<!-- Passo 7: Observações -->
				<div class="step-content" data-step="7">
					<h3 class="form-section-title">Observações</h3>
					<div class="row g-3">
						<div class="col-md-12">
							<label class="form-label fw-bold">Em Inglês</label>
							<textarea class="form-control" name="htlobsing" rows="8"><?= htmlspecialchars($htlobsing) ?></textarea>
						</div>
						<div class="col-md-6">
							<label class="form-label fw-bold">Em Português</label>
							<textarea class="form-control" name="htlobs" rows="5"><?= htmlspecialchars($htlobs) ?></textarea>
						</div>
						<div class="col-md-6">
							<label class="form-label fw-bold">Em Espanhol (Blumar Opina)</label>
							<textarea class="form-control" name="htlobsesp" rows="5"><?= htmlspecialchars($htlobsesp) ?></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label fw-bold">Histórico de Alterações de Templates</label>
							<textarea class="form-control" name="historico_temp" rows="4"><?= htmlspecialchars($historico_temp) ?></textarea>
						</div>
					</div>
				</div>

				<!-- Passo 8: Marcações -->
				<div class="step-content" data-step="8">
					<h3 class="form-section-title">Marcações e Flags</h3>
					<div class="row g-4">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Marcações Gerais</h6>
								</div>
								<div class="card-body">
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="flaghtl" id="flaghtl" <?= ($flaghtl == 't' ? 'checked' : '') ?>>
										<label class="form-check-label" for="flaghtl">Ativo na Internet Blumar</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="flaglatino" id="flaglatino" <?= ($flaglatino == 't' ? 'checked' : '') ?>>
										<label class="form-check-label" for="flaglatino">Não aparecer Template no Tarifário Latino</label>
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
										<label class="form-check-label" for="ativo_bnuts">Ativo site Bnuts</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Destaques Tarifário FIT (Máx. 3)</h6>
								</div>
								<div class="card-body">
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
								</div>
							</div>
							<div class="card mt-3">
								<div class="card-header">
									<h6 class="mb-0">Site Nacional</h6>
								</div>
								<div class="card-body">
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

				<!-- Passo 9: Classificações e Estilos -->
				<div class="step-content" data-step="9">
					<h3 class="form-section-title">Classificações e Estilos</h3>
					<div class="row g-4">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Classificação de Estrelas Blumar</h6>
								</div>
								<div class="card-body">
									<input type="text" class="form-control" name="htlestrelablumar" maxlength="1" value="<?= htmlspecialchars($htlestrelablumar) ?>">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Classificação Ecológico</h6>
								</div>
								<div class="card-body">
									<select class="form-select" name="classif_eco">
										<option value="0" <?= ($classif_eco == '0' ? 'selected' : '') ?>>None</option>
										<option value="1" <?= ($classif_eco == '1' ? 'selected' : '') ?>>Very Rustic</option>
										<option value="2" <?= ($classif_eco == '2' ? 'selected' : '') ?>>Basic</option>
										<option value="3" <?= ($classif_eco == '3' ? 'selected' : '') ?>>Superior</option>
										<option value="4" <?= ($classif_eco == '4' ? 'selected' : '') ?>>Friendly</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Estilos do Hotel</h6>
								</div>
								<div class="card-body">
									<div class="mb-3">
										<select class="form-select" name="estilo" id="estilo" onchange="javascript:insere_estilo_htl();">
											<option value="0">Selecione um estilo</option>
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
									<div id="estilos_do_htl" class="list-group">
										<?php
										$pega_estilos = "SELECT cod_estilo, pk_estilo_htl FROM conteudo_internet.ci_hotel_estilo WHERE mneu_for = '$mneu_for'";
										$result_tour = pg_exec($conn, $pega_estilos);
										if ($result_tour && pg_numrows($result_tour) > 0) {
											for ($rowcid = 0; $rowcid < pg_numrows($result_tour); $rowcid++) {
												$cod_estilo = pg_result($result_tour, $rowcid, 'cod_estilo');
												$pk_estilo = pg_result($result_tour, $rowcid, 'pk_estilo_htl');
												$estilos = ['', 'Ecologico', 'Familia', 'Praia', 'Resort', 'Lua de mel', 'Safari', 'Cruzeiros', 'Tudo incluido', 'Gastronomia', 'Aventura', 'Cultural'];
												$estilo_text = $estilos[$cod_estilo] ?? '';
												echo '<div class="list-group-item d-flex justify-content-between align-items-center">
													<span>' . htmlspecialchars($estilo_text) . '</span>
													<a href="#" class="pkestilohtl btn btn-sm btn-danger">
														<input type="hidden" class="pkestilohtlvalue" value="' . $pk_estilo . '">X
													</a>
												</div>';
											}
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Most Recommended (Inglês)</h6>
								</div>
								<div class="card-body">
									<textarea class="form-control" name="desc_mostrp_ing" rows="4"><?= htmlspecialchars($desc_mostrp_ing) ?></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Flag</h6>
								</div>
								<div class="card-body">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" name="ativo_mostrp" id="ativo_mostrp" <?= ($ativo_mostrp == 't' ? 'checked' : '') ?>>
										<label class="form-check-label" for="ativo_mostrp">É Most Recommended</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Passo 10: Facilidades -->
				<div class="step-content" data-step="10">
					<h3 class="form-section-title">Facilidades do Hotel e Apartamento</h3>
					<div class="row g-4">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-success text-white">
									<h6 class="mb-0">Facilidades do Hotel</h6>
								</div>
								<div class="card-body">
									<div class="list-group list-group-flush mb-3">
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
													<span>' . htmlspecialchars($tpofacdsc1) . '</span>
													<a href="javascript:apaga_fac_htl(' . $tpofaccod1 . ');" class="btn btn-sm btn-danger">X</a>
												</div>';
											}
										} else {
											echo '<div class="list-group-item text-muted">Nenhuma facilidade cadastrada</div>';
										}
										?>
									</div>
									<div class="d-grid gap-2">
										<a href="javascript:add_fac_htl();" class="btn btn-success">Adicionar Facilidades</a>
										<a href="javascript:apaga_fac_htl();" class="btn btn-outline-danger">Excluir Facilidades</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card">
								<div class="card-header bg-info text-white">
									<h6 class="mb-0">Facilidades do Apartamento</h6>
								</div>
								<div class="card-body">
									<div class="list-group list-group-flush mb-3">
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
													<span>' . htmlspecialchars($tpofacdsc2) . '</span>
													<a href="javascript:apaga_fac_apto(' . $tpofaccod2 . ');" class="btn btn-sm btn-danger">X</a>
												</div>';
											}
										} else {
											echo '<div class="list-group-item text-muted">Nenhuma facilidade cadastrada</div>';
										}
										?>
									</div>
									<div class="d-grid gap-2">
										<a href="javascript:add_fac_apto();" class="btn btn-info">Adicionar Facilidades</a>
										<a href="javascript:apaga_fac_apto();" class="btn btn-outline-danger">Excluir Facilidades</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Passo 11: Dados Extras -->
				<div class="step-content" data-step="11">
					<h3 class="form-section-title">Dados Adicionais</h3>
					<div class="row g-3">
						<div class="col-md-4">
							<label class="form-label">Número de Quartos</label>
							<input type="text" class="form-control" name="htl_num_quartos" maxlength="10" value="<?= htmlspecialchars($htl_num_quartos) ?>">
						</div>
						<div class="col-md-4">
							<label class="form-label">Slug</label>
							<input type="text" class="form-control" name="slug" maxlength="255" value="<?= htmlspecialchars($slug) ?>">
						</div>
						<div class="col-md-4">
							<label class="form-label">Price Range</label>
							<input type="text" class="form-control" name="price_range" maxlength="20" value="<?= htmlspecialchars($price_range) ?>">
						</div>
						<div class="col-md-4">
							<label class="form-label">Short Description PT</label>
							<textarea class="form-control" name="short_description_pt" rows="3"><?= htmlspecialchars($short_description_pt) ?></textarea>
						</div>
						<div class="col-md-4">
							<label class="form-label">Short Description EN</label>
							<textarea class="form-control" name="short_description_en" rows="3"><?= htmlspecialchars($short_description_en) ?></textarea>
						</div>
						<div class="col-md-4">
							<label class="form-label">Short Description ES</label>
							<textarea class="form-control" name="short_description_es" rows="3"><?= htmlspecialchars($short_description_es) ?></textarea>
						</div>
						<div class="col-md-4">
							<label class="form-label">Insight PT</label>
							<textarea class="form-control" name="insight_pt" rows="3"><?= htmlspecialchars($insight_pt) ?></textarea>
						</div>
						<div class="col-md-4">
							<label class="form-label">Insight EN</label>
							<textarea class="form-control" name="insight_en" rows="3"><?= htmlspecialchars($insight_en) ?></textarea>
						</div>
						<div class="col-md-4">
							<label class="form-label">Insight ES</label>
							<textarea class="form-control" name="insight_es" rows="3"><?= htmlspecialchars($insight_es) ?></textarea>
						</div>
						<div class="col-md-3">
							<label class="form-label">City Name</label>
							<input type="text" class="form-control" name="city_name" maxlength="255" value="<?= htmlspecialchars($city_name) ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">State</label>
							<input type="text" class="form-control" name="state" maxlength="50" value="<?= htmlspecialchars($state) ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Country</label>
							<input type="text" class="form-control" name="country" maxlength="50" value="<?= htmlspecialchars($country) ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Rating (0-5)</label>
							<input type="number" class="form-control" name="rating" step="0.1" min="0" max="5" value="<?= htmlspecialchars($rating) ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Rating Count</label>
							<input type="number" class="form-control" name="rating_count" value="<?= htmlspecialchars($rating_count) ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Capacity Min</label>
							<input type="number" class="form-control" name="capacity_min" value="<?= htmlspecialchars($capacity_min) ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Capacity Max</label>
							<input type="number" class="form-control" name="capacity_max" value="<?= htmlspecialchars($capacity_max) ?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Meeting Rooms Count</label>
							<input type="number" class="form-control" name="meeting_rooms_count" value="<?= htmlspecialchars($meeting_rooms_count) ?>">
						</div>
						<div class="col-md-12">
							<label class="form-label">Meeting Rooms Detail</label>
							<textarea class="form-control" name="meeting_rooms_detail" rows="3"><?= htmlspecialchars($meeting_rooms_detail) ?></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label">Dining Experiences</label>
							<textarea class="form-control" name="dining_experiences" rows="3"><?= htmlspecialchars($dining_experiences) ?></textarea>
						</div>
						<div class="col-md-4">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="has_convention_center" id="has_convention_center" <?= ($has_convention_center == 't' ? 'checked' : '') ?>>
								<label class="form-check-label" for="has_convention_center">
									Has Convention Center
								</label>
							</div>
						</div>
					</div>
				</div>

				<!-- Navegação do Wizard -->
				<div class="wizard-actions">
					<button type="button" class="btn btn-secondary" id="prevBtn">
						← Anterior
					</button>
					<div>
						<button type="button" class="btn btn-outline-primary me-2" id="saveBtn" onclick="javascript:update_hotel();">
							💾 Salvar Alterações
						</button>
						<button type="button" class="btn btn-primary" id="nextBtn">
							Próximo →
						</button>
					</div>
				</div>
			</div>
		</form>

		<?php if (isset($update_apto)): ?>
			<div class="alert alert-success mt-4">
				<h5>✓ HOTEL ATUALIZADO COM SUCESSO!</h5>
			</div>
		<?php endif; ?>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
	(function() {
		// Encapsular tudo em uma função auto-executável para evitar conflitos
		'use strict';

		// Wizard State
		var currentStep = 1;
		var totalSteps = 11;

		// Limpar eventos anteriores se existirem
		$('#hotelEditForm').off();
		$('.wizard-step').off();
		$('#nextBtn').off();
		$('#prevBtn').off();
		$('#saveDraft').off();
		$('#loadDraft').off();
		$('.language-tab').off();

		// Inicialização
		$(document).ready(function() {
			updateWizard();

			// Language tabs
			$('.language-tab').on('click', function() {
				var lang = $(this).data('lang');
				var group = $(this).data('group');

				$('.language-tab[data-group="' + group + '"]').removeClass('active');
				$(this).addClass('active');

				$('.language-content[data-group="' + group + '"]').removeClass('active');
				$('.language-content[data-lang="' + lang + '"][data-group="' + group + '"]').addClass('active');
			});

			// Navigation
			$('#nextBtn').on('click', function() {
				if (currentStep < totalSteps) {
					currentStep++;
					updateWizard();
				}
			});

			$('#prevBtn').on('click', function() {
				if (currentStep > 1) {
					currentStep--;
					updateWizard();
				}
			});

			// Click nos steps
			$('.wizard-step').on('click', function() {
				var step = parseInt($(this).data('step'));
				currentStep = step;
				updateWizard();
			});
		});

		function updateWizard() {
			// Atualizar conteúdo
			$('.step-content').removeClass('active');
			$('.step-content[data-step="' + currentStep + '"]').addClass('active');

			// Atualizar steps
			$('.wizard-step').removeClass('active completed');
			$('.wizard-step').each(function() {
				var step = parseInt($(this).data('step'));
				if (step < currentStep) {
					$(this).addClass('completed');
				} else if (step === currentStep) {
					$(this).addClass('active');
				}
			});

			// Atualizar botões
			$('#prevBtn').prop('disabled', currentStep === 1);
			if (currentStep === totalSteps) {
				$('#nextBtn').text('Finalizar ✓');
			} else {
				$('#nextBtn').text('Próximo →');
			}

			// Atualizar progress bar
			var progress = (currentStep / totalSteps) * 100;
			$('#progressBar').css('width', progress + '%');

			// Scroll to top
			$('.wizard-content').animate({
				scrollTop: 0
			}, 300);
		}

		// Salvar rascunho
		$('#saveDraft').on('click', function() {
			var formData = $('#hotelEditForm').serialize();
			var hotelKey = 'hotelDraft_' + <?= json_encode($mneu_for) ?>;
			localStorage.setItem(hotelKey, formData);

			// Feedback visual
			var $btn = $(this);
			$btn.html('<i class="bi bi-check"></i> Salvo!').addClass('btn-success').removeClass('btn-outline-secondary');
			setTimeout(function() {
				$btn.html('<i class="bi bi-save"></i> Salvar Rascunho').removeClass('btn-success').addClass('btn-outline-secondary');
			}, 2000);
		});

		// Carregar rascunho
		$('#loadDraft').on('click', function() {
			var hotelKey = 'hotelDraft_' + <?= json_encode($mneu_for) ?>;
			var savedData = localStorage.getItem(hotelKey);

			if (savedData) {
				if (!confirm('Deseja carregar o rascunho salvo? Isso substituirá os dados atuais do formulário.')) {
					return;
				}

				$('#hotelEditForm')[0].reset();
				var pairs = savedData.split('&');

				pairs.forEach(function(pair) {
					var parts = pair.split('=');
					var name = decodeURIComponent(parts[0]);
					var value = decodeURIComponent(parts[1] || '');

					var $elements = $('[name="' + name + '"]');
					if ($elements.length === 0) return;

					if ($elements.is(':checkbox')) {
						$elements.prop('checked', value === 'on' || value === $elements.val());
					} else {
						$elements.val(value);
					}
				});

				// Feedback visual
				var $btn = $(this);
				$btn.html('<i class="bi bi-check"></i> Carregado!').addClass('btn-success').removeClass('btn-outline-info');
				setTimeout(function() {
					$btn.html('<i class="bi bi-upload"></i> Carregar Rascunho').removeClass('btn-success').addClass('btn-outline-info');
				}, 2000);
			} else {
				alert('Nenhum rascunho encontrado para este hotel.');
			}
		});

		// Auto-save a cada 5 minutos
		var autoSaveInterval = setInterval(function() {
			var formData = $('#hotelEditForm').serialize();
			var hotelKey = 'hotelDraft_' + <?= json_encode($mneu_for) ?>;
			localStorage.setItem(hotelKey, formData);
			console.log('Auto-save realizado');
		}, 300000);

		// Limpar interval quando sair da página
		$(window).on('beforeunload', function() {
			clearInterval(autoSaveInterval);
		});

		// Atalhos de teclado
		$(document).off('keydown.wizard').on('keydown.wizard', function(e) {
			// Alt + Seta Direita = Próximo
			if (e.altKey && e.keyCode === 39 && currentStep < totalSteps) {
				currentStep++;
				updateWizard();
				e.preventDefault();
			}
			// Alt + Seta Esquerda = Anterior
			if (e.altKey && e.keyCode === 37 && currentStep > 1) {
				currentStep--;
				updateWizard();
				e.preventDefault();
			}
			// Alt + S = Salvar
			if (e.altKey && e.keyCode === 83) {
				$('#saveDraft').click();
				e.preventDefault();
			}
		});
	})();
</script>
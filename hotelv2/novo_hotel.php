<?php
require_once '../util/connection.php';

$mneu_for = pg_escape_string($_POST["mneu_for"] ?? '');

$hoteis = "SELECT nome_for 
           FROM sbd95.fornec 
           WHERE mneu_for = '$mneu_for'";
$result_hoteis_pendentes = pg_exec($conn, $hoteis);
$nome_for = '';
if ($result_hoteis_pendentes && pg_numrows($result_hoteis_pendentes) > 0) {
	$nome_for = pg_result($result_hoteis_pendentes, 0, 'nome_for');
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
		background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
			<h2 class="mb-2">Cadastro de Novo Hotel</h2>
			<p class="mb-0"><?= htmlspecialchars($nome_for . ' - ' . $mneu_for) ?></p>
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
				<div class="wizard-step-label">Observações</div>
			</div>
			<div class="wizard-step" data-step="7">
				<div class="wizard-step-circle">7</div>
				<div class="wizard-step-label">Marcações</div>
			</div>
			<div class="wizard-step" data-step="8">
				<div class="wizard-step-circle">8</div>
				<div class="wizard-step-label">Classificações</div>
			</div>
			<div class="wizard-step" data-step="9">
				<div class="wizard-step-circle">9</div>
				<div class="wizard-step-label">Facilidades</div>
			</div>
			<div class="wizard-step" data-step="10">
				<div class="wizard-step-circle">10</div>
				<div class="wizard-step-label">Descrições Curtas</div>
			</div>
			<div class="wizard-step" data-step="11">
				<div class="wizard-step-circle">11</div>
				<div class="wizard-step-label">Extras</div>
			</div>
		</div>

		<form id="hotelForm">
			<input type="hidden" name="mneu_for" id="mneu_for" value="<?= htmlspecialchars($mneu_for) ?>">

			<div class="wizard-content">
				<!-- Passo 1: Descrições -->
				<div class="step-content active" data-step="1">
					<h3 class="form-section-title">Descrições do Hotel</h3>
					<div class="row g-3">
						<div class="col-md-12">
							<label class="form-label fw-bold">Português</label>
							<textarea class="form-control" name="descricao_pt" id="descricao_pt" rows="4"></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label fw-bold">Inglês</label>
							<textarea class="form-control" name="descricao_en" id="descricao_en" rows="4"></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label fw-bold">Espanhol (FIT e GRP)</label>
							<textarea class="form-control" name="descricao_esp" id="descricao_esp" rows="4"></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label fw-bold">Espanhol (GRP)</label>
							<textarea class="form-control" name="descesp_grpfit" id="descesp_grpfit" rows="4"></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label fw-bold">Chamada Destaque (Site Nacional) <small class="text-muted">Máx. 200 caracteres</small></label>
							<textarea class="form-control" name="hotel_cham" id="hotel_cham" rows="3"></textarea>
						</div>
					</div>
				</div>

				<!-- Passo 2: Conteúdo para Resorts -->
				<div class="step-content" data-step="2">
					<h3 class="form-section-title">Conteúdo para Resorts</h3>
					<div class="row g-4">
						<?php
						$resort_fields = [
							['name' => 'regime_hotel', 'label' => 'Régimen de Comidas', 'pt' => 'regime_hotel_pt', 'en' => 'regime_hotel_en', 'es' => 'regime_hotel_esp'],
							['name' => 'rec_entret', 'label' => 'Recreación & Entretenimiento', 'pt' => 'rec_entret_pt', 'en' => 'rec_entret_en', 'es' => 'rec_entret_esp'],
							['name' => 'otras_ativ', 'label' => 'Otras Actividades', 'pt' => 'otras_ativ_pt', 'en' => 'otras_ativ_en', 'es' => 'otras_ativ_esp'],
							['name' => 'alojamiento', 'label' => 'Alojamiento', 'pt' => 'alojamiento_pt', 'en' => 'alojamiento_en', 'es' => 'alojamiento_esp'],
							['name' => 'gastronomia', 'label' => 'Gastronomia', 'pt' => 'gastronomia_pt', 'en' => 'gastronomia_en', 'es' => 'gastronomia_esp'],
							['name' => 'servicios', 'label' => 'Servicios', 'pt' => 'servicios_pt', 'en' => 'servicios_en', 'es' => 'servicios_esp'],
							['name' => 'convenciones', 'label' => 'Convenciones', 'pt' => 'convenciones_pt', 'en' => 'convenciones_en', 'es' => 'convenciones_esp'],
							['name' => 'campo_extra', 'label' => 'Servicios Adicionales', 'pt' => 'campo_extra_pt', 'en' => 'campo_extra_en', 'es' => 'campo_extra_esp'],
						];

						foreach ($resort_fields as $field):
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
											<textarea class="form-control" name="<?= htmlspecialchars($field['pt']) ?>" rows="3"></textarea>
										</div>
										<div class="language-content" data-lang="en" data-group="<?= htmlspecialchars($field['name']) ?>">
											<textarea class="form-control" name="<?= htmlspecialchars($field['en']) ?>" rows="3"></textarea>
										</div>
										<div class="language-content" data-lang="es" data-group="<?= htmlspecialchars($field['name']) ?>">
											<textarea class="form-control" name="<?= htmlspecialchars($field['es']) ?>" rows="3"></textarea>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
						<div class="col-md-12">
							<label class="form-label fw-bold">Conteúdo Complementar Ecológico</label>
							<textarea class="form-control" name="complemento" id="complemento" rows="4"></textarea>
						</div>
					</div>
				</div>

				<!-- Passo 3: Fotos e Galeria -->
				<div class="step-content" data-step="3">
					<h3 class="form-section-title">Fotos e Galeria</h3>
					<div class="row g-3">
						<div class="col-md-6">
							<label class="form-label">Fachada</label>
							<input type="text" class="form-control" name="foto_fachada" id="foto_fachada" maxlength="100">
						</div>
						<div class="col-md-6">
							<label class="form-label">Fachada TBN</label>
							<input type="text" class="form-control" name="fotofachada_tbn" id="fotofachada_tbn" maxlength="100">
						</div>
						<div class="col-md-6">
							<label class="form-label">Piscina</label>
							<input type="text" class="form-control" name="fotopiscina" id="fotopiscina" maxlength="100">
						</div>
						<div class="col-md-6">
							<label class="form-label">Foto Extra 1</label>
							<input type="text" class="form-control" name="fotoextra" id="fotoextra" maxlength="100">
						</div>
						<div class="col-md-6">
							<label class="form-label">Foto Extra 2 (Recepção)</label>
							<input type="text" class="form-control" name="fotoextra_recep" id="fotoextra_recep" maxlength="100">
						</div>
						<div class="col-md-6">
							<label class="form-label">Foto Extra 3</label>
							<input type="text" class="form-control" name="ft_resort1" id="ft_resort1" maxlength="100">
						</div>
						<div class="col-md-6">
							<label class="form-label">Foto Extra 4</label>
							<input type="text" class="form-control" name="ft_resort2" id="ft_resort2" maxlength="100">
						</div>
						<div class="col-md-6">
							<label class="form-label">Foto Extra 5</label>
							<input type="text" class="form-control" name="ft_resort3" id="ft_resort3" maxlength="100">
						</div>
						<div class="col-md-12">
							<label class="form-label">Imagens da Galeria <small class="text-muted">(URLs separadas por vírgula)</small></label>
							<textarea class="form-control" name="gallery_images" id="gallery_images" rows="3"></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label">Imagem da Planta Baixa</label>
							<input type="text" class="form-control" name="blueprint_image" id="blueprint_image" maxlength="255">
						</div>
					</div>
				</div>

				<!-- Passo 4: Apartamentos -->
				<div class="step-content" data-step="4">
					<h3 class="form-section-title">Apartamentos (até 4 categorias)</h3>
					<div class="row g-3">
						<?php for ($i = 1; $i <= 4; $i++): ?>
							<div class="col-md-12">
								<div class="row border p-3 mb-3">
									<div class="col-md-3">
										<label class="form-label">Categoria <?= $i ?></label>
										<select class="form-select" name="categ<?= $i ?>" id="categ<?= $i ?>">
											<option value="0">Apto Categ</option>
											<?php
											$query_aptocateg = "SELECT aptocatcod, catdscing FROM conteudo_internet.apto_categoria";
											$result_aptocateg = pg_exec($conn, $query_aptocateg);
											if ($result_aptocateg) {
												for ($row = 0; $row < pg_numrows($result_aptocateg); $row++) {
													$aptocatcod = pg_result($result_aptocateg, $row, 'aptocatcod');
													$catdscing = pg_result($result_aptocateg, $row, 'catdscing');
													echo '<option value="' . $aptocatcod . '">' . htmlspecialchars($catdscing) . '</option>';
												}
											}
											?>
										</select>
									</div>
									<div class="col-md-3">
										<label class="form-label">Localização <?= $i ?></label>
										<select class="form-select" name="loc<?= $i ?>" id="loc<?= $i ?>">
											<option value="0">Apto Location</option>
											<?php
											$query_aptoloc = "SELECT aptoloccod, aptolocdscing FROM conteudo_internet.apto_localizacao";
											$result_aptoloc = pg_exec($conn, $query_aptoloc);
											if ($result_aptoloc) {
												for ($row = 0; $row < pg_numrows($result_aptoloc); $row++) {
													$aptoloccod = pg_result($result_aptoloc, $row, 'aptoloccod');
													$aptolocdscing = pg_result($result_aptoloc, $row, 'aptolocdscing');
													echo '<option value="' . $aptoloccod . '">' . htmlspecialchars($aptolocdscing) . '</option>';
												}
											}
											?>
										</select>
									</div>
									<div class="col-md-2">
										<label class="form-label">Qtd. <?= $i ?></label>
										<input type="text" class="form-control" name="qtd<?= $i ?>" id="qtd<?= $i ?>" maxlength="20">
									</div>
									<div class="col-md-4">
										<label class="form-label">Foto <?= $i ?></label>
										<input type="text" class="form-control" name="foto<?= $i ?>" id="foto<?= $i ?>" maxlength="100">
									</div>
								</div>
							</div>
						<?php endfor; ?>
						<div class="col-md-12">
							<label class="form-label">Categorias de Quartos <small class="text-muted">(separadas por vírgula)</small></label>
							<textarea class="form-control" name="room_categories" id="room_categories" rows="3"></textarea>
						</div>
					</div>
				</div>

				<!-- Passo 5: Mídia e Localização -->
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
										<input type="text" class="form-control" name="htlurl" id="htlurl" maxlength="100">
									</div>
									<div class="mb-3">
										<label class="form-label">Imagem do Mapa</label>
										<input type="text" class="form-control" name="mapa" id="mapa" maxlength="100">
									</div>
									<div class="mb-3">
										<label class="form-label">Mapa Ecológico</label>
										<input type="text" class="form-control" name="map_eco" id="map_eco" maxlength="100">
									</div>
									<div class="mb-3">
										<label class="form-label">URL do Iframe do Mapa</label>
										<input type="text" class="form-control" name="map_iframe_url" id="map_iframe_url" maxlength="500">
									</div>
									<div class="row">
										<div class="col-6">
											<label class="form-label">Latitude</label>
											<input type="number" class="form-control" name="latitude" id="latitude" step="0.000001">
										</div>
										<div class="col-6">
											<label class="form-label">Longitude</label>
											<input type="number" class="form-control" name="longitude" id="longitude" step="0.000001">
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
										<input type="text" class="form-control" name="url_htl_360" id="url_htl_360" maxlength="100">
									</div>
									<div class="mb-3">
										<label class="form-label">Arquivo Foto 360</label>
										<input type="text" class="form-control" name="arq_htl_360" id="arq_htl_360" maxlength="100">
									</div>
									<div class="mb-3">
										<label class="form-label">Endereço Vídeo</label>
										<input type="text" class="form-control" name="url_video" id="url_video" maxlength="100">
									</div>
									<div class="mb-3">
										<label class="form-label">Arquivo do Vídeo</label>
										<input type="text" class="form-control" name="arq_video" id="arq_video" maxlength="100">
									</div>
									<div class="mb-3">
										<label class="form-label">Tour Virtual sem Flash</label>
										<input type="text" class="form-control" name="virtual_tour" id="virtual_tour" maxlength="100">
									</div>
									<div class="mb-3">
										<label class="form-label">URL 360 das Salas</label>
										<input type="text" class="form-control" name="url_360_halls" id="url_360_halls" maxlength="255">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Passo 6: Observações -->
				<div class="step-content" data-step="6">
					<h3 class="form-section-title">Observações</h3>
					<div class="row g-3">
						<div class="col-md-12">
							<label class="form-label fw-bold">Em Inglês</label>
							<textarea class="form-control" name="obs_en" id="obs_en" rows="8"></textarea>
						</div>
						<div class="col-md-6">
							<label class="form-label fw-bold">Em Português</label>
							<textarea class="form-control" name="obs_pt" id="obs_pt" rows="5"></textarea>
						</div>
						<div class="col-md-6">
							<label class="form-label fw-bold">Em Espanhol (Blumar Opina)</label>
							<textarea class="form-control" name="obs_esp" id="obs_esp" rows="5"></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label fw-bold">Histórico de Alterações de Templates</label>
							<textarea class="form-control" name="historico_temp" id="historico_temp" rows="4"></textarea>
						</div>
					</div>
				</div>

				<!-- Passo 7: Marcações -->
				<div class="step-content" data-step="7">
					<h3 class="form-section-title">Marcações e Flags</h3>
					<div class="row g-4">
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Marcações Gerais</h6>
								</div>
								<div class="card-body">
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="flaghtl" id="flaghtl">
										<label class="form-check-label" for="flaghtl">Ativo na Internet Blumar</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="ativo_latino" id="ativo_latino">
										<label class="form-check-label" for="ativo_latino">Não aparecer Template no Tarifário Latino</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="ativo_flat" id="ativo_flat">
										<label class="form-check-label" for="ativo_flat">É Flat</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="resort" id="resort">
										<label class="form-check-label" for="resort">É Resort</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="ecologico" id="ecologico">
										<label class="form-check-label" for="ecologico">É Ecológico</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="validafotopiscina" id="validafotopiscina">
										<label class="form-check-label" for="validafotopiscina">É destaque no tarifário Latino</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="bestdeal" id="bestdeal">
										<label class="form-check-label" for="bestdeal">Best Deal</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="ativo_bnuts" id="ativo_bnuts">
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
										<input class="form-check-input" type="checkbox" name="inet_mapa" id="inet_mapa">
										<label class="form-check-label" for="inet_mapa">Singular</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="luxury" id="luxury">
										<label class="form-check-label" for="luxury">Green</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="novo" id="novo">
										<label class="form-check-label" for="novo">New</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="favoritos" id="favoritos">
										<label class="form-check-label" for="favoritos">Loved</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="superb" id="superb">
										<label class="form-check-label" for="superb">Superb</label>
									</div>
								</div>
							</div>
							<div class="card mt-3">
								<div class="card-header">
									<h6 class="mb-0">Site Nacional</h6>
								</div>
								<div class="card-body">
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="pg6fq7" id="pg6fq7">
										<label class="form-check-label" for="pg6fq7">Promo especial</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="pg4fq5" id="pg4fq5">
										<label class="form-check-label" for="pg4fq5">Bonus Blumar</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="chdgratis" id="chdgratis">
										<label class="form-check-label" for="chdgratis">Criança Grátis</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="blumarrecomenda" id="blumarrecomenda">
										<label class="form-check-label" for="blumarrecomenda">Blumar Recomenda</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="blumarreveillon" id="blumarreveillon">
										<label class="form-check-label" for="blumarreveillon">Reveillon</label>
									</div>
									<div class="form-check mb-2">
										<input class="form-check-input" type="checkbox" name="allinclusive" id="allinclusive">
										<label class="form-check-label" for="allinclusive">All Inclusive</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Passo 8: Classificações -->
				<div class="step-content" data-step="8">
					<h3 class="form-section-title">Classificações e Most Recommended</h3>
					<div class="row g-4">
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Classificação de Estrelas Blumar</h6>
								</div>
								<div class="card-body text-center">
									<input type="text" class="form-control" name="htlestrelablumar" id="htlestrelablumar" maxlength="1" size="1">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Classificação Ecológico</h6>
								</div>
								<div class="card-body">
									<select class="form-select" name="classif_eco" id="classif_eco">
										<option value="0">None</option>
										<option value="1">Very Rustic->Basic</option>
										<option value="2">Basic->Comfort</option>
										<option value="3">Superior->Premium</option>
										<option value="4">Friendly</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Classificação Luxury</h6>
								</div>
								<div class="card-body">
									<select class="form-select" name="classif_lux" id="classif_lux">
										<option value="0">None</option>
										<option value="1">Tropical</option>
										<option value="2">Opulence</option>
										<option value="3">Beach Front</option>
										<option value="4">Bliss</option>
										<option value="5">Barefoot Chick</option>
										<option value="6">Top Notch</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<h6 class="mb-0">Most Recommended (Inglês)</h6>
								</div>
								<div class="card-body">
									<textarea class="form-control" name="desc_mostrp_ing" id="desc_mostrp_ing" rows="4"></textarea>
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
										<input class="form-check-input" type="checkbox" name="ativo_mostrp" id="ativo_mostrp">
										<label class="form-check-label" for="ativo_mostrp">É Most Recommended</label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Passo 9: Facilidades -->
				<div class="step-content" data-step="9">
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
										$query_fachtl1 = "SELECT tpofaccod, tpofacdsc FROM conteudo_internet.ci_tipo_facilidade WHERE tipo = 1 AND ativo = true ORDER BY tpofacdsc ASC";
										$result_fachtl1 = pg_exec($conn, $query_fachtl1);
										if ($result_fachtl1 && pg_numrows($result_fachtl1) > 0) {
											for ($rowfac1 = 0; $rowfac1 < pg_numrows($result_fachtl1); $rowfac1++) {
												$tpofaccod1 = pg_result($result_fachtl1, $rowfac1, 'tpofaccod');
												$tpofacdsc1 = pg_result($result_fachtl1, $rowfac1, 'tpofacdsc');
												echo '<div class="form-check mb-2">
													<input class="form-check-input" type="checkbox" name="facilities[]" value="' . $tpofaccod1 . '" id="fac_h' . $tpofaccod1 . '">
													<label class="form-check-label" for="fac_h' . $tpofaccod1 . '">' . htmlspecialchars($tpofacdsc1) . '</label>
												</div>';
											}
										} else {
											echo '<div class="text-muted">Nenhuma facilidade disponível</div>';
										}
										?>
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
										$query_fachtl2 = "SELECT tpofaccod, tpofacdsc FROM conteudo_internet.ci_tipo_facilidade WHERE tipo = 2 AND ativo = true ORDER BY tpofacdsc ASC";
										$result_fachtl2 = pg_exec($conn, $query_fachtl2);
										if ($result_fachtl2 && pg_numrows($result_fachtl2) > 0) {
											for ($rowfac2 = 0; $rowfac2 < pg_numrows($result_fachtl2); $rowfac2++) {
												$tpofaccod2 = pg_result($result_fachtl2, $rowfac2, 'tpofaccod');
												$tpofacdsc2 = pg_result($result_fachtl2, $rowfac2, 'tpofacdsc');
												echo '<div class="form-check mb-2">
													<input class="form-check-input" type="checkbox" name="facilities[]" value="' . $tpofaccod2 . '" id="fac_a' . $tpofaccod2 . '">
													<label class="form-check-label" for="fac_a' . $tpofaccod2 . '">' . htmlspecialchars($tpofacdsc2) . '</label>
												</div>';
											}
										} else {
											echo '<div class="text-muted">Nenhuma facilidade disponível</div>';
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Passo 10: Descrições Curtas e Insights -->
				<div class="step-content" data-step="10">
					<h3 class="form-section-title">Descrições Curtas e Insights</h3>
					<div class="row g-3">
						<div class="col-md-4">
							<label class="form-label">Número de Quartos</label>
							<input type="text" class="form-control" name="htl_num_quartos" id="htl_num_quartos" maxlength="10">
						</div>
						<div class="col-md-4">
							<label class="form-label">Slug</label>
							<input type="text" class="form-control" name="slug" id="slug" maxlength="255">
						</div>
						<div class="col-md-4">
							<label class="form-label">Short Description PT</label>
							<textarea class="form-control" name="short_description_pt" rows="3"></textarea>
						</div>
						<div class="col-md-4">
							<label class="form-label">Short Description EN</label>
							<textarea class="form-control" name="short_description_en" rows="3"></textarea>
						</div>
						<div class="col-md-4">
							<label class="form-label">Short Description ES</label>
							<textarea class="form-control" name="short_description_es" rows="3"></textarea>
						</div>
						<div class="col-md-4">
							<label class="form-label">Insight PT</label>
							<textarea class="form-control" name="insight_pt" rows="3"></textarea>
						</div>
						<div class="col-md-4">
							<label class="form-label">Insight EN</label>
							<textarea class="form-control" name="insight_en" rows="3"></textarea>
						</div>
						<div class="col-md-4">
							<label class="form-label">Insight ES</label>
							<textarea class="form-control" name="insight_es" rows="3"></textarea>
						</div>
						<div class="col-md-12">
							<label class="form-label">Faixa de Preço <small class="text-muted">Ex: $100 - $300</small></label>
							<input type="text" class="form-control" name="price_range" id="price_range">
						</div>
					</div>
				</div>

				<!-- Passo 11: Localização, Capacidade e Experiências -->
				<div class="step-content" data-step="11">
					<h3 class="form-section-title">Localização, Capacidade e Experiências</h3>
					<div class="row g-3">
						<div class="col-md-3">
							<label class="form-label">City Name</label>
							<input type="text" class="form-control" name="city_name" id="city_name" maxlength="255">
						</div>
						<div class="col-md-3">
							<label class="form-label">State</label>
							<input type="text" class="form-control" name="state" id="state" maxlength="50">
						</div>
						<div class="col-md-3">
							<label class="form-label">Country</label>
							<input type="text" class="form-control" name="country" id="country" maxlength="50">
						</div>
						<div class="col-md-3">
							<label class="form-label">Capacity Min</label>
							<input type="number" class="form-control" name="capacity_min" id="capacity_min">
						</div>
						<div class="col-md-3">
							<label class="form-label">Capacity Max</label>
							<input type="number" class="form-control" name="capacity_max" id="capacity_max">
						</div>
						<div class="col-md-3">
							<label class="form-label">Rating (0-5)</label>
							<input type="number" class="form-control" name="rating" id="rating" step="0.1" min="0" max="5">
						</div>
						<div class="col-md-3">
							<label class="form-label">Rating Count</label>
							<input type="number" class="form-control" name="rating_count" id="rating_count">
						</div>
						<div class="col-md-3">
							<label class="form-label">Meeting Rooms Count</label>
							<input type="number" class="form-control" name="meeting_rooms_count" id="meeting_rooms_count">
						</div>
						<div class="col-md-12">
							<label class="form-label">Meeting Rooms Detail</label>
							<textarea class="form-control" name="meeting_rooms_detail" id="meeting_rooms_detail" rows="3"></textarea>
						</div>
						<div class="col-md-3">
							<label class="form-label">Has Convention Center</label>
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="has_convention_center" id="has_convention_center">
								<label class="form-check-label">Sim</label>
							</div>
						</div>
						<div class="col-md-12">
							<label class="form-label">Dining Experiences</label>
							<textarea class="form-control" name="dining_experiences" id="dining_experiences" rows="3"></textarea>
						</div>
					</div>
				</div>

				<!-- Navegação do Wizard -->
				<div class="wizard-actions">
					<button type="button" class="btn btn-secondary" id="prevBtn">
						← Anterior
					</button>
					<div>
						<button type="button" class="btn btn-outline-primary me-2" id="saveBtn" onclick="javascript:insere_novo_hotel();">
							💾 Inserir Hotel
						</button>
						<button type="button" class="btn btn-primary" id="nextBtn">
							Próximo →
						</button>
					</div>
				</div>
			</div>
		</form>
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
		$('#hotelForm').off();
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
			var formData = $('#hotelForm').serialize();
			var hotelKey = 'hotelNewDraft_' + <?= json_encode($mneu_for) ?>;
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
			var hotelKey = 'hotelNewDraft_' + <?= json_encode($mneu_for) ?>;
			var savedData = localStorage.getItem(hotelKey);

			if (savedData) {
				if (!confirm('Deseja carregar o rascunho salvo? Isso substituirá os dados atuais do formulário.')) {
					return;
				}

				$('#hotelForm')[0].reset();
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
			var formData = $('#hotelForm').serialize();
			var hotelKey = 'hotelNewDraft_' + <?= json_encode($mneu_for) ?>;
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
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

<div class="container-fluid py-4">
	<div class="row mb-4">
		<div class="col-12">
			<h2 class="text-center mb-3">Cadastro de Novo Hotel</h2>
			<div class="alert alert-info text-center">
				<strong>Nome do Hotel:</strong> <?= htmlspecialchars($nome_for . ' - ' . $mneu_for) ?>
			</div>
			<input type="hidden" name="mneu_for" id="mneu_for" value="<?= htmlspecialchars($mneu_for) ?>">
		</div>
	</div>

	<form id="hotelForm">
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
								<textarea class="form-control" name="descricao_pt" id="descricao_pt" rows="4"></textarea>
							</div>
							<div class="col-md-12 mb-3">
								<label class="form-label">Inglês</label>
								<textarea class="form-control" name="descricao_en" id="descricao_en" rows="4"></textarea>
							</div>
							<div class="col-md-12 mb-3">
								<label class="form-label">Espanhol (FIT e GRP)</label>
								<textarea class="form-control" name="descricao_esp" id="descricao_esp" rows="4"></textarea>
							</div>
							<div class="col-md-12 mb-3">
								<label class="form-label">Espanhol (GRP)</label>
								<textarea class="form-control" name="descesp_grpfit" id="descesp_grpfit" rows="4"></textarea>
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
						<div class="row">
							<!-- Régimen de comidas -->
							<div class="col-md-4 mb-3">
								<h6>Régimen de Comidas</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="regime_hotel_pt" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="regime_hotel_en" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="regime_hotel_esp" rows="3"></textarea>
								</div>
							</div>
							<!-- Recreación & Entretenimiento -->
							<div class="col-md-4 mb-3">
								<h6>Recreación & Entretenimiento</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="rec_entret_pt" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="rec_entret_en" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="rec_entret_esp" rows="3"></textarea>
								</div>
							</div>
							<!-- Otras Actividades -->
							<div class="col-md-4 mb-3">
								<h6>Otras Actividades</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="otras_ativ_pt" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="otras_ativ_en" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="otras_ativ_esp" rows="3"></textarea>
								</div>
							</div>
							<!-- Alojamiento -->
							<div class="col-md-4 mb-3">
								<h6>Alojamiento</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="alojamiento_pt" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="alojamiento_en" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="alojamiento_esp" rows="3"></textarea>
								</div>
							</div>
							<!-- Gastronomia -->
							<div class="col-md-4 mb-3">
								<h6>Gastronomia</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="gastronomia_pt" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="gastronomia_en" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="gastronomia_esp" rows="3"></textarea>
								</div>
							</div>
							<!-- Servicios -->
							<div class="col-md-4 mb-3">
								<h6>Servicios</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="servicios_pt" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="servicios_en" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="servicios_esp" rows="3"></textarea>
								</div>
							</div>
							<!-- Convenciones -->
							<div class="col-md-4 mb-3">
								<h6>Convenciones</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="convenciones_pt" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="convenciones_en" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="convenciones_esp" rows="3"></textarea>
								</div>
							</div>
							<!-- Servicios Adicionales -->
							<div class="col-md-4 mb-3">
								<h6>Servicios Adicionales</h6>
								<div class="mb-2">
									<label class="form-label small">Português</label>
									<textarea class="form-control form-control-sm" name="campo_extra_pt" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Inglês</label>
									<textarea class="form-control form-control-sm" name="campo_extra_en" rows="3"></textarea>
								</div>
								<div class="mb-2">
									<label class="form-label small">Espanhol</label>
									<textarea class="form-control form-control-sm" name="campo_extra_esp" rows="3"></textarea>
								</div>
							</div>
							<!-- Conteúdo Complementar Ecológico -->
							<div class="col-md-4 mb-3">
								<h6>Conteúdo Complementar Ecológico</h6>
								<textarea class="form-control" name="complemento" id="complemento" rows="5"></textarea>
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
						<h6>Chamada Destaque (Site Nacional) <small class="text-muted">Máx. 200 caracteres</small></h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="hotel_cham" id="hotel_cham" rows="3"></textarea>
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
						<div class="row">
							<div class="col-md-6 mb-3">
								<label class="form-label">Fachada</label>
								<input type="text" class="form-control" name="foto_fachada" id="foto_fachada" maxlength="100">
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Fachada TBN</label>
								<input type="text" class="form-control" name="fotofachada_tbn" id="fotofachada_tbn" maxlength="100">
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Piscina</label>
								<input type="text" class="form-control" name="fotopiscina" id="fotopiscina" maxlength="100">
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Foto Extra 1</label>
								<input type="text" class="form-control" name="fotoextra" id="fotoextra" maxlength="100">
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Foto Extra 2 (Recepção)</label>
								<input type="text" class="form-control" name="fotoextra_recep" id="fotoextra_recep" maxlength="100">
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Foto Extra 3</label>
								<input type="text" class="form-control" name="ft_resort1" id="ft_resort1" maxlength="100">
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Foto Extra 4</label>
								<input type="text" class="form-control" name="ft_resort2" id="ft_resort2" maxlength="100">
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Foto Extra 5</label>
								<input type="text" class="form-control" name="ft_resort3" id="ft_resort3" maxlength="100">
							</div>
							<div class="col-md-12 mb-3">
								<label class="form-label">Imagens da Galeria (URLs separadas por vírgula)</label>
								<textarea class="form-control" name="gallery_images" id="gallery_images" rows="3"></textarea>
							</div>
							<div class="col-md-12 mb-3">
								<label class="form-label">Imagem da Planta Baixa</label>
								<input type="text" class="form-control" name="blueprint_image" id="blueprint_image" maxlength="255">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 5: Fotos dos Apartamentos -->
		<div class="accordion mb-4" id="accordionApartamentos">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseApartamentos">
						Fotos dos Apartamentos (até 4 categorias)
					</button>
				</h2>
				<div id="collapseApartamentos" class="accordion-collapse collapse" data-bs-parent="#accordionApartamentos">
					<div class="accordion-body">
						<?php for ($i = 1; $i <= 4; $i++): ?>
							<div class="row mb-3 border-bottom pb-3">
								<div class="col-md-3">
									<label class="form-label">Categoria</label>
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
									<label class="form-label">Localização</label>
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
									<label class="form-label">Qtd.</label>
									<input type="text" class="form-control" name="qtd<?= $i ?>" id="qtd<?= $i ?>" maxlength="20">
								</div>
								<div class="col-md-4">
									<label class="form-label">Foto</label>
									<input type="text" class="form-control" name="foto<?= $i ?>" id="foto<?= $i ?>" maxlength="100">
								</div>
							</div>
						<?php endfor; ?>
						<div class="row">
							<div class="col-md-12">
								<label class="form-label">Categorias de Quartos (separadas por vírgula)</label>
								<textarea class="form-control" name="room_categories" id="room_categories" rows="3"></textarea>
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
							<input type="text" class="form-control" name="htlurl" id="htlurl" maxlength="100">
						</div>
						<div class="mb-3">
							<label class="form-label">Mapa</label>
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
				<div class="card">
					<div class="card-header">
						<h6>Vídeos e 360°</h6>
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

		<!-- Seção 7: Observações -->
		<div class="accordion mb-4" id="accordionObservacoes">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseObservacoes">
						Observações
					</button>
				</h2>
				<div id="collapseObservacoes" class="accordion-collapse collapse" data-bs-parent="#accordionObservacoes">
					<div class="accordion-body">
						<div class="row">
							<div class="col-md-6 mb-3">
								<label class="form-label">Português</label>
								<textarea class="form-control" name="obs_pt" id="obs_pt" rows="3"></textarea>
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Inglês</label>
								<textarea class="form-control" name="obs_en" id="obs_en" rows="3"></textarea>
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Espanhol (Blumar Opina)</label>
								<textarea class="form-control" name="obs_esp" id="obs_esp" rows="3"></textarea>
							</div>
							<div class="col-md-6 mb-3">
								<label class="form-label">Histórico de Alterações de Templates</label>
								<textarea class="form-control" name="historico_temp" id="historico_temp" rows="3"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 8: Marcações e Checkboxes -->
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
								<h6>Flags Gerais</h6>
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
							<div class="col-md-6">
								<h6>Destaques para Tarifário FIT (Selos - máx. 3)</h6>
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
								<h6 class="mt-3">Marcações para Site Nacional</h6>
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
		</div>

		<!-- Seção 9: Classificações -->
		<div class="row mb-4">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Classificação de Estrelas Blumar</h6>
					</div>
					<div class="card-body text-center">
						<input type="text" class="form-control" name="htlestrelablumar" id="htlestrelablumar" maxlength="1" size="1">
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Classificação Eco</h6>
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
						<h6>Classificação Luxury</h6>
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
		</div>

		<!-- Seção 10: Most Recommended Properties -->
		<div class="row mb-4">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<h6>Descritivo Most Recommended (Inglês)</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="desc_mostrp_ing" id="desc_mostrp_ing" rows="3"></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Flag Most Recommended</h6>
					</div>
					<div class="card-body text-center">
						<div class="form-check mt-3">
							<input class="form-check-input" type="checkbox" name="ativo_mostrp" id="ativo_mostrp">
							<label class="form-check-label" for="ativo_mostrp">É Most Recommended Properties</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 11: Facilidades -->
		<div class="accordion mb-4" id="accordionFacilidades">
			<div class="accordion-item">
				<h2 class="accordion-header">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFacilidades">
						Facilidades do Hotel e Apartamento
					</button>
				</h2>
				<div id="collapseFacilidades" class="accordion-collapse collapse" data-bs-parent="#accordionFacilidades">
					<div class="accordion-body">
						<div class="row">
							<div class="col-md-6">
								<h6>Facilidades do Hotel</h6>
								<?php
								$query_fachtl = "SELECT tpofaccod, tpofacdsc FROM conteudo_internet.ci_tipo_facilidade WHERE tipo = 1 AND ativo = true ORDER BY tpofacdsc ASC";
								$result_fachtl = pg_exec($conn, $query_fachtl);
								if ($result_fachtl) {
									for ($row = 0; $row < pg_numrows($result_fachtl); $row++) {
										$tpofaccod = pg_result($result_fachtl, $row, 'tpofaccod');
										$tpofacdsc = pg_result($result_fachtl, $row, 'tpofacdsc');
										echo '<div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="facilities[]" value="' . $tpofaccod . '" id="fac_h' . $tpofaccod . '">
                                                <label class="form-check-label" for="fac_h' . $tpofaccod . '">' . htmlspecialchars($tpofacdsc) . '</label>
                                              </div>';
									}
								}
								?>
							</div>
							<div class="col-md-6">
								<h6>Facilidades do Apartamento</h6>
								<?php
								$query_fachtl = "SELECT tpofaccod, tpofacdsc FROM conteudo_internet.ci_tipo_facilidade WHERE tipo = 2 AND ativo = true ORDER BY tpofacdsc ASC";
								$result_fachtl = pg_exec($conn, $query_fachtl);
								if ($result_fachtl) {
									for ($row = 0; $row < pg_numrows($result_fachtl); $row++) {
										$tpofaccod = pg_result($result_fachtl, $row, 'tpofaccod');
										$tpofacdsc = pg_result($result_fachtl, $row, 'tpofacdsc');
										echo '<div class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="facilities[]" value="' . $tpofaccod . '" id="fac_a' . $tpofaccod . '">
                                                <label class="form-check-label" for="fac_a' . $tpofaccod . '">' . htmlspecialchars($tpofacdsc) . '</label>
                                              </div>';
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 12: Dados Adicionais e Novos Campos -->
		<div class="row mb-4">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h6>Dados Adicionais</h6>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">Número de Quartos/Capacidade (Ex: 220)</label>
							<input type="text" class="form-control" name="htl_num_quartos" id="htl_num_quartos" maxlength="10">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h6>Slug e Descrições Curtas</h6>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">Slug</label>
							<input type="text" class="form-control" name="slug" id="slug" maxlength="255">
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-4">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Descrição Curta PT</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="short_description_pt" rows="2"></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Descrição Curta EN</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="short_description_en" rows="2"></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Descrição Curta ES</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="short_description_es" rows="2"></textarea>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 13: Insights -->
		<div class="row mb-4">
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Insight PT</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="insight_pt" rows="3"></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Insight EN</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="insight_en" rows="3"></textarea>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h6>Insight ES & Faixa de Preço</h6>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<textarea class="form-control" name="insight_es" rows="3"></textarea>
						</div>
						<input type="text" class="form-control" name="price_range" id="price_range" placeholder="Ex: $100 - $300">
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 14: Localização e Capacidade -->
		<div class="row mb-4">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h6>Localização e Capacidade</h6>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-3 mb-3">
								<label class="form-label">Nome da Cidade</label>
								<input type="text" class="form-control" name="city_name" id="city_name" maxlength="255">
							</div>
							<div class="col-md-3 mb-3">
								<label class="form-label">Estado</label>
								<input type="text" class="form-control" name="state" id="state" maxlength="50">
							</div>
							<div class="col-md-3 mb-3">
								<label class="form-label">País</label>
								<input type="text" class="form-control" name="country" id="country" maxlength="50">
							</div>
							<div class="col-md-3 mb-3">
								<label class="form-label">Capacidade Mínima</label>
								<input type="number" class="form-control" name="capacity_min" id="capacity_min">
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 mb-3">
								<label class="form-label">Capacidade Máxima</label>
								<input type="number" class="form-control" name="capacity_max" id="capacity_max">
							</div>
							<div class="col-md-3 mb-3">
								<label class="form-label">Classificação (0-5)</label>
								<input type="number" class="form-control" name="rating" id="rating" step="0.1" min="0" max="5">
							</div>
							<div class="col-md-3 mb-3">
								<label class="form-label">Número de Avaliações</label>
								<input type="number" class="form-control" name="rating_count" id="rating_count">
							</div>
							<div class="col-md-3 mb-3">
								<label class="form-label">Possui Centro de Convenções</label>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="has_convention_center" id="has_convention_center">
									<label class="form-check-label">Sim</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 mb-3">
								<label class="form-label">Número de Salas de Reunião</label>
								<input type="number" class="form-control" name="meeting_rooms_count" id="meeting_rooms_count">
							</div>
							<div class="col-md-8 mb-3">
								<label class="form-label">Detalhes das Salas de Reunião</label>
								<textarea class="form-control" name="meeting_rooms_detail" id="meeting_rooms_detail" rows="2"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Seção 15: Experiências -->
		<div class="row mb-4">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h6>Experiências Culinárias</h6>
					</div>
					<div class="card-body">
						<textarea class="form-control" name="dining_experiences" id="dining_experiences" rows="3"></textarea>
					</div>
				</div>
			</div>
		</div>

		<!-- Botão de Submit -->
		<div class="row">
			<div class="col-12 text-center">
				<button type="button" class="btn btn-primary btn-lg" onclick="javascript:insere_novo_hotel();">Inserir</button>
			</div>
		</div>
	</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
	// Função para serializar o form (se necessário para o JS)
	function getFormData() {
		return $('#hotelForm').serialize();
	}
</script>
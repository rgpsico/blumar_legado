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
		<div class="row g-4">
			<!-- 1. Descrição em Português -->
			<div class="col-md-12">
				<label class="form-label fw-bold">1. Descrição em Português</label>
				<textarea class="form-control" name="descricao_pt" id="descricao_pt" rows="4" placeholder="Descreva o hotel em português..."></textarea>
			</div>

			<!-- 2. Descrição em Inglês -->
			<div class="col-md-12">
				<label class="form-label fw-bold">2. Descrição em Inglês</label>
				<textarea class="form-control" name="descricao_en" id="descricao_en" rows="4" placeholder="Describe the hotel in English..."></textarea>
			</div>

			<!-- 3. Descrição em Espanhol -->
			<div class="col-md-12">
				<label class="form-label fw-bold">3. Descrição em Espanhol</label>
				<textarea class="form-control" name="descricao_esp" id="descricao_esp" rows="4" placeholder="Describe el hotel en español..."></textarea>
			</div>

			<!-- 4. Foto da Fachada -->
			<div class="col-md-6">
				<label class="form-label fw-bold">4. Foto da Fachada (URL)</label>
				<input type="text" class="form-control" name="foto_fachada" id="foto_fachada" placeholder="https://exemplo.com/fachada.jpg">
			</div>

			<!-- 5. Foto da Piscina -->
			<div class="col-md-6">
				<label class="form-label fw-bold">5. Foto da Piscina (URL)</label>
				<input type="text" class="form-control" name="fotopiscina" id="fotopiscina" placeholder="https://exemplo.com/piscina.jpg">
			</div>

			<!-- 6. Mapa Google -->
			<div class="col-md-6">
				<label class="form-label fw-bold">6. Link do Google Maps</label>
				<input type="text" class="form-control" name="htlurl" id="htlurl" placeholder="https://maps.google.com/...">
			</div>

			<!-- 7. Número de Quartos -->
			<div class="col-md-6">
				<label class="form-label fw-bold">7. Número de Quartos</label>
				<input type="text" class="form-control" name="htl_num_quartos" id="htl_num_quartos" placeholder="Ex: 220">
			</div>

			<!-- 8. Classificação de Estrelas -->
			<div class="col-md-4">
				<label class="form-label fw-bold">8. Classificação (Estrelas 1-5)</label>
				<input type="number" class="form-control" name="htlestrelablumar" id="htlestrelablumar" min="1" max="5" placeholder="5">
			</div>

			<!-- 9. É Resort? -->
			<div class="col-md-4">
				<label class="form-label fw-bold">9. É Resort?</label>
				<div class="form-check mt-2">
					<input class="form-check-input" type="checkbox" name="resort" id="resort">
					<label class="form-check-label" for="resort">Sim</label>
				</div>
			</div>

			<!-- 10. Ativo na Internet -->
			<div class="col-md-4">
				<label class="form-label fw-bold">10. Ativo na Internet?</label>
				<div class="form-check mt-2">
					<input class="form-check-input" type="checkbox" name="flaghtl" id="flaghtl">
					<label class="form-check-label" for="flaghtl">Sim</label>
				</div>
			</div>

			<!-- Botões -->
			<div class="col-12 text-center mt-4">
				<button type="button" class="btn btn-primary btn-lg me-2" onclick="javascript:insere_novo_hotelv2();">
					<i class="bi bi-save"></i> Cadastrar Hotel
				</button>
				<button type="button" class="btn btn-secondary btn-lg me-2" id="saveDraft">
					<i class="bi bi-bookmark"></i> Salvar Rascunho
				</button>
				<button type="button" class="btn btn-info btn-lg" id="loadDraft">
					<i class="bi bi-folder-open"></i> Carregar Rascunho
				</button>
			</div>
		</div>
	</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
	// Salvar rascunho
	$('#saveDraft').click(function() {
		const formData = $('#hotelForm').serialize();
		localStorage.setItem('hotelDraft', formData);
		alert('Rascunho salvo com sucesso!');
	});

	// Carregar rascunho
	$('#loadDraft').click(function() {
		const savedData = localStorage.getItem('hotelDraft');
		if (savedData) {
			$('#hotelForm')[0].reset();
			const pairs = savedData.split('&');

			pairs.forEach(function(pair) {
				const [name, value] = pair.split('=');
				const decodedName = decodeURIComponent(name);
				const decodedValue = decodeURIComponent(value || '');
				const $element = $('[name="' + decodedName + '"]');

				if ($element.is(':checkbox')) {
					$element.prop('checked', decodedValue === 'on');
				} else {
					$element.val(decodedValue);
				}
			});

			alert('Rascunho carregado com sucesso!');
		} else {
			alert('Nenhum rascunho encontrado.');
		}
	});

	// Auto-save a cada 5 minutos
	setInterval(function() {
		const formData = $('#hotelForm').serialize();
		localStorage.setItem('hotelDraft', formData);
	}, 300000);
</script>
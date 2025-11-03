<?php
require_once '../util/connection.php';



$cod_venue = (int) $_REQUEST["cod_venue"];

// Default values if no venue found
$cod_venues = '';
$nome = '';
$mneu_for = '';
$fk_cod_cidade = '';
$especialidade = '';
$descritivo_en = '';
$descritivo_pt = '';
$descritivo_esp = '';
$foto1 = '';
$foto2 = '';
$ativo = 'f';
$short_description_pt = '';
$short_description_en = '';
$short_description_es = '';
$insight_pt = '';
$insight_en = '';
$insight_es = '';
$price_range = '';
$capacity_min = '';
$capacity_max = '';
$address_line = '';
$venue_city = '';
$state = '';
$country = '';
$latitude = '';
$longitude = '';
$foto3 = '';
$foto4 = '';
$foto5 = '';
$floor_plan_image = '';
$product_link_url = '';

// Fetch venue data
$pega_venue = "
    SELECT *
    FROM conteudo_internet.venues
    WHERE cod_venues = $cod_venue
";
$result_venue = pg_exec($conn, $pega_venue);

if ($result_venue && pg_numrows($result_venue) > 0) {
	$row = pg_fetch_assoc($result_venue);
	$cod_venues = $row['cod_venues'] ?? '';
	$nome = $row['nome'] ?? '';
	$mneu_for = $row['mneu_for'] ?? '';
	$fk_cod_cidade = $row['fk_cod_cidade'] ?? '';
	$especialidade = $row['especialidade'] ?? '';
	$descritivo_en = $row['descritivo_en'] ?? '';
	$descritivo_pt = $row['descritivo_pt'] ?? '';
	$descritivo_esp = $row['descritivo_esp'] ?? '';
	$foto1 = $row['foto1'] ?? '';
	$foto2 = $row['foto2'] ?? '';
	$ativo = $row['ativo'] ?? 'f';
	$short_description_pt = $row['short_description_pt'] ?? '';
	$short_description_en = $row['short_description_en'] ?? '';
	$short_description_es = $row['short_description_es'] ?? '';
	$insight_pt = $row['insight_pt'] ?? '';
	$insight_en = $row['insight_en'] ?? '';
	$insight_es = $row['insight_es'] ?? '';
	$price_range = $row['price_range'] ?? '';
	$capacity_min = $row['capacity_min'] ?? '';
	$capacity_max = $row['capacity_max'] ?? '';
	$address_line = $row['address_line'] ?? '';
	$venue_city = $row['city'] ?? '';
	$state = $row['state'] ?? '';
	$country = $row['country'] ?? '';
	$latitude = $row['latitude'] ?? '';
	$longitude = $row['longitude'] ?? '';
	$foto3 = $row['foto3'] ?? '';
	$foto4 = $row['foto4'] ?? '';
	$foto5 = $row['foto5'] ?? '';
	$floor_plan_image = $row['floor_plan_image'] ?? '';
	$product_link_url = $row['product_link_url'] ?? '';
}

// Fetch all cities
$lista_cidades = "
    SELECT *
    FROM tarifario.cidade_tpo
    ORDER BY nome_pt ASC
";
$result_cid = pg_exec($conn, $lista_cidades);
$cities = [];
if ($result_cid) {
	while ($row = pg_fetch_assoc($result_cid)) {
		$cities[] = $row;
	}
}

// Fetch current city for selected option
$current_city = null;
if ($fk_cod_cidade) {
	$cidade_rest = "
        SELECT *
        FROM tarifario.cidade_tpo
        WHERE cidade_cod = $fk_cod_cidade
    ";
	$result_cidade_rest = pg_exec($conn, $cidade_rest);
	if ($result_cidade_rest && pg_numrows($result_cidade_rest) > 0) {
		$current_city = pg_fetch_assoc($result_cidade_rest);
	}
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Editar Venue</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
			background-color: #f5f7fa;
			padding: 20px;
		}

		.form-container {
			max-width: 1200px;
			margin: 0 auto;
			background: white;
			border-radius: 12px;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
			overflow: hidden;
		}

		.form-header {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			padding: 30px;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.form-header h1 {
			font-size: 28px;
			margin: 0;
		}

		.btn-back {
			background: rgba(255, 255, 255, 0.2);
			color: white;
			border: 2px solid white;
			padding: 10px 20px;
			border-radius: 6px;
			cursor: pointer;
			font-size: 14px;
			font-weight: 500;
			transition: all 0.3s ease;
		}

		.btn-back:hover {
			background: white;
			color: #667eea;
		}

		.tabs {
			display: flex;
			background: #f7fafc;
			border-bottom: 2px solid #e2e8f0;
			overflow-x: auto;
		}

		.tab {
			padding: 15px 30px;
			cursor: pointer;
			font-weight: 500;
			color: #718096;
			border-bottom: 3px solid transparent;
			transition: all 0.3s ease;
			white-space: nowrap;
		}

		.tab:hover {
			background: #edf2f7;
			color: #4a5568;
		}

		.tab.active {
			color: #667eea;
			border-bottom-color: #667eea;
			background: white;
		}

		.tab-content {
			display: none;
			padding: 30px;
			animation: fadeIn 0.3s ease;
		}

		.tab-content.active {
			display: block;
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

		.form-section {
			margin-bottom: 30px;
		}

		.section-title {
			font-size: 18px;
			font-weight: 600;
			color: #2d3748;
			margin-bottom: 20px;
			padding-bottom: 10px;
			border-bottom: 2px solid #e2e8f0;
		}

		.form-row {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
			gap: 20px;
			margin-bottom: 20px;
		}

		.form-group {
			display: flex;
			flex-direction: column;
			gap: 8px;
		}

		.form-group.full-width {
			grid-column: 1 / -1;
		}

		label {
			font-size: 14px;
			font-weight: 600;
			color: #4a5568;
		}

		label .required {
			color: #f56565;
		}

		label .hint {
			font-weight: 400;
			color: #718096;
			font-size: 12px;
		}

		input[type="text"],
		input[type="number"],
		select,
		textarea {
			padding: 10px 12px;
			border: 1px solid #e2e8f0;
			border-radius: 6px;
			font-size: 14px;
			transition: all 0.3s ease;
			font-family: inherit;
		}

		input[type="text"]:focus,
		input[type="number"]:focus,
		select:focus,
		textarea:focus {
			outline: none;
			border-color: #667eea;
			box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
		}

		textarea {
			resize: vertical;
			min-height: 100px;
		}

		.char-counter {
			font-size: 12px;
			color: #718096;
			text-align: right;
			margin-top: -5px;
		}

		.translate-group {
			display: flex;
			align-items: flex-end;
			gap: 10px;
		}

		.translate-group .form-group {
			flex: 1;
		}

		.btn-translate {
			background: #48bb78;
			color: white;
			border: none;
			padding: 10px 20px;
			border-radius: 6px;
			cursor: pointer;
			font-size: 14px;
			font-weight: 500;
			display: flex;
			align-items: center;
			gap: 8px;
			transition: all 0.3s ease;
			white-space: nowrap;
			height: 42px;
		}

		.btn-translate:hover {
			background: #38a169;
			transform: translateY(-1px);
			box-shadow: 0 4px 8px rgba(72, 187, 120, 0.3);
		}

		.btn-translate:disabled {
			background: #cbd5e0;
			cursor: not-allowed;
			transform: none;
		}

		.loading-spinner {
			display: inline-block;
			width: 14px;
			height: 14px;
			border: 2px solid rgba(255, 255, 255, 0.3);
			border-top-color: white;
			border-radius: 50%;
			animation: spin 0.8s linear infinite;
		}

		@keyframes spin {
			to {
				transform: rotate(360deg);
			}
		}

		.image-preview-group {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
			gap: 15px;
		}

		.image-preview-item {
			display: flex;
			flex-direction: column;
			gap: 10px;
		}

		.image-preview {
			width: 100%;
			height: 150px;
			border-radius: 8px;
			object-fit: cover;
			border: 2px solid #e2e8f0;
			background: #f7fafc;
		}

		.image-placeholder {
			width: 100%;
			height: 150px;
			border-radius: 8px;
			border: 2px dashed #cbd5e0;
			display: flex;
			align-items: center;
			justify-content: center;
			color: #a0aec0;
			font-size: 48px;
			background: #f7fafc;
		}

		.checkbox-group {
			display: flex;
			align-items: center;
			gap: 10px;
			padding: 15px;
			background: #f7fafc;
			border-radius: 8px;
			border: 2px solid #e2e8f0;
		}

		.checkbox-group input[type="checkbox"] {
			width: 20px;
			height: 20px;
			cursor: pointer;
		}

		.checkbox-group label {
			font-size: 14px;
			margin: 0;
			cursor: pointer;
			flex: 1;
		}

		.form-actions {
			position: sticky;
			bottom: 0;
			background: white;
			padding: 20px 30px;
			border-top: 2px solid #e2e8f0;
			display: flex;
			gap: 15px;
			justify-content: flex-end;
			box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
		}

		.btn {
			padding: 12px 30px;
			border: none;
			border-radius: 6px;
			cursor: pointer;
			font-size: 14px;
			font-weight: 500;
			transition: all 0.3s ease;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.btn-primary {
			background: #667eea;
			color: white;
		}

		.btn-primary:hover {
			background: #5568d3;
			transform: translateY(-1px);
			box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
		}

		.btn-secondary {
			background: #e2e8f0;
			color: #4a5568;
		}

		.btn-secondary:hover {
			background: #cbd5e0;
		}

		.alert {
			padding: 15px 20px;
			border-radius: 8px;
			margin-bottom: 20px;
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.alert-success {
			background: #c6f6d5;
			color: #22543d;
			border: 1px solid #9ae6b4;
		}

		.alert-error {
			background: #fed7d7;
			color: #742a2a;
			border: 1px solid #fc8181;
		}

		.alert-info {
			background: #bee3f8;
			color: #2c5282;
			border: 1px solid #90cdf4;
		}

		@media (max-width: 768px) {
			.form-row {
				grid-template-columns: 1fr;
			}

			.tabs {
				flex-wrap: nowrap;
			}

			.tab {
				font-size: 13px;
				padding: 12px 15px;
			}

			.form-actions {
				flex-direction: column;
			}

			.btn {
				width: 100%;
				justify-content: center;
			}
		}

		.map-preview {
			width: 100%;
			height: 300px;
			border-radius: 8px;
			border: 2px solid #e2e8f0;
			margin-top: 10px;
		}
	</style>
</head>

<body>
	<div class="form-container">
		<div class="form-header">
			<div>
				<h1>✏️ Editar Venue</h1>
				<p style="opacity: 0.9; margin-top: 5px;"><?php echo htmlspecialchars($nome); ?></p>
			</div>
			<button class="btn-back" onclick="acao_venuesv2()">← Voltar</button>
		</div>

		<div class="tabs">
			<div class="tab active" onclick="switchTab(0)">
				<span>📋</span> Informações Básicas
			</div>
			<div class="tab" onclick="switchTab(1)">
				<span>🌍</span> Descrições
			</div>
			<div class="tab" onclick="switchTab(2)">
				<span>📍</span> Localização
			</div>
			<div class="tab" onclick="switchTab(3)">
				<span>📸</span> Imagens
			</div>
			<div class="tab" onclick="switchTab(4)">
				<span>⚙️</span> Configurações
			</div>
		</div>

		<form id="venueForm">
			<!-- Tab 1: Informações Básicas -->
			<div class="tab-content active">
				<div class="form-section">
					<h3 class="section-title">Informações Principais</h3>
					<div class="form-row">
						<div class="form-group">
							<label for="nome">Nome do Venue <span class="required">*</span></label>
							<input type="text" id="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
						</div>
						<div class="form-group">
							<label for="mneu_for">Código MNEU_FOR</label>
							<input type="text" id="mneu_for" maxlength="4" value="<?php echo htmlspecialchars($mneu_for); ?>">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group">
							<label for="especialidade">Especialidade / Tipo</label>
							<input type="text" id="especialidade" value="<?php echo htmlspecialchars($especialidade); ?>" placeholder="Ex: Restaurante, Hotel, Centro de Eventos">
						</div>
						<div class="form-group">
							<label for="citie">Cidade (Sistema Legado)</label>
							<select id="citie">
								<?php if ($current_city): ?>
									<option value="<?php echo htmlspecialchars($current_city['cidade_cod']); ?>" selected>
										<?php echo htmlspecialchars($current_city['nome_en']); ?>
									</option>
								<?php endif; ?>
								<option value="0">--------------------</option>
								<?php foreach ($cities as $city): ?>
									<option value="<?php echo htmlspecialchars($city['cidade_cod']); ?>">
										<?php echo htmlspecialchars($city['nome_en']); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>

				<div class="form-section">
					<h3 class="section-title">Capacidade e Preços</h3>
					<div class="form-row">
						<div class="form-group">
							<label for="capacity_min">Capacidade Mínima</label>
							<input type="number" id="capacity_min" value="<?php echo htmlspecialchars($capacity_min); ?>" placeholder="Ex: 50">
						</div>
						<div class="form-group">
							<label for="capacity_max">Capacidade Máxima</label>
							<input type="number" id="capacity_max" value="<?php echo htmlspecialchars($capacity_max); ?>" placeholder="Ex: 500">
						</div>
						<div class="form-group">
							<label for="price_range">Faixa de Preço</label>
							<input type="text" id="price_range" value="<?php echo htmlspecialchars($price_range); ?>" placeholder="Ex: $$ ou R$ 1000-5000">
						</div>
					</div>
				</div>
			</div>

			<!-- Tab 2: Descrições -->
			<div class="tab-content">
				<div class="form-section">
					<h3 class="section-title">Descrições Completas</h3>

					<div class="translate-group" style="margin-bottom: 20px;">
						<div class="form-group full-width">
							<label for="descritivo_pt">Descrição Completa (Português) <span class="required">*</span></label>
							<textarea id="descritivo_pt" rows="5" maxlength="2000"><?php echo htmlspecialchars($descritivo_pt); ?></textarea>
							<div class="char-counter">
								<span id="desc_pt_count"><?php echo strlen($descritivo_pt); ?></span>/2000 caracteres
							</div>
						</div>
						<button type="button" class="btn-translate" onclick="translateText($('#descritivo_pt').val())" id="btnTranslate">
							🌐 Traduzir
						</button>
					</div>

					<div class="form-row">
						<div class="form-group">
							<label for="descritivo_en">Descrição Completa (Inglês)</label>
							<textarea id="descritivo_en" rows="5" maxlength="2000"><?php echo htmlspecialchars($descritivo_en); ?></textarea>
							<div class="char-counter">
								<span id="desc_en_count"><?php echo strlen($descritivo_en); ?></span>/2000 caracteres
							</div>
						</div>
						<div class="form-group">
							<label for="descritivo_esp">Descrição Completa (Espanhol)</label>
							<textarea id="descritivo_esp" rows="5" maxlength="2000"><?php echo htmlspecialchars($descritivo_esp); ?></textarea>
							<div class="char-counter">
								<span id="desc_esp_count"><?php echo strlen($descritivo_esp); ?></span>/2000 caracteres
							</div>
						</div>
					</div>
				</div>

				<div class="form-section">
					<h3 class="section-title">Descrições Curtas</h3>
					<div class="form-row">
						<div class="form-group">
							<label for="short_description_pt">Descrição Curta (PT) <span class="hint">- Max 160 caracteres</span></label>
							<textarea id="short_description_pt" rows="2" maxlength="160"><?php echo htmlspecialchars($short_description_pt); ?></textarea>
							<div class="char-counter">
								<span id="short_pt_count"><?php echo strlen($short_description_pt); ?></span>/160 caracteres
							</div>
						</div>
						<div class="form-group">
							<label for="short_description_en">Descrição Curta (EN)</label>
							<textarea id="short_description_en" rows="2" maxlength="160"><?php echo htmlspecialchars($short_description_en); ?></textarea>
							<div class="char-counter">
								<span id="short_en_count"><?php echo strlen($short_description_en); ?></span>/160 caracteres
							</div>
						</div>
						<div class="form-group">
							<label for="short_description_es">Descrição Curta (ES)</label>
							<textarea id="short_description_es" rows="2" maxlength="160"><?php echo htmlspecialchars($short_description_es); ?></textarea>
							<div class="char-counter">
								<span id="short_es_count"><?php echo strlen($short_description_es); ?></span>/160 caracteres
							</div>
						</div>
					</div>
				</div>

				<div class="form-section">
					<h3 class="section-title">Insights / Destaques</h3>
					<div class="form-row">
						<div class="form-group">
							<label for="insight_pt">Insight (PT) <span class="hint">- Ponto de destaque</span></label>
							<textarea id="insight_pt" rows="3" maxlength="500"><?php echo htmlspecialchars($insight_pt); ?></textarea>
						</div>
						<div class="form-group">
							<label for="insight_en">Insight (EN)</label>
							<textarea id="insight_en" rows="3" maxlength="500"><?php echo htmlspecialchars($insight_en); ?></textarea>
						</div>
						<div class="form-group">
							<label for="insight_es">Insight (ES)</label>
							<textarea id="insight_es" rows="3" maxlength="500"><?php echo htmlspecialchars($insight_es); ?></textarea>
						</div>
					</div>
				</div>
			</div>

			<!-- Tab 3: Localização -->
			<div class="tab-content">
				<div class="form-section">
					<h3 class="section-title">Endereço Completo</h3>
					<div class="form-row">
						<div class="form-group full-width">
							<label for="address_line">Endereço Completo</label>
							<input type="text" id="address_line" value="<?php echo htmlspecialchars($address_line); ?>" placeholder="Rua, número, complemento">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group">
							<label for="venue_city">Cidade</label>
							<input type="text" id="venue_city" value="<?php echo htmlspecialchars($venue_city); ?>" placeholder="Ex: São Paulo">
						</div>
						<div class="form-group">
							<label for="state">Estado/Província</label>
							<input type="text" id="state" value="<?php echo htmlspecialchars($state); ?>" placeholder="Ex: SP">
						</div>
						<div class="form-group">
							<label for="country">País</label>
							<input type="text" id="country" value="<?php echo htmlspecialchars($country); ?>" placeholder="Ex: Brasil">
						</div>
					</div>
				</div>

				<div class="form-section">
					<h3 class="section-title">Coordenadas GPS</h3>
					<div class="form-row">
						<div class="form-group">
							<label for="latitude">Latitude</label>
							<input type="number" step="any" id="latitude" value="<?php echo htmlspecialchars($latitude); ?>" placeholder="Ex: -23.5505">
						</div>
						<div class="form-group">
							<label for="longitude">Longitude</label>
							<input type="number" step="any" id="longitude" value="<?php echo htmlspecialchars($longitude); ?>" placeholder="Ex: -46.6333">
						</div>
					</div>
					<?php if ($latitude && $longitude): ?>
						<div id="mapPreview" class="map-preview"></div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Tab 4: Imagens -->
			<div class="tab-content">
				<div class="form-section">
					<h3 class="section-title">Fotos do Venue</h3>
					<div class="alert alert-info">
						ℹ️ Adicione URLs das imagens. As imagens serão exibidas no site e materiais promocionais.
					</div>

					<div class="image-preview-group">
						<?php for ($i = 1; $i <= 5; $i++):
							$foto_var = "foto{$i}";
							$foto_value = $$foto_var;
						?>
							<div class="image-preview-item">
								<label for="foto<?php echo $i; ?>">Foto <?php echo $i; ?></label>
								<?php if ($foto_value): ?>
									<img src="<?php echo htmlspecialchars($foto_value); ?>" alt="Foto <?php echo $i; ?>" class="image-preview" id="preview_foto<?php echo $i; ?>">
								<?php else: ?>
									<div class="image-placeholder" id="preview_foto<?php echo $i; ?>">🖼️</div>
								<?php endif; ?>
								<input type="text" id="foto<?php echo $i; ?>" value="<?php echo htmlspecialchars($foto_value); ?>" placeholder="URL da imagem" oninput="updateImagePreview(<?php echo $i; ?>)">
							</div>
						<?php endfor; ?>
					</div>
				</div>

				<div class="form-section">
					<h3 class="section-title">Planta Baixa</h3>
					<div class="form-row">
						<div class="form-group full-width">
							<label for="floor_plan_image">Imagem da Planta Baixa</label>
							<?php if ($floor_plan_image): ?>
								<img src="<?php echo htmlspecialchars($floor_plan_image); ?>" alt="Planta Baixa" class="image-preview" id="preview_floor_plan" style="max-width: 400px;">
							<?php else: ?>
								<div class="image-placeholder" id="preview_floor_plan" style="max-width: 400px;">📐</div>
							<?php endif; ?>
							<input type="text" id="floor_plan_image" value="<?php echo htmlspecialchars($floor_plan_image); ?>" placeholder="URL da planta baixa" oninput="updateFloorPlanPreview()">
						</div>
					</div>
				</div>
			</div>

			<!-- Tab 5: Configurações -->
			<div class="tab-content">
				<div class="form-section">
					<h3 class="section-title">Links e Integrações</h3>
					<div class="form-row">
						<div class="form-group full-width">
							<label for="product_link_url">Link do Produto/Página</label>
							<input type="text" id="product_link_url" value="<?php echo htmlspecialchars($product_link_url); ?>" placeholder="https://...">
						</div>
					</div>
				</div>

				<div class="form-section">
					<h3 class="section-title">Status de Publicação</h3>
					<div class="checkbox-group">
						<input type="checkbox" id="ativo" <?php echo ($ativo == 't') ? 'checked' : ''; ?>>
						<label for="ativo">
							<strong>Ativo na Internet</strong><br>
							<span style="font-size: 13px; color: #718096;">Quando marcado, o venue ficará visível no site público</span>
						</label>
					</div>
				</div>
			</div>

			<input type="hidden" id="cod_venues" value="<?php echo htmlspecialchars($cod_venues); ?>">
		</form>

		<div class="form-actions">
			<button type="button" class="btn btn-secondary" onclick="acao_venuesv2()">
				✕ Cancelar
			</button>
			<button type="button" class="btn btn-primary" onclick="update_venue()">
				💾 Salvar Alterações
			</button>
		</div>
	</div>

	<script>
		// Switch entre tabs
		function switchTab(index) {
			const tabs = document.querySelectorAll('.tab');
			const contents = document.querySelectorAll('.tab-content');

			tabs.forEach((tab, i) => {
				if (i === index) {
					tab.classList.add('active');
					contents[i].classList.add('active');
				} else {
					tab.classList.remove('active');
					contents[i].classList.remove('active');
				}
			});
		}

		// Character counters
		function setupCharCounters() {
			const fields = [{
					id: 'descritivo_pt',
					counter: 'desc_pt_count'
				},
				{
					id: 'descritivo_en',
					counter: 'desc_en_count'
				},
				{
					id: 'descritivo_esp',
					counter: 'desc_esp_count'
				},
				{
					id: 'short_description_pt',
					counter: 'short_pt_count'
				},
				{
					id: 'short_description_en',
					counter: 'short_en_count'
				},
				{
					id: 'short_description_es',
					counter: 'short_es_count'
				}
			];

			fields.forEach(field => {
				$('#' + field.id).on('input', function() {
					$('#' + field.counter).text($(this).val().length);
				});
			});
		}

		// Update image preview
		function updateImagePreview(index) {
			const url = $('#foto' + index).val();
			const preview = $('#preview_foto' + index);

			if (url) {
				preview.replaceWith(`<img src="${url}" alt="Foto ${index}" class="image-preview" id="preview_foto${index}" onerror="this.onerror=null; this.src=''; this.outerHTML='<div class=\\'image-placeholder\\' id=\\'preview_foto${index}\\'>❌</div>';">`);
			} else {
				preview.replaceWith(`<div class="image-placeholder" id="preview_foto${index}">🖼️</div>`);
			}
		}

		// Update floor plan preview
		function updateFloorPlanPreview() {
			const url = $('#floor_plan_image').val();
			const preview = $('#preview_floor_plan');

			if (url) {
				preview.replaceWith(`<img src="${url}" alt="Planta Baixa" class="image-preview" id="preview_floor_plan" style="max-width: 400px;" onerror="this.onerror=null; this.outerHTML='<div class=\\'image-placeholder\\' id=\\'preview_floor_plan\\' style=\\'max-width: 400px;\\'>❌</div>';">`);
			} else {
				preview.replaceWith(`<div class="image-placeholder" id="preview_floor_plan" style="max-width: 400px;">📐</div>`);
			}
		}

		// Tradução automática
		function translateText(text) {
			if (!text.trim()) {
				alert('Por favor, insira um texto em português para traduzir.');
				return;
			}

			const btn = $('#btnTranslate');
			btn.prop('disabled', true);
			btn.html('<span class="loading-spinner"></span> Traduzindo...');

			const token = 'sk-759b7002f685438685f482786fe20967';
			$.ajax({
				url: 'https://api.deepseek.com/v1/chat/completions',
				method: 'POST',
				contentType: 'application/json',
				headers: {
					'Authorization': `Bearer ${token}`
				},
				data: JSON.stringify({
					model: 'deepseek-chat',
					messages: [{
						role: 'user',
						content: `Traduza o texto a seguir para inglês (en) e espanhol (es), de forma separada e precisa. Retorne apenas um objeto JSON válido no formato: {"en": "tradução em inglês", "es": "tradução em espanhol"}. Não adicione explicações extras.\n\nTexto: ${text}`
					}],
					temperature: 0.1,
					max_tokens: 1000
				}),
				success: function(response) {
					try {
						let content = response.choices[0].message.content;
						content = content.replace(/```json\s*/g, '').replace(/```\s*$/g, '').trim();
						const translatedJson = JSON.parse(content);

						if (translatedJson.en) {
							$('#descritivo_en').val(translatedJson.en);
							$('#desc_en_count').text(translatedJson.en.length);
						}
						if (translatedJson.es) {
							$('#descritivo_esp').val(translatedJson.es);
							$('#desc_esp_count').text(translatedJson.es.length);
						}

						// Show success message
						showAlert('success', '✓ Tradução concluída com sucesso!');
					} catch (parseError) {
						console.error('Erro ao parsear resposta JSON:', parseError);
						showAlert('error', '❌ Erro ao processar a tradução.');
					}
				},
				error: function(err) {
					console.error('Erro na tradução automática:', err);
					showAlert('error', '❌ Erro na API do DeepSeek. Verifique o token e a configuração.');
				},
				complete: function() {
					btn.prop('disabled', false);
					btn.html('🌐 Traduzir');
				}
			});
		}

		// Show alert
		function showAlert(type, message) {
			const alertHtml = `
				<div class="alert alert-${type}" style="position: fixed; top: 20px; right: 20px; z-index: 9999; animation: slideIn 0.3s ease;">
					${message}
				</div>
			`;
			$('body').append(alertHtml);
			setTimeout(() => {
				$('.alert').fadeOut(300, function() {
					$(this).remove();
				});
			}, 3000);
		}

		// Initialize
		$(document).ready(function() {
			setupCharCounters();
		});
	</script>
</body>

</html>
<?php
require_once '../util/connection.php';

$cod_venue = (int) $_GET["cod_venue"];

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
	$venue_city = $row['city'] ?? ''; // Note: 'venue_city' maps to 'city' in DB
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
<html lang="pt">

<head>
	<meta charset="UTF-8">
	<title>Cadastro de Venue</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
		}

		h1,
		h4 {
			color: #333;
		}

		textarea {
			width: 100%;
			max-width: 600px;
		}

		input[type="text"],
		input[type="number"],
		select {
			width: 100%;
			max-width: 600px;
			margin-bottom: 10px;
		}

		label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}

		.section {
			margin-bottom: 30px;
		}

		#loading {
			display: none;
			color: #007bff;
			font-style: italic;
		}

		button {
			margin-left: 10px;
			padding: 5px 10px;
		}
	</style>
</head>

<body>
	<h1>Cadastro de Venue</h1>

	<form id="venueForm">
		<div class="section">
			<label for="mneu_for">MNEU_FOR:</label>
			<input type="text" id="mneu_for" maxlength="4" value="<?php echo htmlspecialchars($mneu_for); ?>" size="4">
		</div>

		<div class="section">
			<label for="nome">Nome:</label>
			<input type="text" id="nome" value="<?php echo htmlspecialchars($nome); ?>" size="60">
		</div>

		<div class="section">
			<label for="citie">Selecione uma Cidade:</label>
			<select id="citie">
				<?php if ($current_city): ?>
					<option value="<?php echo htmlspecialchars($current_city['cidade_cod']); ?>" selected>
						<?php echo htmlspecialchars($current_city['nome_en']); ?>
					</option>
					<option value="0">--------------------</option>
				<?php endif; ?>
				<?php foreach ($cities as $city): ?>
					<option value="<?php echo htmlspecialchars($city['cidade_cod']); ?>">
						<?php echo htmlspecialchars($city['nome_en']); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="section">
			<label for="especialidade">Especialidade:</label>
			<input type="text" id="especialidade" value="<?php echo htmlspecialchars($especialidade); ?>" size="60">
		</div>

		<div class="section">
			<label for="descritivo_pt">Descritivo em Português:</label>
			<textarea id="descritivo_pt" rows="4"><?php echo htmlspecialchars($descritivo_pt); ?></textarea>
			<button type="button" onclick="translateText($('#descritivo_pt').val())">Traduzir com IA</button>
			<div id="loading">Traduzindo...</div>
		</div>

		<div class="section">
			<label for="descritivo_en">Descritivo em Inglês:</label>
			<textarea id="descritivo_en" rows="4"><?php echo htmlspecialchars($descritivo_en); ?></textarea>
		</div>



		<div class="section">
			<label for="descritivo_esp">Descritivo em Espanhol:</label>
			<textarea id="descritivo_esp" rows="4"><?php echo htmlspecialchars($descritivo_esp); ?></textarea>
		</div>

		<h4>Short Descriptions</h4>
		<div class="section">
			<label for="short_description_pt">Short Description PT:</label>
			<textarea id="short_description_pt" rows="2"><?php echo htmlspecialchars($short_description_pt); ?></textarea>
		</div>
		<div class="section">
			<label for="short_description_en">Short Description EN:</label>
			<textarea id="short_description_en" rows="2"><?php echo htmlspecialchars($short_description_en); ?></textarea>
		</div>
		<div class="section">
			<label for="short_description_es">Short Description ES:</label>
			<textarea id="short_description_es" rows="2"><?php echo htmlspecialchars($short_description_es); ?></textarea>
		</div>

		<h4>Insights</h4>
		<div class="section">
			<label for="insight_pt">Insight PT:</label>
			<textarea id="insight_pt" rows="3"><?php echo htmlspecialchars($insight_pt); ?></textarea>
		</div>
		<div class="section">
			<label for="insight_en">Insight EN:</label>
			<textarea id="insight_en" rows="3"><?php echo htmlspecialchars($insight_en); ?></textarea>
		</div>
		<div class="section">
			<label for="insight_es">Insight ES:</label>
			<textarea id="insight_es" rows="3"><?php echo htmlspecialchars($insight_es); ?></textarea>
		</div>

		<h4>Pricing & Capacity</h4>
		<div class="section">
			<label for="price_range">Price Range:</label>
			<input type="text" id="price_range" value="<?php echo htmlspecialchars($price_range); ?>" size="60">
		</div>
		<div class="section">
			<label for="capacity_min">Capacity Min:</label>
			<input type="number" id="capacity_min" value="<?php echo ($capacity_min ? htmlspecialchars($capacity_min) : ''); ?>" size="10">
		</div>
		<div class="section">
			<label for="capacity_max">Capacity Max:</label>
			<input type="number" id="capacity_max" value="<?php echo ($capacity_max ? htmlspecialchars($capacity_max) : ''); ?>" size="10">
		</div>

		<h4>Address</h4>
		<div class="section">
			<label for="address_line">Address Line:</label>
			<input type="text" id="address_line" value="<?php echo htmlspecialchars($address_line); ?>" size="60">
		</div>
		<div class="section">
			<label for="venue_city">Venue City:</label>
			<input type="text" id="venue_city" value="<?php echo htmlspecialchars($venue_city); ?>" size="60">
		</div>
		<div class="section">
			<label for="state">State:</label>
			<input type="text" id="state" value="<?php echo htmlspecialchars($state); ?>" size="60">
		</div>
		<div class="section">
			<label for="country">Country:</label>
			<input type="text" id="country" value="<?php echo htmlspecialchars($country); ?>" size="60">
		</div>

		<h4>Coordinates</h4>
		<div class="section">
			<label for="latitude">Latitude:</label>
			<input type="number" step="any" id="latitude" value="<?php echo ($latitude ? htmlspecialchars($latitude) : ''); ?>" size="20">
		</div>
		<div class="section">
			<label for="longitude">Longitude:</label>
			<input type="number" step="any" id="longitude" value="<?php echo ($longitude ? htmlspecialchars($longitude) : ''); ?>" size="20">
		</div>

		<h4>Photos</h4>
		<div class="section">
			<label for="foto1">Foto 1:</label>
			<input type="text" id="foto1" maxlength="100" value="<?php echo htmlspecialchars($foto1); ?>" size="60">
		</div>
		<div class="section">
			<label for="foto2">Foto 2:</label>
			<input type="text" id="foto2" maxlength="100" value="<?php echo htmlspecialchars($foto2); ?>" size="60">
		</div>
		<div class="section">
			<label for="foto3">Foto 3:</label>
			<input type="text" id="foto3" maxlength="100" value="<?php echo htmlspecialchars($foto3); ?>" size="60">
		</div>
		<div class="section">
			<label for="foto4">Foto 4:</label>
			<input type="text" id="foto4" maxlength="100" value="<?php echo htmlspecialchars($foto4); ?>" size="60">
		</div>
		<div class="section">
			<label for="foto5">Foto 5:</label>
			<input type="text" id="foto5" maxlength="100" value="<?php echo htmlspecialchars($foto5); ?>" size="60">
		</div>
		<div class="section">
			<label for="floor_plan_image">Floor Plan Image:</label>
			<input type="text" id="floor_plan_image" maxlength="100" value="<?php echo htmlspecialchars($floor_plan_image); ?>" size="60">
		</div>

		<h4>Other</h4>
		<div class="section">
			<label for="product_link_url">Product Link URL:</label>
			<input type="text" id="product_link_url" value="<?php echo htmlspecialchars($product_link_url); ?>" size="60">
		</div>

		<div class="section">
			<label>
				<input type="checkbox" id="ativo" <?php echo ($ativo == 't') ? 'checked' : ''; ?>>
				Ativo na Internet <small>(Irá aparecer na internet se marcado)</small>
			</label>
		</div>

		<input type="hidden" id="cod_venues" value="<?php echo htmlspecialchars($cod_venues); ?>">

		<div class="section">
			<input type="button" value="Inserir" onclick="javascript:update_venue();">
		</div>
	</form>

	<script>
		function translateText(text) {
			if (!text.trim()) {
				alert('Por favor, insira um texto em português para traduzir.');
				return;
			}

			// Mostrar loading
			$('#loading').show();

			const token = 'sk-759b7002f685438685f482786fe20967'; // Coloque seu token real aqui (mantenha seguro!)
			$.ajax({
				url: 'https://api.deepseek.com/v1/chat/completions', // Endpoint correto
				method: 'POST',
				contentType: 'application/json',
				headers: {
					'Authorization': `Bearer ${token}`
				},
				data: JSON.stringify({
					model: 'deepseek-chat', // Modelo recomendado para tradução
					messages: [{
						role: 'user',
						content: `Traduza o texto a seguir para inglês (en) e espanhol (es), de forma separada e precisa. Retorne apenas um objeto JSON válido no formato: {"en": "tradução em inglês", "es": "tradução em espanhol"}. Não adicione explicações extras.\n\nTexto: ${text}`
					}],
					temperature: 0.1, // Baixa temperatura para consistência
					max_tokens: 1000 // Limite para evitar respostas longas
				}),
				success: function(response) {
					// A resposta vem em choices[0].message.content como string (possivelmente com Markdown)
					try {
						let content = response.choices[0].message.content;
						// Limpa blocos de código Markdown (```json
						content = content.replace(/```json\s*/g, '').replace(/```\s*$/g, '').trim();
						const translatedJson = JSON.parse(content);
						if (translatedJson.en) $('#descritivo_en').val(translatedJson.en);
						if (translatedJson.es) $('#descritivo_esp').val(translatedJson.es);
					} catch (parseError) {
						console.error('Erro ao parsear resposta JSON:', parseError);
						// Log adicional para debug: console.log('Conteúdo bruto:', response.choices[0].message.content);
						alert('Erro ao processar a tradução. Verifique o console para detalhes.');
					}
				},
				error: function(err) {
					console.error('Erro na tradução automática:', err);
					// Opcional: Mostrar alerta ao usuário
					alert('Erro na API do DeepSeek. Verifique o token e a configuração.');
				},
				complete: function() {
					// Esconder loading ao final (sucesso ou erro)
					$('#loading').hide();
				}
			});
		}

		// Assuming update_venue() is defined elsewhere
	</script>

</body>

</html>
<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
require_once '../util/connection.php';

// Configuração de paginação
$items_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

// Filtros
$search = isset($_GET['search']) ? pg_escape_string($conn, $_GET['search']) : '';
$filter_city = isset($_GET['city']) ? pg_escape_string($conn, $_GET['city']) : '';
$filter_active = isset($_GET['active']) ? $_GET['active'] : '';

// Query base
$where_clauses = [];
if ($search) {
	$where_clauses[] = "(nome ILIKE '%{$search}%' OR especialidade ILIKE '%{$search}%')";
}
if ($filter_city) {
	$where_clauses[] = "city = '{$filter_city}'";
}
if ($filter_active !== '') {
	$where_clauses[] = "ativo = " . ($filter_active === '1' ? 'true' : 'false');
}

$where_sql = !empty($where_clauses) ? 'WHERE ' . implode(' AND ', $where_clauses) : '';

// Count total
$count_query = "SELECT COUNT(*) as total FROM conteudo_internet.venues {$where_sql}";
$count_result = pg_exec($conn, $count_query);
$total_items = pg_result($count_result, 0, 'total');
$total_pages = ceil($total_items / $items_per_page);

// Query principal
$pega_venue = "
    SELECT 
        cod_venues, nome, especialidade, short_description_pt,
        city, state, country, ativo, foto1, capacity_min, capacity_max, price_range
    FROM conteudo_internet.venues
    {$where_sql}
    ORDER BY nome
    LIMIT {$items_per_page} OFFSET {$offset}
";

// Query para cidades (para o filtro)
$cities_query = "SELECT DISTINCT city FROM conteudo_internet.venues WHERE city IS NOT NULL ORDER BY city";
$cities_result = pg_exec($conn, $cities_query);
?>

<style>
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	.venues-container {
		font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
		background-color: #f5f7fa;
		color: #2c3e50;
		padding: 20px;
	}

	.venues-header {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		padding: 30px;
		border-radius: 12px;
		margin-bottom: 30px;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
	}

	.venues-header h1 {
		font-size: 28px;
		margin-bottom: 10px;
	}

	.venues-header p {
		opacity: 0.9;
		font-size: 14px;
	}

	.venues-toolbar {
		background: white;
		padding: 20px;
		border-radius: 12px;
		margin-bottom: 20px;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
		display: flex;
		flex-wrap: wrap;
		gap: 15px;
		align-items: center;
	}

	.venues-btn {
		padding: 10px 20px;
		border: none;
		border-radius: 6px;
		cursor: pointer;
		font-size: 14px;
		font-weight: 500;
		transition: all 0.3s ease;
		text-decoration: none;
		display: inline-flex;
		align-items: center;
		gap: 8px;
	}

	.venues-btn-primary {
		background: #667eea;
		color: white;
	}

	.venues-btn-primary:hover {
		background: #5568d3;
		transform: translateY(-1px);
		box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
	}

	.venues-btn-success {
		background: #48bb78;
		color: white;
	}

	.venues-btn-warning {
		background: #ed8936;
		color: white;
		padding: 6px 12px;
		font-size: 12px;
	}

	.venues-btn-danger {
		background: #f56565;
		color: white;
		padding: 6px 12px;
		font-size: 12px;
	}

	.venues-btn-info {
		background: #4299e1;
		color: white;
		padding: 6px 12px;
		font-size: 12px;
	}

	.venues-filters {
		display: flex;
		flex-wrap: wrap;
		gap: 15px;
		flex: 1;
	}

	.venues-filter-group {
		display: flex;
		flex-direction: column;
		gap: 5px;
	}

	.venues-filter-group label {
		font-size: 12px;
		font-weight: 600;
		color: #4a5568;
	}

	.venues-filter-group input,
	.venues-filter-group select {
		padding: 8px 12px;
		border: 1px solid #e2e8f0;
		border-radius: 6px;
		font-size: 14px;
		min-width: 200px;
	}

	.venues-filter-group input:focus,
	.venues-filter-group select:focus {
		outline: none;
		border-color: #667eea;
		box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
	}

	.venues-grid {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
		gap: 20px;
		margin-bottom: 30px;
	}

	.venue-card {
		background: white;
		border-radius: 12px;
		overflow: hidden;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
		transition: all 0.3s ease;
		display: flex;
		flex-direction: column;
	}

	.venue-card:hover {
		transform: translateY(-4px);
		box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
	}

	.venue-image {
		width: 100%;
		height: 200px;
		object-fit: cover;
		background: #e2e8f0;
	}

	.venue-image-placeholder {
		width: 100%;
		height: 200px;
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		display: flex;
		align-items: center;
		justify-content: center;
		color: white;
		font-size: 48px;
	}

	.venue-content {
		padding: 20px;
		flex: 1;
		display: flex;
		flex-direction: column;
	}

	.venue-header {
		margin-bottom: 12px;
	}

	.venue-name {
		font-size: 18px;
		font-weight: 700;
		color: #2d3748;
		margin-bottom: 5px;
	}

	.venue-specialty {
		font-size: 13px;
		color: #718096;
		font-weight: 500;
	}

	.venue-description {
		font-size: 14px;
		color: #4a5568;
		line-height: 1.6;
		margin-bottom: 15px;
		flex: 1;
	}

	.venue-info {
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
		margin-bottom: 15px;
	}

	.info-badge {
		padding: 4px 10px;
		border-radius: 20px;
		font-size: 12px;
		font-weight: 500;
		background: #edf2f7;
		color: #4a5568;
	}

	.venue-location {
		font-size: 13px;
		color: #718096;
		margin-bottom: 15px;
		display: flex;
		align-items: center;
		gap: 5px;
	}

	.status-badge {
		display: inline-block;
		padding: 4px 12px;
		border-radius: 20px;
		font-size: 12px;
		font-weight: 600;
		margin-bottom: 15px;
	}

	.status-active {
		background: #c6f6d5;
		color: #22543d;
	}

	.status-inactive {
		background: #fed7d7;
		color: #742a2a;
	}

	.venue-actions {
		display: flex;
		gap: 8px;
		padding-top: 15px;
		border-top: 1px solid #e2e8f0;
	}

	.venues-pagination {
		display: flex;
		justify-content: center;
		align-items: center;
		gap: 10px;
		background: white;
		padding: 20px;
		border-radius: 12px;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
	}

	.venues-pagination a,
	.venues-pagination span {
		padding: 8px 14px;
		border-radius: 6px;
		text-decoration: none;
		color: #4a5568;
		font-size: 14px;
		font-weight: 500;
		transition: all 0.2s ease;
		cursor: pointer;
	}

	.venues-pagination a:hover {
		background: #edf2f7;
		color: #667eea;
	}

	.venues-pagination .current {
		background: #667eea;
		color: white;
	}

	.no-results {
		background: white;
		padding: 60px 20px;
		border-radius: 12px;
		text-align: center;
		color: #718096;
		grid-column: 1 / -1;
	}

	.no-results-icon {
		font-size: 64px;
		margin-bottom: 20px;
	}

	@media (max-width: 768px) {
		.venues-grid {
			grid-template-columns: 1fr;
		}

		.venues-toolbar {
			flex-direction: column;
			align-items: stretch;
		}

		.venues-filters {
			flex-direction: column;
		}

		.venues-filter-group input,
		.venues-filter-group select {
			width: 100%;
		}
	}
</style>

<div class="venues-container">
	<div class="venues-header">
		<h1>🏛️ Administração de Venues</h1>
		<p>Gerencie todos os espaços e locais cadastrados no sistema</p>
	</div>

	<?php if ($_SESSION['consulta'] != 't'): ?>
		<div class="venues-toolbar">
			<button class="venues-btn venues-btn-primary" onclick="novo_venuev2()">
				➕ Novo Venue
			</button>

			<div class="venues-filters">
				<div class="venues-filter-group">
					<label>Buscar</label>
					<input type="text" id="search_venue" placeholder="Nome ou especialidade..."
						value="<?php echo htmlspecialchars($search); ?>">
				</div>

				<div class="venues-filter-group">
					<label>Cidade</label>
					<select id="filter_city">
						<option value="">Todas</option>
						<?php
						if ($cities_result) {
							for ($i = 0; $i < pg_numrows($cities_result); $i++) {
								$city = pg_result($cities_result, $i, 'city');
								$selected = ($city == $filter_city) ? 'selected' : '';
								echo "<option value=\"{$city}\" {$selected}>{$city}</option>";
							}
						}
						?>
					</select>
				</div>

				<div class="venues-filter-group">
					<label>Status</label>
					<select id="filter_active">
						<option value="">Todos</option>
						<option value="1" <?php echo $filter_active === '1' ? 'selected' : ''; ?>>Ativos</option>
						<option value="0" <?php echo $filter_active === '0' ? 'selected' : ''; ?>>Inativos</option>
					</select>
				</div>

				<div class="venues-filter-group" style="justify-content: flex-end;">
					<label>&nbsp;</label>
					<button class="venues-btn venues-btn-success" onclick="filtrar_venues()">🔍 Filtrar</button>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="venues-grid">
		<?php
		$result_venue = pg_exec($conn, $pega_venue);

		if ($result_venue && pg_numrows($result_venue) > 0) {
			for ($i = 0; $i < pg_numrows($result_venue); $i++) {
				$cod_venues = pg_result($result_venue, $i, 'cod_venues');
				$nome = pg_result($result_venue, $i, 'nome');
				$especialidade = pg_result($result_venue, $i, 'especialidade');
				$description = pg_result($result_venue, $i, 'short_description_pt');
				$city = pg_result($result_venue, $i, 'city');
				$state = pg_result($result_venue, $i, 'state');
				$country = pg_result($result_venue, $i, 'country');
				$ativo = pg_result($result_venue, $i, 'ativo') === 't';
				$foto1 = pg_result($result_venue, $i, 'foto1');
				$capacity_min = pg_result($result_venue, $i, 'capacity_min');
				$capacity_max = pg_result($result_venue, $i, 'capacity_max');
				$price_range = pg_result($result_venue, $i, 'price_range');

				$location = array_filter([$city, $state, $country]);
				$location_str = implode(', ', $location);
		?>
				<div class="venue-card">
					<?php if ($foto1): ?>
						<img src="<?php echo htmlspecialchars($foto1); ?>" alt="<?php echo htmlspecialchars($nome); ?>" class="venue-image">
					<?php else: ?>
						<div class="venue-image-placeholder">🏛️</div>
					<?php endif; ?>

					<div class="venue-content">
						<div class="venue-header">
							<h2 class="venue-name"><?php echo htmlspecialchars($nome); ?></h2>
							<?php if ($especialidade): ?>
								<p class="venue-specialty"><?php echo htmlspecialchars($especialidade); ?></p>
							<?php endif; ?>
						</div>

						<span class="status-badge <?php echo $ativo ? 'status-active' : 'status-inactive'; ?>">
							<?php echo $ativo ? '✓ Ativo' : '✗ Inativo'; ?>
						</span>

						<?php if ($description): ?>
							<p class="venue-description">
								<?php echo htmlspecialchars(substr($description, 0, 120)) . (strlen($description) > 120 ? '...' : ''); ?>
							</p>
						<?php endif; ?>

						<div class="venue-info">
							<?php if ($capacity_min && $capacity_max): ?>
								<span class="info-badge">👥 <?php echo $capacity_min; ?>-<?php echo $capacity_max; ?> pessoas</span>
							<?php endif; ?>
							<?php if ($price_range): ?>
								<span class="info-badge">💰 <?php echo htmlspecialchars($price_range); ?></span>
							<?php endif; ?>
						</div>

						<?php if ($location_str): ?>
							<div class="venue-location">
								📍 <?php echo htmlspecialchars($location_str); ?>
							</div>
						<?php endif; ?>

						<div class="venue-actions">
							<button class="venues-btn venues-btn-info" onclick="ver_venue(<?php echo $cod_venues; ?>)">
								👁️ Ver
							</button>
							<?php if ($_SESSION['consulta'] != 't'): ?>
								<button class="venues-btn venues-btn-warning" onclick="editar_venue(<?php echo $cod_venues; ?>)">
									✏️ Editar
								</button>
								<button class="venues-btn venues-btn-danger" onclick="excluir_venue(<?php echo $cod_venues; ?>, '<?php echo addslashes($nome); ?>')">
									🗑️ Excluir
								</button>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php
			}
		} else {
			?>
			<div class="no-results">
				<div class="no-results-icon">🔍</div>
				<h3>Nenhum venue encontrado</h3>
				<p>Tente ajustar os filtros ou cadastre um novo venue.</p>
			</div>
		<?php
		}
		?>
	</div>

	<?php if ($total_pages > 1): ?>
		<div class="venues-pagination">
			<?php if ($page > 1): ?>
				<a onclick="carregar_pagina_venues(1)">« Primeira</a>
				<a onclick="carregar_pagina_venues(<?php echo $page - 1; ?>)">‹ Anterior</a>
			<?php endif; ?>

			<?php
			$start = max(1, $page - 2);
			$end = min($total_pages, $page + 2);

			for ($i = $start; $i <= $end; $i++):
				if ($i == $page):
			?>
					<span class="current"><?php echo $i; ?></span>
				<?php else: ?>
					<a onclick="carregar_pagina_venues(<?php echo $i; ?>)"><?php echo $i; ?></a>
			<?php
				endif;
			endfor;
			?>

			<?php if ($page < $total_pages): ?>
				<a onclick="carregar_pagina_venues(<?php echo $page + 1; ?>)">Próxima ›</a>
				<a onclick="carregar_pagina_venues(<?php echo $total_pages; ?>)">Última »</a>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>

<script>
	// Função para carregar páginas com filtros
	function carregar_pagina_venues(page) {
		var search = $('#search_venue').val();
		var city = $('#filter_city').val();
		var active = $('#filter_active').val();

		var params = '?page=' + page;
		if (search) params += '&search=' + encodeURIComponent(search);
		if (city) params += '&city=' + encodeURIComponent(city);
		if (active !== '') params += '&active=' + active;

		$.ajax({
			dataType: "html",
			url: "venuesv2/miolo_venues.php" + params,
			error: function() {
				alert("Erro ao carregar a página!");
			},
			success: function(resposta) {
				$("#container_miolo").html(resposta);
			}
		});
	}

	// Função para filtrar venues
	function filtrar_venues() {
		carregar_pagina_venues(1);
	}

	// Permitir filtrar com Enter
	$('#search_venue').keypress(function(e) {
		if (e.which == 13) {
			filtrar_venues();
		}
	});
</script>
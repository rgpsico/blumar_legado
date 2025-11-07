<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
require_once '../util/connection.php';

// ================================
// CONSULTAS INICIAIS
// ================================

// Hotéis pendentes
$sqlPendentes = "
    SELECT nome_for, mneu_for
    FROM sbd95.fornec
    WHERE categ = 'Hotel'
      AND status = 'true'
      AND mneu_for NOT IN (SELECT mneu_for FROM conteudo_internet.ci_hotel)
    ORDER BY nome_for
";
$pendentes = pg_query($conn, $sqlPendentes);

// Hotéis cadastrados
$sqlHoteis = "
    SELECT h.nome_htl, h.frncod, f.nome_for, f.mneu_for
    FROM conteudo_internet.ci_hotel h
    LEFT JOIN sbd95.fornec f ON h.mneu_for = f.mneu_for
    ORDER BY f.nome_for
";
$hoteis = pg_query($conn, $sqlHoteis);

// Cidades
$sqlCidades = "
    SELECT TRIM(UPPER(t.nome_en)) AS nome_cidade, c.cid
    FROM sbd95.cidades c
    INNER JOIN tarifario.cidade_tpo t ON c.nome_cid = TRIM(UPPER(t.nome_en))
    ORDER BY t.nome_en
";
$cidades = pg_query($conn, $sqlCidades);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>Administração de Hotéis</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
	<link href="../css/system-modern.css?v=1.0" rel="stylesheet">
	<style>
		body {
			padding: 0;
		}

		.select-large {
			width: 100%;
			max-width: 500px;
		}
	</style>
</head>

<body class="modern-system">

	<div class="modern-container">
		<div class="modern-header modern-mb-xl">
			<h1 class="h2 mb-1">🏨 Administração de Hotéis</h1>
			<p class="mb-0 opacity-75">Gerencie o cadastro e informações de hotéis do sistema</p>
		</div>

		<div class="modern-tabs">
			<ul class="modern-tab-list" id="hotelTabs" role="tablist">
				<li class="modern-tab-item active" id="cadastro-tab" data-bs-toggle="tab" data-bs-target="#cadastro" role="tab">
					<i class="bi bi-plus-circle"></i> Novo Hotel
				</li>
				<li class="modern-tab-item" id="alteracao-tab" data-bs-toggle="tab" data-bs-target="#alteracao" role="tab">
					<i class="bi bi-pencil-square"></i> Alterar Hotel
				</li>
				<li class="modern-tab-item" id="consulta-tab" data-bs-toggle="tab" data-bs-target="#consulta" role="tab">
					<i class="bi bi-file-earmark-text"></i> Consultas e Relatórios
				</li>
			</ul>
		</div>

		<div class="tab-content mt-4" id="hotelTabsContent">
			<!-- ===================== NOVO HOTEL ===================== -->
			<div class="tab-pane fade show active" id="cadastro" role="tabpanel">
				<div class="modern-content-wrapper">
					<h3 class="modern-section-title modern-mb-md">
						<i class="bi bi-building-add"></i> Inserir novo hotel
					</h3>
					<div class="modern-form-group">
						<label for="mneu_for" class="modern-form-label">Selecione o hotel para cadastrar</label>
						<select class="modern-form-select select-large" id="mneu_for" onchange="novo_hotelv2()">
							<option value="0" selected>Escolha um hotel...</option>
							<?php while ($row = pg_fetch_assoc($pendentes)): ?>
								<option value="<?= htmlspecialchars($row['mneu_for']) ?>">
									<?= htmlspecialchars($row['nome_for']) ?>
								</option>
							<?php endwhile; ?>
						</select>
					</div>
				</div>
			</div>

			<!-- ===================== ALTERAÇÃO ===================== -->
			<div class="tab-pane fade" id="alteracao" role="tabpanel">
				<div class="modern-content-wrapper modern-mb-md">
					<h3 class="modern-section-title modern-mb-md">
						<i class="bi bi-pencil-square"></i> Alterar hotel existente
					</h3>
					<div class="modern-form-group">
						<label for="frncod" class="modern-form-label">Selecione o hotel para alterar</label>
						<select class="modern-form-select select-large" id="frncod" onchange="altera_hotelv2()">
							<option value="0" selected>Escolha um hotel...</option>
							<?php while ($row = pg_fetch_assoc($hoteis)): ?>
								<option value="<?= htmlspecialchars($row['frncod']) ?>">
									<?= htmlspecialchars($row['nome_for'] ?: $row['nome_htl']) ?>
								</option>
							<?php endwhile; ?>
						</select>
					</div>
				</div>

				<div class="modern-content-wrapper">
					<h3 class="modern-section-title modern-mb-md">
						<i class="bi bi-geo-alt"></i> Alterar hotéis por cidade
					</h3>
					<div class="modern-form-group">
						<label for="frncod2" class="modern-form-label">Selecione uma cidade</label>
						<select class="modern-form-select select-large" id="frncod2" onchange="altera_hotel2()">
							<option value="0" selected>Escolha uma cidade...</option>
							<?php while ($row = pg_fetch_assoc($cidades)): ?>
								<option value="<?= htmlspecialchars($row['cid']) ?>"><?= htmlspecialchars($row['nome_cidade']) ?></option>
							<?php endwhile; ?>
						</select>
					</div>
				</div>
			</div>

			<!-- ===================== CONSULTAS ===================== -->
			<div class="tab-pane fade" id="consulta" role="tabpanel">
				<div class="modern-content-wrapper modern-mb-md">
					<h3 class="modern-section-title modern-mb-md">
						<i class="bi bi-search"></i> Listagem de Hotéis por Cidade
					</h3>
					<div class="modern-form-group">
						<label for="cidcod" class="modern-form-label">Selecione uma cidade</label>
						<select class="modern-form-select select-large" id="cidcod" onchange="listagem_htl_ingles()">
							<option value="0" selected>Escolha uma cidade...</option>
							<?php
							pg_result_seek($cidades, 0);
							while ($row = pg_fetch_assoc($cidades)): ?>
								<option value="<?= htmlspecialchars($row['cid']) ?>"><?= htmlspecialchars($row['nome_cidade']) ?></option>
							<?php endwhile; ?>
						</select>
					</div>
				</div>

				<div class="modern-content-wrapper">
					<h3 class="modern-section-title modern-mb-md">
						<i class="bi bi-file-earmark-bar-graph"></i> Relatórios Rápidos
					</h3>
					<div class="modern-flex modern-gap-md" style="flex-wrap: wrap;">
						<a href="hotel/relatorio-hoteis-nacional.php" class="modern-btn modern-btn-primary">
							<i class="bi bi-list-ul"></i> Listagem Nacional
						</a>
						<button onclick="listagem_selo_new()" class="modern-btn modern-btn-info">
							<i class="bi bi-star"></i> Hotéis <b>NEW</b>
						</button>
						<button onclick="listagem_selo_unique()" class="modern-btn modern-btn-info">
							<i class="bi bi-gem"></i> Hotéis <b>UNIQUE</b>
						</button>
						<button onclick="listagem_selo_luxury()" class="modern-btn modern-btn-success">
							<i class="bi bi-tree"></i> Hotéis <b>Eco Friendly</b>
						</button>
						<button onclick="listagem_selo_favoritos()" class="modern-btn modern-btn-warning">
							<i class="bi bi-heart"></i> Hotéis <b>Favoritos</b>
						</button>
						<button onclick="listagem_health_safe()" class="modern-btn modern-btn-primary">
							<i class="bi bi-shield-check"></i> Formulário <b>Health & Safe</b>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
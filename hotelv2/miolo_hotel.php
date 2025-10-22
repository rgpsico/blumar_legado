<?php
session_start();
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
	<style>
		body {
			background: #f9f9f9;
			padding: 30px;
		}

		.card {
			margin-bottom: 20px;
		}

		.select-large {
			width: 100%;
			max-width: 500px;
		}
	</style>
</head>

<body>

	<div class="container">
		<h2 class="mb-4 text-primary fw-bold">Administração de Conteúdo de Hotéis</h2>

		<ul class="nav nav-tabs" id="hotelTabs" role="tablist">
			<li class="nav-item" role="presentation">
				<button class="nav-link active" id="cadastro-tab" data-bs-toggle="tab" data-bs-target="#cadastro" type="button" role="tab">Novo Hotel</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="alteracao-tab" data-bs-toggle="tab" data-bs-target="#alteracao" type="button" role="tab">Alterar Hotel</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="consulta-tab" data-bs-toggle="tab" data-bs-target="#consulta" type="button" role="tab">Consultas e Relatórios</button>
			</li>
		</ul>

		<div class="tab-content mt-3" id="hotelTabsContent">
			<!-- ===================== NOVO HOTEL ===================== -->
			<div class="tab-pane fade show active" id="cadastro" role="tabpanel">
				<div class="card p-3 shadow-sm">
					<h5>Inserir novo hotel</h5>
					<select class="form-select select-large mt-2" id="mneu_for" onchange="novo_hotelv2()">
						<option value="0" selected>Escolha um hotel para cadastrar</option>
						<?php while ($row = pg_fetch_assoc($pendentes)): ?>
							<option value="<?= htmlspecialchars($row['mneu_for']) ?>">
								<?= htmlspecialchars($row['nome_for']) ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>

			<!-- ===================== ALTERAÇÃO ===================== -->
			<div class="tab-pane fade" id="alteracao" role="tabpanel">
				<div class="card p-3 shadow-sm">
					<h5>Alterar hotel existente</h5>
					<select class="form-select select-large mt-2" id="frncod" onchange="altera_hotelv2()">
						<option value="0" selected>Escolha um hotel para alterar</option>
						<?php while ($row = pg_fetch_assoc($hoteis)): ?>
							<option value="<?= htmlspecialchars($row['frncod']) ?>">
								<?= htmlspecialchars($row['nome_for'] ?: $row['nome_htl']) ?>
							</option>
						<?php endwhile; ?>
					</select>
				</div>

				<div class="card p-3 shadow-sm">
					<h5>Alterar hotéis por cidade</h5>
					<select class="form-select select-large mt-2" id="frncod2" onchange="altera_hotel2()">
						<option value="0" selected>Selecione uma cidade</option>
						<?php while ($row = pg_fetch_assoc($cidades)): ?>
							<option value="<?= htmlspecialchars($row['cid']) ?>"><?= htmlspecialchars($row['nome_cidade']) ?></option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>

			<!-- ===================== CONSULTAS ===================== -->
			<div class="tab-pane fade" id="consulta" role="tabpanel">
				<div class="card p-3 shadow-sm">
					<h5>Listagem de Hotéis por Cidade</h5>
					<select class="form-select select-large mt-2" id="cidcod" onchange="listagem_htl_ingles()">
						<option value="0" selected>Selecione uma cidade</option>
						<?php
						pg_result_seek($cidades, 0);
						while ($row = pg_fetch_assoc($cidades)): ?>
							<option value="<?= htmlspecialchars($row['cid']) ?>"><?= htmlspecialchars($row['nome_cidade']) ?></option>
						<?php endwhile; ?>
					</select>
				</div>

				<div class="card p-3 shadow-sm">
					<h5>Relatórios Rápidos</h5>
					<ul>
						<li><a href="hotel/relatorio-hoteis-nacional.php">Listagem Nacional</a></li>
						<li><a href="#" onclick="listagem_selo_new()">Hotéis com selo <b>NEW</b></a></li>
						<li><a href="#" onclick="listagem_selo_unique()">Hotéis com selo <b>UNIQUE</b></a></li>
						<li><a href="#" onclick="listagem_selo_luxury()">Hotéis <b>Eco Friendly</b></a></li>
						<li><a href="#" onclick="listagem_selo_favoritos()">Hotéis <b>Favoritos</b></a></li>
						<li><a href="#" onclick="listagem_health_safe()">Formulário <b>Health & Safe</b></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
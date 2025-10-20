<?php
require_once '../util/connection.php';

$query = "
SELECT
    f.nome_for,
    f.mneu_for,
    h.frncod,
    h.city_name,
    CASE
        WHEN h.mneu_for IS NULL THEN false
        ELSE true
    END AS cadastrado
FROM sbd95.fornec f
LEFT JOIN conteudo_internet.ci_hotel h
    ON f.mneu_for = h.mneu_for
WHERE
    f.categ = 'Hotel'
    AND f.status = 'true'
ORDER BY f.nome_for
";

$result = pg_exec($conn, $query);
$has_results = $result && pg_numrows($result) > 0;
?>

<style>
	a {
		text-decoration: none;
		color: inherit;
	}

	a:hover {
		text-decoration: underline;
	}

	.page-item.active .page-link {
		background-color: #0d6efd;
		border-color: #0d6efd;
		color: white;
	}

	.page-link {
		cursor: pointer;
	}

	.hidden {
		display: none !important;
	}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<div class="container py-5">
	<h3 class="mb-4">Administração de Conteúdo de Hotéis</h3>

	<div class="card shadow-sm">
		<div class="card-header bg-primary text-white">
			<b>Lista de Hotéis (Cadastrados e Pendentes)</b>
		</div>

		<div class="card-body">

			<!-- 🔍 FILTROS -->
			<div class="row mb-3">
				<div class="col-md-4">
					<input type="text" id="filtroNome" class="form-control" placeholder="Filtrar por nome do fornecedor">
				</div>
				<div class="col-md-4">
					<input type="text" id="filtroCidade" class="form-control" placeholder="Filtrar por cidade">
				</div>
				<div class="col-md-4">
					<select id="filtroStatus" class="form-select">
						<option value="">Todos</option>
						<option value="pendente">Pendente</option>
						<option value="cadastrado">Cadastrado</option>
					</select>
				</div>
			</div>

			<!-- 🧾 TABELA -->
			<table id="tabelaHoteis" class="table table-striped align-middle">
				<thead>
					<tr>
						<th>#</th>
						<th>Nome do Fornecedor</th>
						<th>Cidade</th>
						<th>Código (mneu_for)</th>
						<th>Status</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($has_results): ?>
						<?php
						$i = 1;
						for ($row = 0; $row < pg_numrows($result); $row++):
							$nome_for = pg_result($result, $row, 'nome_for');
							$mneu_for = pg_result($result, $row, 'mneu_for');
							$frncod   = pg_result($result, $row, 'frncod');
							$city_name = pg_result($result, $row, 'city_name');
							$cadastrado = pg_result($result, $row, 'cadastrado') === 't';
						?>
							<tr class="data-row">
								<td><?= $i++ ?></td>
								<td class="col-nome"><?= htmlspecialchars($nome_for) ?></td>
								<td class="col-cidade"><?= htmlspecialchars($city_name ?: '-') ?></td>
								<td><?= htmlspecialchars($mneu_for) ?></td>
								<td>
									<?php if ($cadastrado): ?>
										<span class="badge bg-success">Cadastrado</span>
									<?php else: ?>
										<span class="badge bg-warning text-dark">Pendente</span>
									<?php endif; ?>
								</td>
								<td>
									<?php if ($cadastrado): ?>
										<button class="btn btn-sm btn-warning"
											onclick="$('#frncod').val('<?= $frncod ?>'); altera_hotelv2();">
											Editar
										</button>
									<?php else: ?>
										<button class="btn btn-sm btn-success"
											onclick="$('#mneu_for').val('<?= $mneu_for ?>'); novo_hotelv2();">
											Cadastrar
										</button>
									<?php endif; ?>
								</td>
							</tr>
						<?php endfor; ?>
					<?php endif; ?>
					<tr id="no-results-row" class="<?= $has_results ? 'hidden' : '' ?>">
						<td colspan="6" class="text-center text-muted">Nenhum hotel encontrado</td>
					</tr>
				</tbody>
			</table>

			<!-- 🔢 PAGINAÇÃO -->
			<nav>
				<ul class="pagination justify-content-center mt-3" id="paginacao"></ul>
			</nav>
		</div>
	</div>

	<input type="hidden" id="mneu_for">
	<input type="hidden" id="frncod">

	<div id="container_miolo" class="mt-4" style="display:flex; justify-content:center; align-items:center;"></div>
</div>

<script>
	$(document).ready(function() {
		const linhasPorPagina = 20;
		let paginaAtual = 1;
		let currentFiltered = $();

		function aplicarFiltro() {
			const filtroNome = $("#filtroNome").val().toLowerCase();
			const filtroCidade = $("#filtroCidade").val().toLowerCase();
			const filtroStatus = $("#filtroStatus").val();

			$("#tabelaHoteis tbody tr.data-row").each(function() {
				const nome = $(this).find(".col-nome").text().toLowerCase();
				const cidade = $(this).find(".col-cidade").text().toLowerCase();
				let matchesStatus = true;

				if (filtroStatus) {
					const badge = $(this).find('td:nth-child(5) .badge');
					const isCadastrado = badge.hasClass('bg-success');
					const isPendente = badge.hasClass('bg-warning');

					if (filtroStatus === 'cadastrado' && !isCadastrado) {
						matchesStatus = false;
					}
					if (filtroStatus === 'pendente' && !isPendente) {
						matchesStatus = false;
					}
				}

				const visivel = nome.includes(filtroNome) &&
					cidade.includes(filtroCidade) &&
					matchesStatus;
				if (visivel) {
					$(this).removeClass('hidden');
				} else {
					$(this).addClass('hidden');
				}
			});

			// Handle no results row
			const visibleDataRows = $("#tabelaHoteis tbody tr.data-row").not('.hidden').length;
			if (visibleDataRows === 0) {
				$("#no-results-row").removeClass('hidden');
			} else {
				$("#no-results-row").addClass('hidden');
			}
		}

		function atualizarTabela() {
			const linhas = currentFiltered;
			const totalLinhas = linhas.length;
			const totalPaginas = Math.ceil(totalLinhas / linhasPorPagina) || 1;

			if (paginaAtual > totalPaginas) paginaAtual = totalPaginas;

			linhas.addClass('hidden');
			const inicio = (paginaAtual - 1) * linhasPorPagina;
			const fim = inicio + linhasPorPagina;
			const toShow = linhas.slice(inicio, fim);
			toShow.removeClass('hidden');

			// Paginação dinâmica
			let html = '';
			const maxBotoes = 7;
			let startPage = Math.max(1, paginaAtual - Math.floor(maxBotoes / 2));
			let endPage = startPage + maxBotoes - 1;
			if (endPage > totalPaginas) {
				endPage = totalPaginas;
				startPage = Math.max(1, endPage - maxBotoes + 1);
			}

			// Botão anterior
			html += `
			<li class="page-item ${paginaAtual === 1 ? 'disabled' : ''}">
				<a class="page-link" data-page="${paginaAtual - 1}">«</a>
			</li>
		`;

			if (startPage > 1) {
				html += `<li class="page-item"><a class="page-link" data-page="1">1</a></li>`;
				if (startPage > 2)
					html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
			}

			for (let i = startPage; i <= endPage; i++) {
				html += `
				<li class="page-item ${i === paginaAtual ? 'active' : ''}">
					<a class="page-link" data-page="${i}">${i}</a>
				</li>
			`;
			}

			if (endPage < totalPaginas) {
				if (endPage < totalPaginas - 1)
					html += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
				html += `<li class="page-item"><a class="page-link" data-page="${totalPaginas}">${totalPaginas}</a></li>`;
			}

			// Botão próximo
			html += `
			<li class="page-item ${paginaAtual === totalPaginas ? 'disabled' : ''}">
				<a class="page-link" data-page="${paginaAtual + 1}">»</a>
			</li>
		`;

			$("#paginacao").html(html);
		}

		function aplicarFiltrosEAtualizar() {
			paginaAtual = 1;
			aplicarFiltro();
			currentFiltered = $("#tabelaHoteis tbody tr.data-row").not('.hidden');
			atualizarTabela();
		}

		// Filtros
		$("#filtroNome, #filtroCidade").on("keyup", aplicarFiltrosEAtualizar);
		$("#filtroStatus").on("change", aplicarFiltrosEAtualizar);

		// Inicializa com pendentes
		$("#filtroStatus").val('pendente');
		aplicarFiltrosEAtualizar();
	});
</script>
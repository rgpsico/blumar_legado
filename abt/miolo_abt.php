<?php
session_start();

require_once '../util/connection.php';

// Verifica se é uma requisição AJAX para deletar
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
	$pk_abt = pg_escape_string($_POST['pk_abt']);

	// Inicia transação
	pg_query($conn, "BEGIN");

	try {
		// Deleta registros relacionados
		pg_query($conn, "DELETE FROM conteudo_internet.abt_destinos WHERE fk_abt = $pk_abt");
		pg_query($conn, "DELETE FROM conteudo_internet.abt_estilos WHERE fk_abt = $pk_abt");
		pg_query($conn, "DELETE FROM conteudo_internet.abt_conteudo WHERE fk_abt = $pk_abt");

		// Deleta o ABT
		pg_query($conn, "DELETE FROM conteudo_internet.abt WHERE pk_abt = $pk_abt");

		// Log da ação
		$pk_acesso = $_SESSION['user'];
		$data_now = date('Y-m-d');
		$query_log = "INSERT INTO conteudo_internet.log_adm_conteudo 
                     (usuario, acao, data, fk_conteudo)
                     VALUES ('$pk_acesso', 'Deletou ABT - ID: $pk_abt', '$data_now', '11')";
		pg_query($conn, $query_log);

		pg_query($conn, "COMMIT");
		echo json_encode(['success' => true, 'message' => 'ABT deletado com sucesso!']);
	} catch (Exception $e) {
		pg_query($conn, "ROLLBACK");
		echo json_encode(['success' => false, 'message' => 'Erro ao deletar: ' . $e->getMessage()]);
	}
	exit;
}

// Queries para stats (executadas no PHP para precisão)
$total_abts_query = "SELECT COUNT(*) as total FROM conteudo_internet.abt";
$total_abts_result = pg_query($conn, $total_abts_query);
$total_abts = pg_fetch_result($total_abts_result, 0, 'total');

$total_ativos_query = "SELECT COUNT(*) as total FROM conteudo_internet.abt WHERE ativo = true";
$total_ativos_result = pg_query($conn, $total_ativos_query);
$total_ativos = pg_fetch_result($total_ativos_result, 0, 'total');

$total_idiomas_query = "SELECT COUNT(DISTINCT lang) as total FROM conteudo_internet.abt WHERE lang IN (1, 2)";
$total_idiomas_result = pg_query($conn, $total_idiomas_query);
$total_idiomas = pg_fetch_result($total_idiomas_result, 0, 'total') ?: 0;

$total_destinos_query = "SELECT COUNT(DISTINCT fk_cidade_cod) as total FROM conteudo_internet.abt_destinos";
$total_destinos_result = pg_query($conn, $total_destinos_query);
$total_destinos = pg_fetch_result($total_destinos_result, 0, 'total') ?: 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gerenciamento de ABT - Around Brazil Tours</title>

	<!-- Bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- DataTables -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

	<style>
		:root {
			--primary-color: #0066cc;
			--secondary-color: #00a8e8;
			--success-color: #00c853;
			--danger-color: #ff3d00;
			--warning-color: #ffa000;
			--dark-color: #1a1a2e;
			--light-bg: #f8f9fa;
		}

		body {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			min-height: 100vh;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			padding: 20px 0;
		}

		.main-container {
			background: rgba(255, 255, 255, 0.98);
			backdrop-filter: blur(10px);
			border-radius: 20px;
			box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
			padding: 30px;
			margin: 20px auto;
			max-width: 1400px;
		}

		.page-header {
			background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
			color: white;
			padding: 25px 30px;
			border-radius: 15px;
			margin-bottom: 30px;
			box-shadow: 0 10px 30px rgba(0, 102, 204, 0.3);
		}

		.page-header h1 {
			margin: 0;
			font-size: 2rem;
			font-weight: 600;
			display: flex;
			align-items: center;
			gap: 15px;
		}

		.page-header h1 i {
			font-size: 2.5rem;
		}

		.stats-cards {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
			gap: 20px;
			margin-bottom: 30px;
		}

		.stat-card {
			background: linear-gradient(135deg, #667eea, #764ba2);
			color: white;
			padding: 20px;
			border-radius: 15px;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
			transition: transform 0.3s ease, box-shadow 0.3s ease;
		}

		.stat-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
		}

		.stat-card i {
			font-size: 2.5rem;
			margin-bottom: 10px;
		}

		.stat-card h3 {
			font-size: 2rem;
			margin: 10px 0 5px;
			font-weight: 700;
		}

		.stat-card p {
			margin: 0;
			opacity: 0.9;
			font-size: 0.9rem;
		}

		.action-bar {
			background: white;
			padding: 20px;
			border-radius: 15px;
			margin-bottom: 25px;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
			display: flex;
			justify-content: space-between;
			align-items: center;
			flex-wrap: wrap;
			gap: 15px;
		}

		.btn-action {
			padding: 12px 30px;
			border-radius: 10px;
			font-weight: 600;
			text-transform: uppercase;
			font-size: 0.9rem;
			letter-spacing: 0.5px;
			transition: all 0.3s ease;
			border: none;
			display: inline-flex;
			align-items: center;
			gap: 10px;
		}

		.btn-action:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
		}

		.btn-primary-custom {
			background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
			color: white;
		}

		.table-container {
			background: white;
			border-radius: 15px;
			padding: 25px;
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
		}

		table.dataTable {
			border-collapse: separate !important;
			border-spacing: 0 8px !important;
		}

		table.dataTable thead th {
			background: linear-gradient(135deg, #667eea, #764ba2);
			color: white;
			border: none;
			padding: 15px;
			font-weight: 600;
			text-transform: uppercase;
			font-size: 0.85rem;
			letter-spacing: 0.5px;
		}

		table.dataTable thead th:first-child {
			border-radius: 10px 0 0 10px;
		}

		table.dataTable thead th:last-child {
			border-radius: 0 10px 10px 0;
		}

		table.dataTable tbody tr {
			background: white;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
			transition: all 0.3s ease;
		}

		table.dataTable tbody tr:hover {
			background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
			box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
			transform: translateY(-2px);
		}

		table.dataTable tbody td {
			padding: 15px;
			vertical-align: middle;
			border: none;
		}

		table.dataTable tbody tr td:first-child {
			border-radius: 10px 0 0 10px;
		}

		table.dataTable tbody tr td:last-child {
			border-radius: 0 10px 10px 0;
		}

		.badge-lang {
			padding: 6px 12px;
			border-radius: 8px;
			font-size: 0.8rem;
			font-weight: 600;
		}

		.badge-status {
			padding: 6px 12px;
			border-radius: 8px;
			font-size: 0.75rem;
			font-weight: 600;
			text-transform: uppercase;
		}

		.action-buttons {
			display: flex;
			gap: 8px;
			justify-content: center;
		}

		.btn-action-icon {
			width: 36px;
			height: 36px;
			border-radius: 8px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			border: none;
			transition: all 0.3s ease;
			color: white;
			font-size: 0.9rem;
		}

		.btn-action-icon:hover {
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
		}

		.btn-view {
			background: linear-gradient(135deg, #667eea, #764ba2);
		}

		.btn-edit {
			background: linear-gradient(135deg, #ffa000, #ff6f00);
		}

		.btn-delete {
			background: linear-gradient(135deg, #ff3d00, #dd2c00);
		}

		.dataTables_wrapper .dataTables_length select,
		.dataTables_wrapper .dataTables_filter input {
			border: 2px solid #e0e0e0;
			border-radius: 8px;
			padding: 8px 12px;
			transition: all 0.3s ease;
		}

		.dataTables_wrapper .dataTables_length select:focus,
		.dataTables_wrapper .dataTables_filter input:focus {
			border-color: var(--primary-color);
			box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
			outline: none;
		}

		.dataTables_wrapper .dataTables_paginate .paginate_button {
			border-radius: 8px !important;
			margin: 0 3px;
			padding: 8px 15px !important;
		}

		.dataTables_wrapper .dataTables_paginate .paginate_button.current {
			background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)) !important;
			border: none !important;
			color: white !important;
		}

		.img-thumbnail-table {
			width: 80px;
			height: 50px;
			object-fit: cover;
			border-radius: 8px;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
		}

		@media (max-width: 768px) {
			.page-header h1 {
				font-size: 1.5rem;
			}

			.stats-cards {
				grid-template-columns: 1fr;
			}

			.action-bar {
				flex-direction: column;
				align-items: stretch;
			}

			.btn-action {
				width: 100%;
				justify-content: center;
			}
		}

		/* Loading Overlay */
		.loading-overlay {
			display: none;
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background: rgba(0, 0, 0, 0.7);
			z-index: 9999;
			justify-content: center;
			align-items: center;
		}

		.loading-overlay.active {
			display: flex;
		}

		.spinner {
			width: 60px;
			height: 60px;
			border: 5px solid rgba(255, 255, 255, 0.3);
			border-top-color: white;
			border-radius: 50%;
			animation: spin 1s linear infinite;
		}

		@keyframes spin {
			to {
				transform: rotate(360deg);
			}
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<div class="main-container">
			<!-- Header -->
			<div class="page-header">
				<h1>
					<i class="fas fa-globe-americas"></i>
					Around Brazil Tours - Gerenciamento
				</h1>
			</div>

			<!-- Stats Cards -->
			<div class="stats-cards">
				<div class="stat-card">
					<i class="fas fa-route"></i>
					<h3 id="total-abts"><?php echo $total_abts; ?></h3>
					<p>Total de Pacotes</p>
				</div>
				<div class="stat-card" style="background: linear-gradient(135deg, #00c853, #64dd17);">
					<i class="fas fa-check-circle"></i>
					<h3 id="total-ativos"><?php echo $total_ativos; ?></h3>
					<p>Pacotes Ativos</p>
				</div>
				<div class="stat-card" style="background: linear-gradient(135deg, #ffa000, #ff6f00);">
					<i class="fas fa-language"></i>
					<h3 id="total-idiomas"><?php echo $total_idiomas; ?></h3>
					<p>Idiomas</p>
				</div>
				<div class="stat-card" style="background: linear-gradient(135deg, #00a8e8, #0066cc);">
					<i class="fas fa-map-marked-alt"></i>
					<h3 id="total-destinos"><?php echo $total_destinos; ?></h3>
					<p>Destinos</p>
				</div>
			</div>

			<!-- Action Bar -->
			<?php if ($_SESSION['consulta'] != 't'): ?>
				<div class="action-bar">
					<button class="btn btn-action btn-primary-custom" onclick="novoABT()">
						<i class="fas fa-plus-circle"></i>
						Novo Pacote ABT
					</button>

					<div class="d-flex gap-2">
						<button class="btn btn-action" style="background: linear-gradient(135deg, #00c853, #64dd17); color: white;" onclick="filtrarAtivos()">
							<i class="fas fa-filter"></i>
							Apenas Ativos
						</button>
						<button class="btn btn-action" style="background: linear-gradient(135deg, #6c757d, #495057); color: white;" onclick="limparFiltros()">
							<i class="fas fa-redo"></i>
							Limpar Filtros
						</button>
					</div>
				</div>
			<?php endif; ?>

			<!-- Table Container -->
			<div class="table-container">
				<table id="tabelaABT" class="table table-hover" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Imagem</th>
							<th>Nome</th>
							<th>Título</th>
							<th>Idioma</th>
							<th>Status</th>
							<th>Home</th>
							<th>Preço</th>
							<th>Duração</th>
							<th>Ações</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "
                            SELECT 
                                pk_abt,
                                nome,
                                titulo,
                                foto_topo,
                                lang,
                                ativo,
                                ativo_home,
                                topo_brasil_pass,
                                preco_abt,
                                tempo_abt,
                                data
                            FROM conteudo_internet.abt
                            ORDER BY pk_abt DESC
                        ";

						$result = pg_query($conn, $query);

						while ($row = pg_fetch_assoc($result)) {
							$pk_abt = $row['pk_abt'];
							$nome = htmlspecialchars($row['nome']);
							$titulo = htmlspecialchars($row['titulo']);
							$foto = $row['foto_topo'] ? htmlspecialchars($row['foto_topo']) : 'placeholder.jpg';
							$lang = $row['lang'] == 1 ? 'EN' : 'PT';
							$lang_class = $row['lang'] == 1 ? 'primary' : 'success';
							$ativo = $row['ativo'] == 't' ? 'Ativo' : 'Inativo';
							$ativo_class = $row['ativo'] == 't' ? 'success' : 'secondary';
							$ativo_home = $row['ativo_home'] == 't' ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';
							$off_beaten = $row['topo_brasil_pass'] == 't' ? '<span class="badge bg-warning ms-2">Off Beaten</span>' : '';
							$preco = $row['preco_abt'] ? 'R$ ' . number_format($row['preco_abt'], 2, ',', '.') : '-';
							$tempo = $row['tempo_abt'] ? $row['tempo_abt'] : '-';

							echo "<tr data-ativo='{$row['ativo']}'>
                                <td><strong>#{$pk_abt}</strong></td>
                                <td><img src='../imagens/abt/{$foto}' class='img-thumbnail-table' onerror='' alt='Foto'></td>
                                <td><strong>{$nome}</strong>{$off_beaten}</td>
                                <td>{$titulo}</td>
                                <td><span class='badge bg-{$lang_class} badge-lang'>{$lang}</span></td>
                                <td><span class='badge bg-{$ativo_class} badge-status'>{$ativo}</span></td>
                                <td class='text-center'>{$ativo_home}</td>
                                <td>{$preco}</td>
                                <td>{$tempo}</td>
                                <td>
                                    <div class='action-buttons'>
                                        <button class='btn btn-action-icon btn-view' onclick='visualizarABT({$pk_abt})' title='Visualizar'>
                                            <i class='fas fa-eye'></i>
                                        </button>";

							if ($_SESSION['consulta'] != 't') {
								echo "
                                        <button class='btn btn-action-icon btn-edit' onclick='editarABT({$pk_abt})' title='Editar'>
                                            <i class='fas fa-edit'></i>
                                        </button>
                                        <button class='btn btn-action-icon btn-delete' onclick='deletarABT({$pk_abt}, \"{$nome}\")' title='Excluir'>
                                            <i class='fas fa-trash-alt'></i>
                                        </button>";
							}

							echo "
                                    </div>
                                </td>
                            </tr>";
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Loading Overlay -->
	<div class="loading-overlay" id="loadingOverlay">
		<div class="spinner"></div>
	</div>

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script>
		let table;

		$(document).ready(function() {
			// Inicializa DataTable
			table = $('#tabelaABT').DataTable({
				responsive: true,
				language: {
					url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
				},
				pageLength: 25,
				lengthMenu: [
					[10, 25, 50, 100, -1],
					[10, 25, 50, 100, "Todos"]
				],
				order: [
					[0, 'desc']
				],
				columnDefs: [{
					orderable: false,
					targets: [1, 9]
				}],
				drawCallback: function() {
					atualizarStats();
				}
			});

			// Atualiza estatísticas iniciais (agora com PHP, mas JS atualiza em filtros)
			atualizarStats();
		});

		function atualizarStats() {
			const totalAbts = table.rows({
				search: 'applied'
			}).count();
			const totalAtivos = table.rows({
				search: 'applied'
			}).data().filter(function(row) {
				return $(row[5]).text().includes('Ativo');
			}).length;

			$('#total-abts').text(totalAbts);
			$('#total-ativos').text(totalAtivos);

			// Contar idiomas únicos (fallback JS se PHP não bastar)
			const idiomas = new Set();
			table.rows({
				search: 'applied'
			}).data().each(function(row) {
				idiomas.add($(row[4]).text());
			});
			$('#total-idiomas').text(idiomas.size);

			// Total destinos: fixo do PHP por enquanto
		}

		function novoABT() {
			$('#loadingOverlay').addClass('active');
			// Redirecionar para página de novo ABT
			window.location.href = 'novo_abt.php';
		}

		function visualizarABT(id) {
			$('#loadingOverlay').addClass('active');
			// Abrir em nova aba ou modal
			window.open(`../site/abt_individual.php?pk_abt=${id}`, '_blank');
			setTimeout(() => $('#loadingOverlay').removeClass('active'), 1000);
		}

		function editarABT(id) {
			$('#loadingOverlay').addClass('active');
			// Enviar para página de edição
			const form = document.createElement('form');
			form.method = 'POST';
			form.action = 'form_altera_abt.php';

			const input = document.createElement('input');
			input.type = 'hidden';
			input.name = 'pk_abt';
			input.value = id;

			form.appendChild(input);
			document.body.appendChild(form);
			form.submit();
		}

		function deletarABT(id, nome) {
			Swal.fire({
				title: 'Tem certeza?',
				html: `Você está prestes a excluir o pacote:<br><strong>${nome}</strong><br><br>Esta ação não pode ser desfeita!`,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#ff3d00',
				cancelButtonColor: '#6c757d',
				confirmButtonText: 'Sim, excluir!',
				cancelButtonText: 'Cancelar',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					$('#loadingOverlay').addClass('active');

					$.ajax({
						url: 'lista_abt.php',
						method: 'POST',
						data: {
							action: 'delete',
							pk_abt: id
						},
						dataType: 'json',
						success: function(response) {
							$('#loadingOverlay').removeClass('active');

							if (response.success) {
								Swal.fire({
									title: 'Excluído!',
									text: response.message,
									icon: 'success',
									timer: 2000,
									showConfirmButton: false
								}).then(() => {
									location.reload();
								});
							} else {
								Swal.fire({
									title: 'Erro!',
									text: response.message,
									icon: 'error'
								});
							}
						},
						error: function() {
							$('#loadingOverlay').removeClass('active');
							Swal.fire({
								title: 'Erro!',
								text: 'Erro ao excluir o pacote. Tente novamente.',
								icon: 'error'
							});
						}
					});
				}
			});
		}

		function filtrarAtivos() {
			table.column(5).search('Ativo').draw();

			Swal.fire({
				title: 'Filtro Aplicado',
				text: 'Exibindo apenas pacotes ativos',
				icon: 'info',
				timer: 1500,
				showConfirmButton: false
			});
		}

		function limparFiltros() {
			table.search('').columns().search('').draw();

			Swal.fire({
				title: 'Filtros Limpos',
				text: 'Exibindo todos os pacotes',
				icon: 'info',
				timer: 1500,
				showConfirmButton: false
			});
		}
	</script>
</body>

</html>
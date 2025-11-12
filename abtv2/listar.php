<?php
session_start();

require_once '../util/connection.php';

// Verifica se é uma requisição AJAX para deletar (mantido como fallback, mas agora usa API)
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    // Redireciona para API
    header('Location: api/abt.php?request=excluir_abt&id=' . $_POST['pk_abt']);
    exit;
}
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

        /* Modal Customizações */
        .modal-lg-custom {
            max-width: 90%;
        }

        .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            font-weight: 600;
            color: var(--dark-color);
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 2px solid #e0e0e0;
            padding: 10px 12px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .btn-save {
            background: linear-gradient(135deg, var(--success-color), #64dd17);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 200, 83, 0.4);
        }

        .view-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }

        .readonly-field {
            background: white;
            border: 1px solid #dee2e6;
            padding: 10px;
            border-radius: 6px;
            font-size: 0.95rem;
        }

        /* Backdrop transparente, mas funcional */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0) !important;
            /* Transparente, sem cinza */
            z-index: 1040 !important;
            /* Mantém abaixo do modal */
        }

        .modal-backdrop.show {
            opacity: 0 !important;
            z-index: -100 !important;
            /* Remove o fade-in do cinza */
        }

        /* Garante que o modal fique sempre na frente */
        .modal {
            z-index: 1055 !important;
            /* Aumentei um pouco para segurança */
        }

        .modal .modal-dialog {
            z-index: 1056 !important;
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
                    <h3 id="total-abts">0</h3>
                    <p>Total de Pacotes</p>
                </div>
                <div class="stat-card" style="background: linear-gradient(135deg, #00c853, #64dd17);">
                    <i class="fas fa-check-circle"></i>
                    <h3 id="total-ativos">0</h3>
                    <p>Pacotes Ativos</p>
                </div>
                <div class="stat-card" style="background: linear-gradient(135deg, #ffa000, #ff6f00);">
                    <i class="fas fa-language"></i>
                    <h3 id="total-idiomas">0</h3>
                    <p>Idiomas</p>
                </div>
                <div class="stat-card" style="background: linear-gradient(135deg, #00a8e8, #0066cc);">
                    <i class="fas fa-map-marked-alt"></i>
                    <h3 id="total-destinos">0</h3>
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

                            echo "<tr data-id='{$pk_abt}' data-ativo='{$row['ativo']}'>
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

    <!-- Modal para Criar Novo ABT -->
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalCreateLabel">
                        <i class="fas fa-plus-circle"></i> Novo Pacote ABT
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formCreateABT">
                    <div class="modal-body">
                        <!-- Form fields para create (expandido com campos do schema) -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="create_nome">Nome *</label>
                                <input type="text" class="form-control" id="create_nome" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_titulo">Título</label>
                                <input type="text" class="form-control" id="create_titulo">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_data">Data</label>
                                <input type="date" class="form-control" id="create_data">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_lang">Idioma *</label>
                                <select class="form-select" id="create_lang" required>
                                    <option value="1">Inglês (EN)</option>
                                    <option value="2">Português (PT)</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_preco_abt">Preço (R$)</label>
                                <input type="number" step="0.01" class="form-control" id="create_preco_abt">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_tempo_abt">Duração</label>
                                <input type="text" class="form-control" id="create_tempo_abt" placeholder="ex: 5 days">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_fk_cidade_cod">Cidade Principal</label>
                                <select class="form-select" id="create_fk_cidade_cod">
                                    <option value="">Selecione</option>
                                    <!-- Popule via API listar_cidades no JS -->
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                <label for="create_campo_livre">Descrição Livre</label>
                                <textarea class="form-control" id="create_campo_livre" rows="3"></textarea>
                            </div>
                            <!-- Fotos -->
                            <div class="col-md-6 form-group">
                                <label for="create_foto_topo">Foto Topo</label>
                                <input type="text" class="form-control" id="create_foto_topo" placeholder="/images/...">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="create_foto_campo">Foto Campo</label>
                                <input type="text" class="form-control" id="create_foto_campo" placeholder="/images/...">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="create_foto1">Foto 1 (Principal)</label>
                                <input type="text" class="form-control" id="create_foto1" placeholder="/images/...">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="create_foto2">Foto 2</label>
                                <input type="text" class="form-control" id="create_foto2" placeholder="/images/...">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="create_foto3">Foto 3</label>
                                <input type="text" class="form-control" id="create_foto3" placeholder="/images/...">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="create_foto4">Foto 4</label>
                                <input type="text" class="form-control" id="create_foto4" placeholder="/images/...">
                            </div>
                            <!-- Checkboxes para booleans -->
                            <div class="col-12 form-group">
                                <label>Status e Visibilidade</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="create_ativo">
                                    <label class="form-check-label" for="create_ativo">Ativo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="create_ativo_home">
                                    <label class="form-check-label" for="create_ativo_home">Exibir na Home</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="create_topo_brasil_pass">
                                    <label class="form-check-label" for="create_topo_brasil_pass">Off Beaten Path</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="create_ativo_riolife">
                                    <label class="form-check-label" for="create_ativo_riolife">Rio Life</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="create_new_mod">
                                    <label class="form-check-label" for="create_new_mod">Novo Modo</label>
                                </div>
                            </div>
                            <!-- Estilos (multi-select ou checkboxes) -->
                            <div class="col-12 form-group">
                                <label>Estilos (selecione múltiplos)</label>
                                <select class="form-select" id="create_estilos" multiple>
                                    <!-- Popule via API listar_estilos no JS -->
                                    <option value="1">Classic</option>
                                    <option value="2">Beach</option>
                                    <option value="3">Family</option>
                                    <!-- Mais opções -->
                                </select>
                            </div>
                            <!-- Destinos (multi-select) -->
                            <div class="col-12 form-group">
                                <label>Destinos (selecione múltiplos)</label>
                                <select class="form-select" id="create_destinos" multiple>
                                    <!-- Popule via API listar_cidades no JS -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-save">
                            <i class="fas fa-save"></i> Salvar Novo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Editar ABT -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="modalEditLabel">
                        <i class="fas fa-edit"></i> Editar Pacote ABT
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditABT">
                    <div class="modal-body">
                        <input type="hidden" id="edit_pk_abt">
                        <!-- Form fields similares ao create, mas com IDs prefix 'edit_' -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="edit_nome">Nome *</label>
                                <input type="text" class="form-control" id="edit_nome" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_titulo">Título</label>
                                <input type="text" class="form-control" id="edit_titulo">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_data">Data</label>
                                <input type="date" class="form-control" id="edit_data">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_lang">Idioma *</label>
                                <select class="form-select" id="edit_lang" required>
                                    <option value="1">Inglês (EN)</option>
                                    <option value="2">Português (PT)</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_preco_abt">Preço (R$)</label>
                                <input type="number" step="0.01" class="form-control" id="edit_preco_abt">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_tempo_abt">Duração</label>
                                <input type="text" class="form-control" id="edit_tempo_abt" placeholder="ex: 5 days">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_fk_cidade_cod">Cidade Principal</label>
                                <select class="form-select" id="edit_fk_cidade_cod">
                                    <option value="">Selecione</option>
                                    <!-- Popule via API -->
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                <label for="edit_campo_livre">Descrição Livre</label>
                                <textarea class="form-control" id="edit_campo_livre" rows="3"></textarea>
                            </div>
                            <!-- Fotos (similar ao create) -->
                            <div class="col-md-6 form-group">
                                <label for="edit_foto_topo">Foto Topo</label>
                                <input type="text" class="form-control" id="edit_foto_topo" placeholder="/images/...">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="edit_foto_campo">Foto Campo</label>
                                <input type="text" class="form-control" id="edit_foto_campo" placeholder="/images/...">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="edit_foto1">Foto 1 (Principal)</label>
                                <input type="text" class="form-control" id="edit_foto1" placeholder="/images/...">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="edit_foto2">Foto 2</label>
                                <input type="text" class="form-control" id="edit_foto2" placeholder="/images/...">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="edit_foto3">Foto 3</label>
                                <input type="text" class="form-control" id="edit_foto3" placeholder="/images/...">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="edit_foto4">Foto 4</label>
                                <input type="text" class="form-control" id="edit_foto4" placeholder="/images/...">
                            </div>
                            <!-- Checkboxes (similar ao create) -->
                            <div class="col-12 form-group">
                                <label>Status e Visibilidade</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="edit_ativo">
                                    <label class="form-check-label" for="edit_ativo">Ativo</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="edit_ativo_home">
                                    <label class="form-check-label" for="edit_ativo_home">Exibir na Home</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="edit_topo_brasil_pass">
                                    <label class="form-check-label" for="edit_topo_brasil_pass">Off Beaten Path</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="edit_ativo_riolife">
                                    <label class="form-check-label" for="edit_ativo_riolife">Rio Life</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="edit_new_mod">
                                    <label class="form-check-label" for="edit_new_mod">Novo Modo</label>
                                </div>
                            </div>
                            <!-- Estilos e Destinos (multi-select) -->
                            <div class="col-12 form-group">
                                <label>Estilos (selecione múltiplos)</label>
                                <select class="form-select" id="edit_estilos" multiple>
                                    <!-- Popule via API -->
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                <label>Destinos (selecione múltiplos)</label>
                                <select class="form-select" id="edit_destinos" multiple>
                                    <!-- Popule via API -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-save">
                            <i class="fas fa-save"></i> Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Visualizar ABT -->
    <div class="modal fade" id="modalView" tabindex="-1" aria-labelledby="modalViewLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg-custom">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="modalViewLabel">
                        <i class="fas fa-eye"></i> Visualizar Pacote ABT
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="viewContent">
                        <!-- Conteúdo populado via JS: campos readonly -->
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Nome:</strong> <span id="view_nome" class="readonly-field"></span>
                            </div>
                            <div class="col-md-6">
                                <strong>Título:</strong> <span id="view_titulo" class="readonly-field"></span>
                            </div>
                            <div class="col-md-6">
                                <strong>Data:</strong> <span id="view_data" class="readonly-field"></span>
                            </div>
                            <div class="col-md-6">
                                <strong>Idioma:</strong> <span id="view_lang" class="readonly-field"></span>
                            </div>
                            <div class="col-md-6">
                                <strong>Preço:</strong> <span id="view_preco_abt" class="readonly-field"></span>
                            </div>
                            <div class="col-md-6">
                                <strong>Duração:</strong> <span id="view_tempo_abt" class="readonly-field"></span>
                            </div>
                            <div class="col-md-6">
                                <strong>Cidade Principal:</strong> <span id="view_fk_cidade_cod" class="readonly-field"></span>
                            </div>
                            <div class="col-12">
                                <strong>Descrição:</strong> <span id="view_campo_livre" class="readonly-field d-block mt-2"></span>
                            </div>
                            <div class="col-12">
                                <strong>Status:</strong> <span id="view_ativo" class="readonly-field d-block mt-2 badge bg-success"></span>
                            </div>
                            <!-- Mais campos: fotos como imgs, estilos/destinos como lists -->
                            <div class="col-12 mt-3">
                                <strong>Estilos:</strong>
                                <ul id="view_estilos" class="readonly-field list-unstyled mt-1"></ul>
                            </div>
                            <div class="col-12 mt-3">
                                <strong>Destinos:</strong>
                                <ul id="view_destinos" class="readonly-field list-unstyled mt-1"></ul>
                            </div>
                            <div class="col-12 mt-3">
                                <strong>Tours/Dias:</strong>
                                <ul id="view_tours" class="readonly-field list-unstyled mt-1"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
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
        const modalCreate = new bootstrap.Modal(document.getElementById('modalCreate'));
        const modalEdit = new bootstrap.Modal(document.getElementById('modalEdit'));
        const modalView = new bootstrap.Modal(document.getElementById('modalView'));
        const isConsulta = <?php echo $_SESSION['consulta'] == 't' ? 'true' : 'false'; ?>;

        // Arrays para estilos e cidades (populados via API)
        let estilosOptions = [];
        let cidadesOptions = [];

        function escapeHtml(value) {
            if (value === null || value === undefined) {
                return '';
            }
            return String(value)
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function formatPreco(valor) {
            if (valor === null || valor === undefined || valor === '') {
                return '-';
            }
            const numero = parseFloat(valor);
            if (Number.isNaN(numero)) {
                return '-';
            }
            return 'R$ ' + numero.toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        function formatIdiomaBadge(lang) {
            const idiomaNumero = parseInt(lang, 10);
            const idioma = idiomaNumero === 1 ? 'EN' : 'PT';
            const classe = idiomaNumero === 1 ? 'primary' : 'success';
            return `<span class="badge bg-${classe} badge-lang">${idioma}</span>`;
        }

        function formatStatusBadge(ativo) {
            const ativoNormalizado = ativo === true || ativo === 't' || ativo === 1;
            const texto = ativoNormalizado ? 'Ativo' : 'Inativo';
            const classe = ativoNormalizado ? 'success' : 'secondary';
            return `<span class="badge bg-${classe} badge-status">${texto}</span>`;
        }

        function formatHomeIcon(ativoHome) {
            const ativoNormalizado = ativoHome === true || ativoHome === 't' || ativoHome === 1;
            return ativoNormalizado ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>";
        }

        function formatNome(abt) {
            const nome = `<strong>${escapeHtml(abt.nome || abt.name || '')}</strong>`;
            const offBeaten = (abt.topo_brasil_pass === true || abt.topo_brasil_pass === 't') ? "<span class='badge bg-warning ms-2'>Off Beaten</span>" : '';
            return nome + offBeaten;
        }

        function resolverImagemTopo(abt) {
            const fotoTopo = abt.foto_topo || abt.foto_topo_bpass || abt.foto1;
            if (!fotoTopo) {
                return "../imagens/abt/placeholder.jpg";
            }
            if (typeof fotoTopo === 'string' && fotoTopo.startsWith('http')) {
                return fotoTopo;
            }
            return `../imagens/abt/${fotoTopo}`;
        }

        function montarDadosLinha(abt) {
            const fotoSrc = resolverImagemTopo(abt);
            const titulo = escapeHtml(abt.titulo || '');
            const tempo = abt.tempo_abt ? escapeHtml(abt.tempo_abt) : '-';
            const preco = formatPreco(abt.preco_abt);
            const idioma = formatIdiomaBadge(abt.lang);
            const status = formatStatusBadge(abt.ativo);
            const home = formatHomeIcon(abt.ativo_home);
            const actions = [`<button class='btn btn-action-icon btn-view' onclick='visualizarABT(${abt.pk_abt})' title='Visualizar'><i class='fas fa-eye'></i></button>`];
            if (!isConsulta) {
                actions.push(`<button class='btn btn-action-icon btn-edit' onclick='editarABT(${abt.pk_abt})' title='Editar'><i class='fas fa-edit'></i></button>`);
                actions.push(`<button class='btn btn-action-icon btn-delete' onclick='deletarABT(${abt.pk_abt}, \"${escapeHtml(abt.nome || abt.name || '')}\")' title='Excluir'><i class='fas fa-trash-alt'></i></button>`);
            }

            return [
                `<strong>#${abt.pk_abt}</strong>`,
                `<img src='${fotoSrc}' class='img-thumbnail-table' alt='Foto'>`,
                formatNome(abt),
                titulo,
                idioma,
                status,
                `<span class='text-center d-block'>${home}</span>`,
                preco,
                tempo,
                `<div class='action-buttons'>${actions.join('')}</div>`
            ];
        }

        function coletarDadosFormulario(prefixo) {
            const obterValor = (campo) => $(`#${prefixo}_${campo}`).val();
            const obterCheckbox = (campo) => $(`#${prefixo}_${campo}`).is(':checked');

            const estilosSelecionados = $(`#${prefixo}_estilos`).val();
            const destinosSelecionados = $(`#${prefixo}_destinos`).val();

            return {
                nome: obterValor('nome'),
                titulo: obterValor('titulo'),
                data: obterValor('data'),
                lang: obterValor('lang') ? parseInt(obterValor('lang'), 10) : null,
                preco_abt: obterValor('preco_abt') ? parseFloat(obterValor('preco_abt')) : null,
                tempo_abt: obterValor('tempo_abt') || null,
                fk_cidade_cod: obterValor('fk_cidade_cod') ? parseInt(obterValor('fk_cidade_cod'), 10) : null,
                campo_livre: obterValor('campo_livre'),
                foto_topo: obterValor('foto_topo'),
                foto_campo: obterValor('foto_campo'),
                foto1: obterValor('foto1'),
                foto2: obterValor('foto2'),
                foto3: obterValor('foto3'),
                foto4: obterValor('foto4'),
                ativo: obterCheckbox('ativo'),
                ativo_home: obterCheckbox('ativo_home'),
                topo_brasil_pass: obterCheckbox('topo_brasil_pass'),
                ativo_riolife: obterCheckbox('ativo_riolife'),
                new_mod: obterCheckbox('new_mod'),
                estilos: estilosSelecionados ? estilosSelecionados.map((id) => parseInt(id, 10)).filter((id) => !Number.isNaN(id)) : [],
                destinos: destinosSelecionados ? destinosSelecionados.map((id) => parseInt(id, 10)).filter((id) => !Number.isNaN(id)) : []
            };
        }

        function atualizarLinhaAbt(abt, isNew) {
            const dadosLinha = montarDadosLinha(abt);
            if (isNew) {
                const novaLinha = table.row.add(dadosLinha).draw(false).node();
                $(novaLinha).attr('data-id', abt.pk_abt);
                $(novaLinha).attr('data-ativo', abt.ativo);
            } else {
                const $linhaExistente = $(`#tabelaABT tbody tr[data-id='${abt.pk_abt}']`);
                if ($linhaExistente.length) {
                    const rowRef = table.row($linhaExistente);
                    rowRef.data(dadosLinha).draw(false);
                    $(rowRef.node()).attr('data-id', abt.pk_abt);
                    $(rowRef.node()).attr('data-ativo', abt.ativo);
                } else {
                    const novaLinha = table.row.add(dadosLinha).draw(false).node();
                    $(novaLinha).attr('data-id', abt.pk_abt);
                    $(novaLinha).attr('data-ativo', abt.ativo);
                }
            }
            atualizarStats();
        }

        function buscarAbtEAtualizar(id, isNew) {
            const requisicao = $.getJSON(`api/abt.php?request=buscar_abt&id=${id}`);
            requisicao.done(function(abt) {
                atualizarLinhaAbt(abt, isNew);
            });
            return requisicao;
        }

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

            // Atualiza estatísticas iniciais
            atualizarStats();

            // Popula selects de estilos e cidades via API
            $.get('api/abt.php?request=listar_estilos', function(response) {
                estilosOptions = response;
                estilosOptions.forEach(est => {
                    $('#create_estilos, #edit_estilos').append(`<option value="${est.id}">${est.name}</option>`);
                });
            });

            $.get('api/abt.php?request=listar_cidades', function(response) {
                cidadesOptions = response;
                cidadesOptions.forEach(cid => {
                    $('#create_fk_cidade_cod, #edit_fk_cidade_cod').append(`<option value="${cid.id}">${cid.name || cid.name_en || cid.name_pt}</option>`);
                    $('#create_destinos, #edit_destinos').append(`<option value="${cid.id}">${cid.name || cid.name_en || cid.name_pt}</option>`);
                });
            });

            // Handlers para forms nos modals
            $('#formCreateABT').on('submit', function(e) {
                e.preventDefault();
                const payload = coletarDadosFormulario('create');

                $('#loadingOverlay').addClass('active');

                $.ajax({
                    url: 'api/abt.php?request=criar_abt',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(payload),
                    processData: false,
                    dataType: 'json'
                }).done(function(response) {
                    if (response.success && response.abt_id) {
                        modalCreate.hide();
                        if ($('#formCreateABT')[0]) {
                            $('#formCreateABT')[0].reset();
                        }
                        $('#create_estilos, #create_destinos').val(null).trigger('change');

                        buscarAbtEAtualizar(response.abt_id, true)
                            .done(function() {
                                Swal.fire('Sucesso!', response.message || 'ABT inserido com sucesso!', 'success');
                            })
                            .fail(function() {
                                Swal.fire('Aviso', 'ABT criado, mas não foi possível atualizar a listagem automaticamente.', 'warning');
                            })
                            .always(function() {
                                $('#loadingOverlay').removeClass('active');
                            });
                    } else {
                        Swal.fire('Erro!', response.error || response.message || 'Falha ao criar ABT', 'error');
                        $('#loadingOverlay').removeClass('active');
                    }
                }).fail(function(xhr) {
                    let message = 'Falha na requisição';
                    if (xhr.responseJSON && (xhr.responseJSON.error || xhr.responseJSON.message)) {
                        message = xhr.responseJSON.error || xhr.responseJSON.message;
                    }
                    Swal.fire('Erro!', message, 'error');
                    $('#loadingOverlay').removeClass('active');
                });
            });

            $('#formEditABT').on('submit', function(e) {
                e.preventDefault();
                const abtId = $('#edit_pk_abt').val();
                if (!abtId) {
                    Swal.fire('Erro!', 'Não foi possível identificar o pacote para atualizar.', 'error');
                    return;
                }

                const payload = coletarDadosFormulario('edit');
                $('#loadingOverlay').addClass('active');

                $.ajax({
                    url: `api/abt.php?request=atualizar_abt&id=${abtId}`,
                    method: 'PUT',
                    contentType: 'application/json',
                    data: JSON.stringify(payload),
                    processData: false,
                    dataType: 'json'
                }).done(function(response) {
                    if (response.success) {
                        modalEdit.hide();
                        buscarAbtEAtualizar(abtId, false)
                            .done(function() {
                                Swal.fire('Sucesso!', response.message || 'ABT atualizado com sucesso!', 'success');
                            })
                            .fail(function() {
                                Swal.fire('Aviso', 'ABT atualizado, mas não foi possível sincronizar a listagem.', 'warning');
                            })
                            .always(function() {
                                $('#loadingOverlay').removeClass('active');
                            });
                    } else {
                        Swal.fire('Erro!', response.error || response.message || 'Falha ao atualizar ABT', 'error');
                        $('#loadingOverlay').removeClass('active');
                    }
                }).fail(function(xhr) {
                    let message = 'Falha na requisição';
                    if (xhr.responseJSON && (xhr.responseJSON.error || xhr.responseJSON.message)) {
                        message = xhr.responseJSON.error || xhr.responseJSON.message;
                    }
                    Swal.fire('Erro!', message, 'error');
                    $('#loadingOverlay').removeClass('active');
                });
            });
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

            // Contar idiomas únicos
            const idiomas = new Set();
            table.rows({
                search: 'applied'
            }).data().each(function(row) {
                idiomas.add($(row[4]).text());
            });
            $('#total-idiomas').text(idiomas.size);
        }

        function novoABT() {
            // Limpa form create se necessário
            if ($('#formCreateABT')[0]) {
                $('#formCreateABT')[0].reset();
            }
            // Limpa selects múltiplos
            $('#create_estilos, #create_destinos').val(null).trigger('change');
            modalCreate.show();
        }

        function visualizarABT(id) {
            $('#loadingOverlay').addClass('active');
            $.get('api/abt.php?request=buscar_abt&id=' + id, function(response) {
                $('#loadingOverlay').removeClass('active');
                if (response && response.pk_abt) { // Check for data instead of response.success
                    var data = response;
                    // Popula view fields
                    $('#view_nome').text(data.nome || '-');
                    $('#view_titulo').text(data.titulo || '-');
                    $('#view_data').text(data.data || '-');
                    $('#view_lang').text(data.lang == 1 ? 'EN' : 'PT');
                    $('#view_preco_abt').text(data.preco_abt ? 'R$ ' + parseFloat(data.preco_abt).toLocaleString('pt-BR', {
                        minimumFractionDigits: 2
                    }) : '-');
                    $('#view_tempo_abt').text(data.tempo_abt || '-');
                    $('#view_fk_cidade_cod').text(data.city || data.fk_cidade_cod || '-');
                    $('#view_campo_livre').text(data.campo_livre || '-');
                    $('#view_ativo').text(data.ativo == 't' ? 'Ativo' : 'Inativo').removeClass('bg-success bg-secondary').addClass(data.ativo == 't' ? 'bg-success' : 'bg-secondary');

                    // Estilos como list
                    var estilosHtml = '';
                    if (data.estilos && data.estilos.length > 0) {
                        data.estilos.forEach(est => {
                            estilosHtml += '<li>' + (est.name || est.cod_estilo) + '</li>';
                        });
                    } else {
                        estilosHtml = '<li>Nenhum estilo</li>';
                    }
                    $('#view_estilos').html(estilosHtml);

                    // Destinos como list
                    var destinosHtml = '';
                    if (data.destinos && data.destinos.length > 0) {
                        data.destinos.forEach(dest => {
                            destinosHtml += '<li>' + (dest.city_name || dest.fk_cidade_cod) + '</li>';
                        });
                    } else {
                        destinosHtml = '<li>Nenhum destino</li>';
                    }
                    $('#view_destinos').html(destinosHtml);

                    // Tours como list
                    var toursHtml = '';
                    if (data.tours && data.tours.length > 0) {
                        data.tours.forEach(tour => {
                            toursHtml += '<li>Dia ' + tour.dia_conteudo + ': ' + tour.titulo_conteudo + '</li>';
                        });
                    } else {
                        toursHtml = '<li>Nenhum tour/dia</li>';
                    }
                    $('#view_tours').html(toursHtml);

                    modalView.show();
                } else {
                    Swal.fire('Erro!', response?.error || 'ABT não encontrado', 'error');
                }
            }).fail(function() {
                $('#loadingOverlay').removeClass('active');
                Swal.fire('Erro!', 'Falha na requisição', 'error');
            });
        }

        function editarABT(id) {
            $('#loadingOverlay').addClass('active');
            $.get('api/abt.php?request=buscar_abt&id=' + id, function(response) {
                $('#loadingOverlay').removeClass('active');
                if (response && response.pk_abt) { // Check for data instead of response.success
                    var data = response;
                    // Popula edit form
                    $('#edit_pk_abt').val(data.pk_abt ?? '');
                    $('#edit_nome').val(data.nome ?? '');
                    $('#edit_titulo').val(data.titulo ?? '');
                    $('#edit_data').val(data.data ?? '');
                    $('#edit_lang').val(data.lang ?? '');
                    $('#edit_preco_abt').val(data.preco_abt ?? '');
                    $('#edit_tempo_abt').val(data.tempo_abt ?? '');
                    $('#edit_fk_cidade_cod').val(data.fk_cidade_cod ?? '');
                    $('#edit_campo_livre').val(data.campo_livre ?? '');
                    $('#edit_foto_topo').val(data.foto_topo ?? '');
                    $('#edit_foto_campo').val(data.foto_campo ?? '');
                    $('#edit_foto1').val(data.foto1 ?? '');
                    $('#edit_foto2').val(data.foto2 ?? '');
                    $('#edit_foto3').val(data.foto3 ?? '');
                    $('#edit_foto4').val(data.foto4 ?? '');
                    // Checkboxes
                    $('#edit_ativo').prop('checked', data.ativo == 't');
                    $('#edit_ativo_home').prop('checked', data.ativo_home == 't');
                    $('#edit_topo_brasil_pass').prop('checked', data.topo_brasil_pass == 't');
                    $('#edit_ativo_riolife').prop('checked', data.ativo_riolife == 't');
                    $('#edit_new_mod').prop('checked', data.new_mod == 't');
                    // Multi-selects: seleciona baseados em arrays
                    if (data.estilos && data.estilos.length > 0) {
                        var estIds = data.estilos.map(est => String(est.cod_estilo || est.id));
                        $('#edit_estilos').val(estIds).trigger('change');
                    } else {
                        $('#edit_estilos').val([]).trigger('change');
                    }
                    if (data.destinos && data.destinos.length > 0) {
                        var destIds = data.destinos.map(dest => String(dest.fk_cidade_cod || dest.id));
                        $('#edit_destinos').val(destIds).trigger('change');
                    } else {
                        $('#edit_destinos').val([]).trigger('change');
                    }
                    modalEdit.show();
                } else {
                    Swal.fire('Erro!', response?.error || 'ABT não encontrado', 'error');
                }
            }).fail(function() {
                $('#loadingOverlay').removeClass('active');
                Swal.fire('Erro!', 'Falha na requisição', 'error');
            });
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
                    // Usa DELETE para API (ajuste se precisar de POST simulado)
                    $.ajax({
                        url: 'api/abt.php?request=excluir_abt&id=' + id,
                        method: 'DELETE',
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
                                    text: response.error || response.message,
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
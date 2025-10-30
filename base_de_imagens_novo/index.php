<?php
session_start();
require_once '../util/connection.php';

// Busca os tipos de produtos
$pega_tipos = "SELECT DISTINCT tp_produto FROM banco_imagem.bco_img ORDER BY tp_produto";
$result_tipos = pg_query($conn, $pega_tipos);
$tipos_produtos = pg_fetch_all($result_tipos);

// Configuração da cidade selecionada
$cidade_selecionada = isset($_SESSION['cidade_cod']) ? $_SESSION['cidade_cod'] : '0';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Produtos</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Estilos para submenus na aba Produtos */
        .sub-tabs-container {
            margin-bottom: 20px;
        }

        .sub-tabs-header {
            display: flex;
            border-bottom: 2px solid #ddd;
            margin-bottom: 0;
            flex-wrap: wrap;
        }

        .sub-tabs-header .sub-tab-button {
            background: none;
            border: none;
            padding: 12px 16px;
            cursor: pointer;
            font-size: 14px;
            color: #666;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .sub-tabs-header .sub-tab-button:hover,
        .sub-tabs-header .sub-tab-button.active {
            color: #007bff;
            border-bottom-color: #007bff;
        }

        .sub-tab-pane {
            display: none;
            padding: 20px 0;
        }

        .sub-tab-pane.active {
            display: block;
        }

        .produtos-grid {
            display: block;
        }

        .produto-categoria {
            margin-bottom: 30px;
        }

        /* Estilo para novo formulário de cadastro */
        .cadastro-form-group {
            margin-bottom: 20px;
        }

        .cadastro-form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        .cadastro-form-group input[type="text"],
        .cadastro-form-group input[type="email"],
        .cadastro-form-group input[type="file"],
        .cadastro-form-group select,
        .cadastro-form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .cadastro-form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .checkbox-group {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .checkbox-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 0;
        }

        .checkbox-group input[type="checkbox"] {
            margin: 0;
            cursor: pointer;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            border-left: 4px solid;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }

        .alert-info {
            background-color: #d1ecf1;
            border-color: #17a2b8;
            color: #0c5460;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #545b62;
        }

        .form-hint {
            font-size: 12px;
            color: #666;
            margin-top: 4px;
        }

        .section-title {
            background-color: #f8f9fa;
            padding: 12px;
            margin: 20px 0 15px 0;
            border-left: 4px solid #007bff;
            font-weight: bold;
            color: #333;
        }

        #miolo_produto {
            display: none;
        }

        #miolo_produto.show {
            display: block;
        }

        .loading {
            display: none;
            text-align: center;
            color: #666;
            margin: 20px 0;
        }

        .loading.show {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="header">
            <div class="header-content">
                <h1><i class="fas fa-box"></i> Sistema de Gestão de Produtos</h1>
                <p class="subtitle">Gerencie produtos, uploads e relatórios</p>
            </div>
        </header>

        <main class="main-content">
            <!-- Navegação de Abas -->
            <div class="tabs-container">
                <div class="tabs-header">
                    <button class="tab-button active" data-tab="upload">
                        <i class="fas fa-cloud-upload-alt"></i> Upload
                    </button>
                    <button class="tab-button" data-tab="cadastro">
                        <i class="fas fa-image"></i> Cadastro de Imagem
                    </button>
                    <button class="tab-button" data-tab="filtros">
                        <i class="fas fa-filter"></i> Filtros
                    </button>
                    <button class="tab-button" data-tab="produtos">
                        <i class="fas fa-boxes"></i> Produtos
                    </button>
                    <button class="tab-button" data-tab="relatorios">
                        <i class="fas fa-chart-bar"></i> Relatórios
                    </button>
                </div>
            </div>

            <!-- Abas de Conteúdo -->
            <div class="tabs-content">

                <!-- ABA 1: Upload -->
                <div class="tab-pane active" id="upload">
                    <section class="card upload-section">
                        <div class="card-header">
                            <h2><i class="fas fa-cloud-upload-alt"></i> Upload de Imagensaaa</h2>
                        </div>
                        <div class="card-body">
                            <form id="uploadForm" enctype="multipart/form-data">
                                <div class="upload-area" id="uploadArea">
                                    <i class="fas fa-folder-open upload-icon"></i>
                                    <h3>Arraste e solte pastas aqui</h3>
                                    <p>ou</p>
                                    <label for="folderInput" class="btn btn-primary">
                                        <i class="fas fa-folder-plus"></i> Selecionar Imagem
                                    </label>
                                    <input
                                        type="file"
                                        id="folderInput"
                                        multiple
                                        style="display: none;">
                                </div>

                                <div class="form-group">
                                    <label for="upload_tipo_produto">Categoria do Produto:</label>
                                    <select name="upload_tipo_produto" id="upload_tipo_produto" class="form-control" required>
                                        <option value="">Selecione uma categoria</option>
                                        <?php if ($tipos_produtos): ?>
                                            <?php foreach ($tipos_produtos as $tipo): ?>
                                                <?php $nome_categoria = getNomeCategoria($tipo['tp_produto']); ?>
                                                <option value="<?php echo $tipo['tp_produto']; ?>">
                                                    <?php echo $nome_categoria; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="upload_cidade_cod">Cidade:</label>
                                    <select name="upload_cidade_cod" id="upload_cidade_cod" class="form-control" required>
                                        <option value="">Escolha uma cidade</option>
                                    </select>
                                </div>

                                <div id="fileList" class="file-list"></div>

                                <div class="upload-actions">
                                    <button type="submit" class="btn btn-success" id="uploadBtn" disabled>
                                        <i class="fas fa-upload"></i> Fazer Upload
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="clearBtn" disabled>
                                        <i class="fas fa-times"></i> Limpar
                                    </button>
                                </div>

                                <div id="uploadProgress" class="upload-progress" style="display: none;">
                                    <div class="progress-bar">
                                        <div class="progress-fill" id="progressFill"></div>
                                    </div>
                                    <p class="progress-text" id="progressText">0%</p>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>

                <!-- ABA 2: NOVO - Cadastro de Imagem -->
                <div class="tab-pane" id="cadastro">
                    <section class="card cadastro-section">
                        <div class="card-header">
                            <h2><i class="fas fa-image"></i> Cadastro de Nova Imagem</h2>
                            <p>Preencha o formulário para cadastrar uma nova imagem no banco</p>
                        </div>
                        <div class="card-body">
                            <?php
                            // Inclui o formulário separado (veja arquivo form_cadastro_imagem.php)
                            include 'forms/form_cadastro_imagem.php';
                            ?>
                        </div>
                    </section>
                </div>

                <!-- ABA 3: Filtros -->
                <div class="tab-pane" id="filtros">
                    <section class="card filtros-section">
                        <div class="card-header">
                            <h2><i class="fas fa-filter"></i> Filtros</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="cidade_cod">Cidade:</label>
                                <select name="cidade_cod" id="cidade_cod" class="form-control">
                                    <option value="0">Todas as cidades</option>
                                </select>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- ABA 4: Produtos - Com Submenu -->
                <div class="tab-pane" id="produtos">
                    <section class="card produtos-section">
                        <div class="card-header">
                            <h2><i class="fas fa-boxes"></i> Produtos por Categoria</h2>
                        </div>
                        <div class="card-body">
                            <div class="sub-tabs-container">
                                <!-- Header do Submenu -->
                                <div class="sub-tabs-header">
                                    <?php if ($tipos_produtos): ?>
                                        <?php foreach ($tipos_produtos as $tipo): ?>
                                            <?php $tp_produto = $tipo['tp_produto']; ?>
                                            <?php $nome_categoria = getNomeCategoria($tp_produto); ?>
                                            <?php $icon = getIconeCategoria($tp_produto); ?>
                                            <button class="sub-tab-button <?php echo $tp_produto == '1' ? 'active' : ''; ?>" data-subtab="<?php echo $tp_produto; ?>">
                                                <i class="<?php echo $icon; ?>"></i> <?php echo $nome_categoria; ?>
                                            </button>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>

                                <!-- Conteúdo do Submenu -->
                                <div class="sub-tabs-content">
                                    <?php if ($tipos_produtos): ?>
                                        <?php foreach ($tipos_produtos as $tipo): ?>
                                            <?php $tp_produto = $tipo['tp_produto']; ?>
                                            <div class="sub-tab-pane <?php echo $tp_produto == '1' ? 'active' : ''; ?>" id="subtab-<?php echo $tp_produto; ?>">
                                                <div class="produto-categoria" data-tipo="<?php echo $tp_produto; ?>">
                                                    <div class="categoria-body">
                                                        <div class="form-group">
                                                            <label for="navega_cidade_cod<?php echo $tp_produto; ?>">
                                                                <?php echo $tp_produto == '11' ? 'Inspection:' : 'Cidade:'; ?>
                                                            </label>
                                                            <select
                                                                name="navega_cidade_cod<?php echo $tp_produto; ?>"
                                                                id="navega_cidade_cod<?php echo $tp_produto; ?>"
                                                                class="form-control select-cidade"
                                                                data-tipo="<?php echo $tp_produto; ?>">
                                                                <option value="0">
                                                                    <?php echo $tp_produto == '11' ? 'Escolha um inspection' : 'Escolha uma cidade'; ?>
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div id="miolo_prod<?php echo $tp_produto; ?>" class="resultado-produto">
                                                            <p class="empty-state">Selecione uma cidade para visualizar os produtos</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- ABA 5: Relatórios -->
                <div class="tab-pane" id="relatorios">
                    <section class="card relatorios-section">
                        <div class="card-header">
                            <h2><i class="fas fa-chart-bar"></i> Relatórios</h2>
                        </div>
                        <div class="card-body">
                            <div class="relatorios-grid">
                                <a href="relatorio_hoteis.php" class="btn btn-report">
                                    <i class="fas fa-hotel"></i>
                                    <span>Relatório de Hotéis</span>
                                </a>
                                <a href="relatorio_tours.php" class="btn btn-report">
                                    <i class="fas fa-map-marked-alt"></i>
                                    <span>Relatório de Tours</span>
                                </a>
                                <a href="relatorio_geral.php" class="btn btn-report">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Relatório Geral</span>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </main>

        <footer class="footer">
            <p>&copy; 2025 Sistema de Gestão de Produtos. Todos os direitos reservados.</p>
        </footer>
    </div>

    <script src="js/main.js"></script>
    <script src="js/upload.js"></script>
    <script src="../js/banco_imagem.js"></script>
    <!-- Script para funcionalidade dos submenus -->
    <script>
        $(document).ready(function() {
            // Funcionalidade dos sub-tabs na aba Produtos
            $('.sub-tab-button').on('click', function() {
                var subTabId = $(this).data('subtab');
                // Remove active de todos os botões e panes
                $('.sub-tab-button').removeClass('active');
                $('.sub-tab-pane').removeClass('active');
                // Ativa o clicado
                $(this).addClass('active');
                $('#subtab-' + subTabId).addClass('active');
            });
        });
    </script>
</body>

</html>

<?php
function getNomeCategoria($tp_produto)
{
    $categorias = [
        '1' => 'Hotel',
        '2' => 'Tour',
        '3' => 'Venue',
        '4' => 'Restaurante',
        '5' => 'Gifts',
        '6' => 'Transportes',
        '7' => 'Various',
        '8' => 'Tours for Incentives',
        '9' => 'Tours Technical',
        '10' => 'Cidade',
        '11' => 'Inspection Report'
    ];
    return isset($categorias[$tp_produto]) ? $categorias[$tp_produto] : 'Outros';
}

function getIconeCategoria($tp_produto)
{
    $icones = [
        '1' => 'fas fa-hotel',
        '2' => 'fas fa-map-marked-alt',
        '3' => 'fas fa-building',
        '4' => 'fas fa-utensils',
        '5' => 'fas fa-gift',
        '6' => 'fas fa-bus',
        '7' => 'fas fa-ellipsis-h',
        '8' => 'fas fa-trophy',
        '9' => 'fas fa-wrench',
        '10' => 'fas fa-city',
        '11' => 'fas fa-clipboard-check'
    ];
    return isset($icones[$tp_produto]) ? $icones[$tp_produto] : 'fas fa-box';
}
?>
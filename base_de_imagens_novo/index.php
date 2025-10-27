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
        /* Estilos adicionais para as abas (tabs) */
        .tabs-container {
            margin-bottom: 20px;
        }

        .tabs-nav {
            display: flex;
            border-bottom: 2px solid #ddd;
            margin-bottom: 0;
        }

        .tabs-nav .tab-btn {
            background: none;
            border: none;
            padding: 12px 24px;
            cursor: pointer;
            font-size: 16px;
            color: #666;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .tabs-nav .tab-btn:hover,
        .tabs-nav .tab-btn.active {
            color: #007bff;
            border-bottom-color: #007bff;
        }

        .tab-content {
            display: none;
            padding: 20px 0;
        }

        .tab-content.active {
            display: block;
        }

        .produto-categoria {
            display: block;
            /* Muda de grid para display block dentro da aba */
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
            <!-- Seção de Upload -->
            <section class="card upload-section">
                <div class="card-header">
                    <h2><i class="fas fa-cloud-upload-alt"></i> Upload de Pastas</h2>
                </div>
                <div class="card-body">
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="upload-area" id="uploadArea">
                            <i class="fas fa-folder-open upload-icon"></i>
                            <h3>Arraste e solte pastas aqui</h3>
                            <p>ou</p>
                            <label for="folderInput" class="btn btn-primary">
                                <i class="fas fa-folder-plus"></i> Selecionar Pasta
                            </label>
                            <input
                                type="file"
                                id="folderInput"
                                webkitdirectory
                                directory
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

            <!-- Seção de Filtros -->
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

            <!-- Seção de Produtos - Agora com Abas (Tabs) -->
            <section class="card produtos-section">
                <div class="card-header">
                    <h2><i class="fas fa-boxes"></i> Produtos por Categoria</h2>
                </div>
                <div class="card-body">
                    <div class="tabs-container">
                        <!-- Navegação das Abas -->
                        <ul class="tabs-nav" id="tabsNav">
                            <?php if ($tipos_produtos): ?>
                                <?php foreach ($tipos_produtos as $tipo): ?>
                                    <?php $tp_produto = $tipo['tp_produto']; ?>
                                    <?php $nome_categoria = getNomeCategoria($tp_produto); ?>
                                    <?php if (in_array($tp_produto, ['2', '4', '10'])): // Filtra apenas Tour (2), Restaurante (4), Cidade (10) 
                                    ?>
                                        <li><button class="tab-btn" data-tab="<?php echo $tp_produto; ?>">
                                                <i class="<?php echo getIconeCategoria($tp_produto); ?>"></i> <?php echo $nome_categoria; ?>
                                            </button></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>

                        <!-- Conteúdo das Abas -->
                        <div class="tabs-content">
                            <?php if ($tipos_produtos): ?>
                                <?php foreach ($tipos_produtos as $tipo): ?>
                                    <?php $tp_produto = $tipo['tp_produto']; ?>
                                    <?php if (in_array($tp_produto, ['2', '4', '10'])): // Apenas as categorias solicitadas 
                                    ?>
                                        <div class="tab-content" id="tab-<?php echo $tp_produto; ?>">
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
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Seção de Relatórios -->
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
        </main>

        <footer class="footer">
            <p>&copy; 2025 Sistema de Gestão de Produtos. Todos os direitos reservados.</p>
        </footer>
    </div>

    <script src="js/main.js"></script>
    <script src="js/upload.js"></script>
    <!-- Script para funcionalidade das abas -->
    <script>
        $(document).ready(function() {
            // Ativa a primeira aba por padrão
            $('.tab-btn').first().addClass('active');
            $('.tab-content').first().addClass('active');

            // Event listener para trocar abas
            $('.tab-btn').on('click', function() {
                var tabId = $(this).data('tab');
                $('.tab-btn').removeClass('active');
                $(this).addClass('active');
                $('.tab-content').removeClass('active');
                $('#tab-' + tabId).addClass('active');
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
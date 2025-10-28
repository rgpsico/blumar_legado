<?php
/**
 * Visualização de Imagens com Galeria e Preview
 */

ini_set('display_errors', 1);
error_reporting(~0);

if (!isset($_SESSION)) {
    session_start();
}

require_once '../util/connection.php';

// Receber filtros
$tp_produto = $_GET['tp_produto'] ?? '';
$cidade_cod = $_GET['cidade_cod'] ?? '';
$search = $_GET['search'] ?? '';

// Montar query com prepared statement
$where_conditions = ["ativo_cli = '1'"];
$params = [];
$param_count = 1;

if (!empty($tp_produto)) {
    $where_conditions[] = "tp_produto = $" . $param_count++;
    $params[] = $tp_produto;
}

if (!empty($cidade_cod)) {
    $where_conditions[] = "fk_cidcod = $" . $param_count++;
    $params[] = $cidade_cod;
}

if (!empty($search)) {
    $where_conditions[] = "(
        nome_produto ILIKE $" . $param_count . " OR 
        palavras_chave ILIKE $" . $param_count . " OR
        legenda ILIKE $" . $param_count . "
    )";
    $params[] = "%$search%";
    $param_count++;
}

$where_clause = implode(' AND ', $where_conditions);

$query = "
    SELECT 
        pk_bco_img,
        mneu_for,
        nome_produto,
        tam_1,
        tam_2,
        tam_3,
        tam_4,
        tam_5,
        legenda,
        legenda_pt,
        legenda_esp,
        autor,
        palavras_chave,
        data_cadastro,
        tp_produto,
        fk_cidcod,
        fachada,
        (SELECT nome_en FROM tarifario.cidade_tpo WHERE cidade_cod = fk_cidcod) as cidade_nome
    FROM banco_imagem.bco_img
    WHERE $where_clause
    ORDER BY data_cadastro DESC
    LIMIT 50
";

$stmt = pg_prepare($conn, 'list_images', $query);
$result = pg_execute($conn, 'list_images', $params);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Galeria de Imagens - Blumar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .filters {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }
        
        .filters input,
        .filters select,
        .filters button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .filters button {
            background: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        
        .filters button:hover {
            background: #45a049;
        }
        
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        
        .card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }
        
        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background: #f0f0f0;
        }
        
        .card-content {
            padding: 15px;
        }
        
        .card-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 8px;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .card-info {
            font-size: 13px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .card-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            margin-top: 10px;
        }
        
        .tag {
            background: #e3f2fd;
            color: #1976d2;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
        }
        
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            margin-left: 5px;
        }
        
        .badge-fachada {
            background: #ff9800;
            color: white;
        }
        
        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }
        
        .btn-small {
            flex: 1;
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.2s;
        }
        
        .btn-edit {
            background: #2196F3;
            color: white;
        }
        
        .btn-edit:hover {
            background: #1976D2;
        }
        
        .btn-delete {
            background: #f44336;
            color: white;
        }
        
        .btn-delete:hover {
            background: #d32f2f;
        }
        
        /* Lightbox */
        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }
        
        .lightbox.active {
            display: flex;
        }
        
        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
            position: relative;
        }
        
        .lightbox-image {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
        }
        
        .lightbox-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            max-width: 800px;
        }
        
        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 40px;
            color: white;
            cursor: pointer;
            background: rgba(0,0,0,0.5);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }
        
        .lightbox-close:hover {
            background: rgba(0,0,0,0.8);
        }
        
        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #999;
            font-size: 18px;
        }
        
        .image-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 48px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Galeria de Imagens</h1>
        <br>
        <form method="GET" class="filters">
            <input type="text" name="search" placeholder="Buscar..." value="<?php echo htmlspecialchars($search); ?>">
            
            <select name="tp_produto">
                <option value="">Todos os tipos</option>
                <option value="1" <?php echo $tp_produto == '1' ? 'selected' : ''; ?>>Hotel</option>
                <option value="2" <?php echo $tp_produto == '2' ? 'selected' : ''; ?>>Tour</option>
                <option value="3" <?php echo $tp_produto == '3' ? 'selected' : ''; ?>>Venue</option>
                <option value="4" <?php echo $tp_produto == '4' ? 'selected' : ''; ?>>Restaurante</option>
                <option value="10" <?php echo $tp_produto == '10' ? 'selected' : ''; ?>>Cidade</option>
            </select>
            
            <select name="cidade_cod">
                <option value="">Todas as cidades</option>
                <!-- Carregar cidades dinamicamente -->
            </select>
            
            <button type="submit">Filtrar</button>
            <a href="?" style="text-decoration: none; color: #666;">Limpar</a>
        </form>
    </div>
    
    <div class="gallery">
        <?php
        if ($result && pg_num_rows($result) > 0) {
            while ($row = pg_fetch_assoc($result)) {
                
                // Usar thumbnail (tam_5) ou tam_4 como fallback
                $thumb = $row['tam_5'] ?: $row['tam_4'];
                $full_image = $row['tam_1'] ?: $row['tam_2'];
                
                // Tags de palavras-chave
                $tags = !empty($row['palavras_chave']) 
                    ? array_slice(explode(',', $row['palavras_chave']), 0, 3) 
                    : [];
                
                ?>
                <div class="card" onclick="openLightbox(<?php echo $row['pk_bco_img']; ?>)">
                    <?php if ($thumb): ?>
                        <img src="<?php echo htmlspecialchars($thumb); ?>" 
                             alt="<?php echo htmlspecialchars($row['nome_produto']); ?>"
                             class="card-image"
                             onerror="this.parentElement.innerHTML='<div class=\'image-placeholder\'>📷</div>'">
                    <?php else: ?>
                        <div class="image-placeholder">📷</div>
                    <?php endif; ?>
                    
                    <div class="card-content">
                        <div class="card-title">
                            <?php echo htmlspecialchars($row['nome_produto']); ?>
                            <?php if ($row['fachada'] == '1'): ?>
                                <span class="badge badge-fachada">Fachada</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="card-info">
                            📍 <?php echo htmlspecialchars($row['cidade_nome'] ?? 'N/A'); ?>
                        </div>
                        
                        <?php if ($row['autor']): ?>
                        <div class="card-info">
                            📷 <?php echo htmlspecialchars($row['autor']); ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($tags)): ?>
                        <div class="card-tags">
                            <?php foreach ($tags as $tag): ?>
                                <span class="tag"><?php echo htmlspecialchars(trim($tag)); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="card-actions">
                            <button class="btn-small btn-edit" onclick="editImage(<?php echo $row['pk_bco_img']; ?>, event)">
                                Editar
                            </button>
                            <button class="btn-small btn-delete" onclick="confirmDelete(<?php echo $row['pk_bco_img']; ?>, event)">
                                Excluir
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Dados para lightbox (escondidos) -->
                <script>
                    window.imageData = window.imageData || {};
                    window.imageData[<?php echo $row['pk_bco_img']; ?>] = {
                        id: <?php echo $row['pk_bco_img']; ?>,
                        nome: <?php echo json_encode($row['nome_produto']); ?>,
                        imagem: <?php echo json_encode($full_image); ?>,
                        legenda: <?php echo json_encode($row['legenda']); ?>,
                        legenda_pt: <?php echo json_encode($row['legenda_pt']); ?>,
                        autor: <?php echo json_encode($row['autor']); ?>,
                        cidade: <?php echo json_encode($row['cidade_nome']); ?>,
                        data: <?php echo json_encode($row['data_cadastro']); ?>
                    };
                </script>
                <?php
            }
        } else {
            echo '<div class="no-results">Nenhuma imagem encontrada</div>';
        }
        ?>
    </div>
</div>

<!-- Lightbox -->
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
    <span class="lightbox-close">&times;</span>
    <div class="lightbox-content" onclick="event.stopPropagation()">
        <img id="lightbox-image" class="lightbox-image" src="" alt="">
        <div class="lightbox-info" id="lightbox-info"></div>
    </div>
</div>

<script>
function openLightbox(imageId) {
    const data = window.imageData[imageId];
    if (!data) return;
    
    const lightbox = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-image');
    const info = document.getElementById('lightbox-info');
    
    img.src = data.imagem;
    
    info.innerHTML = `
        <h2>${data.nome}</h2>
        ${data.legenda ? `<p><strong>Legenda:</strong> ${data.legenda}</p>` : ''}
        ${data.autor ? `<p><strong>Autor:</strong> ${data.autor}</p>` : ''}
        <p><strong>Cidade:</strong> ${data.cidade || 'N/A'}</p>
        <p><strong>Data:</strong> ${data.data}</p>
    `;
    
    lightbox.classList.add('active');
}

function closeLightbox() {
    document.getElementById('lightbox').classList.remove('active');
}

function editImage(id, event) {
    event.stopPropagation();
    // Redirecionar para página de edição
    window.location.href = 'edit_imagem.php?pk_bco_img=' + id;
}

function confirmDelete(id, event) {
    event.stopPropagation();
    
    if (!confirm('Deseja realmente excluir esta imagem?')) {
        return;
    }
    
    const deletePhysical = confirm('Deletar também os arquivos físicos do servidor?\n\nOK = Sim (exclusão permanente)\nCancelar = Não (apenas desativar)');
    
    deleteImage(id, deletePhysical);
}

async function deleteImage(id, deleteFiles) {
    try {
        const response = await fetch('delete_image_secure.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                pk_bco_img: id,
                delete_files: deleteFiles
            })
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert(result.message);
            location.reload();
        } else {
            alert('Erro: ' + result.error);
        }
        
    } catch (error) {
        alert('Erro ao excluir imagem');
        console.error(error);
    }
}

// Fechar lightbox com ESC
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});
</script>

</body>
</html>

<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once '../util/connection.php';

// ================================
// FILTROS
// ================================
$filtro_titulo = isset($_GET['titulo']) ? trim($_GET['titulo']) : '';
$filtro_status = isset($_GET['ativo']) ? $_GET['ativo'] : '';

// ================================
// PAGINAÇÃO
// ================================
$registrosPorPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
$offset = ($paginaAtual - 1) * $registrosPorPagina;

// ================================
// CONDIÇÕES DINÂMICAS
// ================================
$where = [];
$params = [];
if ($filtro_titulo !== '') {
  $where[] = "titulo ILIKE $" . (count($params) + 1);
  $params[] = "%{$filtro_titulo}%";
}
if ($filtro_status !== '') {
  $where[] = "ativo = $" . (count($params) + 1);
  $params[] = ($filtro_status === 't') ? 't' : 'f';
}
$whereSQL = count($where) > 0 ? 'WHERE ' . implode(' AND ', $where) : '';

// ================================
// CONSULTA PRINCIPAL
// ================================
$sql_total = "SELECT COUNT(*) AS total FROM conteudo_internet.blog_nacional $whereSQL";
$result_total = pg_query_params($conn, $sql_total, $params);
$totalRegistros = pg_fetch_result($result_total, 0, 'total');
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

$sql_posts = "
  SELECT pk_blognacional, titulo, data_post, ativo
  FROM conteudo_internet.blog_nacional
  $whereSQL
  ORDER BY pk_blognacional DESC
  LIMIT $registrosPorPagina OFFSET $offset
";
$result_posts = pg_query_params($conn, $sql_posts, $params);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../css/system-modern.css?v=1.0" rel="stylesheet">

<div class="modern-content-wrapper modern-fade-in">
  <div class="modern-flex-between modern-mb-lg">
    <h2 class="modern-page-title">📰 Blog Nacional</h2>
    <button class="modern-btn modern-btn-success modern-btn-sm" onclick="novo_postv2()">
      <i class="bi bi-plus-circle"></i> Novo Post
    </button>
  </div>

  <!-- Filtros -->
  <div class="modern-filter-bar modern-mb-lg">
    <form id="formFiltro" class="modern-form-row">
      <div class="modern-form-group" style="flex: 2;">
        <label for="titulo" class="modern-form-label">Buscar por título</label>
        <input type="text" name="titulo" id="titulo" class="modern-form-control" placeholder="Digite o título do post..." value="<?php echo htmlspecialchars($filtro_titulo); ?>">
      </div>
      <div class="modern-form-group">
        <label for="ativo" class="modern-form-label">Status</label>
        <select name="ativo" id="ativo" class="modern-form-select">
          <option value="">Todos</option>
          <option value="t" <?php echo ($filtro_status === 't') ? 'selected' : ''; ?>>✅ Ativos</option>
          <option value="f" <?php echo ($filtro_status === 'f') ? 'selected' : ''; ?>>❌ Inativos</option>
        </select>
      </div>
      <div class="modern-form-group" style="display: flex; gap: 0.5rem; align-items: flex-end;">
        <button type="submit" class="modern-btn modern-btn-primary">
          <i class="bi bi-funnel"></i> Filtrar
        </button>
        <button type="button" class="modern-btn modern-btn-secondary" onclick="limparFiltro()">
          <i class="bi bi-x-circle"></i> Limpar
        </button>
      </div>
    </form>
  </div>

  <!-- Tabela -->
  <div class="modern-table-wrapper">
    <table class="modern-table">
      <thead>
        <tr>
          <th style="width: 60px;">ID</th>
          <th>Título</th>
          <th style="width: 150px;">Data</th>
          <th style="width: 100px;">Status</th>
          <th style="width: 260px;">Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result_posts && pg_num_rows($result_posts) > 0) {
          while ($row = pg_fetch_assoc($result_posts)) {
            echo '<tr>';
            echo '<td><strong>#' . $row['pk_blognacional'] . '</strong></td>';
            echo '<td>' . htmlspecialchars($row['titulo']) . '</td>';
            echo '<td>' . ($row['data_post'] ?? '-') . '</td>';
            echo '<td>';
            if ($row['ativo'] === 't') {
              echo '<span class="modern-badge modern-badge-success">✅ Ativo</span>';
            } else {
              echo '<span class="modern-badge modern-badge-danger">❌ Inativo</span>';
            }
            echo '</td>';
            echo '<td>
                    <div class="modern-table-actions">
                      <button class="modern-btn modern-btn-info modern-btn-sm" onclick="visualizarPost(' . $row['pk_blognacional'] . ')">
                        <i class="bi bi-eye"></i> Ver
                      </button>
                      <button class="modern-btn modern-btn-primary modern-btn-sm" onclick="editarPostv2(' . $row['pk_blognacional'] . ')">
                        <i class="bi bi-pencil"></i> Editar
                      </button>
                      <button class="modern-btn modern-btn-danger modern-btn-sm" onclick="excluirPostv2(' . $row['pk_blognacional'] . ')">
                        <i class="bi bi-trash"></i> Excluir
                      </button>
                    </div>
                  </td>';
            echo '</tr>';
          }
        } else {
          echo '<tr><td colspan="5" class="modern-text-center modern-text-muted" style="padding: 2rem;">
                  <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                  Nenhum post encontrado
                </td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Paginação -->
  <?php if ($totalPaginas > 1): ?>
  <div class="modern-pagination">
    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
      <a href="#" class="modern-pagination-item <?php echo ($i == $paginaAtual) ? 'active' : ''; ?>"
         onclick="carregarPagina(<?php echo $i; ?>); return false;">
        <?php echo $i; ?>
      </a>
    <?php endfor; ?>
  </div>
  <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $("#formFiltro").on("submit", function(e) {
    e.preventDefault();
    const params = $(this).serialize();
    $.get("blogv2/miolo_blognacional.php", params, function(resposta) {
      $("#container_miolo").html(resposta);
    });
  });

  function limparFiltro() {
    $("#titulo").val('');
    $("#ativo").val('');
    $("#formFiltro").submit();
  }

  function visualizarPost(id) {
    window.open('https://www.blumar.com.br/blog/post.php?post=' + id, '_blank');
  }

  function editarPostv2(id) {
    $.post("blogv2/form_altera_post.php", {
      pk_blognacional: id
    }, function(resposta) {
      $("#container_miolo").html(resposta);
    });
  }

  function excluirPostv2(id) {
    if (confirm("Tem certeza que deseja excluir este post?")) {
      $.post("blogv2/excluir_post.php", {
        pk_blognacional: id
      }, function(resposta) {
        $("#container_miolo").html(resposta);
      });
    }
  }

  function carregarPagina(pagina) {
    const params = $("#formFiltro").serialize() + "&pagina=" + pagina;
    $.get("blogv2/miolo_blognacional.php", params, function(resposta) {
      $("#container_miolo").html(resposta);
    });
  }
</script>
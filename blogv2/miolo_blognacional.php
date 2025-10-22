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

<div class="container-fluid bg-white p-4 shadow-sm rounded">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="m-0">📰 Blog Nacional</h4>
    <button class="btn btn-success btn-sm" onclick="novo_postv2()">+ Novo Post</button>
  </div>

  <!-- Filtro -->
  <form id="formFiltro" class="row g-2 mb-4">
    <div class="col-md-5">
      <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Buscar por título" value="<?php echo htmlspecialchars($filtro_titulo); ?>">
    </div>
    <div class="col-md-3">
      <select name="ativo" id="ativo" class="form-select">
        <option value="">-- Status --</option>
        <option value="t" <?php echo ($filtro_status === 't') ? 'selected' : ''; ?>>Ativos</option>
        <option value="f" <?php echo ($filtro_status === 'f') ? 'selected' : ''; ?>>Inativos</option>
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>
    <div class="col-md-2">
      <button type="button" class="btn btn-secondary w-100" onclick="limparFiltro()">Limpar</button>
    </div>
  </form>

  <!-- Tabela -->
  <table class="table table-bordered table-hover align-middle">
    <thead>
      <tr>
        <th style="width: 60px;">ID</th>
        <th>Título</th>
        <th style="width: 150px;">Data</th>
        <th style="width: 80px;">Ativo</th>
        <th style="width: 150px;">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result_posts && pg_num_rows($result_posts) > 0) {
        while ($row = pg_fetch_assoc($result_posts)) {
          echo '<tr>';
          echo '<td>' . $row['pk_blognacional'] . '</td>';
          echo '<td>' . htmlspecialchars($row['titulo']) . '</td>';
          echo '<td>' . ($row['data_post'] ?? '-') . '</td>';
          echo '<td>' . ($row['ativo'] === 't' ? '✅' : '❌') . '</td>';
          echo '<td>
                  <button class="btn btn-primary btn-sm" onclick="editarPostv2(' . $row['pk_blognacional'] . ')">Editar</button>
                  <button class="btn btn-danger btn-sm" onclick="excluirPostv2(' . $row['pk_blognacional'] . ')">Excluir</button>
                </td>';
          echo '</tr>';
        }
      } else {
        echo '<tr><td colspan="5" class="text-center text-muted">Nenhum post encontrado</td></tr>';
      }
      ?>
    </tbody>
  </table>

  <!-- Paginação -->
  <nav aria-label="Paginação do Blog">
    <ul class="pagination justify-content-center">
      <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
        <li class="page-item <?php echo ($i == $paginaAtual) ? 'active' : ''; ?>">
          <a class="page-link" href="#" onclick="carregarPagina(<?php echo $i; ?>)"><?php echo $i; ?></a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>
</div>

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
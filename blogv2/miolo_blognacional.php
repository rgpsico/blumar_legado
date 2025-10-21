<?php
ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

// ================================
// PAGINAÇÃO
// ================================
$registrosPorPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? max(1, intval($_GET['pagina'])) : 1;
$offset = ($paginaAtual - 1) * $registrosPorPagina;

// ================================
// CONSULTA PRINCIPAL
// ================================
$sql_total = "SELECT COUNT(*) AS total FROM conteudo_internet.blog_nacional";
$result_total = pg_query($conn, $sql_total);
$totalRegistros = pg_fetch_result($result_total, 0, 'total');
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

$sql_posts = "
    SELECT pk_blognacional, titulo, data_post, ativo
    FROM conteudo_internet.blog_nacional
    ORDER BY pk_blognacional DESC
    LIMIT $registrosPorPagina OFFSET $offset
";
$result_posts = pg_exec($conn, $sql_posts);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid bg-white p-4 shadow-sm rounded">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="m-0">📰 Blog Nacional</h4>
    <button class="btn btn-success btn-sm" onclick="novo_post()">+ Novo Post</button>
  </div>

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
                  <button class="btn btn-primary btn-sm" onclick="editarPost(' . $row['pk_blognacional'] . ')">Editar</button>
                  <button class="btn btn-danger btn-sm" onclick="excluirPost(' . $row['pk_blognacional'] . ')">Excluir</button>
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

<script>
  function editarPost(id) {
    // envia o ID via POST para carregar o formulário de edição
    $.ajax({
      url: "blog/form_altera_post.php",
      type: "POST",
      data: {
        pk_blognacional: id
      },
      success: function(resposta) {
        $("#container_miolo").html(resposta);
      },
      error: function() {
        alert("Erro ao carregar post para edição!");
      }
    });
  }

  function excluirPost(id) {
    if (confirm("Tem certeza que deseja excluir este post?")) {
      $.ajax({
        url: "blog/excluir_post.php",
        type: "POST",
        data: {
          pk_blognacional: id
        },
        success: function(resposta) {
          $("#container_miolo").html(resposta);
        },
        error: function() {
          alert("Erro ao excluir post!");
        }
      });
    }
  }

  function carregarPagina(pagina) {
    $.ajax({
      url: "blog/miolo_blognacional.php",
      type: "GET",
      data: {
        pagina: pagina
      },
      success: function(resposta) {
        $("#container_miolo").html(resposta);
      }
    });
  }
</script>
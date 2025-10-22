<?php
ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

// =========================================
// VERIFICA SE É EDIÇÃO OU NOVO POST
// =========================================
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$post = null;

if ($id > 0) {
  $sql = "SELECT * FROM conteudo_internet.blog_nacional WHERE pk_blognacional = $1 LIMIT 1";
  $result = pg_query_params($conn, $sql, [$id]);
  if ($result && pg_num_rows($result) > 0) {
    $post = pg_fetch_assoc($result);
  }
}

// =========================================
// SALVAR ALTERAÇÕES
// =========================================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titulo = pg_escape_string($_POST['titulo']);
  $descritivo_blumar = pg_escape_string($_POST['descritivo_blumar']);
  $data_post = pg_escape_string($_POST['data_post']);
  $ativo = isset($_POST['ativo']) ? 'true' : 'false';

  if ($id > 0) {
    // UPDATE
    $sql_update = "
            UPDATE conteudo_internet.blog_nacional
            SET titulo = '$titulo',
                descritivo_blumar = '$descritivo_blumar',
                data_post = '$data_post',
                ativo = $ativo
            WHERE pk_blognacional = $id
        ";
    pg_exec($conn, $sql_update);
    header('Location: lista_blog.php?msg=atualizado');
    exit;
  } else {
    // INSERT
    $sql_insert = "
            INSERT INTO conteudo_internet.blog_nacional
                (titulo, descritivo_blumar, data_post, ativo)
            VALUES
                ('$titulo', '$descritivo_blumar', '$data_post', $ativo)
        ";
    pg_exec($conn, $sql_insert);
    header('Location: lista_blog.php?msg=criado');
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title><?php echo $id > 0 ? 'Editar Post' : 'Novo Post'; ?> - Blog Nacional</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- TinyMCE - Editor de texto -->
  <script src="https://cdn.tiny.cloud/1/jo7idzhud6aviu1mcv8mllu99verm7oorkijqpuenv5rouqb/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#descritivo_blumar',
      height: 400,
      menubar: false,
      plugins: 'link image code lists table media',
      toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media | code',
      language: 'pt-BR'
    });
  </script>

  <style>
    body {
      padding: 30px;
      background-color: #f8f9fa;
    }

    .form-label {
      font-weight: 600;
    }
  </style>
</head>

<body>

  <div class="container bg-white p-4 shadow rounded">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="m-0"><?php echo $id > 0 ? '✏️ Editar Post' : '🆕 Novo Post'; ?></h3>
      <a href="lista_blog.php" class="btn btn-secondary btn-sm">← Voltar</a>
    </div>

    <form method="POST" action="">
      <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control" required
          value="<?php echo htmlspecialchars($post['titulo'] ?? ''); ?>">
      </div>

      <div class="mb-3">
        <label for="data_post" class="form-label">Data do Post</label>
        <input type="date" name="data_post" id="data_post" class="form-control"
          value="<?php echo htmlspecialchars($post['data_post'] ?? date('Y-m-d')); ?>">
      </div>

      <div class="mb-3">
        <label for="descritivo_blumar" class="form-label">Conteúdo</label>
        <textarea name="descritivo_blumar" id="descritivo_blumar" class="form-control"><?php
                                                                                        echo htmlspecialchars($post['descritivo_blumar'] ?? '');
                                                                                        ?></textarea>
      </div>

      <div class="form-check mb-3">
        <input type="checkbox" name="ativo" id="ativo" class="form-check-input"
          <?php echo (isset($post['ativo']) && $post['ativo'] === 't') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="ativo">Ativo</label>
      </div>

      <button type="submit" class="btn btn-primary">💾 Salvar</button>
    </form>
  </div>

</body>

</html>
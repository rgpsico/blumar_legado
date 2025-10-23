<?php
ini_set('display_errors', 1);
error_reporting(~0);

require_once '../util/connection.php';

$pk_blognacional = isset($_POST['pk_blognacional']) ? intval($_POST['pk_blognacional']) : 0;

if ($pk_blognacional <= 0) {
    echo '<div class="alert alert-danger">Post não encontrado!</div>';
    exit;
}

$sql = "SELECT * FROM conteudo_internet.blog_nacional WHERE pk_blognacional = $1";
$result = pg_query_params($conn, $sql, [$pk_blognacional]);
if (!$result || pg_num_rows($result) === 0) {
    echo '<div class="alert alert-danger">Post não encontrado!</div>';
    exit;
}

$post = pg_fetch_assoc($result);

$query_cidade = "
    select 
        pk_cidade_tpo, 
        nome_pt, 
        nome_en, 
        descritivo_pt, 
        descritivo_en, 
        foto1, 
        foto2,
        tpocidcod,
        cidade_cod 
    from 
        tarifario.cidade_tpo
    order by 
        nome_en
";

$result_cidade = pg_exec($conn, $query_cidade);
$cidades_options = '<option value="0" ' . ($post['citie'] == 0 ? 'selected' : '') . '>Escolha uma cidade para o post</option>';
if ($result_cidade) {
    for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) {
        $nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
        $cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
        $selected = ($post['citie'] == $cidade_cod) ? 'selected' : '';
        $cidades_options .= '<option value="' . $cidade_cod . '" ' . $selected . '>' . $nome_en . '</option>';
    }
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://cdn.tiny.cloud/1/jo7idzhud6aviu1mcv8mllu99verm7oorkijqpuenv5rouqb/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>

<div class="container-fluid bg-white p-4 shadow-sm rounded">
    <h4 class="mb-3">✏️ Editar Posts - <?php echo htmlspecialchars($post['titulo']); ?></h4>

    <form id="form_editar_post">
        <input type="hidden" id="pk_blognacional" value="<?php echo $post['pk_blognacional']; ?>">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" id="titulo" class="form-control" value="<?php echo htmlspecialchars($post['titulo']); ?>" maxlength="200">
            </div>

            <div class="col-md-3 mb-3">
                <label for="data_post" class="form-label">Data do Post</label>
                <input type="date" id="data_post" class="form-control"
                    value="<?php echo htmlspecialchars($post['data_post']); ?>">
            </div>

            <div class="col-md-3 mb-3">
                <label for="classif" class="form-label">Tipo</label>
                <select id="classif" class="form-select">
                    <option value="0" <?php echo ($post['classif'] == 0) ? 'selected' : ''; ?>>-----------------</option>
                    <option value="1" <?php echo ($post['classif'] == 1) ? 'selected' : ''; ?>>Hotels</option>
                    <option value="2" <?php echo ($post['classif'] == 2) ? 'selected' : ''; ?>>Tours</option>
                    <option value="3" <?php echo ($post['classif'] == 3) ? 'selected' : ''; ?>>Boats</option>
                    <option value="4" <?php echo ($post['classif'] == 4) ? 'selected' : ''; ?>>Flights</option>
                    <option value="5" <?php echo ($post['classif'] == 5) ? 'selected' : ''; ?>>Destinations</option>
                    <option value="6" <?php echo ($post['classif'] == 6) ? 'selected' : ''; ?>>Festivals</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="citie" class="form-label">Cidade</label>
                <select id="citie" class="form-select">
                    <?php echo $cidades_options; ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="regiao" class="form-label">Região Geográfica</label>
                <select id="regiao" class="form-select">
                    <option value="0" <?php echo ($post['regiao'] == 0) ? 'selected' : ''; ?>>-----------------</option>
                    <option value="1" <?php echo ($post['regiao'] == 1) ? 'selected' : ''; ?>>Norte</option>
                    <option value="2" <?php echo ($post['regiao'] == 2) ? 'selected' : ''; ?>>Nordeste</option>
                    <option value="3" <?php echo ($post['regiao'] == 3) ? 'selected' : ''; ?>>Sudeste</option>
                    <option value="4" <?php echo ($post['regiao'] == 4) ? 'selected' : ''; ?>>Centro-Oeste</option>
                    <option value="5" <?php echo ($post['regiao'] == 5) ? 'selected' : ''; ?>>Sul</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="descritivo_blumar" class="form-label">Conteúdo (Blumar)</label>
            <textarea id="descritivo_blumar" name="descritivo_blumar" class="form-control" rows="8"><?php echo $post['descritivo_blumar']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="descritivo_be" class="form-label">Conteúdo (BeBrazil)</label>
            <textarea id="descritivo_be" name="descritivo_be" class="form-control" rows="4"><?php echo $post['descritivo_be']; ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="foto_capa" class="form-label">Foto de Capa (URL)</label>
                <input type="text" id="foto_capa" class="form-control" value="<?php echo htmlspecialchars($post['foto_capa']); ?>" maxlength="200">
            </div>

            <div class="col-md-6 mb-3">
                <label for="foto_topo" class="form-label">Foto de Topo (URL)</label>
                <input type="text" id="foto_topo" class="form-control" value="<?php echo htmlspecialchars($post['foto_topo']); ?>" maxlength="200">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="url_video" class="form-label">URL do Vídeo (YouTube, Vimeo...)</label>
                <input type="text" id="url_video" class="form-control" value="<?php echo htmlspecialchars($post['url_video']); ?>" maxlength="200">
            </div>

            <div class="col-md-6 mb-3">
                <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                <input type="text" id="meta_description" class="form-control" value="<?php echo htmlspecialchars($post['meta_description']); ?>" maxlength="200">
            </div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" id="ativo" class="form-check-input" <?php echo ($post['ativo'] === 't') ? 'checked' : ''; ?>>
            <label for="ativo" class="form-check-label">Ativo</label>
        </div>

        <button type="button" class="btn btn-primary" onclick="alteracao_post()">💾 Salvar Alterações</button>
        <button type="button" class="btn btn-secondary" onclick="acao_blognacional()">← Voltar</button>
    </form>
</div>

<script>
    setTimeout(function() {
        if (typeof tinymce !== "undefined") {
            tinymce.remove();
            tinymce.init({
                selector: "#descritivo_blumar, #descritivo_be",
                plugins: "image link media code fullscreen lists table",
                toolbar: "undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image media | fullscreen code",
                language: "pt_BR",
                branding: false,
                height: 400,

                images_upload_url: 'blogv2/upload_image.php',
                automatic_uploads: true,

                file_picker_callback: function(cb, value, meta) {
                    if (meta.filetype === 'image') {
                        const input = document.createElement('input');
                        input.type = 'file';
                        input.accept = 'image/*';
                        input.onchange = function() {
                            const file = this.files[0];
                            const formData = new FormData();
                            formData.append('file', file);
                            fetch('blogv2/upload_image.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(res => res.json())
                                .then(data => cb(data.location, {
                                    title: file.name
                                }))
                                .catch(err => alert('Erro: ' + err));
                        };
                        input.click();
                    }
                }
            });
        }
    }, 500);
</script>
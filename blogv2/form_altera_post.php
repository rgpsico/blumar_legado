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
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://cdn.tiny.cloud/1/jo7idzhud6aviu1mcv8mllu99verm7oorkijqpuenv5rouqb/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>

<div class="container-fluid bg-white p-4 shadow-sm rounded">
    <h4 class="mb-3">✏️ Editar Post - <?php echo htmlspecialchars($post['titulo']); ?></h4>

    <form id="form_editar_post">
        <input type="hidden" id="pk_blognacional" value="<?php echo $post['pk_blognacional']; ?>">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" id="titulo" class="form-control" value="<?php echo htmlspecialchars($post['titulo']); ?>">
            </div>

            <div class="col-md-3 mb-3">
                <label for="data_post" class="form-label">Data do Post</label>
                <input type="date" id="data_post" class="form-control"
                    value="<?php echo htmlspecialchars($post['data_post']); ?>">
            </div>

            <div class="col-md-3 mb-3">
                <label for="classif" class="form-label">Classificação</label>
                <input type="number" id="classif" class="form-control" min="1" max="99"
                    value="<?php echo htmlspecialchars($post['classif']); ?>">
            </div>
        </div>

        <div class="mb-3">
            <label for="descritivo_blumar" class="form-label">Conteúdo (Blumar)</label>
            <textarea id="descritivo_blumar" name="descritivo_blumar" class="form-control" rows="8"><?php echo htmlspecialchars($post['descritivo_blumar']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="descritivo_be" class="form-label">Conteúdo (Be)</label>
            <textarea id="descritivo_be" class="form-control" rows="4"><?php echo htmlspecialchars($post['descritivo_be']); ?></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="foto_capa" class="form-label">Foto de Capa (URL)</label>
                <input type="text" id="foto_capa" class="form-control" value="<?php echo htmlspecialchars($post['foto_capa']); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="foto_topo" class="form-label">Foto de Topo (URL)</label>
                <input type="text" id="foto_topo" class="form-control" value="<?php echo htmlspecialchars($post['foto_topo']); ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="url_video" class="form-label">URL do Vídeo (YouTube, Vimeo...)</label>
                <input type="text" id="url_video" class="form-control" value="<?php echo htmlspecialchars($post['url_video']); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="meta_description" class="form-label">Meta Description (SEO)</label>
                <input type="text" id="meta_description" class="form-control" value="<?php echo htmlspecialchars($post['meta_description']); ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="citie" class="form-label">Cidade (ID)</label>
                <input type="number" id="citie" class="form-control" value="<?php echo htmlspecialchars($post['citie']); ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label for="regiao" class="form-label">Região (ID)</label>
                <input type="number" id="regiao" class="form-control" value="<?php echo htmlspecialchars($post['regiao']); ?>">
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
                height: 500,
                menubar: "file edit view insert format tools table help",
                plugins: [
                    "advlist",
                    "autolink",
                    "lists",
                    "link",
                    "image",
                    "charmap",
                    "preview",
                    "anchor",
                    "searchreplace",
                    "visualblocks",
                    "code",
                    "fullscreen",
                    "insertdatetime",
                    "media",
                    "table",
                    "code",
                    "help",
                    "wordcount"
                ],
                toolbar: "undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | " +
                    "bullist numlist outdent indent | link image media | fullscreen preview code",
                image_title: true,
                automatic_uploads: false, // você pode deixar true se quiser upload via input file
                file_picker_types: "image",
                image_caption: true,
                // 🔹 Permite inserir imagem por URL
                images_upload_url: false,
                image_advtab: true,
                // 🔹 Permite colar imagens externas (caso queira futuramente)
                paste_data_images: true,
                // 🔹 Configura o idioma e estilo visual
                language: "pt_BR",
                branding: false,
                content_style: "body { font-family:Helvetica,Arial,sans-serif; font-size:14px }",
            });
        }
    }, 200);
</script>
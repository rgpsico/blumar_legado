<?php
ini_set('display_errors', 1);
error_reporting(~0);
require_once '../util/connection.php'; // Assumindo que o connection.php está no caminho correto; ajuste se necessário

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
$cidades_options = '';
if ($result_cidade) {
    for ($rowcid = 0; $rowcid < pg_numrows($result_cidade); $rowcid++) {
        $nome_en = pg_result($result_cidade, $rowcid, 'nome_en');
        $cidade_cod = pg_result($result_cidade, $rowcid, 'cidade_cod');
        $cidades_options .= '<option value="' . $cidade_cod . '">' . $nome_en . '</option>';
    }
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.tiny.cloud/1/jo7idzhud6aviu1mcv8mllu99verm7oorkijqpuenv5rouqb/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>

<div class="container-fluid bg-white p-4 shadow-sm rounded">
    <h4 class="mb-3">🆕 Novo Post</h4>

    <form id="form_novo_post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" id="titulo" class="form-control" maxlength="200">
            </div>

            <div class="col-md-3 mb-3">
                <label for="data_post" class="form-label">Data do Post</label>
                <input type="date" id="data_post" class="form-control" value="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="col-md-3 mb-3">
                <label for="classif" class="form-label">Tipo</label>
                <select id="classif" class="form-select">
                    <option value="0">-----------------</option>
                    <option value="1">Hotels</option>
                    <option value="2">Tours</option>
                    <option value="3">Boats</option>
                    <option value="4">Flights</option>
                    <option value="5">Destinations</option>
                    <option value="6">Festivals</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="citie" class="form-label">Cidade</label>
                <select id="citie" class="form-select">
                    <option value="0" selected>Escolha uma cidade para o post</option>
                    <?php echo $cidades_options; ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="regiao" class="form-label">Região Geográfica</label>
                <select id="regiao" class="form-select">
                    <option value="0">-----------------</option>
                    <option value="1">Norte</option>
                    <option value="2">Nordeste</option>
                    <option value="3">Sudeste</option>
                    <option value="4">Centro-Oeste</option>
                    <option value="5">Sul</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="descritivo_blumar" class="form-label">Conteúdo (Blumar)</label>
            <textarea id="descritivo_blumar" name="descritivo_blumar" class="form-control" rows="8"></textarea>
        </div>

        <div class="mb-3">
            <label for="descritivo_be" class="form-label">Conteúdo (BeBrazil)</label>
            <textarea id="descritivo_be" name="descritivo_be" class="form-control" rows="4"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="foto_capa" class="form-label">Foto de Capa (URL)</label>
                <input type="text" id="foto_capa" class="form-control" maxlength="200">
            </div>

            <div class="col-md-6 mb-3">
                <label for="foto_topo" class="form-label">Foto de Topo (URL)</label>
                <input type="text" id="foto_topo" class="form-control" maxlength="200">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="url_video" class="form-label">URL do Vídeo</label>
                <input type="text" id="url_video" class="form-control" maxlength="200">
            </div>

            <div class="col-md-6 mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <input type="text" id="meta_description" class="form-control" maxlength="200">
            </div>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" id="ativo" class="form-check-input" checked>
            <label for="ativo" class="form-check-label">Ativo</label>
        </div>

        <button type="button" class="btn btn-success" onclick="insere_novo_postv2()">💾 Salvar</button>
        <button type="button" class="btn btn-secondary" onclick="acao_blognacionalv2()">← Voltar</button>
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

    function insere_novo_postv2() {
        // 🔄 Atualiza conteúdo do TinyMCE nos textareas
        tinymce.triggerSave();

        const dados = {
            titulo: $("#titulo").val(),
            data_post: $("#data_post").val(),
            classif: $("#classif").val(),
            descritivo_blumar: $("#descritivo_blumar").val(),
            descritivo_be: $("#descritivo_be").val(),
            foto_capa: $("#foto_capa").val(),
            foto_topo: $("#foto_topo").val(),
            url_video: $("#url_video").val(),
            meta_description: $("#meta_description").val(),
            citie: $("#citie").val(),
            regiao: $("#regiao").val(),
            ativo: $("#ativo").is(":checked") ? "true" : "false"
        };

        $.post("blogv2/insere_novo_post.php", dados, function(resp) {
            alert(resp);
            acao_blognacionalv2();
        }).fail(function(xhr) {
            alert("❌ Erro ao salvar: " + xhr.responseText);
        });
    }
</script>
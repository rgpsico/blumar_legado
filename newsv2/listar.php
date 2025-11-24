<?php
// Nova tela de newsletters (v2) reaproveitando formulários do legado
$pk_news = isset($_GET['pk_news']) ? (int) $_GET['pk_news'] : null;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletters - Conteúdo do Especialista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f6fa;
        }
        .card {
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175);
        }
        .form-select,
        .form-control,
        .form-label {
            color: #212529;
        }
        .form-select option {
            color: #212529;
        }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <strong>Comentário do especialista</strong>
        </div>
        <div class="card-body">
            <p class="text-muted">Selecione um especialista para abrir o formulário herdado do legado e salvar os dados na nova API.</p>
            <div class="row g-3 align-items-end">
                <div class="col-md-6">
                    <label for="especialistaSelect" class="form-label">Especialista</label>
                    <select id="especialistaSelect" class="form-select text-dark">
                        <option value="">Escolha o especialista</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Newsletter</label>
                    <input type="text" class="form-control" id="pk_news" value="<?php echo htmlspecialchars((string) $pk_news); ?>" placeholder="ID da newsletter" />
                </div>
            </div>
        </div>
    </div>

    <div id="formContainer" class="card d-none">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <span>Formulário do especialista</span>
            <span class="small" id="especialistaInfo"></span>
        </div>
        <div class="card-body">
            <form id="formEspecialista">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="titulo">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="subtitulo">Subtítulo</label>
                        <input type="text" class="form-control" id="subtitulo" name="subtitulo">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="comentario">Comentário</label>
                        <textarea class="form-control" id="comentario" name="comentario" rows="5" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="link">Link do especialista</label>
                        <input type="url" class="form-control" id="link" name="link" placeholder="https://...">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="imagem">URL da imagem</label>
                        <input type="url" class="form-control" id="imagem" name="imagem" placeholder="https://...">
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Salvar comentário</button>
                    <button type="button" id="btnLimpar" class="btn btn-outline-secondary">Limpar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const especialistaSelect = document.getElementById('especialistaSelect');
const formContainer = document.getElementById('formContainer');
const form = document.getElementById('formEspecialista');
const especialistaInfo = document.getElementById('especialistaInfo');
const pkNewsInput = document.getElementById('pk_news');
const btnLimpar = document.getElementById('btnLimpar');

async function carregarEspecialistas() {
    const response = await fetch('../api/news.php?request=listar_especialistas');
    const data = await response.json();
    especialistaSelect.innerHTML = '<option value="">Escolha o especialista</option>';
    data.data.forEach((item) => {
        const option = document.createElement('option');
        option.value = item.id;
        option.textContent = item.nome;
        especialistaSelect.appendChild(option);
    });
}

async function carregarFormulario(especialistaId) {
    if (!especialistaId) {
        formContainer.classList.add('d-none');
        form.reset();
        return;
    }
    const params = new URLSearchParams({
        request: 'carregar_comentario_especialista',
        especialista_id: especialistaId,
        pk_news: pkNewsInput.value || ''
    });
    const response = await fetch('../api/news.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: params.toString()
    });
    const payload = await response.json();
    const { especialista, comentario } = payload;
    especialistaInfo.textContent = `${especialista.nome} • ${especialista.cargo || 'Especialista'}`;
    document.getElementById('titulo').value = comentario.titulo || '';
    document.getElementById('subtitulo').value = comentario.subtitulo || '';
    document.getElementById('comentario').value = comentario.comentario || '';
    document.getElementById('link').value = comentario.link || '';
    document.getElementById('imagem').value = comentario.imagem || '';
    formContainer.classList.remove('d-none');
}

form.addEventListener('submit', async (event) => {
    event.preventDefault();
    const params = new URLSearchParams({
        request: 'salvar_comentario_especialista',
        especialista_id: especialistaSelect.value,
        pk_news: pkNewsInput.value || '',
        titulo: document.getElementById('titulo').value,
        subtitulo: document.getElementById('subtitulo').value,
        comentario: document.getElementById('comentario').value,
        link: document.getElementById('link').value,
        imagem: document.getElementById('imagem').value
    });

    const response = await fetch('../api/news.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: params.toString()
    });

    const payload = await response.json();
    if (payload.success) {
        alert('Comentário salvo com sucesso!');
    } else {
        alert(payload.message || 'Erro ao salvar.');
    }
});

btnLimpar.addEventListener('click', () => {
    form.reset();
});

especialistaSelect.addEventListener('change', (event) => {
    carregarFormulario(event.target.value);
});

carregarEspecialistas();
</script>
</body>
</html>

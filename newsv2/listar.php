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
            <p class="text-muted">Selecione um especialista para abrir o formulário herdado do legado e editar os dados diretamente na interface original.</p>
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
            <span>Formulário do especialista (legado)</span>
            <span class="small" id="especialistaInfo"></span>
        </div>
        <div class="card-body p-0">
            <div class="p-3 border-bottom">
                <p class="mb-0 text-muted">
                    O formulário abaixo é carregado diretamente do sistema legado. Qualquer alteração será feita no mesmo fluxo
                    já conhecido pelos usuários.
                </p>
            </div>
            <iframe id="iframeLegado" src="" style="width: 100%; min-height: 80vh; border: 0;"></iframe>
        </div>
    </div>
</div>

<script>
const especialistaSelect = document.getElementById('especialistaSelect');
const formContainer = document.getElementById('formContainer');
const especialistaInfo = document.getElementById('especialistaInfo');
const pkNewsInput = document.getElementById('pk_news');
const iframeLegado = document.getElementById('iframeLegado');
const LEGACY_FORM_URL = '../news/listar.php';

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

function abrirFormularioLegado(especialistaId) {
    if (!especialistaId) {
        formContainer.classList.add('d-none');
        iframeLegado.src = '';
        especialistaInfo.textContent = '';
        return;
    }

    const pkNews = pkNewsInput.value.trim();
    if (!pkNews) {
        alert('Informe o ID da newsletter antes de abrir o formulário.');
        especialistaSelect.value = '';
        return;
    }

    const url = new URL(LEGACY_FORM_URL, window.location.href);
    url.searchParams.set('pk_news', pkNews);
    url.searchParams.set('especialista_id', especialistaId);

    const selectedOption = especialistaSelect.options[especialistaSelect.selectedIndex];
    especialistaInfo.textContent = `${selectedOption.textContent} • formulário do legado`;
    iframeLegado.src = url.toString();
    formContainer.classList.remove('d-none');
    formContainer.scrollIntoView({ behavior: 'smooth' });
}

especialistaSelect.addEventListener('change', (event) => {
    abrirFormularioLegado(event.target.value);
});

carregarEspecialistas();
</script>
</body>
</html>

$(document).ready(function () {
    // Inicializa a página
    init();

    /**
     * Inicialização
     */
    function init() {
        carregarTodasCidades();
        carregarCidadesPorTipo();
        carregarCidadesUpload(); // Carrega cidades no select de upload
        setupEventListeners();
    }

    /**
     * Configura os event listeners
     */
    function setupEventListeners() {
        // Listener para mudança na cidade principal
        $('#cidade_cod').on('change', function () {
            const cidadeCod = $(this).val();
            // Você pode adicionar lógica adicional aqui se necessário
            console.log('Cidade selecionada:', cidadeCod);
        });

        // Listener para mudança nas cidades por tipo de produto
        $('.select-cidade').on('change', function () {
            const tipoProduto = $(this).data('tipo');
            const cidadeCod = $(this).val();

            if (cidadeCod !== '0') {
                if (tipoProduto === '2') {
                    // Para tours: carrega galeria flat de todas as imagens da cidade (como no legado)
                    carregarImagensTourCidade(cidadeCod, tipoProduto);
                } else if (tipoProduto === '11') {
                    carregarGaleriaInspection(cidadeCod, tipoProduto);
                } else {
                    // Para outros tipos (ex: Hotel): carrega lista de produtos agrupados
                    carregarProdutosPorCidade(cidadeCod, tipoProduto);
                }
            } else {
                $(`#miolo_prod${tipoProduto}`).html('');
            }
        });

        // Event delegation para botões de delete (funciona para tours e modal)
        $(document).on('click', '.delete-img', function (e) {
            e.preventDefault();
            const pkBcoImg = $(this).data('pk');
            const card = $(this).closest('.galeria-item, #tumb_bancoimg');
            const isTour = $(this).closest('#miolo_prod2').length > 0;
            const isModal = $(this).closest('#modal-galeria').length > 0;

            if (confirm('Tem certeza que deseja excluir esta imagem do banco de dados? (A imagem física será preservada)')) {
                deletarImagem(pkBcoImg, card, isTour, isModal);
            }
        });
    }

    /**
     * Deleta imagem via AJAX
     */
    function deletarImagem(pkBcoImg, card, isTour, isModal) {
        $.ajax({
            url: 'ajax_handler.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'deletar_imagem',
                pk_bco_img: pkBcoImg
            },
            success: function (response) {
                if (response.success) {
                    // Remove o card do DOM
                    card.fadeOut(300, function () {
                        $(this).remove();
                    });
                    // Se era a última imagem, mostra mensagem
                    if (isTour && $('.tumb_bancoimg').length === 0) {
                        $('#miolo_prod2').append('<p class="alert alert-info">Nenhuma imagem restante.</p>');
                    } else if (isModal && $('.galeria-item').length === 0) {
                        $('#galeria-imagens-container').html('<div class="alert alert-info">Nenhuma imagem encontrada.</div>');
                    }
                    mostrarSucesso('Imagem excluída com sucesso do banco de dados.');
                } else {
                    mostrarErro('Erro ao excluir: ' + (response.error || 'Desconhecido'));
                }
            },
            error: function (xhr, status, error) {
                mostrarErro('Erro na requisição de exclusão: ' + error);
            }
        });
    }

    /**
     * Mostra mensagem de sucesso
     */
    function mostrarSucesso(mensagem) {
        console.log('Sucesso: ' + mensagem);
        // Opcional: adicionar toast ou alert
        alert(mensagem); // Pode ser substituído por um sistema de notificações
    }

    /**
     * Carrega todas as cidades no select principal
     */
    function carregarTodasCidades() {
        $.ajax({
            url: 'ajax_handler.php',
            type: 'POST',
            dataType: 'json',
            data: { action: 'carregar_cidades' },
            success: function (response) {
                if (response.success) {
                    let options = '<option value="0">Escolha uma cidade</option>';

                    response.cidades.forEach(function (cidade) {
                        options += `<option value="${cidade.cidade_cod}">${cidade.nome_en}</option>`;
                    });

                    $('#cidade_cod').html(options);
                } else {
                    mostrarErro('Erro ao carregar cidades: ' + response.error);
                }
            },
            error: function (xhr, status, error) {
                mostrarErro('Erro na requisição: ' + error);
            }
        });
    }

    /**
     * Carrega cidades para cada tipo de produto
     */
    function carregarCidadesPorTipo() {
        $('.select-cidade').each(function () {
            const selectElement = $(this);
            const tipoProduto = selectElement.data('tipo');

            if (tipoProduto == '11') {
                // Para inspection reports, carrega inspections
                carregarInspections(selectElement);
            } else {
                // Para outros tipos, carrega cidades
                $.ajax({
                    url: 'ajax_handler.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        action: 'carregar_cidades_por_tipo',
                        tp_produto: tipoProduto
                    },
                    success: function (response) {
                        if (response.success) {
                            let options = '<option value="0">Escolha uma cidade</option>';

                            response.cidades.forEach(function (cidade) {
                                if (cidade.nome_en) {
                                    options += `<option value="${cidade.fk_cidcod}">${cidade.nome_en}</option>`;
                                }
                            });

                            selectElement.html(options);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Erro ao carregar cidades do tipo ' + tipoProduto + ':', error);
                    }
                });
            }
        });
    }

    /**
     * Carrega cidades no select de upload (reutiliza a lógica de carregarTodasCidades)
     */
    function carregarCidadesUpload() {
        $.ajax({
            url: 'ajax_handler.php',
            type: 'POST',
            dataType: 'json',
            data: { action: 'carregar_cidades' },
            success: function (response) {
                if (response.success) {
                    let options = '<option value="">Escolha uma cidade</option>'; // Mantém o default

                    response.cidades.forEach(function (cidade) {
                        options += `<option value="${cidade.cidade_cod}">${cidade.nome_en}</option>`;
                    });

                    $('#upload_cidade_cod').html(options);
                } else {
                    console.error('Erro ao carregar cidades para upload: ' + response.error);
                }
            },
            error: function (xhr, status, error) {
                console.error('Erro na requisição de cidades para upload: ' + error);
            }
        });
    }

    /**
     * Carrega inspections
     */
    function carregarInspections(selectElement) {
        $.ajax({
            url: 'ajax_handler.php',
            type: 'POST',
            dataType: 'json',
            data: { action: 'carregar_inspections' },
            success: function (response) {
                if (response.success) {
                    let options = '<option value="0">Escolha um inspection</option>';

                    response.inspections.forEach(function (inspection) {
                        options += `<option value="${inspection.pk_ireport_destinations}">
                                        ${inspection.pk_ireport_destinations} - ${inspection.destinos}
                                    </option>`;
                    });

                    selectElement.html(options);
                }
            },
            error: function (xhr, status, error) {
                console.error('Erro ao carregar inspections:', error);
            }
        });
    }

    /**
     * Carrega galeria flat de tours para a cidade (adaptado do legado)
     */
    function carregarImagensTourCidade(cidadeCod, tipoProduto) {
        const targetDiv = $(`#miolo_prod${tipoProduto}`);

        // Mostra loading
        targetDiv.html('<div class="loading">Carregando tours...</div>');

        $.ajax({
            url: 'ajax_handler.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'carregar_imagens_tour_cidade',
                cidade_cod: cidadeCod
            },
            success: function (response) {
                if (response.success) {
                    targetDiv.html(response.html);
                } else {
                    targetDiv.html('<div class="alert alert-danger">Erro ao carregar tours: ' + (response.error || 'Desconhecido') + '</div>');
                }
            },
            error: function (xhr, status, error) {
                targetDiv.html('<div class="alert alert-danger">Erro na requisição.</div>');
                console.error('Erro:', error);
            }
        });
    }

    /**
     * Carrega produtos por cidade e tipo (para tipos agrupados, ex: Hotel)
     */
    function carregarProdutosPorCidade(cidadeCod, tipoProduto) {
        const targetDiv = $(`#miolo_prod${tipoProduto}`);

        // Mostra loading
        targetDiv.html('<div class="loading">Carregando...</div>');

        $.ajax({
            url: 'ajax_handler.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'carregar_produtos',
                cidade_cod: cidadeCod,
                tp_produto: tipoProduto
            },
            success: function (response) {
                if (response.success) {
                    if (response.produtos.length > 0) {
                        let html = '<div class="lista-produtos">';
                        html += '<table class="table-produtos">';
                        html += '<thead><tr>';
                        html += '<th>Código</th>';
                        html += '<th>Nome</th>';
                        html += '<th>Total de Imagens</th>';
                        html += '<th>Ações</th>';
                        html += '</tr></thead>';
                        html += '<tbody>';

                        response.produtos.forEach(function (produto) {
                            const nomeProduto = produto.nome_fornecedor || produto.nome_produto || 'N/A';
                            html += `<tr>
                                        <td>${produto.mneu_for}</td>
                                        <td><strong>${nomeProduto}</strong></td>
                                        <td><span class="badge">${produto.total_imagens} foto(s)</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-info btn-ver-galeria" 
                                                    data-mneu="${produto.mneu_for}"
                                                    data-nome="${nomeProduto}"
                                                    data-tp="${tipoProduto}">
                                                📷 Ver Galeria
                                            </button>
                                        </td>
                                    </tr>`;
                        });

                        html += '</tbody></table></div>';
                        targetDiv.html(html);

                        // Adiciona event listener para os botões de galeria
                        $('.btn-ver-galeria').off('click').on('click', function () {  // Use off para evitar múltiplos binds
                            const mneuFor = $(this).data('mneu');
                            const nomeProduto = $(this).data('nome');
                            const tpProduto = $(this).data('tp');
                            abrirGaleria(mneuFor, nomeProduto, tpProduto);
                        });
                    } else {
                        targetDiv.html('<div class="alert alert-info">Nenhum produto encontrado.</div>');
                    }
                } else {
                    targetDiv.html('<div class="alert alert-danger">Erro ao carregar produtos.</div>');
                }
            },
            error: function (xhr, status, error) {
                targetDiv.html('<div class="alert alert-danger">Erro na requisição.</div>');
                console.error('Erro:', error);
            }
        });
    }

    /**
     * Carrega galeria de inspection
     */
    function carregarGaleriaInspection(inspectionId, tipoProduto) {
        const targetDiv = $(`#miolo_prod${tipoProduto}`);

        // Mostra loading
        targetDiv.html('<div class="loading">Carregando inspection...</div>');

        $.ajax({
            url: 'ajax_handler.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'carregar_produtos',
                cidade_cod: inspectionId,
                tp_produto: tipoProduto
            },
            success: function (response) {
                if (response.success) {
                    if (response.produtos.length > 0) {
                        let html = '<div class="galeria-inspection">';

                        response.produtos.forEach(function (item) {
                            html += `<div class="inspection-item">
                                        <h4>${item.titulo || 'Inspection'}</h4>
                                        <p>${item.descricao || ''}</p>
                                    </div>`;
                        });

                        html += '</div>';
                        targetDiv.html(html);
                    } else {
                        targetDiv.html('<div class="alert alert-info">Nenhum inspection encontrado.</div>');
                    }
                }
            },
            error: function (xhr, status, error) {
                targetDiv.html('<div class="alert alert-danger">Erro ao carregar inspection.</div>');
            }
        });
    }

    /**
     * Mostra mensagem de erro
     */
    function mostrarErro(mensagem) {
        console.error(mensagem);
        // Você pode adicionar um sistema de notificações aqui
        alert(mensagem);
    }

    /**
     * Abre a galeria de imagens de um produto (agora aceita tp_produto)
     */
    function abrirGaleria(mneuFor, nomeProduto, tpProduto) {
        // Cria o modal se não existir
        if ($('#modal-galeria').length === 0) {
            criarModalGaleria();
        }

        // Atualiza o título
        $('#modal-galeria-titulo').html(`<b>${nomeProduto.toUpperCase()}</b> PICTURES`);

        // Carrega as imagens
        carregarImagensProduto(mneuFor, nomeProduto, tpProduto);

        // Mostra o modal
        $('#modal-galeria').fadeIn(300);
        $('body').css('overflow', 'hidden');
    }

    /**
     * Cria o modal da galeria
     */
    function criarModalGaleria() {
        const modalHtml = `
            <div id="modal-galeria" class="modal-galeria">
                <div class="modal-galeria-content">
                    <div class="modal-galeria-header">
                        <div id="modal-galeria-titulo"></div>
                        <button class="modal-galeria-close">&times;</button>
                    </div>
                    <div class="modal-galeria-body" id="galeria-imagens-container">
                        <!-- Imagens serão carregadas aqui -->
                    </div>
                </div>
            </div>
        `;

        $('body').append(modalHtml);

        // Event listener para fechar
        $('.modal-galeria-close, #modal-galeria').on('click', function (e) {
            if (e.target === this) {
                $('#modal-galeria').fadeOut(300);
                $('body').css('overflow', 'auto');
            }
        });
    }

    /**
     * Carrega imagens do produto (agora aceita tp_produto)
     */
    function carregarImagensProduto(mneuFor, nomeProduto, tpProduto) {
        const container = $('#galeria-imagens-container');

        // Mostra loading
        container.html('<div class="loading">Carregando galeria...</div>');

        $.ajax({
            url: 'ajax_handler.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'carregar_imagens_produto',
                mneu_for: mneuFor,
                tp_produto: tpProduto
            },
            success: function (response) {
                if (response.success && response.imagens.length > 0) {
                    let html = '<div class="galeria-grid">';

                    response.imagens.forEach(function (img) {
                        html += criarCardImagem(img, nomeProduto, mneuFor);
                    });

                    html += '</div>';
                    container.html(html);
                } else {
                    container.html('<div class="alert alert-info">Nenhuma imagem encontrada.</div>');
                }
            },
            error: function (xhr, status, error) {
                container.html('<div class="alert alert-danger">Erro ao carregar imagens.</div>');
                console.error('Erro:', error);
            }
        });
    }

    /**
     * Cria o card de uma imagem (para modal, outros tipos) - Adicionado botão delete
     */
    function criarCardImagem(img, nomeProduto, mneuFor) {
        const legenda = img.legenda ? img.legenda.substring(0, 21) : '';
        const autor = img.autor || '';
        const fachada = img.fachada === 't' ? '<span class="badge-fachada" title="Fachada">F</span>' : '';
        const nacional = img.nacional === 't' ? '<span class="badge-nacional" title="Nacional">N</span>' : '';

        let html = `
            <div class="galeria-item">
                <div class="galeria-item-img">
                    <img src="https://www.blumar.com.br/${img.tam_1}" 
                         alt="${legenda}"
                         loading="lazy">
                </div>
                
                <div class="galeria-item-info">
                    ${legenda ? `<div class="galeria-legenda"><b>${legenda}</b></div>` : ''}
                    
                    <div class="galeria-meta">
                        <span class="galeria-id">ID: ${img.pk_bco_img}</span>
                        ${autor ? `<span class="galeria-autor" title="${autor}">©</span>` : ''}
                        ${fachada}
                        ${nacional}
                        ${img.ordem ? `<span class="badge-ordem">${img.ordem}</span>` : ''}
                    </div>
                </div>
                
                <div class="galeria-item-actions">
        `;

        // Botões de tamanhos disponíveis
        if (img.tam_2) {
            html += `<button class="btn-tamanho" onclick="window.open('https://www.blumar.com.br/${img.tam_2}', '_blank')" title="300 x 200">T2</button>`;
        }
        if (img.tam_3) {
            html += `<button class="btn-tamanho" onclick="window.open('https://www.blumar.com.br/${img.tam_3}', '_blank')" title="450 x 300">T3</button>`;
        }
        if (img.tam_4) {
            html += `<button class="btn-tamanho" onclick="window.open('https://www.blumar.com.br/${img.tam_4}', '_blank')" title="840 x 560">T4</button>`;
        }
        if (img.tam_5) {
            html += `<button class="btn-tamanho" onclick="window.open('https://www.blumar.com.br/${img.tam_5}', '_blank')" title="Tamanho Original">T5</button>`;
        }
        if (img.zip) {
            html += `<button class="btn-tamanho btn-zip" onclick="window.open('https://www.blumar.com.br/${img.zip}', '_blank')" title="Arquivo Compactado">ZIP</button>`;
        }

        // Botão de delete (lixeirinha)
        html += `
                    <button class="btn-delete delete-img" data-pk="${img.pk_bco_img}" title="Excluir do banco">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        `;

        return html;
    }

    // Exportar função para uso global
    window.abrirGaleria = abrirGaleria;
});

// ===== CONTROLE DE ABAS ===== (mantido igual ao original)
document.addEventListener('DOMContentLoaded', function () {
    // Inicializar abas
    initializeTabs();
});

/**
 * Inicializa o sistema de abas
 */
function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabPanes = document.querySelectorAll('.tab-pane');

    // Adicionar event listeners aos botões de aba
    tabButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const tabName = this.getAttribute('data-tab');
            openTab(tabName);
        });
    });

    // Suporte para navegação com teclado
    tabButtons.forEach((button, index) => {
        button.addEventListener('keydown', function (e) {
            let targetIndex = null;

            if (e.key === 'ArrowRight') {
                targetIndex = (index + 1) % tabButtons.length;
                e.preventDefault();
            } else if (e.key === 'ArrowLeft') {
                targetIndex = (index - 1 + tabButtons.length) % tabButtons.length;
                e.preventDefault();
            } else if (e.key === 'Home') {
                targetIndex = 0;
                e.preventDefault();
            } else if (e.key === 'End') {
                targetIndex = tabButtons.length - 1;
                e.preventDefault();
            }

            if (targetIndex !== null) {
                tabButtons[targetIndex].focus();
                tabButtons[targetIndex].click();
            }
        });
    });
}

/**
 * Abre uma aba específica
 * @param {string} tabName - Nome da aba a ser aberta
 */
function openTab(tabName) {
    // Ocultar todas as abas
    const tabPanes = document.querySelectorAll('.tab-pane');
    tabPanes.forEach(pane => {
        pane.classList.remove('active');
    });

    // Remover classe active de todos os botões
    const tabButtons = document.querySelectorAll('.tab-button');
    tabButtons.forEach(button => {
        button.classList.remove('active');
    });

    // Mostrar aba selecionada
    const selectedPane = document.getElementById(tabName);
    if (selectedPane) {
        selectedPane.classList.add('active');

        // Ativar botão correspondente
        const activeButton = document.querySelector(`[data-tab="${tabName}"]`);
        if (activeButton) {
            activeButton.classList.add('active');
        }

        // Salvar aba ativa no localStorage (opcional)
        localStorage.setItem('activeTab', tabName);

        // Disparar evento customizado
        const event = new CustomEvent('tabChanged', { detail: { tabName } });
        document.dispatchEvent(event);

        // Fazer scroll suave para o topo
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}

/**
 * Recupera a aba ativa do localStorage
 */
function loadActiveTab() {
    const activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        openTab(activeTab);
    }
}

// Carregar aba ativa ao recarregar a página
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadActiveTab);
} else {
    loadActiveTab();
}

// ===== UTILITÁRIOS ===== (mantido igual ao original)
/**
 * Obtém a aba ativa no momento
 * @returns {string} Nome da aba ativa
 */
function getActiveTab() {
    const activeButton = document.querySelector('.tab-button.active');
    return activeButton ? activeButton.getAttribute('data-tab') : null;
}

/**
 * Verifica se uma aba está ativa
 * @param {string} tabName - Nome da aba
 * @returns {boolean}
 */
function isTabActive(tabName) {
    return getActiveTab() === tabName;
}

/**
 * Desabilita uma aba
 * @param {string} tabName - Nome da aba
 */
function disableTab(tabName) {
    const button = document.querySelector(`[data-tab="${tabName}"]`);
    if (button) {
        button.disabled = true;
    }
}

/**
 * Habilita uma aba
 * @param {string} tabName - Nome da aba
 */
function enableTab(tabName) {
    const button = document.querySelector(`[data-tab="${tabName}"]`);
    if (button) {
        button.disabled = false;
    }
}

/**
 * Atualiza o conteúdo de uma aba via AJAX
 * @param {string} tabName - Nome da aba
 * @param {string} url - URL para fazer requisição
 * @param {object} data - Dados para enviar (opcional)
 */
function updateTabContent(tabName, url, data = null) {
    const pane = document.getElementById(tabName);
    if (!pane) return;

    // Mostrar indicador de carregamento
    pane.innerHTML = '<div class="loading"><i class="fas fa-spinner fa-spin"></i> Carregando...</div>';

    const options = {
        method: data ? 'POST' : 'GET',
        headers: {
            'Content-Type': 'application/json',
        }
    };

    if (data) {
        options.body = JSON.stringify(data);
    }

    fetch(url, options)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.text();
        })
        .then(html => {
            pane.innerHTML = html;
            // Re-inicializar elementos após atualização
            document.dispatchEvent(new CustomEvent('tabContentUpdated', { detail: { tabName } }));
        })
        .catch(error => {
            console.error('Erro ao atualizar aba:', error);
            pane.innerHTML = '<div class="error"><p>Erro ao carregar o conteúdo</p></div>';
        });
}

/**
 * Listener para eventos de mudança de aba
 * @param {function} callback - Função a ser chamada quando mudar de aba
 */
function onTabChange(callback) {
    document.addEventListener('tabChanged', function (e) {
        callback(e.detail.tabName);
    });
}

// ===== EXEMPLOS DE USO ===== (mantido igual ao original)
// Ouvir mudanças de aba
onTabChange(function (tabName) {
    console.log('Aba ativa:', tabName);
});

// Exemplo: Atualizar conteúdo quando a aba "produtos" for aberta
document.addEventListener('tabChanged', function (e) {
    if (e.detail.tabName === 'produtos') {
        console.log('Aba de produtos aberta');
        // Aqui você pode carregar dados de produtos se necessário
    }
});
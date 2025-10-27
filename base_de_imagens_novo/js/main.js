$(document).ready(function () {
    // Inicializa a página
    init();

    /**
     * Inicialização
     */
    function init() {
        carregarTodasCidades();
        carregarCidadesPorTipo();
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
                if (tipoProduto === '11') {
                    carregarGaleriaInspection(cidadeCod, tipoProduto);
                } else {
                    carregarProdutosPorCidade(cidadeCod, tipoProduto);
                }
            } else {
                $(`#miolo_prod${tipoProduto}`).html('');
            }
        });
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
     * Carrega produtos por cidade e tipo
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
                        html += '<thead><tr><th>Nome</th><th>Descrição</th><th>Ações</th></tr></thead>';
                        html += '<tbody>';

                        response.produtos.forEach(function (produto) {
                            html += `<tr>
                                        <td>${produto.nome || 'N/A'}</td>
                                        <td>${produto.descricao || 'N/A'}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" onclick="verDetalhes(${produto.pk_bco_img})">
                                                Ver detalhes
                                            </button>
                                        </td>
                                    </tr>`;
                        });

                        html += '</tbody></table></div>';
                        targetDiv.html(html);
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
});

/**
 * Ver detalhes do produto (função global)
 */
function verDetalhes(produtoId) {
    // Implementar lógica para exibir detalhes
    console.log('Ver detalhes do produto:', produtoId);
    // Você pode abrir um modal ou redirecionar para outra página
}
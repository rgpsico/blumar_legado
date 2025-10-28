// js/upload.js - Funcionalidade de Upload de Múltiplos Arquivos de Imagem

$(document).ready(function () {
    let selectedFiles = []; // Armazena arquivos selecionados
    let currentUpload = null; // Controla upload em progresso

    /**
     * Configura eventos de drag and drop
     */
    setupDragAndDrop();

    /**
     * Configura o input de arquivos
     */
    setupFileInput();

    /**
     * Listener para submit do form
     */
    $('#uploadForm').on('submit', handleUpload);

    /**
     * Configura drag and drop na área de upload (para múltiplos arquivos)
     */
    function setupDragAndDrop() {
        const uploadArea = $('#uploadArea');

        // Drag over
        uploadArea.on('dragover dragenter', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('drag-over');
        });

        // Drag leave
        uploadArea.on('dragleave dragend', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('drag-over');
        });

        // Drop
        uploadArea.on('drop', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).removeClass('drag-over');

            const files = e.originalEvent.dataTransfer.files;
            if (files.length > 0) {
                processFiles(files);
            }
        });
    }

    /**
     * Configura o input de seleção de múltiplos arquivos
     */
    function setupFileInput() {
        $('#folderInput').on('change', function (e) {
            const files = e.target.files;
            if (files.length > 0) {
                processFiles(files);
            }
        });
    }

    /**
     * Processa arquivos selecionados (filtra apenas imagens JPG/PNG)
     */
    function processFiles(files) {
        selectedFiles = [];
        const fileList = $('#fileList');
        fileList.empty();

        let validFiles = 0;
        let invalidFiles = 0;

        // Filtra apenas imagens JPG e PNG
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const fileExt = file.name.split('.').pop().toLowerCase();

            if (['jpg', 'jpeg', 'png'].includes(fileExt)) {
                selectedFiles.push(file);
                validFiles++;

                // Adiciona à lista visual
                const fileItem = createFileItem(file);
                fileList.append(fileItem);
            } else {
                invalidFiles++;
            }
        }

        // Atualiza UI
        if (selectedFiles.length > 0) {
            $('#uploadBtn').prop('disabled', false);
            $('#clearBtn').prop('disabled', false);
            fileList.append(`<p class="file-summary">Total: ${selectedFiles.length} imagens válidas ${invalidFiles > 0 ? `| ${invalidFiles} arquivos ignorados (apenas JPG/PNG permitidos)` : ''}</p>`);
        } else {
            fileList.html('<p class="alert alert-warning">Nenhum arquivo de imagem válido (JPG/PNG) encontrado.</p>');
            $('#uploadBtn').prop('disabled', true);
            $('#clearBtn').prop('disabled', true);
        }
    }

    /**
     * Cria item visual para arquivo
     */
    function createFileItem(file) {
        const size = (file.size / 1024).toFixed(2); // KB
        const relativePath = file.name; // Sem estrutura de pasta, só nome

        return `
            <div class="file-item">
                <i class="fas fa-file-image"></i>
                <span class="file-name">${file.name}</span>
                <span class="file-size">${size} KB</span>
                <button type="button" class="btn-remove-file" data-index="${selectedFiles.indexOf(file)}" title="Remover">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
    }

    /**
     * Remove arquivo da lista
     */
    $(document).on('click', '.btn-remove-file', function () {
        const index = parseInt($(this).data('index'));
        selectedFiles.splice(index, 1);
        $(this).closest('.file-item').remove();

        // Atualiza summary
        const fileList = $('#fileList');
        if (selectedFiles.length === 0) {
            fileList.html('<p class="empty-state">Nenhum arquivo selecionado.</p>');
            $('#uploadBtn').prop('disabled', true);
            $('#clearBtn').prop('disabled', true);
        } else {
            fileList.find('.file-summary').text(`Total: ${selectedFiles.length} imagens válidas`);
        }
    });

    /**
     * Limpa todos os arquivos
     */
    $('#clearBtn').on('click', function () {
        selectedFiles = [];
        $('#fileList').empty().html('<p class="empty-state">Nenhum arquivo selecionado.</p>');
        $('#folderInput').val('');
        $('#uploadBtn').prop('disabled', true);
        $(this).prop('disabled', true);
    });

    /**
     * Manipula o upload
     */
    function handleUpload(e) {
        e.preventDefault();

        const formData = new FormData();
        const tpProduto = $('#upload_tipo_produto').val();
        const cidadeCod = $('#upload_cidade_cod').val();

        if (!tpProduto || !cidadeCod) {
            alert('Selecione categoria e cidade antes de fazer upload.');
            return;
        }

        // Adiciona metadados
        formData.append('action', 'upload_imagens');
        formData.append('tp_produto', tpProduto);
        formData.append('cidade_cod', cidadeCod);

        // Adiciona arquivos
        selectedFiles.forEach((file, index) => {
            formData.append(`file_${index}`, file);
            formData.append(`file_name_${index}`, file.name);
            // Sem file_path, pois não é pasta
        });

        formData.append('total_files', selectedFiles.length);

        // Inicia upload com progress
        currentUpload = $.ajax({
            url: 'ajax_handler.php', // Ou upload_handler.php se separado
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        const percent = (e.loaded / e.total) * 100;
                        updateProgress(percent);
                    }
                });
                return xhr;
            },
            success: function (response) {
                if (response.success) {
                    mostrarSucesso('Upload concluído! ' + response.inserted + ' imagens inseridas no banco.');
                    $('#clearBtn').click(); // Limpa form
                    // Opcional: recarregar listas de produtos
                    location.reload(); // Ou recarregue seções específicas
                } else {
                    mostrarErro('Erro no upload: ' + (response.error || 'Desconhecido'));
                }
                currentUpload = null;
            },
            error: function (xhr, status, error) {
                mostrarErro('Erro na requisição de upload: ' + error);
                currentUpload = null;
            }
        });

        // Mostra progresso
        $('#uploadProgress').show();
        updateProgress(0);
    }


    /**
     * Atualiza barra de progresso
     */
    function updateProgress(percent) {
        $('#progressFill').css('width', percent + '%');
        $('#progressText').text(Math.round(percent) + '%');
    }

    /**
     * Cancela upload em progresso
     */
    $('#uploadBtn').on('click', function () {
        if (currentUpload) {
            currentUpload.abort();
            currentUpload = null;
            $('#uploadProgress').hide();
            mostrarErro('Upload cancelado.');
        }
    });
});
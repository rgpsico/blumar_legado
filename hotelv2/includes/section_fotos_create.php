<div class="step-content" data-step="3">
    <h3 class="form-section-title">Fotos e Galeria</h3>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Fachada</label>
            <input type="text" class="form-control" name="htlimgfotofachada" maxlength="150" value="">
        </div>
        <div class="col-md-6">
            <label class="form-label">Fachada TBN</label>
            <input type="text" class="form-control" name="fotofachada_tbn" maxlength="150" value="">
        </div>
        <div class="col-md-6">
            <label class="form-label">Piscina</label>
            <input type="text" class="form-control" name="htlfotopiscina" maxlength="150" value="">
        </div>
        <div class="col-md-6">
            <label class="form-label">Foto Extra 1</label>
            <input type="text" class="form-control" name="fotoextra" maxlength="150" value="">
        </div>
        <div class="col-md-6">
            <label class="form-label">Foto Extra 2 (Recepção)</label>
            <input type="text" class="form-control" name="fotoextra_recep" maxlength="150" value="">
        </div>
        <div class="col-md-6">
            <label class="form-label">Foto Extra 3</label>
            <input type="text" class="form-control" name="ft_resort1" maxlength="150" value="">
        </div>
        <div class="col-md-6">
            <label class="form-label">Foto Extra 4</label>
            <input type="text" class="form-control" name="ft_resort2" maxlength="150" value="">
        </div>
        <div class="col-md-6">
            <label class="form-label">Foto Extra 5</label>
            <input type="text" class="form-control" name="ft_resort3" maxlength="150" value="">
        </div>
        <div class="col-md-12">
            <label class="form-label">Imagens da Galeria <small class="text-muted">(Visualize e gerencie as imagens selecionadas abaixo)</small></label>
            <!-- Textarea oculta, mantida para submissão do form -->
            <textarea class="form-control d-none" name="gallery_images" id="gallery_images" rows="3"></textarea>
            <button type="button" class="btn btn-outline-primary mt-1" id="select_gallery_images" disabled>Selecionar Imagens (Disponível após salvar)</button>
            <!-- Container para thumbnails selecionadas -->
            <div id="selected_gallery_thumbs" class="row mt-2"></div>
        </div>
        <div class="col-md-12">
            <label class="form-label">Imagem da Planta Baixa</label>
            <input type="text" class="form-control" name="blueprint_image" maxlength="255" value="">
        </div>
    </div>
</div>

<!-- Modal para seleção de imagens -->
<div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="galleryModalLabel">Selecionar Imagens da Galeria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <button type="button" class="btn btn-secondary me-2" id="select_all">Selecionar Todas</button>
                    <button type="button" class="btn btn-secondary" id="deselect_all">Deselecionar Todas</button>
                </div>
                <div id="images_loading" class="text-center py-3">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                    <p>Carregando imagens do hotel...</p>
                </div>
                <div id="images_container" class="row" style="display: none;"></div>
                <div id="no_images" class="alert alert-info" style="display: none;">
                    Nenhuma imagem encontrada para este hotel.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="save_selected_images">Adicionar Selecionadas</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Para modo create, hotelId é vazio inicialmente
    if (typeof window.galleryHotelId === 'undefined') {
        window.galleryHotelId = '';
    }
    const hotelId = window.galleryHotelId;

    const apiBaseUrl = 'http://localhost/blumar_legado/blumar/api/hotel_gallery_api.php';

    var modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    var selectedImages = [];

    // Função para renderizar thumbnails selecionadas
    function renderSelectedThumbs() {
        var container = $('#selected_gallery_thumbs');
        var currentValue = $('#gallery_images').val().trim();
        var currentUrls = currentValue ? currentValue.split(',').map(function(u) {
            return u.trim();
        }).filter(function(u) {
            return u;
        }) : [];

        container.empty();
        if (currentUrls.length === 0) {
            container.append('<div class="col-12"><small class="text-muted">Nenhuma imagem selecionada.</small></div>');
            return;
        }

        currentUrls.forEach(function(url, index) {
            var thumbDiv = $(`
            <div class="col-md-2 col-sm-3 col-4 mb-2 position-relative">
                <img src="${url}" 
                     alt="Thumbnail ${index + 1}" 
                     class="img-fluid rounded" 
                     style="height: 100px; object-fit: cover; width: 100%;"
                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxMiIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPlNlbSBJbWFnZW08L3RleHQ+PC9zdmc+';">
                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" 
                        style="border-radius: 50%; width: 20px; height: 20px; padding: 0; font-size: 10px; z-index: 1;"
                        onclick="removeSelectedImage(${index})">
                    ×
                </button>
            </div>
        `);
            container.append(thumbDiv);
        });
    }

    // Função para remover uma imagem selecionada
    function removeSelectedImage(indexToRemove) {
        var currentValue = $('#gallery_images').val().trim();
        var currentUrls = currentValue ? currentValue.split(',').map(function(u) {
            return u.trim();
        }).filter(function(u) {
            return u;
        }) : [];

        if (indexToRemove >= 0 && indexToRemove < currentUrls.length) {
            currentUrls.splice(indexToRemove, 1);
            $('#gallery_images').val(currentUrls.join(', '));
            renderSelectedThumbs(); // Re-renderiza após remoção
        }
    }

    // Inicializa thumbnails na carga da página
    $(document).ready(function() {
        renderSelectedThumbs();
    });

    // Listener para mudanças manuais na textarea (opcional, para sync se editar direto)
    $('#gallery_images').on('input', function() {
        renderSelectedThumbs();
    });

    $('#select_gallery_images').on('click', function() {
        if (!hotelId) {
            alert('ID do hotel não encontrado. Salve o hotel primeiro para carregar as imagens da galeria.');
            return;
        }

        // Limpa seleções anteriores
        selectedImages = [];
        $('#images_container').empty().hide();
        $('#no_images').hide();
        $('#images_loading').show();

        // Busca imagens via API
        $.ajax({
            url: `${apiBaseUrl}?action=list&hotel_id=${encodeURIComponent(hotelId)}`,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#images_loading').hide();
                if (data.total > 0 && data.images) {
                    $('#images_container').show();
                    renderImages(data.images);
                } else {
                    $('#no_images').show();
                }
            },
            error: function(xhr, status, error) {
                $('#images_loading').hide();
                console.error('Erro ao carregar imagens:', error);
                alert('Erro ao carregar imagens do hotel. Verifique o console para detalhes.');
                $('#no_images').show().html('Erro ao carregar imagens: ' + error);
            }
        });

        modal.show();
    });

    function renderImages(images) {
        $('#images_container').empty();
        images.forEach(function(imgData, index) {
            var url = imgData.image_url || '';
            var previewUrl = imgData.image_url || '';

            var imgDiv = $(`
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="img_${index}" value="${url}">
                            <label class="form-check-label" for="img_${index}">
                                Imagem ${index + 1} (ID: ${imgData.id})
                            </label>
                        </div>
                        <img src="${previewUrl}" 
                             alt="Preview" class="img-fluid mt-2" style="max-height: 200px; object-fit: cover;" 
                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjIwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxNCIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPlNlbSBQcmV2aWV3PC90ZXh0Pjwvc3ZnPg==';">
                    </div>
                </div>
            </div>
        `);
            $('#images_container').append(imgDiv);

            // Event listener para checkbox
            $(`#img_${index}`).on('change', function() {
                var checkboxUrl = $(this).val();
                if ($(this).is(':checked') && checkboxUrl) {
                    if (selectedImages.indexOf(checkboxUrl) === -1) {
                        selectedImages.push(checkboxUrl);
                    }
                } else {
                    selectedImages = selectedImages.filter(function(u) {
                        return u !== checkboxUrl;
                    });
                }
            });
        });
    }

    // Selecionar todas as imagens
    $('#select_all').on('click', function() {
        $('#images_container input[type="checkbox"]').prop('checked', true).trigger('change');
        // Atualiza selectedImages com todas as URLs
        selectedImages = [];
        $('#images_container input[type="checkbox"]').each(function() {
            var url = $(this).val();
            if (url && selectedImages.indexOf(url) === -1) {
                selectedImages.push(url);
            }
        });
    });

    // Deselecionar todas as imagens
    $('#deselect_all').on('click', function() {
        $('#images_container input[type="checkbox"]').prop('checked', false).trigger('change');
        selectedImages = [];
    });

    $('#save_selected_images').on('click', function() {
        if (selectedImages.length === 0) {
            alert('Selecione pelo menos uma imagem.');
            return;
        }

        // Pega o valor atual da textarea
        var currentValue = $('#gallery_images').val().trim();
        var currentUrls = currentValue ? currentValue.split(',').map(function(u) {
            return u.trim();
        }).filter(function(u) {
            return u;
        }) : [];

        // Adiciona as novas selecionadas (evita duplicatas)
        selectedImages.forEach(function(newUrl) {
            if (currentUrls.indexOf(newUrl) === -1) {
                currentUrls.push(newUrl);
            }
        });

        // Atualiza textarea
        $('#gallery_images').val(currentUrls.join(', '));

        // Renderiza as thumbnails atualizadas
        renderSelectedThumbs();

        modal.hide();
    });
</script>
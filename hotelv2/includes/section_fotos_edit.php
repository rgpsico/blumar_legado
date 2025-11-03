<div class="step-content" data-step="3">
    <h3 class="form-section-title">Fotos e Galeria</h3>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Fachada</label>
            <input type="text" class="form-control" name="htlimgfotofachada" maxlength="150" value="<?= htmlspecialchars($htlimgfotofachada) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Fachada TBN</label>
            <input type="text" class="form-control" name="fotofachada_tbn" maxlength="150" value="<?= htmlspecialchars($fotofachada_tbn) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Piscina</label>
            <input type="text" class="form-control" name="htlfotopiscina" maxlength="150" value="<?= htmlspecialchars($htlfotopiscina) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Foto Extra 1</label>
            <input type="text" class="form-control" name="fotoextra" maxlength="150" value="<?= htmlspecialchars($fotoextra) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Foto Extra 2 (Recepção)</label>
            <input type="text" class="form-control" name="fotoextra_recep" maxlength="150" value="<?= htmlspecialchars($fotoextra_recep) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Foto Extra 3</label>
            <input type="text" class="form-control" name="ft_resort1" maxlength="150" value="<?= htmlspecialchars($ft_resort1) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Foto Extra 4</label>
            <input type="text" class="form-control" name="ft_resort2" maxlength="150" value="<?= htmlspecialchars($ft_resort2) ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label">Foto Extra 5</label>
            <input type="text" class="form-control" name="ft_resort3" maxlength="150" value="<?= htmlspecialchars($ft_resort3) ?>">
        </div>
        <div class="col-md-12">
            <label class="form-label">Imagens da Galeria <small class="text-muted">(Visualize e gerencie as imagens selecionadas abaixo)</small></label>
            <!-- Textarea oculta, mantida para submissão do form -->
            <textarea class="form-control d-none" name="gallery_images" id="gallery_images" rows="3"><?= htmlspecialchars($gallery_images) ?></textarea>
            <button type="button" class="btn btn-outline-primary mt-1" id="select_gallery_images">Selecionar Imagens</button>
            <!-- Container para thumbnails selecionadas -->
            <div id="selected_gallery_thumbs" class="row mt-2"></div>
        </div>
        <div class="col-md-12">
            <label class="form-label">Imagem da Planta Baixa</label>
            <input type="text" class="form-control" name="blueprint_image" maxlength="255" value="<?= htmlspecialchars($blueprint_image) ?>">
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
                <!-- Seção de Upload -->
                <div class="card mb-3" id="upload_section" style="display: <?= $frncod ? 'block' : 'none'; ?>;">
                    <div class="card-header">
                        <h6>Upload de Nova Imagem</h6>
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="file" class="form-control" id="image_upload" multiple accept="image/*">
                            <button type="button" class="btn btn-primary" id="upload_images">Fazer Upload</button>
                        </div>
                        <div id="upload_progress" class="progress mt-2" style="display: none;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;">0%</div>
                        </div>
                        <div id="upload_status" class="mt-2"></div>
                    </div>
                </div>

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
    // Evita redeclaração: usa window para escopo global único
    if (typeof window.galleryHotelId === 'undefined') {
        window.galleryHotelId = <?= json_encode($frncod ?? ''); ?>;
    }
    if (typeof window.hotelIdEdit === 'undefined') {
        window.hotelIdEdit = window.galleryHotelId;
    }
    if (typeof window.apiBaseUrl === 'undefined') {
        window.apiBaseUrl = 'http://localhost/blumar_legado/blumar/api/hotel_gallery_api.php';

    }

    var modal = new bootstrap.Modal(document.getElementById('galleryModal'));
    var selectedImages = [];
    var galleryAllImages = []; // Armazena todas as imagens da API para uso em thumbs

    // Função para carregar TODAS as imagens da galeria do hotel (para thumbs e modal)
    function loadGalleryImages(callback) {
        if (!window.hotelIdEdit) {
            console.warn('ID do hotel não encontrado para loadGalleryImages.');
            if (callback) callback([]);
            return;
        }

        $.ajax({
            url: `${window.apiBaseUrl}?action=list&hotel_id=${encodeURIComponent(window.hotelIdEdit)}`,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log('Dados da API para galeria:', data);
                if (data && data.images) {
                    galleryAllImages = data.images;
                    if (callback) callback(data.images);
                } else {
                    galleryAllImages = [];
                    if (callback) callback([]);
                }
            },
            error: function(xhr, status, error) {
                console.error('Erro ao carregar galeria:', xhr.responseText);
                galleryAllImages = [];
                if (callback) callback([]);
            }
        });
    }

    // Função para carregar lista de imagens no modal
    function loadImages() {
        loadGalleryImages(function(images) {
            $('#images_loading').hide();
            if (images && images.length > 0) {
                $('#images_container').show();
                renderImages(images);
            } else {
                $('#no_images').show().html('Nenhuma imagem encontrada para este hotel no banco de dados.');
            }
        });
    }

    // Função para excluir imagem do banco e pasta
    function deleteImage(imgId, imgUrl) {
        if (!confirm('Tem certeza que deseja excluir esta imagem? Isso removerá o arquivo e o registro do banco.')) {
            return;
        }

        var formData = new FormData();
        formData.append('action', 'delete');
        formData.append('id', imgId);

        $.ajax({
            url: window.apiBaseUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                if (data.action === 'delete') {
                    alert('Imagem excluída com sucesso!');
                    // Remove da lista selecionada se estiver
                    selectedImages = selectedImages.filter(function(u) {
                        return u !== imgUrl;
                    });
                    // Recarrega todas as imagens e re-renderiza thumbs
                    loadGalleryImages(function() {
                        renderSelectedThumbs();
                        loadImages(); // Recarrega modal se aberto
                    });
                } else {
                    alert('Erro ao excluir: ' + (data.error || 'Desconhecido'));
                }
            },
            error: function(xhr, status, error) {
                alert('Erro na requisição: ' + error);
            }
        });
    }

    // Função para renderizar thumbnails selecionadas (agora via API)
    function renderSelectedThumbs() {
        var container = $('#selected_gallery_thumbs');

        if (!galleryAllImages || galleryAllImages.length === 0) {
            container.html('<div class="col-12"><small class="text-muted">Nenhuma imagem cadastrada.</small></div>');
            return;
        }

        container.empty();

        galleryAllImages.forEach(function(img, index) {
            var thumbDiv = $(`
            <div class="col-md-2 col-sm-3 col-4 mb-2 position-relative">
                <img src="${img.image_url}" 
                     alt="${img.title || 'Imagem ' + img.id}" 
                     class="img-fluid rounded" 
                     style="height: 100px; object-fit: cover; width: 100%;"
                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSIjZGRkIi8+PHRleHQgeD0iNTAlIiB5PSI1MCUiIGZvbnQtZmFtaWx5PSJBcmlhbCIgZm9udC1zaXplPSIxMiIgZmlsbD0iIzk5OSIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZHk9Ii4zZW0iPlNlbSBJbWFnZW08L3RleHQ+PC9zdmc+';">
                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" 
                        style="border-radius: 50%; width: 20px; height: 20px; padding: 0; font-size: 10px; z-index: 1;"
                        onclick="deleteImage(${img.id}, '${img.image_url.replace(/'/g, "\\'")}')">
                    ×
                </button>
            </div>
        `);
            container.append(thumbDiv);
        });
    }

    // Função para remover uma imagem selecionada (atualiza textbox e re-renderiza)
    function removeSelectedImage(indexToRemove) {
        var currentValue = $('#gallery_images').val().trim();
        var currentUrls = currentValue ? currentValue.split(',').map(function(u) {
            return u.trim();
        }).filter(function(u) {
            return u;
        }) : [];

        if (indexToRemove >= 0 && indexToRemove < currentUrls.length) {
            var removedUrl = currentUrls.splice(indexToRemove, 1)[0];
            $('#gallery_images').val(currentUrls.join(', '));
            // Recarrega galeria e re-renderiza
            loadGalleryImages(function() {
                renderSelectedThumbs();
            });
        }
    }

    // Inicializa thumbnails na carga da página (carrega da API)
    $(document).ready(function() {
        if (window.hotelIdEdit) {
            loadGalleryImages(function() {
                renderSelectedThumbs();
            });
        } else {
            renderSelectedThumbs(); // Fallback se sem ID
        }
    });

    // Listener para mudanças manuais na textarea (opcional, para sync se editar direto)
    $('#gallery_images').on('input', function() {
        renderSelectedThumbs();
    });

    // Upload de imagens
    $('#upload_images').on('click', function() {
        var files = $('#image_upload')[0].files;
        if (files.length === 0) {
            alert('Selecione pelo menos uma imagem para upload.');
            return;
        }

        if (!window.hotelIdEdit) {
            alert('ID do hotel não encontrado. Salve o hotel primeiro para fazer upload.');
            return;
        }

        var formData = new FormData();
        for (var i = 0; i < files.length; i++) {
            formData.append('images[]', files[i]);
        }
        formData.append('action', 'upload');
        formData.append('hotel_id', window.hotelIdEdit);

        var progressBar = $('#upload_progress');
        var progress = progressBar.find('.progress-bar');
        var status = $('#upload_status');
        progressBar.show();
        status.html('<small class="text-info">Iniciando upload...</small>');

        $.ajax({
            url: window.apiBaseUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        var percent = (e.loaded / e.total) * 100;
                        progress.css('width', percent + '%').text(Math.round(percent) + '%');
                    }
                });
                return xhr;
            },
            success: function(data) {
                console.log('Upload response:', data);
                progressBar.hide();
                if (data.success) {
                    status.html('<small class="text-success">Upload concluído! Recarregando lista de imagens...</small>');
                    // Recarrega galeria após upload
                    loadGalleryImages(function() {
                        renderSelectedThumbs();
                        loadImages(); // Se modal aberto
                    });
                } else {
                    status.html('<small class="text-danger">Erro no upload: ' + (data.error || 'Desconhecido') + '</small>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Upload error:', xhr.responseText);
                progressBar.hide();
                status.html('<small class="text-danger">Erro no upload: ' + error + '</small>');
            }
        });
    });

    $('#select_gallery_images').on('click', function() {
        if (!window.hotelIdEdit) {
            alert('ID do hotel não encontrado. Não é possível carregar as imagens.');
            return;
        }

        // Limpa seleções anteriores
        selectedImages = [];
        loadImages(); // Usa a nova função loadImages

        modal.show();
    });

    function renderImages(images) {
        console.log('Rendering images:', images);
        $('#images_container').empty();
        if (!images || images.length === 0) {
            $('#no_images').show();
            return;
        }
        images.forEach(function(imgData, index) {
            var url = imgData.image_url || '';
            var previewUrl = imgData.image_url || '';

            var imgDiv = $(`
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="img_${index}" value="${url}">
                                <label class="form-check-label" for="img_${index}">
                                    Imagem ${index + 1} (ID: ${imgData.id})
                                </label>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteImage(${imgData.id}, '${url.replace(/'/g, "\\'")}')">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
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
        loadGalleryImages(function() {
            renderSelectedThumbs();
        });

        modal.hide();
    });
</script>
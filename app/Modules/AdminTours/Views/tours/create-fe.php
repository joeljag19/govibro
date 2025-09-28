<?= $this->extend('layouts/mainlayout') ?>

<?= $this->section('title') ?>
    Crear Nuevo Tour
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="breadcrumb-bar breadcrumb-bg-02 text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title mb-2">Añadir Nuevo Tour</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Admin</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tours') ?>">Tours</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Crear</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <form action="<?= site_url('admin/tours/store') ?>" method="post" enctype="multipart/form-data" id="main-tour-form">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-lg-3 theiaStickySidebar">
                    <div class="card border-0 mb-4 mb-lg-0">
                        <div class="card-body">
                            <div>
                                <h5 class="mb-3">Secciones del Tour</h5>
                                <ul class="add-tab-list">
                                    <li><a href="#general" class="active">General</a></li>
                                    <li><a href="#pricing">Precios</a></li>
                                    <li><a href="#inclusiones">Inclusiones / Exclusiones</a></li>
                                    <li><a href="#itinerario">Itinerario</a></li>
                                    <li><a href="#gallery">Galería</a></li>
                                    <li><a href="#location">Ubicación</a></li>
                                    <li><a href="#faqs">FAQs</a></li>
                                    <li><a href="#availability">Disponibilidad</a></li>
                                    <li><a href="#translations">Traducciones</a></li>
                                    <li><a href="#seo">SEO</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
<div class="card shadow-none" id="general">
    <div class="card-header">
        <h5 class="fs-18">Información General</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Título</label>
                <input type="text" id="title" name="title" class="form-control <?= (session('errors.title')) ? 'is-invalid' : '' ?>" value="<?= old('title') ?>" >
                    <?php if (session('errors.title')): ?>
                        <div class="invalid-feedback">
                            <?= session('errors.title') ?>
                        </div>
                    <?php endif; ?>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Categoría</label>
                <select name="category_id" class="select <?= (session('errors.category_id')) ? 'is-invalid' : '' ?>">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= esc($category['id']) ?>"><?= esc($category['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (session('errors.category_id')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.category_id') ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción Corta</label>
            <textarea id="short_desc" name="short_desc" class="form-control" rows="3"><?= old('short_desc') ?></textarea>
        </div>
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label class="form-label mb-0">Contenido Principal</label>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#aiContentModal">
                    <i class="fas fa-magic me-1"></i> Generar con IA
                </button>
            </div>
            <div id="quill-editor" style="height: 250px;"><?= old('content') ?></div>
            <input type="hidden" name="content" id="quill-content-input">
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Video (URL YouTube)</label>
                <input type="text" name="video" class="form-control" value="<?= old('video') ?>">
            </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Duración</label>
            <div class="input-group">
                <input type="number" name="duration_value" class="form-control" placeholder="Ej. 8" value="<?= old('duration_value') ?>">
                <select name="duration_unit" class="form-select" style="flex: 0.5;">
                    <option value="hour">Horas</option>
                    <option value="day">Días</option>
                    <option value="night">Noches</option>
                </select>
            </div>
        </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Estado</label>
                <select name="status" class="select">
                    <option value="draft">Borrador</option>
                    <option value="published">Publicado</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Destacado</label>
                <select name="is_featured" class="select">
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>
        </div>
    </div>
</div>

                    <div class="card shadow-none" id="pricing">
                        <div class="card-header"><h5 class="fs-18">Precios</h5></div>
                        <div class="card-body">
                             <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Precio Base (USD)</label>
                                    <input type="number" name="price" class="form-control <?= (session('errors.price')) ? 'is-invalid' : '' ?>" step="0.01" value="<?= old('price') ?>" >
                                    <?php if (session('errors.price')): ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.price') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Precio de Oferta (USD)</label>
                                    <input type="number" name="sale_price" class="form-control" step="0.01" value="<?= old('sale_price') ?>">
                                </div>
                                <hr>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="enable_person_types" id="enable_person_types" <?= old('enable_person_types') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="enable_person_types">
                                        Habilitar precios por tipo de persona (adultos, niños, etc.)
                                    </label>
                                </div>

                                <div id="person-types-section" style="display: <?= old('enable_person_types') ? 'block' : 'none' ?>;">
                                    <div id="person-types-list">
                                        </div>
                                    <button type="button" class="btn btn-primary btn-sm mt-2" id="add-person-type">
                                        <i class="isax isax-add-circle me-1"></i>Añadir Tipo de Persona
                                    </button>
                                </div>
                                <input type="hidden" name="person_types" id="person-types-json">
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-none" id="inclusiones">
                        <div class="card-header"><h5 class="fs-18">Inclusiones / Exclusiones</h5></div>
                        <div class="card-body">
                             <div class="row">
                                <div class="col-lg-6"><div id="include-container"></div><button type="button" id="add-include" class="btn btn-success btn-sm mt-2"><i class="isax isax-add-circle me-1"></i>Añadir Inclusión</button></div>
                                <div class="col-lg-6"><div id="exclude-container"></div><button type="button" id="add-exclude" class="btn btn-danger btn-sm mt-2"><i class="isax isax-add-circle me-1"></i>Añadir Exclusión</button></div>
                            </div>
                        </div>
                    </div>

                      <div class="card shadow-none" id="itinerario">
                        <div class="card-header"><h5 class="fs-18">Itinerario</h5></div>
                        <div class="card-body">
                             <div class="row">
                                <div id="itinerary-container"></div>
                                <button type="button" id="add-itinerary" class="btn btn-primary btn-sm mt-2"><i class="isax isax-add-circle me-1"></i>Añadir Parada al Itinerario</button>
                           </div>
                        </div>
                    </div>
                    
                   <div class="card shadow-none" id="gallery">
                    <div class="card-header">
                        <h5 class="fs-18">Galería de Imágenes</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Imagen Principal (Destacada)</label>
                            <input type="file" name="image" class="form-control <?= (session('errors.image')) ? 'is-invalid' : '' ?>" accept="image/*">
                            <?php if (session('errors.image')): ?>
                                <div class="invalid-feedback">
                                    <?= session('errors.image') ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <hr>
                        <h6 class="mb-2">Imágenes Adicionales</h6>
                        <div class="file-upload drag-file w-100 d-flex align-items-center justify-content-center flex-column mb-3">
                            <span class="upload-img d-block mb-2"><i class="isax isax-document-upload fs-24"></i></span>
                            <h6 class="mb-1">Arrastra y suelta las imágenes aquí</h6>
                            <p class="mb-2">o</p>
                            <label for="gallery_files" class="btn btn-sm btn-primary">Seleccionar Archivos</label>
                            <input type="file" name="gallery[]" id="gallery_files" class="form-control" accept="image/*" multiple style="display: none;">
                        </div>
                        
                        <div id="gallery_previews" class="d-flex align-items-center flex-wrap gap-2">
                            </div>
                    </div>
                    </div>

                    <div class="card shadow-none" id="location">
                        <div class="card-header"><h5 class="fs-18">Ubicación</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Ubicación Principal</label>
                                    <select name="location_id" class="select <?= (session('errors.location_id')) ? 'is-invalid' : '' ?>">
                                        <?php foreach ($locations as $location): ?>
                                            <option value="<?= esc($location['id']) ?>"><?= esc($location['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (session('errors.location_id')): ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.location_id') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-12 mb-3"><label class="form-label">Dirección</label><input type="text" name="address" class="form-control" value="<?= old('address') ?>"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Latitud</label><input type="text" name="map_lat" id="map-lat" class="form-control" value="<?= old('map_lat') ?>"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Longitud</label><input type="text" name="map_lng" id="map-lng" class="form-control" value="<?= old('map_lng') ?>"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Zoom del Mapa</label><input type="number" name="map_zoom" id="map-zoom" class="form-control" value="<?= old('map_zoom', '12') ?>"></div>
                                 </div>
                        <div id="map" style="height: 400px; width: 100%; border-radius: 5px;"></div>

                           

                        </div>
                    </div>

                    <div class="card shadow-none" id="faqs">
                        <div class="card-header"><h5 class="fs-18">Preguntas Frecuentes (FAQ)</h5></div>
                        <div class="card-body"><div id="faq-container"></div><button type="button" id="add-faq" class="btn btn-primary btn-sm mt-2"><i class="isax isax-add-circle me-1"></i>Añadir Pregunta</button></div>
                    </div>
                    
                    <div class="card shadow-none" id="availability"><div class="card-body"><p>La gestión de disponibilidad se activa después de crear el tour.</p></div></div>
                    <div class="card shadow-none" id="translations"><div class="card-body"><p>La gestión de traducciones se activa después de crear el tour.</p></div></div>
                    <div class="card shadow-none" id="seo">
                        <div class="card-header">
                            <h5 class="fs-18">SEO</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="seo_title" class="form-label">Título SEO</label>
                                <input type="text" id="seo_title" name="seo_title" class="form-control" maxlength="60" value="<?= old('seo_title') ?>">
                                <small class="form-text text-muted">Óptimo: 50-60 caracteres. Se muestra en la pestaña del navegador y en los resultados de Google.</small>
                                <div id="seo_title_count" class="text-end text-muted small">0 / 60</div>
                            </div>
                            <div class="mb-3">
                                <label for="seo_description" class="form-label">Meta Descripción</label>
                                <textarea id="seo_description" name="seo_description" class="form-control" rows="3" maxlength="160"><?= old('seo_description') ?></textarea>
                                <small class="form-text text-muted">Óptimo: 150-160 caracteres. Es el texto que aparece debajo del título en los resultados de Google.</small>
                                <div id="seo_description_count" class="text-end text-muted small">0 / 160</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <button type="reset" class="btn btn-light me-2">Limpiar Formulario</button>
                        <button type="submit" class="btn btn-primary">Crear Tour</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="aiContentModal" tabindex="-1" aria-labelledby="aiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="aiModalLabel"><i class="fas fa-magic me-2"></i>Asistente de Contenido IA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted">Describe tu tour con palabras clave (ej: "excursión catamarán isla saona, almuerzo y bebidas") y la IA escribirá el contenido por ti.</p>
        <div class="input-group">
            <input type="text" id="ai-keywords" class="form-control" placeholder="Introduce tus palabras clave...">
            <button class="btn btn-primary" type="button" id="generate-content-btn">
                <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true" style="display: none;"></span>
                Generar
            </button>
        </div>
        <div id="ai-error" class="text-danger mt-2"></div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
function initMap() {
    const initialLat = parseFloat(document.getElementById('map-lat').value) || 18.4861;
    const initialLng = parseFloat(document.getElementById('map-lng').value) || -69.9312;
    const initialZoom = parseInt(document.getElementById('map-zoom').value) || 8;
    const map = new google.maps.Map(document.getElementById('map'), { center: { lat: initialLat, lng: initialLng }, zoom: initialZoom });
    let marker;
    if (document.getElementById('map-lat').value && document.getElementById('map-lng').value) {
        marker = new google.maps.Marker({ position: { lat: initialLat, lng: initialLng }, map: map });
    }
    map.addListener('click', function(event) {
        if (marker) { marker.setMap(null); }
        marker = new google.maps.Marker({ position: event.latLng, map: map });
        document.getElementById('map-lat').value = event.latLng.lat().toFixed(6);
        document.getElementById('map-lng').value = event.latLng.lng().toFixed(6);
    });
    map.addListener('zoom_changed', function() { document.getElementById('map-zoom').value = map.getZoom(); });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3Seb2ELTehVAZLE06PegKtPtvzyD0mdM&callback=initMap"></script>

<script>
$(document).ready(function() {

    // --- LÓGICA DE REPOBLACIÓN CORREGIDA ---
    const oldData = {
        include: <?= old('include', '[]') ?>,
        exclude: <?= old('exclude', '[]') ?>,
        itinerary: <?= old('itinerary', '[]') ?>,
        faqs: <?= old('faqs', '[]') ?>
    };

    if (oldData.include && Array.isArray(oldData.include)) {
        oldData.include.forEach(item => {
            $('#add-include').click();
            $('#include-container .input-group:last input').val(item.item);
        });
    }
    if (oldData.exclude && Array.isArray(oldData.exclude)) {
        oldData.exclude.forEach(item => {
            $('#add-exclude').click();
            $('#exclude-container .input-group:last input').val(item.item);
        });
    }
    if (oldData.itinerary && Array.isArray(oldData.itinerary)) {
        oldData.itinerary.forEach(item => {
            $('#add-itinerary').click();
            const lastItem = $('#itinerary-container .itinerary-item:last');
            lastItem.find('input[name*="[title]"]').val(item.title);
            lastItem.find('input[name*="[comment]"]').val(item.comment);
        });
    }
    if (oldData.faqs && Array.isArray(oldData.faqs)) {
        oldData.faqs.forEach(item => {
            $('#add-faq').click();
            const lastItem = $('#faq-container .faq-item:last');
            lastItem.find('input[name*="[question]"]').val(item.question);
            lastItem.find('textarea[name*="[answer]"]').val(item.answer);
        });
    }

    // --- QUILL EDITOR INITIALIZATION ---
    var quill = new Quill('#quill-editor', { theme: 'snow' });
    quill.root.innerHTML = `<?= old('content', '') ?>`;

    // --- MANEJADOR DE ENVÍO CON AJAX (ACTIVADO) ---
    $('#main-tour-form').on('submit', function(event) {
        event.preventDefault();

        $("#quill-content-input").val(quill.root.innerHTML);

        var form = this;
        var formData = new FormData(form);
        var submitButton = $(this).find('button[type="submit"]');

        submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');
        $('.invalid-feedback').remove();
        $('.is-invalid').removeClass('is-invalid');

        $.ajax({
            url: $(form).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('¡Tour creado exitosamente!');
                    window.location.href = response.redirect_url;
                } else {
                    alert('Por favor, corrige los errores del formulario.');
                    $.each(response.errors, function(field, message) {
                        var input = $('[name="' + field + '"], [name="' + field + '[]"]');
                        input.addClass('is-invalid');
                        // Para Quill, busca el contenedor en lugar del input
                        if (field === 'content') {
                             $('#quill-editor').parent().append('<div class="invalid-feedback d-block">' + message + '</div>');
                        } else {
                             input.after('<div class="invalid-feedback d-block">' + message + '</div>');
                        }
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error en AJAX:", textStatus, errorThrown, jqXHR.responseText);
                alert('Ocurrió un error inesperado en el servidor. Revisa la consola del navegador (F12) para más detalles.');
            },
            complete: function() {
                submitButton.prop('disabled', false).text('Crear Tour');
            }
        });
    });

    // --- AI CONTENT GENERATION & SEO ---
    $('#generate-content-btn').on('click', function() {
        const keywords = $('#ai-keywords').val().trim();
        const btn = $(this);
        const spinner = btn.find('.spinner-border');
        const aiError = $('#ai-error');

        if (!keywords) {
            aiError.text('Por favor, introduce algunas palabras clave.');
            return;
        }

        spinner.show();
        btn.prop('disabled', true);
        aiError.text('');

        fetch('<?= site_url('api/generate-tour-content') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('input[name=csrf_test_name]').val()
            },
            body: JSON.stringify({ keywords: keywords })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success && result.data) {
                $('#title').val(result.data.title || '');
                $('#short_desc').val(result.data.short_desc || '');
                quill.root.innerHTML = result.data.content || '';
                $('#seo_title').val(result.data.seo_title || '');
                $('#seo_description').val(result.data.seo_description || '');
                $('#seo_title').trigger('input');
                $('#seo_description').trigger('input');
                $('#aiContentModal').modal('hide');
                [$('#title'), $('#short_desc'), $('#quill-editor'), $('#seo_title'), $('#seo_description')].forEach($el => {
                    $el.css('background-color', '#d1e7dd');
                    setTimeout(() => { $el.css('background-color', ''); }, 2000);
                });
            } else {
                aiError.text(result.message || 'Ocurrió un error desconocido.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            aiError.text('Error de conexión. Revisa la consola.');
        })
        .finally(() => {
            spinner.hide();
            btn.prop('disabled', false);
        });
    });

    // --- SEO CHARACTER COUNTERS ---
    function updateCharCount(inputElement, countElement, maxLength) {
        const currentLength = $(inputElement).val().length;
        $(countElement).text(`${currentLength} / ${maxLength}`);
    }
    $('#seo_title').on('input', function() { updateCharCount(this, '#seo_title_count', 60); });
    $('#seo_description').on('input', function() { updateCharCount(this, '#seo_description_count', 160); });
    $('#seo_title').trigger('input');
    $('#seo_description').trigger('input');

    // --- GALLERY MANAGEMENT ---
    let galleryFiles = new DataTransfer();
    $('#gallery_files').on('change', function(event) { addFilesToGallery(event.target.files); });
    function addFilesToGallery(files) {
        for (let file of files) {
            if (![...galleryFiles.files].find(f => f.name === file.name && f.size === file.size)) {
                galleryFiles.items.add(file);
            }
        }
        updatePreviews();
        document.getElementById('gallery_files').files = galleryFiles.files;
    }
    function updatePreviews() {
        const previewsContainer = $('#gallery_previews').html('');
        for (let i = 0; i < galleryFiles.files.length; i++) {
            const file = galleryFiles.files[i];
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewHtml = `<div class="gallery-upload-img me-2 position-relative"><img src="${e.target.result}" alt="${file.name}"><span class="trash-icon d-flex align-items-center justify-content-center text-danger gallery-trash" data-index="${i}"><i class="isax isax-trash"></i></span></div>`;
                previewsContainer.append(previewHtml);
            }
            reader.readAsDataURL(file);
        }
    }
    $(document).on('click', '.gallery-trash', function() {
        const indexToRemove = $(this).data('index');
        const newFiles = new DataTransfer();
        for (let i = 0; i < galleryFiles.files.length; i++) {
            if (i !== indexToRemove) {
                newFiles.items.add(galleryFiles.files[i]);
            }
        }
        galleryFiles = newFiles;
        updatePreviews();
        document.getElementById('gallery_files').files = galleryFiles.files;
    });

    // --- DYNAMIC FIELDS MANAGEMENT ---
    function addDynamicItem(containerId, template) { $(containerId).append(template); }
    let includeIndex = 0;
    $('#add-include').click(() => addDynamicItem('#include-container', `<div class="input-group mb-2"><input type="text" name="include[${includeIndex++}][item]" class="form-control" placeholder="Ej: Transporte incluido"><button class="btn btn-danger btn-sm remove-item" type="button">X</button></div>`));
    let excludeIndex = 0;
    $('#add-exclude').click(() => addDynamicItem('#exclude-container', `<div class="input-group mb-2"><input type="text" name="exclude[${excludeIndex++}][item]" class="form-control" placeholder="Ej: Propinas"><button class="btn btn-danger btn-sm remove-item" type="button">X</button></div>`));
    let itineraryIndex = 0;
    $('#add-itinerary').click(() => {
        const html = `<div class="row align-items-center itinerary-item mb-3"><div class="col-md-5"><input type="text" name="itinerary[${itineraryIndex}][title]" class="form-control" placeholder="Título"></div><div class="col-md-6"><input type="text" name="itinerary[${itineraryIndex}][comment]" class="form-control" placeholder="Comentario"></div><div class="col-md-1"><button type="button" class="btn btn-danger btn-sm remove-item">X</button></div></div>`;
        addDynamicItem('#itinerary-container', html);
        itineraryIndex++;
    });
    let faqIndex = 0;
    $('#add-faq').click(() => {
        const html = `<div class="faq-item mb-3"><div class="row"><div class="col-11 mb-2"><input type="text" name="faqs[${faqIndex}][question]" class="form-control" placeholder="Pregunta"></div><div class="col-1"><button type="button" class="btn btn-danger btn-sm remove-item">X</button></div></div><div class="row"><div class="col-12"><textarea name="faqs[${faqIndex}][answer]" class="form-control" rows="2" placeholder="Respuesta"></textarea></div></div></div>`;
        addDynamicItem('#faq-container', html);
        faqIndex++;
    });
    $(document).on('click', '.remove-item', function() { $(this).closest('.input-group, .itinerary-item, .faq-item').remove(); });
});
</script>
<?= $this->endSection() ?>
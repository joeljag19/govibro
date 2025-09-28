<?= $this->extend('layouts/mainlayout') ?>

<?= $this->section('title') ?>
    Editar Tour: <?= esc($tour['title']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="breadcrumb-bar breadcrumb-bg-02 text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title mb-2">Editar Tour</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Admin</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/tours') ?>">Tours</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container">
         <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <form action="<?= site_url('admin/tours/update/' . $tour['id']) ?>" method="post" enctype="multipart/form-data" id="main-tour-form">
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
                        <div class="card-header"><h5 class="fs-18">Información General</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Título</label>
                                    <input type="text" id="title" name="title" class="form-control <?= (session('errors.title')) ? 'is-invalid' : '' ?>" value="<?= old('title', $tour['title'] ?? '') ?>">
                                    <?php if (session('errors.title')): ?><div class="invalid-feedback"><?= session('errors.title') ?></div><?php endif; ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Categoría</label>
                                    <select name="category_id" class="select <?= (session('errors.category_id')) ? 'is-invalid' : '' ?>">
                                        <?php foreach ($categories as $category): ?>
                                            <option value="<?= esc($category['id']) ?>" <?= (old('category_id', $tour['category_id'] ?? '') == $category['id']) ? 'selected' : '' ?>><?= esc($category['name']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php if (session('errors.category_id')): ?><div class="invalid-feedback"><?= session('errors.category_id') ?></div><?php endif; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Descripción Corta</label>
                                <textarea id="short_desc" name="short_desc" class="form-control" rows="3"><?= old('short_desc', $tour['short_desc'] ?? '') ?></textarea>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label mb-0">Contenido Principal</label>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#aiContentModal"><i class="fas fa-magic me-1"></i> Generar con IA</button>
                                </div>
                                <div id="quill-editor" style="height: 250px;"><?= old('content', $tour['content'] ?? '') ?></div>
                                <input type="hidden" name="content" id="quill-content-input">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Video (URL YouTube)</label><input type="text" name="video" class="form-control" value="<?= old('video', $tour['video'] ?? '') ?>"></div>
                               
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Video (URL YouTube)</label>
                                    <input type="text" name="video" class="form-control" value="<?= old('video', $tour['video'] ?? '') ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Duración</label>
                                    <div class="input-group">
                                        <input type="number" name="duration_value" class="form-control" placeholder="Ej. 8" value="<?= old('duration_value', $tour['duration_value'] ?? '') ?>">
                                        <select name="duration_unit" class="form-select" style="flex: 0.5;">
                                            <option value="hour" <?= ($tour['duration_unit'] ?? '') == 'hour' ? 'selected' : '' ?>>Horas</option>
                                            <option value="day" <?= ($tour['duration_unit'] ?? '') == 'day' ? 'selected' : '' ?>>Días</option>
                                            <option value="night" <?= ($tour['duration_unit'] ?? '') == 'night' ? 'selected' : '' ?>>Noches</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3"><label class="form-label">Estado</label><select name="status" class="select"><option value="draft" <?= (old('status', $tour['status'] ?? '') == 'draft') ? 'selected' : '' ?>>Borrador</option><option value="published" <?= (old('status', $tour['status'] ?? '') == 'published') ? 'selected' : '' ?>>Publicado</option></select></div>
                                <div class="col-md-6 mb-3"><label class="form-label">Destacado</label><select name="is_featured" class="select"><option value="0" <?= (old('is_featured', $tour['is_featured'] ?? '0') == '0') ? 'selected' : '' ?>>No</option><option value="1" <?= (old('is_featured', $tour['is_featured'] ?? '0') == '1') ? 'selected' : '' ?>>Sí</option></select></div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-none" id="pricing">
                        <div class="card-header"><h5 class="fs-18">Precios</h5></div>
                        <div class="card-body">
                             
                       <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio Base (USD)</label>
                            <input type="number" name="price" class="form-control <?= (session('errors.price')) ? 'is-invalid' : '' ?>" step="0.01" value="<?= old('price', $tour['price'] ?? '') ?>">
                            <?php if (session('errors.price')): ?><div class="invalid-feedback"><?= session('errors.price') ?></div><?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Precio de Oferta (USD)</label>
                            <input type="number" name="sale_price" class="form-control" step="0.01" value="<?= old('sale_price', $tour['sale_price'] ?? '') ?>">
                        </div>
                    </div>
                    <hr>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="enable_person_types" id="enable_person_types" <?= !empty($tourMeta['enable_person_types']) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="enable_person_types">
                            Habilitar precios por tipo de persona (adultos, niños, etc.)
                        </label>
                    </div>

                    <div id="person-types-section" style="display: <?= !empty($tourMeta['enable_person_types']) ? 'block' : 'none' ?>;">
                        <div id="person-types-list">
                            </div>
                        <button type="button" class="btn btn-primary btn-sm mt-2" id="add-person-type">
                            <i class="isax isax-add-circle me-1"></i>Añadir Tipo de Persona
                        </button>
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
                            <div id="itinerary-container"></div>
                            <button type="button" id="add-itinerary" class="btn btn-primary btn-sm mt-2"><i class="isax isax-add-circle me-1"></i>Añadir Parada</button>
                        </div>
                    </div>
                    
<div class="card shadow-none" id="gallery">
    <div class="card-header">
        <h5 class="fs-18">Galería de Imágenes</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Cambiar Imagen Principal (Destacada)</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <small class="form-text text-muted">Sube una nueva imagen solo si deseas reemplazar la actual.</small>
        </div>
        <?php if (!empty($tour['image_id'])): ?>
            <div class="mb-3">
                <p class="mb-1"><strong>Imagen Principal Actual:</strong></p>
                <img src="<?= base_url('uploads/tours/' . $tour['image_id']) ?>" alt="Imagen Principal" class="img-thumbnail" width="150">
            </div>
        <?php endif; ?>
        <hr>

        <h6 class="mb-2">Imágenes Adicionales</h6>
        <div class="file-upload drag-file w-100 d-flex align-items-center justify-content-center flex-column mb-3">
            <span class="upload-img d-block mb-2"><i class="isax isax-document-upload fs-24"></i></span>
            <h6 class="mb-1">Arrastra y suelta nuevas imágenes aquí</h6>
            <p class="mb-2">o</p>
            <label for="gallery_files" class="btn btn-sm btn-primary">Seleccionar Archivos</label>
            <input type="file" name="gallery[]" id="gallery_files" class="form-control" accept="image/*" multiple style="display: none;">
        </div>
        
        <h6 class="mt-3">Galería Completa (Actual y Nuevas)</h6>
        <div id="gallery_previews" class="d-flex align-items-center flex-wrap gap-2">
            </div>
    </div>
</div>                 

                    <div class="card shadow-none" id="location">
                        <div class="card-header"><h5 class="fs-18">Ubicación</h5></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3"><label class="form-label">Ubicación Principal</label><select name="location_id" class="select <?= (session('errors.location_id')) ? 'is-invalid' : '' ?>"><?php foreach ($locations as $location): ?><option value="<?= esc($location['id']) ?>" <?= (old('location_id', $tour['location_id'] ?? '') == $location['id']) ? 'selected' : '' ?>><?= esc($location['name']) ?></option><?php endforeach; ?></select>
                                <?php if (session('errors.location_id')): ?><div class="invalid-feedback"><?= session('errors.location_id') ?></div><?php endif; ?></div>
                                <div class="col-md-12 mb-3"><label class="form-label">Dirección</label><input type="text" name="address" class="form-control" value="<?= old('address', $tour['address'] ?? '') ?>"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Latitud</label><input type="text" name="map_lat" id="map-lat" class="form-control" value="<?= old('map_lat', $tour['map_lat'] ?? '') ?>"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Longitud</label><input type="text" name="map_lng" id="map-lng" class="form-control" value="<?= old('map_lng', $tour['map_lng'] ?? '') ?>"></div>
                                <div class="col-md-4 mb-3"><label class="form-label">Zoom del Mapa</label><input type="number" name="map_zoom" id="map-zoom" class="form-control" value="<?= old('map_zoom', $tour['map_zoom'] ?? '12') ?>"></div>
                            </div>
                            <div id="map" style="height: 400px; width: 100%; border-radius: 5px;"></div>
                        </div>
                    </div>

                    <div class="card shadow-none" id="faqs">
                        <div class="card-header"><h5 class="fs-18">Preguntas Frecuentes (FAQ)</h5></div>
                        <div class="card-body"><div id="faq-container"></div><button type="button" id="add-faq" class="btn btn-primary btn-sm mt-2"><i class="isax isax-add-circle me-1"></i>Añadir Pregunta</button></div>
                    </div>
                    
                    <input type="hidden" name="person_types" id="person-types-json">

                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <a href="<?= site_url('admin/tours') ?>" class="btn btn-light me-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Tour</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
// --- INICIALIZACIÓN DEL MAPA ---
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

    // ====================================================================
    // 1. INICIALIZACIÓN SEGURA DE DATOS Y QUILL EDITOR
    // ====================================================================
    const tourData = {
        include: <?= json_encode(json_decode($tour['include'] ?? '[]')) ?>,
        exclude: <?= json_encode(json_decode($tour['exclude'] ?? '[]')) ?>,
        itinerary: <?= json_encode(json_decode($tour['itinerary'] ?? '[]')) ?>,
        faqs: <?= json_encode(json_decode($tour['faqs'] ?? '[]')) ?>,
        person_types: <?= json_encode(json_decode($tourMeta['person_types'] ?? '[]')) ?>,
        existing_gallery: <?= !empty($tour['gallery']) ? $tour['gallery'] : '[]' ?>
    };

    var quill = new Quill('#quill-editor', { theme: 'snow' });
    // Se decodifica el contenido en PHP y se re-codifica como una cadena JSON segura para JavaScript.
    const quillContent = <?= json_encode(old('content', $tour['content'] ?? '')) ?>;
    quill.root.innerHTML = quillContent;



// ====================================================================
// 4. ENVÍO DEL FORMULARIO (CORREGIDO Y COMPLETADO)
// ====================================================================
$('#main-tour-form').on('submit', function(event) {
    event.preventDefault();
    $("#quill-content-input").val(quill.root.innerHTML);

    // --- Recopilar datos dinámicos y convertirlos a JSON ---
    const includes = Array.from($('#include-container .input-group')).map(el => ({ item: $(el).find('.include-text').val() })).filter(i => i.item);
    const excludes = Array.from($('#exclude-container .input-group')).map(el => ({ item: $(el).find('.exclude-text').val() })).filter(i => i.item);
    const itinerary = Array.from($('#itinerary-container .itinerary-item')).map(el => ({ title: $(el).find('.itinerary-title').val(), comment: $(el).find('.itinerary-comment').val() })).filter(i => i.title);
    const faqs = Array.from($('#faq-container .faq-item')).map(el => ({ question: $(el).find('.faq-question').val(), answer: $(el).find('.faq-answer').val() })).filter(i => i.question);
    const personTypes = Array.from($('#person-types-list .person-type-item')).map(el => ({ type: $(el).find('.person-type-text').val(), min: $(el).find('.person-type-min').val(), max: $(el).find('.person-type-max').val(), price: $(el).find('.person-type-price').val() })).filter(i => i.type && i.price);

    // Asignar los JSON a los campos ocultos (asegúrate de que los campos ocultos existan en tu HTML)
    $('input[name="include"]').val(JSON.stringify(includes));
    $('input[name="exclude"]').val(JSON.stringify(excludes));
    $('input[name="itinerary"]').val(JSON.stringify(itinerary));
    $('input[name="faqs"]').val(JSON.stringify(faqs));
    $('input[name="person_types"]').val(JSON.stringify(personTypes));
    
    var form = this;
    var formData = new FormData(form);
    var submitButton = $(this).find('button[type="submit"]');

    submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Actualizando...');
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
                alert(response.message || '¡Tour actualizado exitosamente!');
                location.reload();
            } else {
                alert('Por favor, corrige los errores del formulario.');
                $.each(response.errors, function(field, message) {
                    var input = $('[name="' + field + '"]');
                    input.addClass('is-invalid');
                    input.after('<div class="invalid-feedback d-block">' + message + '</div>');
                });
            }
        },
        error: function() { alert('Ocurrió un error inesperado al actualizar.'); },
        complete: function() { submitButton.prop('disabled', false).text('Actualizar Tour'); }
    });
});





    // --- GESTIÓN DE GALERÍA (CON BORRADO AJAX MEJORADO) ---
    let galleryFiles = new DataTransfer();
    updatePreviews(); // Cargar la galería existente al iniciar

    function updatePreviews() {
        const previewsContainer = $('#gallery_previews').html('');
        // Mostrar imágenes existentes
        if (tourData.existing_gallery && Array.isArray(tourData.existing_gallery)) {
            tourData.existing_gallery.forEach((imageName) => {
                const imageUrl = `<?= base_url('uploads/tours/') ?>${imageName}`;
                const previewHtml = `<div class="gallery-upload-img me-2 position-relative">
                                         <img src="${imageUrl}" alt="${imageName}">
                                         <span class="trash-icon d-flex align-items-center justify-content-center text-danger delete-image-btn" data-tour-id="<?= esc($tour['id']) ?>" data-image-name="${encodeURIComponent(imageName)}" style="cursor: pointer;">
                                             <i class="isax isax-trash"></i>
                                         </span>
                                     </div>`;
                previewsContainer.append(previewHtml);
            });
        }
        // Previsualizar imágenes nuevas
        Array.from(galleryFiles.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewHtml = `<div class="gallery-upload-img me-2 position-relative new-image"><img src="${e.target.result}" alt="${file.name}"><span class="trash-icon d-flex align-items-center justify-content-center text-danger gallery-trash-new" data-index="${index}"><i class="isax isax-trash"></i></span></div>`;
                previewsContainer.append(previewHtml);
            }
            reader.readAsDataURL(file);
        });
    }

    $('#gallery_files').on('change', function(event) {
        for (let file of event.target.files) {
            if (![...galleryFiles.files].find(f => f.name === file.name && f.size === file.size)) {
                galleryFiles.items.add(file);
            }
        }
        updatePreviews();
        document.getElementById('gallery_files').files = galleryFiles.files;
    });

    // Borrar imágenes NUEVAS (aún no guardadas)
    $(document).on('click', '.gallery-trash-new', function() {
        const indexToRemove = $(this).data('index');
        const newFiles = new DataTransfer();
        for (let i = 0; i < galleryFiles.files.length; i++) {
            if (i !== indexToRemove) { newFiles.items.add(galleryFiles.files[i]); }
        }
        galleryFiles = newFiles;
        updatePreviews();
        document.getElementById('gallery_files').files = galleryFiles.files;
    });

    // Borrar imágenes EXISTENTES (guardadas) vía AJAX
    $(document).on('click', '.delete-image-btn', function() {
        if (!confirm('¿Estás seguro de que quieres eliminar esta imagen permanentemente?')) return;
        
        const tourId = $(this).data('tour-id');
        const imageName = $(this).data('image-name');
        const url = `<?= site_url('admin/tours/delete-image/') ?>${tourId}/${imageName}`;
        const imageElement = $(this).closest('.gallery-upload-img');

        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': $('input[name=csrf_test_name]').val()
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Eliminar la imagen de la vista sin recargar la página
                imageElement.fadeOut(300, function() { $(this).remove(); });
                // Actualizar el array de datos local para consistencia
                tourData.existing_gallery = tourData.existing_gallery.filter(img => img !== decodeURIComponent(imageName));
            } else {
                alert(data.message || 'Error al eliminar la imagen.');
            }
        })
        .catch(error => { console.error('Error:', error); alert('Ocurrió un error de red.'); });
    });

    // --- POBLACIÓN Y GESTIÓN DE CAMPOS DINÁMICOS ---
    let includeIndex = 0;
    $('#add-include').on('click', function() { $('#include-container').append(`<div class="input-group mb-2"><input type="text" name="include[${includeIndex++}][item]" class="form-control" placeholder="Ej: Transporte incluido"><button class="btn btn-danger btn-sm remove-item" type="button">X</button></div>`); });
    if (tourData.include && Array.isArray(tourData.include)) {
        tourData.include.forEach(item => { $('#add-include').click(); $('#include-container .input-group:last input').val(item.item); });
    }

    let excludeIndex = 0;
    $('#add-exclude').on('click', function() { $('#exclude-container').append(`<div class="input-group mb-2"><input type="text" name="exclude[${excludeIndex++}][item]" class="form-control" placeholder="Ej: Propinas"><button class="btn btn-danger btn-sm remove-item" type="button">X</button></div>`); });
    if (tourData.exclude && Array.isArray(tourData.exclude)) {
        tourData.exclude.forEach(item => { $('#add-exclude').click(); $('#exclude-container .input-group:last input').val(item.item); });
    }

    let itineraryIndex = 0;
    $('#add-itinerary').on('click', function() { $('#itinerary-container').append(`<div class="row align-items-center itinerary-item mb-3"><div class="col-md-5"><input type="text" name="itinerary[${itineraryIndex}][title]" class="form-control" placeholder="Título"></div><div class="col-md-6"><input type="text" name="itinerary[${itineraryIndex}][comment]" class="form-control" placeholder="Comentario"></div><div class="col-md-1"><button type="button" class="btn btn-danger btn-sm remove-item">X</button></div></div>`); itineraryIndex++; });
    if (tourData.itinerary && Array.isArray(tourData.itinerary)) {
        tourData.itinerary.forEach(item => {
            $('#add-itinerary').click();
            const lastItem = $('#itinerary-container .itinerary-item:last');
            lastItem.find('input[name*="[title]"]').val(item.title);
            lastItem.find('input[name*="[comment]"]').val(item.comment);
        });
    }

    let faqIndex = 0;
    $('#add-faq').on('click', function() { $('#faq-container').append(`<div class="faq-item mb-3"><div class="row"><div class="col-11 mb-2"><input type="text" name="faqs[${faqIndex}][question]" class="form-control" placeholder="Pregunta"></div><div class="col-1"><button type="button" class="btn btn-danger btn-sm remove-item">X</button></div></div><div class="row"><div class="col-12"><textarea name="faqs[${faqIndex}][answer]" class="form-control" rows="2" placeholder="Respuesta"></textarea></div></div></div>`); faqIndex++; });
    if (tourData.faqs && Array.isArray(tourData.faqs)) {
        tourData.faqs.forEach(item => {
            $('#add-faq').click();
            const lastItem = $('#faq-container .faq-item:last');
            lastItem.find('input[name*="[question]"]').val(item.question);
            lastItem.find('textarea[name*="[answer]"]').val(item.answer);
        });
    }

    $(document).on('click', '.remove-item', function() {
        $(this).closest('.input-group, .itinerary-item, .faq-item, .person-type-item').remove();
    });
    // --- GESTIÓN DE TIPOS DE PERSONA ---

    // Lógica para mostrar/ocultar la sección
    $('#enable_person_types').change(function() {
        $('#person-types-section').toggle(this.checked);
    }).change(); // Ejecutar al cargar para establecer el estado inicial

    let personTypeCounter = 0;

    // Lógica para AÑADIR un nuevo campo de tipo de persona
    $('#add-person-type').on('click', function() {
        const index = personTypeCounter++;
        const html = `
        <div class="row align-items-center person-type-item mb-2">
            <div class="col-md-3"><input type="text" name="person_types[${index}][type]" class="form-control" placeholder="Ej: Adulto"></div>
            <div class="col-md-2"><input type="number" name="person_types[${index}][min]" class="form-control" placeholder="Mín."></div>
            <div class="col-md-2"><input type="number" name="person_types[${index}][max]" class="form-control" placeholder="Máx."></div>
            <div class="col-md-3"><input type="number" name="person_types[${index}][price]" class="form-control" placeholder="Precio" step="0.01"></div>
            <div class="col-md-2"><button type="button" class="btn btn-danger btn-sm remove-item">X</button></div>
        </div>`;
        $('#person-types-list').append(html);
    });

    // Lógica para CARGAR los datos existentes al abrir la página
    const personTypesData = <?= !empty($tourMeta['person_types']) ? $tourMeta['person_types'] : '[]' ?>;
    if (Array.isArray(personTypesData)) {
        personTypesData.forEach(item => {
            $('#add-person-type').click(); // Simula un clic para crear la fila
            const lastItem = $('#person-types-list .person-type-item:last');
            lastItem.find('input[name*="[type]"]').val(item.type);
            lastItem.find('input[name*="[min]"]').val(item.min);
            lastItem.find('input[name*="[max]"]').val(item.max);
            lastItem.find('input[name*="[price]"]').val(item.price);
        });
    }

    // Lógica para ELIMINAR (asegúrate de que el manejador .remove-item esté genérico)
    $(document).on('click', '.remove-item', function() {
        $(this).closest('.person-type-item').remove();
    });




});


    // 1. Lógica para mostrar/ocultar la sección de tipos de persona
    $('#enable_person_types').change(function() {
        $('#person-types-section').toggle(this.checked);
    }).change(); // Ejecutar al cargar para establecer el estado inicial

    // 2. Lógica para añadir un nuevo campo de tipo de persona
    let personTypeCounter = 0;
    $('#add-person-type').click(function() {
        const index = personTypeCounter++;
        const html = `
            <div class="row mb-2 person-type-item">
                <div class="col-md-3"><input type="text" name="person_types[${index}][type]" class="form-control" placeholder="Ej: Adulto"></div>
                <div class="col-md-2"><input type="number" name="person_types[${index}][min]" class="form-control" placeholder="Mín."></div>
                <div class="col-md-2"><input type="number" name="person_types[${index}][max]" class="form-control" placeholder="Máx."></div>
                <div class="col-md-3"><input type="number" name="person_types[${index}][price]" class="form-control" placeholder="Precio" step="0.01"></div>
                <div class="col-md-2"><button type="button" class="btn btn-danger btn-sm remove-item">X</button></div>
            </div>`;
        $('#person-types-list').append(html);
    });

    // 3. Lógica para cargar los datos existentes al abrir la página
    const personTypesData = <?= !empty($tourMeta['person_types']) ? $tourMeta['person_types'] : '[]' ?>;
    if (Array.isArray(personTypesData)) {
        personTypesData.forEach(item => {
            $('#add-person-type').click();
            const lastItem = $('#person-types-list .person-type-item:last');
            lastItem.find('input[name*="[type]"]').val(item.type);
            lastItem.find('input[name*="[min]"]').val(item.min);
            lastItem.find('input[name*="[max]"]').val(item.max);
            lastItem.find('input[name*="[price]"]').val(item.price);
        });
    }

</script>
<?= $this->endSection() ?>
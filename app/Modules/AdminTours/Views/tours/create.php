<?= $this->extend('layouts/main_dashboard') ?>

<?= $this->section('content') ?>

<?php
// Tomamos los errores directamente de la sesión.
// El '?? []' es para evitar un error si no hay ninguna sesión de errores.
$errors = session('errors') ?? [];
?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Crear Nuevo Tour</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tours') ?>">Tours</a></li>
                        <li class="breadcrumb-item active">Crear</li>
                    </ol>
                </div>
            </div>


                    <div class="card bg-light border mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-magic me-2"></i>Asistente de Contenido IA</h5>
                            <p class="text-muted">Describe tu tour con algunas palabras clave (ej: "excursión en catamarán a isla saona, incluye almuerzo y bebidas") y deja que la IA escriba el contenido por ti.</p>
                            <div class="input-group">
                                <input type="text" id="ai-keywords" class="form-control" placeholder="Introduce tus palabras clave aquí...">
                                <button class="btn btn-primary" type="button" id="generate-content-btn">
                                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true" style="display: none;"></span>
                                    Generar Contenido
                                </button>
                            </div>
                            <div id="ai-error" class="text-danger mt-2"></div>
                        </div>
                    </div>



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('error') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <form method="post" action="<?= base_url('admin/tours/store') ?>" enctype="multipart/form-data" id="main-tour-form">
                                <?= csrf_field() ?>
                                <ul class="nav nav-tabs mb-3" id="tourTabs" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" role="tab">General</a></li>
                                    <li class="nav-item"><a class="nav-link" id="pricing-tab" data-bs-toggle="tab" href="#pricing" role="tab">Precios</a></li>
                                    <li class="nav-item"><a class="nav-link" id="gallery-tab" data-bs-toggle="tab" href="#gallery" role="tab">Galería</a></li>
                                    <li class="nav-item"><a class="nav-link" id="location-tab" data-bs-toggle="tab" href="#location" role="tab">Ubicación</a></li>
                                    <li class="nav-item"><a class="nav-link" id="faqs-tab" data-bs-toggle="tab" href="#faqs" role="tab">FAQs</a></li>
                                    <li class="nav-item"><a class="nav-link" id="availability-tab" data-bs-toggle="tab" href="#availability" role="tab">Disponibilidad</a></li>
                                    <li class="nav-item"><a class="nav-link" id="terms-tab" data-bs-toggle="tab" href="#terms" role="tab">Atributos</a></li>
                                    <li class="nav-item"><a class="nav-link" id="settings-tab" data-bs-toggle="tab" href="#settings" role="tab">Configuraciones</a></li>
                                    <li class="nav-item"><a class="nav-link" id="translations-tab" data-bs-toggle="tab" href="#translations" role="tab">Traducciones</a></li>
                                    <li class="nav-item"><a class="nav-link" id="seo-tab" data-bs-toggle="tab" href="#seo" role="tab">SEO</a></li>
                                </ul>

                                <div class="tab-content" id="tourTabsContent">
                                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                                        <div class="row">
                                        <div class="col-md-6 mb-3"><label class="form-label">Título</label><input type="text" id="title" name="title" class="form-control <?= isset($errors['title']) ? 'is-invalid' : '' ?>" value="<?= old('title') ?>"><?php if (isset($errors['title'])): ?><div class="invalid-feedback"><?= esc($errors['title']) ?></div><?php endif; ?></div>
                                        <div class="col-md-6 mb-3"><label class="form-label">Categoría</label><select name="category_id" class="form-control <?= isset($errors['category_id']) ? 'is-invalid' : '' ?>"><option value="">Selecciona una categoría</option><?php foreach ($categories as $category): ?><option value="<?= esc($category['id']) ?>" <?= old('category_id') == $category['id'] ? 'selected' : '' ?>><?= esc($category['name']) ?></option><?php endforeach; ?></select><?php if (isset($errors['category_id'])): ?><div class="invalid-feedback"><?= esc($errors['category_id']) ?></div><?php endif; ?></div>
                                                                                </div>
                                        <div class="mb-3"><label class="form-label">Descripción Corta</label><textarea id="short_desc" name="short_desc" class="form-control" rows="3"><?= old('short_desc') ?></textarea></div>
                                        <div class="mb-3"><label class="form-label">Contenido</label><textarea id="content"  name="content" class="form-control" rows="5"><?= old('content') ?></textarea></div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3"><label class="form-label">Video (URL de YouTube)</label><input type="text" name="video" class="form-control" placeholder="https://..." value="<?= old('video') ?>"></div>
                                            <div class="col-md-6 mb-3"><label class="form-label">Duración</label><input type="text" name="duration" class="form-control" placeholder="Ej. 8 horas" value="<?= old('duration') ?>"></div>
                                        </div>

                                        <hr><div class="row mb-3 mt-4"><div class="col-12"><h5>Inclusiones</h5><input type="hidden" name="include" id="include-json"></div></div>
                                        <div id="include-list"></div>
                                        <button type="button" class="btn btn-primary mt-2" id="add-include"><i class="fas fa-plus me-1"></i> Añadir Inclusión</button>

                                        <hr><div class="row mb-3 mt-4"><div class="col-12"><h5>Exclusiones</h5><input type="hidden" name="exclude" id="exclude-json"></div></div>
                                        <div id="exclude-list"></div>
                                        <button type="button" class="btn btn-primary mt-2" id="add-exclude"><i class="fas fa-plus me-1"></i> Añadir Exclusión</button>

                                        <hr><div class="row mb-3 mt-4"><div class="col-12"><h5>Itinerario</h5><input type="hidden" name="itinerary" id="itinerary-json"></div></div>
                                        <div id="itinerary-list"></div>
                                        <button type="button" class="btn btn-primary mt-2" id="add-itinerary"><i class="fas fa-plus me-1"></i> Añadir Itinerario</button>

                                        <hr><div class="row mb-3 mt-4"><div class="col-12"><h5>Alrededores</h5><input type="hidden" name="surrounding" id="surrounding-json"></div></div>
                                        <div id="surrounding-list"></div>
                                        <button type="button" class="btn btn-primary mt-2" id="add-surrounding"><i class="fas fa-plus me-1"></i> Añadir Lugar</button>

                                        <hr><div class="row mt-4">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Estado</label>
                                                <select name="status" class="form-control">
                                                    <option value="draft" <?= old('status', 'draft') == 'draft' ? 'selected' : '' ?>>Borrador</option>
                                                    <option value="published" <?= old('status') == 'published' ? 'selected' : '' ?>>Publicado</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Destacado</label>
                                                <select name="is_featured" class="form-control">
                                                    <option value="0" <?= old('is_featured', '0') == '0' ? 'selected' : '' ?>>No</option>
                                                    <option value="1" <?= old('is_featured') == '1' ? 'selected' : '' ?>>Sí</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <div class="tab-pane fade" id="pricing" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Precio Base</label>
<div class="mb-3"><input type="number" name="price" class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>" step="0.01" value="<?= old('price') ?>"><?php if (isset($errors['price'])): ?><div class="invalid-feedback"><?= esc($errors['price']) ?></div><?php endif; ?></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Precio de Venta</label>
                                                <input type="number" name="sale_price" class="form-control" step="0.01" value="<?= old('sale_price') ?>">
                                            </div>
                                        </div>
                                        
                                        <hr><div class="form-check mb-2"><input class="form-check-input" type="checkbox" name="enable_person_types" id="enable_person_types" <?= old('enable_person_types') ? 'checked' : '' ?>><label class="form-check-label" for="enable_person_types">Habilitar los tipos de persona</label></div><input type="hidden" name="person_types" id="person-types-json">
                                        <div id="person-types-section" style="display: <?= old('enable_person_types') ? 'block' : 'none' ?>;"><div id="person-types-list"></div><button type="button" class="btn btn-primary mt-2" id="add-person-type"><i class="fas fa-plus me-1"></i> Añadir Tipo</button></div>

                                        <input type="hidden" name="extra_price" id="extra-price-json">
                                        <input type="hidden" name="discount_by_people" id="discount-by-people-json">
                                        <input type="hidden" name="service_fees" id="service-fees-json">
                                    </div>

                                    <div class="tab-pane fade" id="gallery" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6 mb-3"><label class="form-label">Imagen Principal</label><input type="file" name="image" class="form-control" accept="image/*"></div>
                                            <div class="col-md-6 mb-3"><label class="form-label">Imagen del Banner</label><input type="file" name="banner_image" class="form-control" accept="image/*"></div>
                                        </div>
                                        <div class="mb-3"><label class="form-label">Galería Adicional</label><input type="file" name="gallery[]" class="form-control" accept="image/*" multiple></div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="location" role="tabpanel">
                                        <div class="row">
<div class="mb-3"><label class="form-label">Ubicación</label><select name="location_id" class="form-control <?= isset($errors['location_id']) ? 'is-invalid' : '' ?>"><option value="">Selecciona una ubicación</option><?php foreach ($locations as $location): ?><option value="<?= esc($location['id']) ?>" <?= old('location_id') == $location['id'] ? 'selected' : '' ?>><?= esc($location['name']) ?></option><?php endforeach; ?></select><?php if (isset($errors['location_id'])): ?><div class="invalid-feedback"><?= esc($errors['location_id']) ?></div><?php endif; ?></div>                                            <div class="col-md-6 mb-3"><label class="form-label">Dirección</label><input type="text" name="address" class="form-control" value="<?= old('address') ?>"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3"><label class="form-label">Latitud</label><input type="text" name="map_lat" id="map-lat" class="form-control" value="<?= old('map_lat', '40.7128') ?>"></div>
                                            <div class="col-md-4 mb-3"><label class="form-label">Longitud</label><input type="text" name="map_lng" id="map-lng" class="form-control" value="<?= old('map_lng', '-74.0060') ?>"></div>
                                            <div class="col-md-4 mb-3"><label class="form-label">Zoom del Mapa</label><input type="number" name="map_zoom" id="map-zoom" class="form-control" value="<?= old('map_zoom', '8') ?>"></div>
                                        </div>
                                        <div id="map" style="height: 400px; width: 100%; border-radius: 5px;"></div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="faqs" role="tabpanel">
                                        <h5>Preguntas Frecuentes</h5><input type="hidden" name="faqs" id="faqs-json"><div id="faq-list"></div><button type="button" class="btn btn-primary mt-2" id="add-faq"><i class="fas fa-plus me-1"></i> Añadir Pregunta</button>
                                    </div>

                                    <div class="tab-pane fade" id="availability" role="tabpanel"><p>La gestión de disponibilidad se activa después de crear el tour.</p></div>
                                    <div class="tab-pane fade" id="terms" role="tabpanel">...</div>
                                    <div class="tab-pane fade" id="settings" role="tabpanel">...</div>
                                    <div class="tab-pane fade" id="translations" role="tabpanel">...</div>
                                    <div class="tab-pane fade" id="seo" role="tabpanel">...</div>

                                </div>

                                <hr><button type="submit" class="btn btn-success mt-3">Crear Tour</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.include-item, .exclude-item, .itinerary-item, .faq-item, .person-type-item, .extra-price-item, .discount-item, .service-fee-item, .availability-item, .surrounding-item, .capacity-item, .translation-item {
    border: 1px solid #e9ecef;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
    background-color: #f8f9fa;
}
.include-item .form-group, .exclude-item .form-group, .itinerary-item .form-group, .faq-item .form-group,
.person-type-item .form-group, .extra-price-item .form-group, .discount-item .form-group, .service-fee-item .form-group,
.availability-item .form-group, .surrounding-item .form-group, .capacity-item .form-group, .translation-item .form-group {
    margin-bottom: 0;
}
.remove-include, .remove-exclude, .remove-itinerary, .remove-faq, .remove-person-type, .remove-extra-price, .remove-discount, .remove-service-fee, .remove-availability, .remove-surrounding, .remove-capacity, .remove-translation {
    padding: 6px 10px;
}
.remove-include i, .remove-exclude i, .remove-itinerary i, .remove-faq i, .remove-person-type i, .remove-extra-price i, .remove-discount i, .remove-service-fee i, .remove-availability i, .remove-surrounding i, .remove-capacity i, .remove-translation i {
    font-size: 16px;
}
#map {
    border: 1px solid #e9ecef;
    border-radius: 5px;
}
</style>

<script>
function initMap() {
    // Inicializar el mapa con una ubicación predeterminada
    const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 40.7128, lng: -74.0060 },
        zoom: 8
    });

    let marker;

    // Escuchar clics en el mapa para colocar un pin y actualizar los campos
    map.addListener('click', function(event) {
        // Si ya existe un marcador, eliminarlo
        if (marker) {
            marker.setMap(null);
        }

        // Colocar un nuevo marcador en la posición donde se hizo clic
        marker = new google.maps.Marker({
            position: event.latLng,
            map: map
        });

        // Actualizar los campos de latitud y longitud
        document.getElementById('map-lat').value = event.latLng.lat().toFixed(6);
        document.getElementById('map-lng').value = event.latLng.lng().toFixed(6);

        // Actualizar el nivel de zoom actual del mapa
        map.addListener('zoom_changed', function() {
            document.getElementById('map-zoom').value = map.getZoom();
        });
        document.getElementById('map-zoom').value = map.getZoom();
    });
}

$(document).ready(function() {
    let includeCounter = 0;
    let excludeCounter = 0;
    let itineraryCounter = 0;
    let faqCounter = 0;
    let personTypeCounter = 0;
    let extraPriceCounter = 0;
    let discountCounter = 0;
    let serviceFeeCounter = 0;
    let availabilityCounter = 0;
    let surroundingCounter = 0;
    let capacityCounter = 0;
    let translationCounter = 0;

    // Mostrar/Ocultar secciones basadas en checkboxes
    $('#enable_person_types').change(function() {
        $('#person-types-section').toggle(this.checked);
    });

    $('#enable_extra_price').change(function() {
        $('#extra-price-section').toggle(this.checked);
    });

    $('#enable_service_fee').change(function() {
        $('#service-fee-section').toggle(this.checked);
    });

    $('#enable_fixed_date').change(function() {
        $('#fixed-date-section').toggle(this.checked);
    });

    $('select[name="pass_exprire_type"]').change(function() {
        const value = $(this).val();
        $('#pass-expire-at-section').toggle(value === 'fixed');
        $('#pass-valid-for-section').toggle(value === 'duration');
    });

    // Función para agregar una nueva inclusión
    $('#add-include').click(function() {
        const includeHtml = `
            <div class="row mb-3 include-item" data-id="${includeCounter}">
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" class="form-control include-text" placeholder="Inclusión">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-include mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#include-list').append(includeHtml);
        includeCounter++;
    });

    // Función para eliminar una inclusión
    $(document).on('click', '.remove-include', function() {
        $(this).closest('.include-item').remove();
    });

    // Función para agregar una nueva exclusión
    $('#add-exclude').click(function() {
        const excludeHtml = `
            <div class="row mb-3 exclude-item" data-id="${excludeCounter}">
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" class="form-control exclude-text" placeholder="Exclusión">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-exclude mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#exclude-list').append(excludeHtml);
        excludeCounter++;
    });

    // Función para eliminar una exclusión
    $(document).on('click', '.remove-exclude', function() {
        $(this).closest('.exclude-item').remove();
    });

    // Función para agregar una nueva entrada al itinerario
    $('#add-itinerary').click(function() {
        const itineraryHtml = `
            <div class="row mb-3 itinerary-item" data-id="${itineraryCounter}">
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control itinerary-title" placeholder="Título">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="text" class="form-control itinerary-location" placeholder="Ubicación">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <textarea class="form-control itinerary-comment" rows="2" placeholder="Comentario"></textarea>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="file" class="form-control itinerary-photo" name="itinerary_photos[${itineraryCounter}]" accept="image/*">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-itinerary mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#itinerary-list').append(itineraryHtml);
        itineraryCounter++;
    });

    // Función para eliminar una entrada del itinerario
    $(document).on('click', '.remove-itinerary', function() {
        $(this).closest('.itinerary-item').remove();
    });

    // Función para agregar una nueva pregunta
    $('#add-faq').click(function() {
        const faqHtml = `
            <div class="row mb-3 faq-item" data-id="${faqCounter}">
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" class="form-control faq-question" placeholder="Título de la pregunta">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <textarea class="form-control faq-answer" rows="2" placeholder="Respuesta"></textarea>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-faq mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#faq-list').append(faqHtml);
        faqCounter++;
    });

    // Función para eliminar una pregunta
    $(document).on('click', '.remove-faq', function() {
        $(this).closest('.faq-item').remove();
    });

    // Función para agregar un nuevo tipo de persona
    $('#add-person-type').click(function() {
        const personTypeHtml = `
            <div class="row mb-3 person-type-item" data-id="${personTypeCounter}">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control person-type-text" placeholder="Tipo de Persona">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="number" class="form-control person-type-min" placeholder="Mínimo" min="1">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="number" class="form-control person-type-max" placeholder="Máximo" min="1">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="number" class="form-control person-type-price" placeholder="Precio" step="0.01">
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-person-type mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#person-types-list').append(personTypeHtml);
        personTypeCounter++;
    });

    // Función para agregar un nuevo precio extra
    $('#add-extra-price').click(function() {
        const extraPriceHtml = `
            <div class="row mb-3 extra-price-item" data-id="${extraPriceCounter}">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control extra-price-name" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="number" class="form-control extra-price-amount" placeholder="Precio" step="0.01">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control extra-price-type">
                            <option value="once">Una sola vez</option>
                            <option value="per_person">Precio por persona</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-extra-price mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#extra-price-list').append(extraPriceHtml);
        extraPriceCounter++;
    });

    // Función para agregar un nuevo descuento por número de personas
    $('#add-discount-by-people').click(function() {
        const discountHtml = `
            <div class="row mb-3 discount-item" data-id="${discountCounter}">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="number" class="form-control discount-from" placeholder="A partir de" min="1">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="number" class="form-control discount-amount" placeholder="Descuento" step="0.01">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control discount-type">
                            <option value="percentage">Porcentaje (%)</option>
                            <option value="fixed">Fijo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-discount mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#discount-by-people-list').append(discountHtml);
        discountCounter++;
    });

    // Función para agregar un nuevo service fee
    $('#add-service-fee').click(function() {
        const serviceFeeHtml = `
            <div class="row mb-3 service-fee-item" data-id="${serviceFeeCounter}">
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control service-fee-name" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="number" class="form-control service-fee-amount" placeholder="Precio" step="0.01">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select class="form-control service-fee-type">
                            <option value="percentage">Porcentaje (%)</option>
                            <option value="fixed">Fijo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-service-fee mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#service-fee-list').append(serviceFeeHtml);
        serviceFeeCounter++;
    });

    // Función para agregar una nueva entrada de disponibilidad
    $('#add-availability').click(function() {
        const availabilityHtml = `
            <div class="row mb-3 availability-item" data-id="${availabilityCounter}">
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="date" class="form-control availability-start-date">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="date" class="form-control availability-end-date">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="number" class="form-control availability-price" placeholder="Precio" step="0.01">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="number" class="form-control availability-min-guests" placeholder="Mínimo" min="1">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="number" class="form-control availability-max-people" placeholder="Máximo" min="1">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="text" class="form-control availability-note-to-customer" placeholder="Nota al Cliente">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="text" class="form-control availability-note-to-admin" placeholder="Nota al Admin">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="checkbox" class="form-check-input availability-is-instant">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input type="checkbox" class="form-check-input availability-is-available" checked>
                    </div>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-availability mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#availability-list').append(availabilityHtml);
        availabilityCounter++;
    });

    // Función para agregar un nuevo lugar en los alrededores
    $('#add-surrounding').click(function() {
        const surroundingHtml = `
            <div class="row mb-3 surrounding-item" data-id="${surroundingCounter}">
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="text" class="form-control surrounding-name" placeholder="Nombre del Lugar">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <input type="number" class="form-control surrounding-distance" placeholder="Distancia en km" step="0.01" min="0">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-surrounding mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#surrounding-list').append(surroundingHtml);
        surroundingCounter++;
    });

    // Función para agregar una nueva capacidad
    $('#add-capacity').click(function() {
        const capacityHtml = `
            <div class="row mb-3 capacity-item" data-id="${capacityCounter}">
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control capacity-day">
                            <option value="monday">Lunes</option>
                            <option value="tuesday">Martes</option>
                            <option value="wednesday">Miércoles</option>
                            <option value="thursday">Jueves</option>
                            <option value="friday">Viernes</option>
                            <option value="saturday">Sábado</option>
                            <option value="sunday">Domingo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="number" class="form-control capacity-amount" placeholder="Capacidad" min="1">
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-capacity mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#capacity-list').append(capacityHtml);
        capacityCounter++;
    });

    // Función para agregar una nueva traducción
    $('#add-translation').click(function() {
        const translationHtml = `
            <div class="row mb-3 translation-item" data-id="${translationCounter}">
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">Idioma</label>
                        <select class="form-control translation-locale">
                            <option value="en">Inglés</option>
                            <option value="es">Español</option>
                            <option value="fr">Francés</option>
                            <!-- Añadir más idiomas según sea necesario -->
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Título</label>
                        <input type="text" class="form-control translation-title" placeholder="Título traducido">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Contenido</label>
                        <textarea class="form-control translation-content" rows="2" placeholder="Contenido traducido"></textarea>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label class="form-label">Descripción Corta</label>
                        <textarea class="form-control translation-short-desc" rows="2" placeholder="Descripción corta traducida"></textarea>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                   // Continuación desde donde se cortó
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-translation mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#translation-list').append(translationHtml);
        translationCounter++;
    });

    // Función para eliminar una traducción
    $(document).on('click', '.remove-translation', function() {
        $(this).closest('.translation-item').remove();
    });

    // Función para eliminar un tipo de persona
    $(document).on('click', '.remove-person-type', function() {
        $(this).closest('.person-type-item').remove();
    });

    // Función para eliminar un precio extra
    $(document).on('click', '.remove-extra-price', function() {
        $(this).closest('.extra-price-item').remove();
    });

    // Función para eliminar un descuento
    $(document).on('click', '.remove-discount', function() {
        $(this).closest('.discount-item').remove();
    });

    // Función para eliminar un service fee
    $(document).on('click', '.remove-service-fee', function() {
        $(this).closest('.service-fee-item').remove();
    });

    // Función para eliminar una entrada del itinerario
    $(document).on('click', '.remove-itinerary', function() {
        $(this).closest('.itinerary-item').remove();
    });

    // Función para eliminar una pregunta
    $(document).on('click', '.remove-faq', function() {
        $(this).closest('.faq-item').remove();
    });

    // Función para eliminar una entrada de disponibilidad
    $(document).on('click', '.remove-availability', function() {
        $(this).closest('.availability-item').remove();
    });

    // Función para eliminar un lugar de los alrededores
    $(document).on('click', '.remove-surrounding', function() {
        $(this).closest('.surrounding-item').remove();
    });

    // Función para eliminar una entrada de capacidad
    $(document).on('click', '.remove-capacity', function() {
        $(this).closest('.capacity-item').remove();
    });



    // --- CÓDIGO PARA REPOBLAR CAMPOS DINÁMICOS AL CARGAR LA PÁGINA ---
    function repopulateFromJson(dataKey, addButtonId, listContainerId, itemClass, fieldMappings) {
        const oldDataJson = '<?= html_entity_decode(json_encode(old("'+dataKey+'"))) ?>';
        if (oldDataJson && oldDataJson !== 'null' && oldDataJson !== '""') {
            try {
                const oldData = JSON.parse(oldDataJson);
                if (Array.isArray(oldData)) {
                    oldData.forEach(itemData => {
                        $('#' + addButtonId).click();
                        const lastItem = $('#' + listContainerId + ' .' + itemClass).last();
                        fieldMappings.forEach(mapping => {
                            const element = lastItem.find(mapping.selector);
                            const value = itemData[mapping.key];
                            if (element.length > 0 && value !== undefined) {
                                element.val(value);
                            }
                        });
                    });
                }
            } catch (e) {
                console.error("Error al repoblar " + dataKey + ": ", e, "JSON data:", oldDataJson);
            }
        }
    }

    // Repoblar Inclusiones
    repopulateFromJson('include', 'add-include', 'include-list', 'include-item', [{ key: 'item', selector: '.include-text' }]);
    
    // Repoblar Exclusiones
    repopulateFromJson('exclude', 'add-exclude', 'exclude-list', 'exclude-item', [{ key: 'item', selector: '.exclude-text' }]);
    
    // Repoblar Itinerario
    repopulateFromJson('itinerary', 'add-itinerary', 'itinerary-list', 'itinerary-item', [
        { key: 'title', selector: '.itinerary-title' },
        { key: 'location', selector: '.itinerary-location' },
        { key: 'comment', selector: '.itinerary-comment' }
    ]);

    // Repoblar Alrededores
    repopulateFromJson('surrounding', 'add-surrounding', 'surrounding-list', 'surrounding-item', [
        { key: 'name', selector: '.surrounding-name' },
        { key: 'distance', selector: '.surrounding-distance' }
    ]);
    
    // Repoblar FAQs
    repopulateFromJson('faqs', 'add-faq', 'faq-list', 'faq-item', [
        { key: 'question', selector: '.faq-question' },
        { key: 'answer', selector: '.faq-answer' }
    ]);
    
    // Repoblar Tipos de Persona
    $('#enable_person_types').prop('checked', <?= old('enable_person_types') ? 'true' : 'false' ?>).change();
    repopulateFromJson('person_types', 'add-person-type', 'person-types-list', 'person-type-item', [
        { key: 'type', selector: '.person-type-text' },
        { key: 'min', selector: '.person-type-min' },
        { key: 'max', selector: '.person-type-max' },
        { key: 'price', selector: '.person-type-price' }
    ]);

    // Manejador para el evento submit del formulario principal
    $('#main-tour-form').submit(function(event) {
        console.log('Formulario principal enviado'); // Depuración

        try {
            // Convertir inclusiones a JSON
            const includes = [];
            $('#include-list .include-item').each(function() {
                const item = $(this).find('.include-text').val();
                if (item) {
                    includes.push({ item: item });
                }
            });
            console.log('Inclusiones antes de enviar:', includes);
            $('#include-json').val(JSON.stringify(includes));

            // Convertir exclusiones a JSON
            const excludes = [];
            $('#exclude-list .exclude-item').each(function() {
                const item = $(this).find('.exclude-text').val();
                if (item) {
                    excludes.push({ item: item });
                }
            });
            console.log('Exclusiones antes de enviar:', excludes);
            $('#exclude-json').val(JSON.stringify(excludes));

            // Convertir itinerario a JSON
            const itinerary = [];
            $('#itinerary-list .itinerary-item').each(function(index) {
                const title = $(this).find('.itinerary-title').val() || '';
                const location = $(this).find('.itinerary-location').val() || '';
                const comment = $(this).find('.itinerary-comment').val() || '';
                const photoInput = $(this).find('.itinerary-photo')[0];
                let photoName = '';
                if (photoInput && photoInput.files && photoInput.files.length > 0) {
                    photoName = photoInput.files[0].name;
                }
                if (title || location || comment) {
                    itinerary.push({
                        title: title,
                        location: location,
                        comment: comment,
                        photo: photoName
                    });
                }
            });
            console.log('Itinerario antes de enviar:', itinerary);
            $('#itinerary-json').val(JSON.stringify(itinerary));

            // Convertir FAQs a JSON
            const faqs = [];
            $('#faq-list .faq-item').each(function() {
                const question = $(this).find('.faq-question').val();
                const answer = $(this).find('.faq-answer').val();
                if (question && answer) {
                    faqs.push({ question: question, answer: answer });
                }
            });
            console.log('FAQs antes de enviar:', faqs);
            $('#faqs-json').val(JSON.stringify(faqs));

            // Convertir Tipos de Persona a JSON
            const personTypes = [];
            $('#person-types-list .person-type-item').each(function() {
                const type = $(this).find('.person-type-text').val();
                const min = $(this).find('.person-type-min').val();
                const max = $(this).find('.person-type-max').val();
                const price = $(this).find('.person-type-price').val();
                if (type && min && max && price) {
                    personTypes.push({
                        type: type,
                        min: parseInt(min),
                        max: parseInt(max),
                        price: parseFloat(price)
                    });
                }
            });
            console.log('Tipos de persona antes de enviar:', personTypes);
            $('#person-types-json').val(JSON.stringify(personTypes));

            // Convertir Precios Extra a JSON
            const extraPrices = [];
            $('#extra-price-list .extra-price-item').each(function() {
                const name = $(this).find('.extra-price-name').val();
                const amount = $(this).find('.extra-price-amount').val();
                const type = $(this).find('.extra-price-type').val();
                if (name && amount && type) {
                    extraPrices.push({
                        name: name,
                        amount: parseFloat(amount),
                        type: type
                    });
                }
            });
            console.log('Precios extra antes de enviar:', extraPrices);
            $('#extra-price-json').val(JSON.stringify(extraPrices));

            // Convertir Descuentos por Número de Personas a JSON
            const discountByPeople = [];
            $('#discount-by-people-list .discount-item').each(function() {
                const from = $(this).find('.discount-from').val();
                const amount = $(this).find('.discount-amount').val();
                const type = $(this).find('.discount-type').val();
                if (from && amount && type) {
                    discountByPeople.push({
                        from: parseInt(from),
                        amount: parseFloat(amount),
                        type: type
                    });
                }
            });
            console.log('Descuentos por número de personas antes de enviar:', discountByPeople);
            $('#discount-by-people-json').val(JSON.stringify(discountByPeople));

            // Convertir Service Fees a JSON
            const serviceFees = [];
            $('#service-fee-list .service-fee-item').each(function() {
                const name = $(this).find('.service-fee-name').val();
                const amount = $(this).find('.service-fee-amount').val();
                const type = $(this).find('.service-fee-type').val();
                if (name && amount && type) {
                    serviceFees.push({
                        name: name,
                        amount: parseFloat(amount),
                        type: type
                    });
                }
            });
            console.log('Service Fees antes de enviar:', serviceFees);
            $('#service-fees-json').val(JSON.stringify(serviceFees));

            // Convertir disponibilidad a JSON
            const availability = [];
            $('#availability-list .availability-item').each(function(index) {
                const startDate = $(this).find('.availability-start-date').val();
                const endDate = $(this).find('.availability-end-date').val();
                const price = $(this).find('.availability-price').val();
                const minGuests = $(this).find('.availability-min-guests').val();
                const maxPeople = $(this).find('.availability-max-people').val();
                const noteToCustomer = $(this).find('.availability-note-to-customer').val();
                const noteToAdmin = $(this).find('.availability-note-to-admin').val();
                const isInstant = $(this).find('.availability-is-instant').is(':checked');
                const isAvailable = $(this).find('.availability-is-available').is(':checked');
                if (startDate && endDate) {
                    availability.push({
                        start_date: startDate,
                        end_date: endDate,
                        price: price ? parseFloat(price) : null,
                        min_guests: minGuests ? parseInt(minGuests) : null,
                        max_people: maxPeople ? parseInt(maxPeople) : null,
                        note_to_customer: noteToCustomer || null,
                        note_to_admin: noteToAdmin || null,
                        is_instant: isInstant ? 1 : 0,
                        is_available: isAvailable ? 1 : 0
                    });
                }
            });
            console.log('Disponibilidad antes de enviar:', availability);
            $('#availability-json').val(JSON.stringify(availability));

            // Convertir Alrededores a JSON
            const surrounding = [];
            $('#surrounding-list .surrounding-item').each(function() {
                const name = $(this).find('.surrounding-name').val();
                const distance = $(this).find('.surrounding-distance').val();
                if (name && distance) {
                    surrounding.push({
                        name: name,
                        distance: parseFloat(distance)
                    });
                }
            });
            console.log('Alrededores antes de enviar:', surrounding);
            $('#surrounding-json').val(JSON.stringify(surrounding));

            // Convertir Capacidad a JSON
            const capacity = [];
            $('#capacity-list .capacity-item').each(function() {
                const day = $(this).find('.capacity-day').val();
                const amount = $(this).find('.capacity-amount').val();
                if (day && amount) {
                    capacity.push({
                        day: day,
                        amount: parseInt(amount)
                    });
                }
            });
            console.log('Capacidad antes de enviar:', capacity);
            $('#capacity-json').val(JSON.stringify(capacity));

            // Convertir Traducciones a JSON
            const translations = [];
            $('#translation-list .translation-item').each(function() {
                const locale = $(this).find('.translation-locale').val();
                const title = $(this).find('.translation-title').val();
                const content = $(this).find('.translation-content').val();
                const shortDesc = $(this).find('.translation-short-desc').val();
                if (locale && (title || content || shortDesc)) {
                    translations.push({
                        locale: locale,
                        title: title || '',
                        content: content || '',
                        short_desc: shortDesc || ''
                    });
                }
            });
            console.log('Traducciones antes de enviar:', translations);
            $('#translations-json').val(JSON.stringify(translations));
        } catch (error) {
            console.error('Error al procesar el formulario:', error);
            event.preventDefault();
            alert('Ocurrió un error al procesar el formulario. Por favor, revisa los datos e intenta de nuevo.');
        }
    });
});




document.addEventListener('DOMContentLoaded', function() {
    const generateBtn = document.getElementById('generate-content-btn');
    const keywordsInput = document.getElementById('ai-keywords');
    const spinner = generateBtn.querySelector('.spinner-border');
    const aiError = document.getElementById('ai-error');
    
    const titleInput = document.getElementById('title');
    const shortDescTextarea = document.getElementById('short_desc');
    const contentTextarea = document.getElementById('content');

    generateBtn.addEventListener('click', function() {
        const keywords = keywordsInput.value.trim();
        if (!keywords) {
            aiError.textContent = 'Por favor, introduce algunas palabras clave.';
            return;
        }

        // Mostrar spinner y deshabilitar botón
        spinner.style.display = 'inline-block';
        generateBtn.disabled = true;
        aiError.textContent = '';

        fetch('<?= base_url('api/generate-tour-content') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('input[name="csrf_test_name"]').value
            },
            body: JSON.stringify({ keywords: keywords })
        })
        .then(response => response.json())
        .then(result => {
            if (result.success && result.data) {
                // Rellenar los campos del formulario con la respuesta de la IA
                titleInput.value = result.data.title || '';
                shortDescTextarea.value = result.data.short_desc || '';
                contentTextarea.value = result.data.content || '';
                
                // Efecto visual para indicar que los campos fueron actualizados
                [titleInput, shortDescTextarea, contentTextarea].forEach(el => {
                    el.style.backgroundColor = '#d1e7dd';
                    setTimeout(() => { el.style.backgroundColor = ''; }, 2000);
                });
            } else {
                aiError.textContent = result.message || 'Ocurrió un error desconocido.';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            aiError.textContent = 'Error de conexión. Por favor, revisa la consola.';
        })
        .finally(() => {
            // Ocultar spinner y habilitar botón
            spinner.style.display = 'none';
            generateBtn.disabled = false;
        });
    });
});





</script>

<?= $this->endSection() ?>
<?= $this->extend('layouts/main_dashboard') ?>

<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Editar Tour</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tours') ?>">Tours</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
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

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= session()->getFlashdata('success') ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <!-- Formulario Principal -->
                            <form method="post" action="<?= base_url('admin/tours/update/' . $tour['id']) ?>" enctype="multipart/form-data" id="main-tour-form">
                                <ul class="nav nav-tabs mb-3" id="tourTabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pricing-tab" data-bs-toggle="tab" href="#pricing" role="tab" aria-controls="pricing" aria-selected="false">Precios</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="gallery-tab" data-bs-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false">Galería</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="location-tab" data-bs-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="false">Ubicación</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="faqs-tab" data-bs-toggle="tab" href="#faqs" role="tab" aria-controls="faqs" aria-selected="false">Preguntas Frecuentes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="availability-tab" data-bs-toggle="tab" href="#availability" role="tab" aria-controls="availability" aria-selected="false">Disponibilidad</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="terms-tab" data-bs-toggle="tab" href="#terms" role="tab" aria-controls="terms" aria-selected="false">Términos/Atributos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="settings-tab" data-bs-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Configuraciones</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="translations-tab" data-bs-toggle="tab" href="#translations" role="tab" aria-controls="translations" aria-selected="false">Traducciones</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="related-data-tab" data-bs-toggle="tab" href="#related-data" role="tab" aria-controls="related-data" aria-selected="false">Datos Relacionados</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="seo-tab" data-bs-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false">SEO</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="tourTabsContent">
                                    <!-- Pestaña General -->
                                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Título</label>
                                                    <input type="text" name="title" class="form-control" value="<?= esc($tour['title']) ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Categoría</label>
                                                    <select name="category_id" class="form-control">
                                                        <option value="">Selecciona una categoría</option>
                                                        <?php foreach ($categories as $category): ?>
                                                            <option value="<?= esc($category['id']) ?>" <?= $tour['category_id'] == $category['id'] ? 'selected' : '' ?>><?= esc($category['name']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Descripción Corta</label>
                                                    <textarea name="short_desc" class="form-control" rows="3"><?= esc($tour['short_desc']) ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Contenido</label>
                                                    <textarea name="content" class="form-control" rows="5"><?= esc($tour['content']) ?></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Video (URL de YouTube)</label>
                                                    <input type="text" name="video" class="form-control" value="<?= esc($tour['video']) ?>" placeholder="https://www.youtube.com/watch?v=...">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Duración</label>
                                                    <input type="text" name="duration" class="form-control" value="<?= esc($tour['duration']) ?>" placeholder="Ej. 8 horas">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sección de Inclusiones -->
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <h5>Inclusiones</h5>
                                                <input type="hidden" name="include" id="include-json">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-10">
                                                <label class="form-label">Inclusión</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Acciones</label>
                                            </div>
                                        </div>
                                        <div id="include-list"></div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary mt-2" id="add-include"><i class="fas fa-plus me-1"></i> Añadir Inclusión</button>
                                            </div>
                                        </div>

                                        <!-- Sección de Exclusiones -->
                                        <div class="row mb-3 mt-4">
                                            <div class="col-12">
                                                <h5>Exclusiones</h5>
                                                <input type="hidden" name="exclude" id="exclude-json">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-10">
                                                <label class="form-label">Exclusión</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Acciones</label>
                                            </div>
                                        </div>
                                        <div id="exclude-list"></div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary mt-2" id="add-exclude"><i class="fas fa-plus me-1"></i> Añadir Exclusión</button>
                                            </div>
                                        </div>

                                        <!-- Sección de Itinerario -->
                                        <div class="row mb-3 mt-4">
                                            <div class="col-12">
                                                <h5>Itinerario</h5>
                                                <input type="hidden" name="itinerary" id="itinerary-json">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <label class="form-label">Título</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Ubicación</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Comentario</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Foto</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Acciones</label>
                                            </div>
                                        </div>
                                        <div id="itinerary-list"></div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary mt-2" id="add-itinerary"><i class="fas fa-plus me-1"></i> Añadir Itinerario</button>
                                            </div>
                                        </div>

                                        <!-- Sección de Alrededores -->
                                        <div class="row mb-3 mt-4">
                                            <div class="col-12">
                                                <h5>Alrededores</h5>
                                                <input type="hidden" name="surrounding" id="surrounding-json">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-5">
                                                <label class="form-label">Nombre del Lugar</label>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">Distancia (km)</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Acciones</label>
                                            </div>
                                        </div>
                                        <div id="surrounding-list"></div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary mt-2" id="add-surrounding"><i class="fas fa-plus me-1"></i> Añadir Lugar</button>
                                            </div>
                                        </div>

                                        <!-- Campos de Estado y Destacado -->
                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Estado</label>
                                                    <select name="status" class="form-control">
                                                        <option value="draft" <?= $tour['status'] == 'draft' ? 'selected' : '' ?>>Borrador</option>
                                                        <option value="published" <?= $tour['status'] == 'published' ? 'selected' : '' ?>>Publicado</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Destacado</label>
                                                    <select name="is_featured" class="form-control">
                                                        <option value="0" <?= $tour['is_featured'] == 0 ? 'selected' : '' ?>>No</option>
                                                        <option value="1" <?= $tour['is_featured'] == 1 ? 'selected' : '' ?>>Sí</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pestaña Precios -->
                                    <div class="tab-pane fade" id="pricing" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Precio</label>
                                                    <input type="number" name="price" class="form-control" step="0.01" value="<?= esc($tour['price']) ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Precio de Venta</label>
                                                    <input type="number" name="sale_price" class="form-control" step="0.01" value="<?= esc($tour['sale_price']) ?>">
                                                    <small class="form-text text-muted">Si el precio de venta es inferior al descuento, se mostrará el precio normal.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sección de Tipos de Persona -->
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="enable_person_types" id="enable_person_types" <?= isset($tourMeta['enable_person_types']) && $tourMeta['enable_person_types'] ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="enable_person_types">Habilitar los tipos de persona</label>
                                                </div>
                                                <input type="hidden" name="person_types" id="person-types-json">
                                            </div>
                                        </div>

                                        <div id="person-types-section" style="display: <?= isset($tourMeta['enable_person_types']) && $tourMeta['enable_person_types'] ? 'block' : 'none' ?>;">
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label class="form-label">Tipo de Persona</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Mínimo</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Máximo</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Precio</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Acciones</label>
                                                </div>
                                            </div>
                                            <div id="person-types-list"></div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary mt-2" id="add-person-type"><i class="fas fa-plus me-1"></i> Añadir Tipo de Persona</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sección de Precio Extra -->
                                        <div class="row mb-3 mt-4">
                                            <div class="col-12">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="enable_extra_price" id="enable_extra_price" <?= isset($tourMeta['enable_extra_price']) && $tourMeta['enable_extra_price'] ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="enable_extra_price">Habilitar precio extra</label>
                                                </div>
                                                <input type="hidden" name="extra_price" id="extra-price-json">
                                            </div>
                                        </div>

                                        <div id="extra-price-section" style="display: <?= isset($tourMeta['enable_extra_price']) && $tourMeta['enable_extra_price'] ? 'block' : 'none' ?>;">
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label class="form-label">Nombre</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Precio</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Tipo</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Acciones</label>
                                                </div>
                                            </div>
                                            <div id="extra-price-list"></div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-info mt-2" id="add-extra-price"><i class="fas fa-plus me-1"></i> Añadir item</button>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sección de Descuento por Número de Personas -->
                                        <div class="row mb-3 mt-4">
                                            <div class="col-12">
                                                <h5>Descuento por número de personas</h5>
                                                <input type="hidden" name="discount_by_people" id="discount-by-people-json">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <label class="form-label">A partir de</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Descuento</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Tipo</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Acciones</label>
                                            </div>
                                        </div>
                                        <div id="discount-by-people-list"></div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-info mt-2" id="add-discount-by-people"><i class="fas fa-plus me-1"></i> Añadir item</button>
                                            </div>
                                        </div>

                                        <!-- Sección de Service Fee -->
                                        <div class="row mb-3 mt-4">
                                            <div class="col-12">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="enable_service_fee" id="enable_service_fee" <?= isset($tourMeta['enable_service_fee']) && $tourMeta['enable_service_fee'] ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="enable_service_fee">Habilitar tarifa de servicio</label>
                                                    <small class="form-text text-muted">Este fee es solo para el propietario y no afecta los cálculos de revendedores y vendedores.</small>
                                                </div>
                                                <input type="hidden" name="service_fees" id="service-fees-json">
                                            </div>
                                        </div>

                                        <div id="service-fee-section" style="display: <?= isset($tourMeta['enable_service_fee']) && $tourMeta['enable_service_fee'] ? 'block' : 'none' ?>;">
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label class="form-label">Nombre</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Precio</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Tipo</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Acciones</label>
                                                </div>
                                            </div>
                                            <div id="service-fee-list"></div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-info mt-2" id="add-service-fee"><i class="fas fa-plus me-1"></i> Añadir item</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pestaña Galería -->
                                    <div class="tab-pane fade" id="gallery" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Imagen Principal</label>
                                                    <input type="file" name="image" class="form-control" accept="image/*">
                                                    <?php if ($tour['image_id']): ?>
                                                        <p>Imagen actual: <a href="<?= base_url('uploads/' . $tour['image_id']) ?>" target="_blank">Ver imagen</a></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Imagen del Banner</label>
                                                    <input type="file" name="banner_image" class="form-control" accept="image/*">
                                                    <?php if ($tour['banner_image_id']): ?>
                                                        <p>Imagen actual: <a href="<?= base_url('uploads/' . $tour['banner_image_id']) ?>" target="_blank">Ver imagen</a></p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Galería</label>
                                                    <div class="row">
                                                        <?php $gallery = json_decode($tour['gallery'], true) ?? []; ?>
                                                        <?php if (!empty($gallery)): ?>
                                                            <div class="mt-2">
                                                                <p>Imágenes actuales:</p>
                                                                <?php foreach ($gallery as $index => $image): ?>
                                                                    <div class="col-md-3 mb-3 d-inline-block">
                                                                        <img src="<?= base_url('uploads/' . $image) ?>" alt="Gallery Image" style="width: 100px; height: 100px; object-fit: cover;">
                                                                        <a href="<?= base_url('admin/tours/delete-image/' . $tour['id'] . '/' . $index) ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('¿Estás seguro de que deseas eliminar esta imagen?')">Eliminar</a>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <!-- Campo original para subir nuevas imágenes al guardar el formulario -->
                                                    <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pestaña Ubicación -->
                                    <div class="tab-pane fade" id="location" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Ubicación</label>
                                                    <select name="location_id" class="form-control">
                                                        <option value="">Selecciona una ubicación</option>
                                                        <?php foreach ($locations as $location): ?>
                                                            <option value="<?= esc($location['id']) ?>" <?= $tour['location_id'] == $location['id'] ? 'selected' : '' ?>><?= esc($location['name']) ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Dirección</label>
                                                    <input type="text" name="address" class="form-control" value="<?= esc($tour['address']) ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Latitud</label>
                                                    <input type="text" name="map_lat" id="map-lat" class="form-control" value="<?= esc($tour['map_lat']) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Longitud</label>
                                                    <input type="text" name="map_lng" id="map-lng" class="form-control" value="<?= esc($tour['map_lng']) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Zoom del Mapa</label>
                                                    <input type="number" name="map_zoom" id="map-zoom" class="form-control" value="<?= esc($tour['map_zoom']) ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div id="map" style="height: 400px; width: 100%;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pestaña Preguntas Frecuentes -->
                                    <div class="tab-pane fade" id="faqs" role="tabpanel">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <h5>Preguntas Frecuentes</h5>
                                                <input type="hidden" name="faqs" id="faqs-json">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-5">
                                                <label class="form-label">Título</label>
                                            </div>
                                            <div class="col-md-5">
                                                <label class="form-label">Contenido</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Acciones</label>
                                            </div>
                                        </div>
                                        <div id="faq-list"></div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary mt-2" id="add-faq"><i class="fas fa-plus me-1"></i> Añadir Pregunta</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pestaña Disponibilidad -->
                                    <div class="tab-pane fade" id="availability" role="tabpanel">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <h5>Disponibilidad</h5>
                                                <a href="<?= base_url('admin/tours/availability/' . $tour['id']) ?>" class="btn btn-info btn-sm mb-3">Gestionar Disponibilidad</a>
                                                <input type="hidden" name="availability" id="availability-json">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <label class="form-label">Fecha de Inicio</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Fecha de Fin</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label">Precio</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label">Mínimo de Huéspedes</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label">Máximo de Personas</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label">Nota al Cliente</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label">Nota al Admin</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label">Reserva Instantánea</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label">Disponible</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label">Acciones</label>
                                            </div>
                                        </div>
                                        <div id="availability-list"></div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary mt-2" id="add-availability"><i class="fas fa-plus me-1"></i> Añadir Disponibilidad</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pestaña Términos/Atributos -->
                                    <div class="tab-pane fade" id="terms" role="tabpanel">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <h5>Términos y Atributos</h5>
                                                <p class="text-muted">Selecciona los términos y atributos asociados a este tour.</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <?php if (!empty($terms)): ?>
                                                        <?php foreach ($terms as $term): ?>
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" name="terms[]" value="<?= esc($term['id']) ?>" id="term-<?= esc($term['id']) ?>" <?= in_array($term['id'], $selectedTerms) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="term-<?= esc($term['id']) ?>">
                                                                    <?= esc($term['name']) ?> (Atributo: <?= esc($term['attr_name']) ?>)
                                                                </label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <p>No hay términos disponibles.</p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pestaña Configuraciones -->
                                    <div class="tab-pane fade" id="settings" role="tabpanel">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <h5>Configuraciones del Tour</h5>
                                            </div>
                                        </div>

                                        <!-- Estado por Defecto -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Estado por Defecto</label>
                                                    <select name="default_state" class="form-control">
                                                        <option value="0" <?= $tour['default_state'] == 0 ? 'selected' : '' ?>>No</option>
                                                        <option value="1" <?= $tour['default_state'] == 1 ? 'selected' : '' ?>>Sí</option>
                                                    </select>
                                                    <small class="form-text text-muted">Indica si el tour estará disponible por defecto.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Fechas Fijas -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="enable_fixed_date" id="enable_fixed_date" <?= $tour['enable_fixed_date'] ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="enable_fixed_date">Habilitar fechas fijas</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="fixed-date-section" style="display: <?= $tour['enable_fixed_date'] ? 'block' : 'none' ?>;">
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Fecha de Inicio</label>
                                                        <input type="date" name="start_date" class="form-control" value="<?= esc($tour['start_date']) ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Fecha de Fin</label>
                                                        <input type="date" name="end_date" class="form-control" value="<?= esc($tour['end_date']) ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Última Fecha de Reserva</label>
                                                        <input type="date" name="last_booking_date" class="form-control" value="<?= esc($tour['last_booking_date']) ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- iCal Import URL -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">URL de Importación de iCal</label>
                                                    <input type="text" name="ical_import_url" class="form-control" value="<?= esc($tour['ical_import_url']) ?>" placeholder="https://...">
                                                    <small class="form-text text-muted">Proporciona una URL de iCal para sincronizar la disponibilidad.</small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Configuraciones de Reserva -->
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tipo de Reserva</label>
                                                    <select name="booking_type" class="form-control">
                                                        <option value="standard" <?= $tour['booking_type'] == 'standard' ? 'selected' : '' ?>>Estándar</option>
                                                        <option value="instant" <?= $tour['booking_type'] == 'instant' ? 'selected' : '' ?>>Instantánea</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tipo de Límite</label>
                                                    <select name="limit_type" class="form-control">
                                                        <option value="none" <?= $tour['limit_type'] == 'none' ? 'selected' : '' ?>>Ninguno</option>
                                                        <option value="daily" <?= $tour['limit_type'] == 'daily' ? 'selected' : '' ?>>Diario</option>
                                                        <option value="weekly" <?= $tour['limit_type'] == 'weekly' ? 'selected' : '' ?>>Semanal</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tipo de Capacidad</label>
                                                    <select name="capacity_type" class="form-control">
                                                        <option value="per_tour" <?= $tour['capacity_type'] == 'per_tour' ? 'selected' : '' ?>>Por Tour</option>
                                                        <option value="per_day" <?= $tour['capacity_type'] == 'per_day' ? 'selected' : '' ?>>Por Día</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Sección de Capacidad -->
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <h5>Capacidad</h5>
                                                <input type="hidden" name="capacity" id="capacity-json">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Día</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Capacidad</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Acciones</label>
                                            </div>
                                        </div>
                                        <div id="capacity-list"></div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="button" class="btn btn-primary mt-2" id="add-capacity"><i class="fas fa-plus me-1"></i> Añadir Capacidad</button>
                                            </div>
                                        </div>

                                        <!-- Configuraciones de Pase -->
                                        <div class="row mb-3 mt-4">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Tipo de Expiración del Pase</label>
                                                    <select name="pass_exprire_type" class="form-control">
                                                        <option value="none" <?= $tour['pass_exprire_type'] == 'none' ? 'selected' : '' ?>>Ninguno</option>
                                                        <option value="fixed" <?= $tour['pass_exprire_type'] == 'fixed' ? 'selected' : '' ?>>Fecha Fija</option>
                                                        <option value="duration" <?= $tour['pass_exprire_type'] == 'duration' ? 'selected' : '' ?>>Duración</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="pass-expire-at-section" style="display: <?= $tour['pass_exprire_type'] == 'fixed' ? 'block' : 'none' ?>;">
                                                <div class="form-group">
                                                    <label class="form-label">Fecha de Expiración del Pase</label>
                                                    <input type="date" name="pass_exprire_at" class="form-control" value="<?= esc($tour['pass_exprire_at']) ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="pass-valid-for-section" style="display: <?= $tour['pass_exprire_type'] == 'duration' ? 'block' : 'none' ?>;">
                                                <div class="form-group">
                                                    <label class="form-label">Pase Válido Durante (días)</label>
                                                    <input type="number" name="pass_valid_for" class="form-control" min="1" value="<?= esc($tour['pass_valid_for']) ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Configuraciones de Selección de Fecha -->
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Tipo de Selección de Fecha</label>
                                                    <select name="date_select_type" class="form-control">
                                                        <option value="single" <?= $tour['date_select_type'] == 'single' ? 'selected' : '' ?>>Fecha Única</option>
                                                        <option value="range" <?= $tour['date_select_type'] == 'range' ? 'selected' : '' ?>>Rango de Fechas</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Días Mínimos Antes de la Reserva</label>
                                                    <input type="number" name="min_day_before_booking" class="form-control" min="0" value="<?= esc($tour['min_day_before_booking']) ?>">
                                                    <small class="form-text text-muted">Número mínimo de días antes de que se pueda hacer una reserva.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pestaña Traducciones -->
                                    <div class="tab-pane fade" id="translations" role="tabpanel">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <h5>Traducciones</h5>
                                                <p class="text-muted">Añade o edita traducciones para el tour en diferentes idiomas.</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-primary" id="add-translation"><i class="fas fa-plus me-1"></i> Añadir Traducción</button>
                                            </div>
                                        </div>
                                        <div id="translation-list"></div>
                                    </div>

                                    <!-- Pestaña Datos Relacionados -->
                                    <div class="tab-pane fade" id="related-data" role="tabpanel">
                                        <div class="row mb-3">
                                            <div class="col-12">
                                                <h5>Datos Relacionados</h5>
                                            </div>
                                        </div>

                                        <!-- Reservas -->
                                        <h6 class="mt-4 mb-3">Reservas Asociadas</h6>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Fecha de Inicio</th>
                                                    <th>Fecha de Fin</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($bookings)): ?>
                                                    <tr>
                                                        <td colspan="4" class="text-center">No hay reservas asociadas.</td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($bookings as $booking): ?>
                                                        <tr>
                                                            <td>#BK-<?= esc($booking['id']) ?></td>
                                                            <td><?= esc($booking['start_date']) ?></td>
                                                            <td><?= esc($booking['end_date']) ?></td>
                                                            <td>$<?= number_format($booking['total'], 2) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>

                                        <!-- Reseñas -->
                                        <h6 class="mt-4 mb-3">Reseñas Asociadas</h6>
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Título</th>
                                                    <th>Puntuación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($reviews)): ?>
                                                    <tr>
                                                        <td colspan="3" class="text-center">No hay reseñas asociadas.</td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($reviews as $review): ?>
                                                        <tr>
                                                            <td>#RV-<?= esc($review['id']) ?></td>
                                                            <td><?= esc($review['title']) ?></td>
                                                            <td><?= esc($review['rate_number']) ?>/5</td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>

                                        <!-- Lista de Deseos -->
                                        <h6 class="mt-4 mb-3">Estado en Lista de Deseos</h6>
                                        <p>Este tour está en la lista de deseos del usuario actual: <strong><?= $isInWishlist ? 'Sí' : 'No' ?></strong></p>
                                    </div>

                                    <!-- Pestaña SEO -->
                                    <div class="tab-pane fade" id="seo" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Título SEO</label>
                                                    <input type="text" name="seo_title" class="form-control" value="<?= esc($tour['seo_title'] ?? '') ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mb-3">
                                                    <label class="form-label">Descripción SEO</label>
                                                    <textarea name="seo_description" class="form-control" rows="3"><?= esc($tour['seo_description'] ?? '') ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success mt-3">Guardar Cambios</button>
                            </form>

                            <!-- Formulario Independiente para Subir Imágenes a la Galería -->
                            <form action="<?= base_url('admin/tours/upload-image/' . $tour['id']) ?>" method="post" enctype="multipart/form-data" class="mt-3" id="gallery-upload-form">
                                <div class="form-group">
                                    <label for="gallery-upload">Subir Nueva Imagen a la Galería</label>
                                    <input type="file" name="image" id="gallery-upload" class="form-control" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Subir Imagen</button>
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
    // Inicializar el mapa con la ubicación actual del tour
    const map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: parseFloat("<?= $tour['map_lat'] ?: 40.7128 ?>"), lng: parseFloat("<?= $tour['map_lng'] ?: -74.0060 ?>") },
        zoom: parseInt("<?= $tour['map_zoom'] ?: 8 ?>")
    });

    let marker;

    // Si hay una ubicación existente, colocar un marcador
    if ("<?= $tour['map_lat'] ?>" && "<?= $tour['map_lng'] ?>") {
        marker = new google.maps.Marker({
            position: { lat: parseFloat("<?= $tour['map_lat'] ?>"), lng: parseFloat("<?= $tour['map_lng'] ?>") },
            map: map
        });
    }

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

    // Inicializar inclusiones
    const includes = <?= json_encode(json_decode($tour['include'] ?? '[]', true) ?: []) ?>;
    console.log('Inclusiones cargadas desde la base de datos:', includes);
    if (includes && includes.length > 0) {
        includes.forEach((include, index) => {
            const includeHtml = `
                <div class="row mb-3 include-item" data-id="${index}">
                    <div class="col-md-10">
                        <div class="form-group">
                            <input type="text" class="form-control include-text" placeholder="Inclusión" value="${include.item || ''}">
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
            includeCounter = index + 1;
        });
    }

    // Inicializar exclusiones
    const excludes = <?= json_encode(json_decode($tour['exclude'] ?? '[]', true) ?: []) ?>;
    console.log('Exclusiones cargadas desde la base de datos:', excludes);
    if (excludes && excludes.length > 0) {
        excludes.forEach((exclude, index) => {
            const excludeHtml = `
                <div class="row mb-3 exclude-item" data-id="${index}">
                    <div class="col-md-10">
                        <div class="form-group">
                            <input type="text" class="form-control exclude-text" placeholder="Exclusión" value="${exclude.item || ''}">
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
            excludeCounter = index + 1;
        });
    }

    // Inicializar itinerario
    const itinerary = <?= json_encode(json_decode($tour['itinerary'] ?? '[]', true) ?: []) ?>;
    console.log('Itinerario cargado desde la base de datos:', itinerary);
    if (itinerary && itinerary.length > 0) {
        itinerary.forEach((item, index) => {
            const itineraryHtml = `
                <div class="row mb-3 itinerary-item" data-id="${index}">
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control itinerary-title" placeholder="Título" value="${item.title || ''}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control itinerary-location" placeholder="Ubicación" value="${item.location || ''}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <textarea class="form-control itinerary-comment" rows="2" placeholder="Comentario">${item.comment || ''}</textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="file" class="form-control itinerary-photo" name="itinerary_photos[${index}]" accept="image/*">
                            ${item.photo ? `<p>Imagen actual: <a href="${'<?= base_url('uploads/') ?>' + item.photo}" target="_blank">Ver imagen</a></p>` : ''}
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
            itineraryCounter = index + 1;
        });
    }

    // Inicializar FAQs
    const faqs = <?= json_encode(json_decode($tour['faqs'] ?? '[]', true) ?: []) ?>;
    console.log('FAQs cargadas desde la base de datos:', faqs);
    if (faqs && faqs.length > 0) {
        faqs.forEach((faq, index) => {
            const faqHtml = `
                <div class="row mb-3 faq-item" data-id="${index}">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control faq-question" placeholder="Título de la pregunta" value="${faq.question || ''}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <textarea class="form-control faq-answer" rows="2" placeholder="Respuesta">${faq.answer || ''}</textarea>
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
            faqCounter = index + 1;
        });
    }

    // Inicializar Tipos de Persona
    const personTypes = <?= json_encode(json_decode($tourMeta['person_types'] ?? '[]', true) ?: []) ?>;
    console.log('Tipos de persona cargados desde la base de datos:', personTypes);
    if (personTypes && personTypes.length > 0) {
        personTypes.forEach((type, index) => {
            const personTypeHtml = `
                <div class="row mb-3 person-type-item" data-id="${index}">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control person-type-text" placeholder="Tipo de Persona" value="${type.type || ''}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" class="form-control person-type-min" placeholder="Mínimo" min="1" value="${type.min || ''}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" class="form-control person-type-max" placeholder="Máximo" min="1" value="${type.max || ''}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" class="form-control person-type-price" placeholder="Precio" step="0.01" value="${type.price || ''}">
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
            personTypeCounter = index + 1;
        });
    }

    // Inicializar Precios Extra
    const extraPrices = <?= json_encode(json_decode($tourMeta['extra_price'] ?? '[]', true) ?: []) ?>;
    console.log('Precios extra cargados desde la base de datos:', extraPrices);
    if (extraPrices && extraPrices.length > 0) {
        extraPrices.forEach((price, index) => {
            const extraPriceHtml = `
                <div class="row mb-3 extra-price-item" data-id="${index}">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control extra-price-name" placeholder="Nombre" value="${price.name || ''}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="number" class="form-control extra-price-amount" placeholder="Precio" step="0.01" value="${price.amount || ''}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control extra-price-type">
                                <option value="once" ${price.type === 'once' ? 'selected' : ''}>Una sola vez</option>
                                <option value="per_person" ${price.type === 'per_person' ? 'selected' : ''}>Precio por persona</option>
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
            extraPriceCounter = index + 1;
        });
    }

    // Inicializar Descuentos por Número de Personas
    const discountByPeople = <?= json_encode(json_decode($tourMeta['discount_by_people'] ?? '[]', true) ?: []) ?>;
    console.log('Descuentos por número de personas cargados desde la base de datos:', discountByPeople);
    if (discountByPeople && discountByPeople.length > 0) {
        discountByPeople.forEach((discount, index) => {
            const discountHtml = `
                <div class="row mb-3 discount-item" data-id="${index}">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="number" class="form-control discount-from" placeholder="A partir de" min="1" value="${discount.from || ''}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="number" class="form-control discount-amount" placeholder="Descuento" step="0.01" value="${discount.amount || ''}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control discount-type">
                                <option value="percentage" ${discount.type === 'percentage' ? 'selected' : ''}>Porcentaje (%)</option>
                                <option value="fixed" ${discount.type === 'fixed' ? 'selected' : ''}>Fijo</option>
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
            discountCounter = index + 1;
        });
    }

    // Inicializar Service Fees
    const serviceFees = <?= json_encode(json_decode($tourMeta['service_fees'] ?? '[]', true) ?: []) ?>;
    console.log('Service Fees cargados desde la base de datos:', serviceFees);
    if (serviceFees && serviceFees.length > 0) {
        serviceFees.forEach((fee, index) => {
            const serviceFeeHtml = `
                <div class="row mb-3 service-fee-item" data-id="${index}">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control service-fee-name" placeholder="Nombre" value="${fee.name || ''}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="number" class="form-control service-fee-amount" placeholder="Precio" step="0.01" value="${fee.amount || ''}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control service-fee-type">
                                <option value="percentage" ${fee.type === 'percentage' ? 'selected' : ''}>Porcentaje (%)</option>
                                <option value="fixed" ${fee.type === 'fixed' ? 'selected' : ''}>Fijo</option>
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
            serviceFeeCounter = index + 1;
        });
    }

    // Inicializar disponibilidad
    const availabilityData = <?= json_encode($availabilityData ?? []) ?>;
    console.log('Disponibilidad cargada desde la base de datos:', availabilityData);
    if (availabilityData && availabilityData.length > 0) {
        availabilityData.forEach((item, index) => {
            const availabilityHtml = `
                <div class="row mb-3 availability-item" data-id="${index}">
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" class="form-control availability-start-date" value="${item.start_date || ''}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="date" class="form-control availability-end-date" value="${item.end_date || ''}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="number" class="form-control availability-price" placeholder="Precio" step="0.01" value="${item.price || ''}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="number" class="form-control availability-min-guests" placeholder="Mínimo" min="1" value="${item.min_guests || ''}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="number" class="form-control availability-max-people" placeholder="Máximo" min="1" value="${item.max_people || ''}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="text" class="form-control availability-note-to-customer" placeholder="Nota al Cliente" value="${item.note_to_customer || ''}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="text" class="form-control availability-note-to-admin" placeholder="Nota al Admin" value="${item.note_to_admin || ''}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="checkbox" class="form-check-input availability-is-instant" ${item.is_instant ? 'checked' : ''}>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="checkbox" class="form-check-input availability-is-available" ${item.is_available ? 'checked' : ''}>
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
            availabilityCounter = index + 1;
        });
    }

    // Inicializar Alrededores
    const surrounding = <?= json_encode(json_decode($tour['surrounding'] ?? '[]', true) ?: []) ?>;
    console.log('Alrededores cargados desde la base de datos:', surrounding);
    if (surrounding && surrounding.length > 0) {
        surrounding.forEach((place, index) => {
            const surroundingHtml = `
                <div class="row mb-3 surrounding-item" data-id="${index}">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control surrounding-name" placeholder="Nombre del Lugar" value="${place.name || ''}">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="number" class="form-control surrounding-distance" placeholder="Distancia en km" step="0.01" min="0" value="${place.distance || ''}">
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
            surroundingCounter = index + 1;
        });
    }

    // Inicializar Capacidad
    const capacity = <?= json_encode(json_decode($tour['capacity'] ?? '[]', true) ?: []) ?>;
    console.log('Capacidad cargada desde la base de datos:', capacity);
    if (capacity && capacity.length > 0) {
        capacity.forEach((item, index) => {
            const capacityHtml = `
                <div class="row mb-3 capacity-item" data-id="${index}">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control capacity-day">
                                <option value="monday" ${item.day === 'monday' ? 'selected' : ''}>Lunes</option>
                                <option value="tuesday" ${item.day === 'tuesday' ? 'selected' : ''}>Martes</option>
                                <option value="wednesday" ${item.day === 'wednesday' ? 'selected' : ''}>Miércoles</option>
                                <option value="thursday" ${item.day === 'thursday' ? 'selected' : ''}>Jueves</option>
                                <option value="friday" ${item.day === 'friday' ? 'selected' : ''}>Viernes</option>
                                <option value="saturday" ${item.day === 'saturday' ? 'selected' : ''}>Sábado</option>
                                <option value="sunday" ${item.day === 'sunday' ? 'selected' : ''}>Domingo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="number" class="form-control capacity-amount" placeholder="Capacidad" min="1" value="${item.amount || ''}">
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
            capacityCounter = index + 1;
        });
    }

    // Inicializar Traducciones
    const translations = <?= json_encode($tourTranslations ?? []) ?>;
    console.log('Traducciones cargadas desde la base de datos:', translations);
    if (translations && translations.length > 0) {
        translations.forEach((translation, index) => {
            const translationHtml = `
                <div class="row mb-3 translation-item" data-id="${index}">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Idioma</label>
                            <select class="form-control translation-locale">
                                <option value="en" ${translation.locale === 'en' ? 'selected' : ''}>Inglés</option>
                                <option value="es" ${translation.locale === 'es' ? 'selected' : ''}>Español</option>
                                <option value="fr" ${translation.locale === 'fr' ? 'selected' : ''}>Francés</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Título</label>
                            <input type="text" class="form-control translation-title" placeholder="Título traducido" value="${translation.title || ''}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Contenido</label>
                            <textarea class="form-control translation-content" rows="2" placeholder="Contenido traducido">${translation.content || ''}</textarea>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label">Descripción Corta</label>
                            <textarea class="form-control translation-short-desc" rows="2" placeholder="Descripción corta traducida">${translation.short_desc || ''}</textarea>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-translation mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                        </a>
                    </div>
                </div>
            `;
            $('#translation-list').append(translationHtml);
            translationCounter = index + 1;
        });
    }

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
                    <a aria-label="anchor" class="btn btn-sm bg-danger-subtle remove-translation mb-3" data-bs-toggle="tooltip" data-bs-original-title="Eliminar">
                        <i class="mdi mdi-delete fs-14 text-danger"></i>
                    </a>
                </div>
            </div>
        `;
        $('#translation-list').append(translationHtml);
        translationCounter++;
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

    // Función para eliminar una traducción
    $(document).on('click', '.remove-translation', function() {
        $(this).closest('.translation-item').remove();
    });

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
                } else {
                    photoName = (itinerary[index] && itinerary[index].photo) || '';
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

    // Validación del formulario de subida de imágenes
    $('#gallery-upload-form').submit(function(event) {
        const fileInput = $('#gallery-upload')[0];
        if (!fileInput.files.length) {
            event.preventDefault();
            alert('Por favor, selecciona una imagen para subir.');
            return false;
        }
    });
});
</script>

<?= $this->endSection() ?>
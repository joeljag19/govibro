<?= $this->extend('layouts/main_dashboard') ?>

<?= $this->section('content') ?>

<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Detalles del Tour: <?= esc($tour['title']) ?></h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-primary">Dusty</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/tours') ?>">Tours</a></li>
                        <li class="breadcrumb-item active">Detalles</li>
                    </ol>
                </div>
            </div>

            <!-- Detalles del Tour -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Mensajes de Éxito o Error -->
                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->getFlashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            <?php endif; ?>

                            <h5 class="card-title mb-3">Información General</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Título:</strong> <?= esc($tour['title']) ?></p>
                                    <p><strong>Categoría:</strong> <?= esc($category) ?></p>
                                    <p><strong>Precio:</strong> $<?= number_format($tour['price'], 2) ?></p>
                                    <p><strong>Estado:</strong> 
                                        <span class="badge <?= $tour['status'] == 'published' ? 'bg-success' : 'bg-warning' ?>">
                                            <?= $tour['status'] == 'published' ? 'Publicado' : 'Borrador' ?>
                                        </span>
                                    </p>
                                    <p><strong>Estado de Aprobación:</strong> 
                                        <span class="badge <?= $tour['approval_status'] == 'approved' ? 'bg-success' : ($tour['approval_status'] == 'rejected' ? 'bg-danger' : 'bg-warning') ?>">
                                            <?= ucfirst($tour['approval_status']) ?>
                                        </span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Descripción Corta:</strong> <?= esc($tour['short_desc']) ?></p>
                                    <p><strong>Contenido:</strong> <?= esc($tour['content']) ?></p>
                                    <p><strong>Duración:</strong> <?= esc($tour['duration']) ?: 'No especificada' ?></p>
                                    <p><strong>Máximo de Personas:</strong> <?= esc($tour['max_people']) ?: 'No especificado' ?></p>
                                </div>
                            </div>

                            <h5 class="card-title mt-4 mb-3">Imágenes</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Imagen Principal:</strong> <?= esc($tour['image_id']) ?: 'No disponible' ?></p>
                                    <?php if ($tour['image_id']): ?>
                                        <img src="<?= base_url('uploads/' . $tour['image_id']) ?>" alt="Imagen Principal" class="img-thumbnail" style="max-width: 200px;">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Imagen de Banner:</strong> <?= esc($tour['banner_image_id']) ?: 'No disponible' ?></p>
                                    <?php if ($tour['banner_image_id']): ?>
                                        <img src="<?= base_url('uploads/' . $tour['banner_image_id']) ?>" alt="Imagen de Banner" class="img-thumbnail" style="max-width: 200px;">
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-4">
                                    <p><strong>Galería:</strong></p>
                                    <?php $gallery = json_decode($tour['gallery'], true) ?: []; ?>
                                    <?php if (!empty($gallery)): ?>
                                        <?php foreach ($gallery as $image): ?>
                                            <img src="<?= base_url('uploads/' . $image) ?>" alt="Galería" class="img-thumbnail mb-2" style="max-width: 100px;">
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>No hay imágenes en la galería.</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <h5 class="card-title mt-4 mb-3">Metadatos</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Tipos de Persona:</strong> <?= $tourMeta['enable_person_types'] ? 'Habilitado' : 'Deshabilitado' ?></p>
                                    <?php if ($tourMeta['enable_person_types']): ?>
                                        <pre><?= json_encode(json_decode($tourMeta['person_types'], true), JSON_PRETTY_PRINT) ?></pre>
                                    <?php endif; ?>
                                    <p><strong>Precio Extra:</strong> <?= $tourMeta['enable_extra_price'] ? 'Habilitado' : 'Deshabilitado' ?></p>
                                    <?php if ($tourMeta['enable_extra_price']): ?>
                                        <pre><?= json_encode(json_decode($tourMeta['extra_price'], true), JSON_PRETTY_PRINT) ?></pre>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Tarifas de Servicio:</strong> <?= $tourMeta['enable_service_fee'] ? 'Habilitado' : 'Deshabilitado' ?></p>
                                    <?php if ($tourMeta['enable_service_fee']): ?>
                                        <pre><?= json_encode(json_decode($tourMeta['service_fees'], true), JSON_PRETTY_PRINT) ?></pre>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <h5 class="card-title mt-4 mb-3">Disponibilidad</h5>
                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Máximo de Personas</th>
                                        <th>Disponible</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($availabilityData)): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No hay fechas de disponibilidad definidas.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($availabilityData as $avail): ?>
                                            <tr>
                                                <td><?= esc($avail['start_date']) ?></td>
                                                <td><?= esc($avail['end_date']) ?></td>
                                                <td><?= esc($avail['max_people']) ?: 'No especificado' ?></td>
                                                <td>
                                                    <span class="badge <?= $avail['is_available'] ? 'bg-success' : 'bg-warning' ?>">
                                                        <?= $avail['is_available'] ? 'Sí' : 'No' ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- Acciones -->
                            <div class="mt-4">
                                <a href="<?= base_url('admin/tours/approve/' . $tour['id']) ?>" class="btn btn-success" onclick="return confirm('¿Estás seguro de aprobar este tour?')">Aprobar</a>
                                <a href="<?= base_url('admin/tours/reject/' . $tour['id']) ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de rechazar este tour?')">Rechazar</a>
                                <a href="<?= base_url('admin/tours') ?>" class="btn btn-secondary">Volver a la Lista</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Detalles -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

<?= $this->endSection() ?>
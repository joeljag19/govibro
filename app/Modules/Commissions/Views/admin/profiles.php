<?php $this->extend('layouts/main_dashboard') ?>
<?php $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Perfiles de Comisiones</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Perfiles</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Listado de Perfiles</h5>
                                <a href="<?= base_url('commissions/admin/create-profile') ?>" class="btn btn-primary">Crear Nuevo Perfil</a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Rangos de Comisión</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($profiles)): ?>
                                            <tr>
                                                <td colspan="5" class="text-center">No hay perfiles de comisión definidos.</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($profiles as $profile): ?>
                                                <tr>
                                                    <td><?= esc($profile['id']) ?></td>
                                                    <td><?= esc($profile['name']) ?></td>
                                                    <td><?= esc($profile['description']) ?></td>
                                                    <td>
                                                        <?php if (!empty($profile['ranges'])): ?>
                                                            <?php foreach ($profile['ranges'] as $range): ?>
                                                                <div>
                                                                    Día <?= esc($range['start_day']) ?> - <?= esc($range['end_day'] ?? '∞') ?>: <strong><?= esc($range['reseller_share']) ?>%</strong>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <span class="text-muted">Sin rangos definidos</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('commissions/admin/edit-profile/' . $profile['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                                                        <a href="<?= base_url('commissions/admin/delete-profile/' . $profile['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este perfil?');">Eliminar</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endSection() ?>
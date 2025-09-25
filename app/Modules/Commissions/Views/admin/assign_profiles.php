<?php $this->extend('layouts/main_dashboard') ?>
<?php $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Asignar Perfiles de Comisiones</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Asignar Perfiles</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Perfil Actual</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($resellers)): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No hay revendedores.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($resellers as $reseller): ?>
                                            <tr>
                                                <td><?= esc($reseller['id']) ?></td>
                                                <td><?= esc($reseller['first_name'] . ' ' . $reseller['last_name']) ?></td>
                                                <td><?= esc($reseller['profile_name'] ?? 'Global') ?></td>
                                                <td>
                                                    <form action="<?= base_url('commissions/admin/assign-profile/' . $reseller['id']) ?>" method="post">
                                                        <select name="commission_profile_id" class="form-control d-inline-block w-auto">
                                                            <option value="">Global</option>
                                                            <?php foreach ($profiles as $profile): ?>
                                                                <option value="<?= esc($profile['id']) ?>" <?= $reseller['commission_profile_id'] === $profile['id'] ? 'selected' : '' ?>><?= esc($profile['name']) ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <button type="submit" class="btn btn-primary btn-sm">Asignar</button>
                                                    </form>
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
<?php $this->endSection() ?>
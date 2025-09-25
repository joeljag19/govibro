<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Gestión de Candidatos</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('commissions/admin/candidates') ?>">Comisiones</a></li>
                        <li class="breadcrumb-item active">Candidatos</li>
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

                            <!-- TABLA AÑADIDA: Candidatos a Dueños de Servicios -->
                            <h5 class="card-title mb-3">Candidatos a Dueños de Servicios</h5>
                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($ownerCandidates)): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No hay candidatos a dueños de servicios.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($ownerCandidates as $candidate): ?>
                                            <tr>
                                                <td><?= esc($candidate['id']) ?></td>
                                                <td><?= esc($candidate['name']) ?></td>
                                                <td><?= esc($candidate['email']) ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveOwnerModal<?= $candidate['id'] ?>">Aprobar</button>
                                                    <a href="<?= base_url('commissions/admin/reject-candidate/' . $candidate['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de rechazar a este candidato?')">Rechazar</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- TABLA DE CANDIDATOS A REVENDEDORES -->
                            <h5 class="card-title mt-4 mb-3">Candidatos a Revendedores</h5>
                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($resellerCandidates)): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No hay candidatos a revendedores.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($resellerCandidates as $candidate): ?>
                                            <tr>
                                                <td><?= esc($candidate['id']) ?></td>
                                                <td><?= esc($candidate['name']) ?></td>
                                                <td><?= esc($candidate['email']) ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveResellerModal<?= $candidate['id'] ?>">Aprobar</button>
                                                    <a href="<?= base_url('commissions/admin/reject-candidate/' . $candidate['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de rechazar a este candidato?')">Rechazar</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- TABLA DE CANDIDATOS A VENDEDORES -->
                            <h5 class="card-title mt-4 mb-3">Candidatos a Vendedores</h5>
                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($sellerCandidates)): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No hay candidatos a vendedores.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($sellerCandidates as $candidate): ?>
                                            <tr>
                                                <td><?= esc($candidate['id']) ?></td>
                                                <td><?= esc($candidate['name']) ?></td>
                                                <td><?= esc($candidate['email']) ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveSellerModal<?= $candidate['id'] ?>">Aprobar</button>
                                                    <a href="<?= base_url('commissions/admin/reject-candidate/' . $candidate['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de rechazar a este candidato?')">Rechazar</a>
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

<!-- Modal para aprobar revendedores -->
<?php if (!empty($resellerCandidates)): ?>
    <?php foreach ($resellerCandidates as $candidate): ?>
    <div class="modal fade" id="approveResellerModal<?= $candidate['id'] ?>" tabindex="-1" aria-labelledby="approveResellerModalLabel<?= $candidate['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveResellerModalLabel<?= $candidate['id'] ?>">Aprobar Revendedor: <?= esc($candidate['name']) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('commissions/admin/approve-candidate/' . $candidate['id'] . '/reseller') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="first_name_<?= $candidate['id'] ?>">Nombre</label>
                            <input type="text" class="form-control" id="first_name_<?= $candidate['id'] ?>" name="first_name" value="<?= esc(explode(' ', $candidate['name'])[0] ?? '') ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="last_name_<?= $candidate['id'] ?>">Apellido</label>
                            <input type="text" class="form-control" id="last_name_<?= $candidate['id'] ?>" name="last_name" value="<?= esc(explode(' ', $candidate['name'])[1] ?? '') ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address_<?= $candidate['id'] ?>">Dirección</label>
                            <textarea class="form-control" id="address_<?= $candidate['id'] ?>" name="address" rows="3"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone_<?= $candidate['id'] ?>">Teléfono</label>
                            <input type="text" class="form-control" id="phone_<?= $candidate['id'] ?>" name="phone">
                        </div>
                        <div class="form-group mb-3">
                            <label for="identity_document_<?= $candidate['id'] ?>">Documento de Identidad</label>
                            <input type="text" class="form-control" id="identity_document_<?= $candidate['id'] ?>" name="identity_document">
                        </div>
                        <div class="form-group mb-3">
                            <label for="max_sellers_<?= $candidate['id'] ?>">Límite de Vendedores</label>
                            <input type="number" class="form-control" id="max_sellers_<?= $candidate['id'] ?>" name="max_sellers" min="1" value="10" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="commission_profile_id_<?= $candidate['id'] ?>">Perfil de Comisión</label>
                            <select class="form-control" id="commission_profile_id_<?= $candidate['id'] ?>" name="commission_profile_id" required>
                                <option value="">Seleccione un perfil</option>
                                <?php if (!empty($profiles)): ?>
                                    <?php foreach ($profiles as $profile): ?>
                                        <option value="<?= esc($profile['id']) ?>"><?= esc($profile['name']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Aprobar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Modal para aprobar vendedores -->
<?php if (!empty($sellerCandidates)): ?>
    <?php foreach ($sellerCandidates as $candidate): ?>
    <div class="modal fade" id="approveSellerModal<?= $candidate['id'] ?>" tabindex="-1" aria-labelledby="approveSellerModalLabel<?= $candidate['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approveSellerModalLabel<?= $candidate['id'] ?>">Aprobar Vendedor: <?= esc($candidate['name']) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('commissions/admin/approve-candidate/' . $candidate['id'] . '/seller') ?>" method="post">
                     <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="first_name_<?= $candidate['id'] ?>">Nombre</label>
                            <input type="text" class="form-control" id="first_name_<?= $candidate['id'] ?>" name="first_name" value="<?= esc(explode(' ', $candidate['name'])[0] ?? '') ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="last_name_<?= $candidate['id'] ?>">Apellido</label>
                            <input type="text" class="form-control" id="last_name_<?= $candidate['id'] ?>" name="last_name" value="<?= esc(explode(' ', $candidate['name'])[1] ?? '') ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="address_<?= $candidate['id'] ?>">Dirección</label>
                            <textarea class="form-control" id="address_<?= $candidate['id'] ?>" name="address" rows="3"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone_<?= $candidate['id'] ?>">Teléfono</label>
                            <input type="text" class="form-control" id="phone_<?= $candidate['id'] ?>" name="phone">
                        </div>
                        <div class="form-group mb-3">
                            <label for="identity_document_<?= $candidate['id'] ?>">Documento de Identidad</label>
                            <input type="text" class="form-control" id="identity_document_<?= $candidate['id'] ?>" name="identity_document">
                        </div>
                        <div class="form-group mb-3">
                            <label for="reseller_id_<?= $candidate['id'] ?>">Asociar a Revendedor</label>
                            <select class="form-control" id="reseller_id_<?= $candidate['id'] ?>" name="reseller_id" required>
                                <option value="">Seleccione un revendedor</option>
                                <?php if (!empty($resellers)): ?>
                                    <?php foreach ($resellers as $reseller): ?>
                                        <option value="<?= esc($reseller['id']) ?>"><?= esc($reseller['first_name'] . ' ' . $reseller['last_name']) ?> (ID: <?= esc($reseller['id']) ?>)</option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="commission_percentage_<?= $candidate['id'] ?>">Porcentaje de Comisión (%)</label>
                            <input type="number" class="form-control" id="commission_percentage_<?= $candidate['id'] ?>" name="commission_percentage" min="0" max="100" step="0.01" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Aprobar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Modal para aprobar Dueños de Servicio -->
<?php if (!empty($ownerCandidates)): ?>
    <?php foreach ($ownerCandidates as $candidate): ?>
    <div class="modal fade" id="approveOwnerModal<?= $candidate['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aprobar Dueño de Servicio: <?= esc($candidate['name']) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('admin/users/approve-owner/' . $candidate['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="form-label">Comisión de la Plataforma (%)</label>
                            <input type="number" class="form-control" name="platform_commission_percentage" value="30.00" step="0.01" required>
                            <small class="form-text text-muted">Este es el porcentaje que GoVibro ganará de cada venta de este dueño.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Aprobar y Crear Perfil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>
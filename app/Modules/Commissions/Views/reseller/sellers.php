<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex justify-content-between align-items-center">
                <h4 class="fs-18 fw-semibold m-0">Mi Equipo de Vendedores</h4>
                <a href="<?= base_url('commissions/reseller/invitations') ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> Invitar Nuevo Vendedor
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Comisión Asignada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($sellers)): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            Aún no tienes vendedores en tu equipo. <a href="<?= base_url('commissions/reseller/invitations') ?>">¡Envía tu primera invitación!</a>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($sellers as $seller): ?>
                                        <tr>
                                            <td><?= esc($seller['user_name']) ?></td>
                                            <td><?= esc($seller['user_email']) ?></td>
                                            <td><?= esc($seller['phone'] ?? 'No especificado') ?></td>
                                            <td><strong><?= esc($seller['commission_share_percentage']) ?>%</strong></td>
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
<?= $this->endSection() ?>
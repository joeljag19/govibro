<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Reporte de Pago para: <?= esc($payee['user_name']) ?> (<?= ucfirst(esc($payee_type)) ?>)</h4>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Comisiones Pendientes</h5>
                            <p><strong>Período:</strong> <?= esc($start_date ?: 'Desde el inicio') ?> a <?= esc($end_date ?: 'Hasta hoy') ?></p>
                            <div class="table-responsive" style="max-height: 400px;">
                                <table class="table table-sm">
                                    <thead class="table-light">
                                        <tr><th>ID Venta</th><th>Fecha</th><th>Comisión Neta</th></tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($commissions)): ?>
                                            <tr><td colspan="3" class="text-center">No hay comisiones pendientes en este período.</td></tr>
                                        <?php else: ?>
                                            <?php foreach ($commissions as $commission): ?>
                                                <tr>
                                                    <td>#SALE-<?= esc($commission['id']) ?></td>
                                                    <td><?= esc($commission['sale_date']) ?></td>
                                                    <td>$<?= number_format($commission['commission_amount'], 2) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Confirmar Pago</h5>
                            <hr>
                            <div class="text-center">
                                <p class="text-muted mb-1">Monto Total a Pagar</p>
                                <h2 class="display-5 text-success">$<?= number_format($total_amount, 2) ?></h2>
                            </div>
                            <hr>
                            <form action="<?= base_url('payouts/admin/create') ?>" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="payee_user_id" value="<?= esc($payee['user_id']) ?>">
                                <input type="hidden" name="payee_role" value="<?= esc($payee_type) ?>">
                                <input type="hidden" name="amount" value="<?= esc($total_amount) ?>">
                                <?php foreach ($commissions as $commission): ?>
                                    <input type="hidden" name="sale_ids[]" value="<?= esc($commission['id']) ?>">
                                <?php endforeach; ?>

                                <div class="mb-3">
                                    <label class="form-label">Método de Pago</label>
                                    <input type="text" name="payment_method" class="form-control" placeholder="Ej: PayPal, Transferencia">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">ID de Transacción</label>
                                    <input type="text" name="transaction_id" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Notas del Administrador</label>
                                    <textarea name="admin_notes" class="form-control" rows="3"></textarea>
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success" <?= $total_amount > 0 ? '' : 'disabled' ?> onclick="return confirm('¿Confirmas que has realizado este pago? Esta acción marcará estas comisiones como pagadas y no se puede deshacer.')">
                                        Confirmar y Registrar Pago
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex justify-content-between align-items-center">
                <h4 class="fs-18 fw-semibold m-0">Historial de Pagos</h4>
                <a href="<?= base_url('payouts/admin') ?>" class="btn btn-outline-primary">Generar Nuevo Pago</a>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr><th>ID Pago</th><th>Beneficiario</th><th>Rol</th><th>Monto</th><th>Fecha</th><th>Método</th><th>ID Transacción</th></tr>
                        </thead>
                        <tbody>
                            <?php if (empty($payouts)): ?>
                                <tr><td colspan="7" class="text-center py-4">No se han registrado pagos.</td></tr>
                            <?php else: ?>
                                <?php foreach ($payouts as $payout): ?>
                                    <tr>
                                        <td>#PAY-<?= esc($payout['id']) ?></td>
                                        <td><?= esc($payout['payee_name']) ?></td>
                                        <td><span class="badge bg-info"><?= esc(ucfirst($payout['payee_role'])) ?></span></td>
                                        <td><strong>$<?= number_format($payout['amount'], 2) ?></strong></td>
                                        <td><?= esc($payout['payout_date']) ?></td>
                                        <td><?= esc($payout['payment_method']) ?></td>
                                        <td><?= esc($payout['transaction_id']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <?= $pager->links() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

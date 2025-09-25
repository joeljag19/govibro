<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Mi Historial de Pagos</h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Pago</th>
                                    <th>Fecha de Pago</th>
                                    <th>Monto</th>
                                    <th>Método</th>
                                    <th>ID Transacción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($payouts)): ?>
                                    <tr><td colspan="5" class="text-center py-4">Aún no has recibido ningún pago.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($payouts as $payout): ?>
                                        <tr>
                                            <td>#PAY-<?= esc($payout['id']) ?></td>
                                            <td><?= esc($payout['payout_date']) ?></td>
                                            <td><strong>$<?= number_format($payout['amount'], 2) ?></strong></td>
                                            <td><?= esc($payout['payment_method']) ?></td>
                                            <td><?= esc($payout['transaction_id']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <?= $pager->links() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
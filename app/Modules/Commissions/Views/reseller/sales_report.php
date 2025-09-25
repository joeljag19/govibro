<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Reporte de Ventas Detallado</h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Tour Vendido</th>
                                    <th>Venta Total</th>
                                    <th>Mi Comisión Bruta (Rango)</th>
                                    <th>Pagado a Vendedor</th>
                                    <th>Mi Ganancia Neta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($sales)): ?>
                                    <tr><td colspan="6" class="text-center py-4">No se han registrado ventas en tu red.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($sales as $sale): ?>
                                        <tr>
                                            <td><?= date('d/m/Y', strtotime($sale['created_at'])) ?></td>
                                            <td><?= esc($sale['tour_title']) ?></td>
                                            <td>$<?= number_format($sale['sale_amount'], 2) ?></td>
                                            <td>
                                                $<?= number_format($sale['reseller_share'], 2) ?>
                                                <br>
                                                <small class="text-muted"><?= esc($sale['commission_profile_range']) ?></small>
                                            </td>
                                            <td>
                                                $<?= number_format($sale['seller_commission'], 2) ?>
                                                <?php if($sale['seller_name']): ?>
                                                    <br>
                                                    <small class="text-muted">(<?= esc($sale['seller_name']) ?>)</small>
                                                <?php endif; ?>
                                            </td>
                                            <td><strong>$<?= number_format($sale['reseller_net_commission'], 2) ?></strong></td>
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

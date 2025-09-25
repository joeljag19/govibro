<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Reporte Maestro de Ventas</h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Venta ID</th>
                                    <th>Fecha</th>
                                    <th>Tour</th>
                                    <th>Venta Total</th>
                                    <th>Comision Total</th>
                                    <th>Dueño (Ganancia)</th>
                                    <th>Plataforma (Ganancia)</th>
                                    <th>Revendedor (Ganancia Neta)</th>
                                    <th>Vendedor (Ganancia)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($sales)): ?>
                                    <tr><td colspan="8" class="text-center py-4">No se han registrado ventas.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($sales as $sale): ?>
                                        <tr>
                                            <td><strong>#<?= esc($sale['id']) ?></strong></td>
                                            <td><?= date('d/m/Y', strtotime($sale['created_at'])) ?></td>
                                            <td><?= esc($sale['tour_title']) ?></td>
                                            <td>$<?= number_format($sale['sale_amount'], 2) ?></td>
                                            <td>$<?= number_format($sale['total_commission'], 2) ?></td>

                                            <td>
                                                $<?= number_format($sale['owner_earning'], 2) ?>
                                                <br><small class="text-muted"><?= esc($sale['owner_name']) ?></small>
                                            </td>
                                            <td class="text-success"><strong>$<?= number_format($sale['platform_commission'], 2) ?></strong></td>
                                            <td>
                                                $<?= number_format($sale['reseller_net_commission'], 2) ?>
                                                <?php if($sale['reseller_name']): ?>
                                                    <br><small class="text-muted"><?= esc($sale['reseller_name']) ?></small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                $<?= number_format($sale['seller_commission'], 2) ?>
                                                <?php if($sale['seller_name']): ?>
                                                    <br><small class="text-muted"><?= esc($sale['seller_name']) ?></small>
                                                <?php endif; ?>
                                            </td>
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

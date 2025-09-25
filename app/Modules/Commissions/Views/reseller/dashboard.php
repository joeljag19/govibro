<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Panel de Revendedor</h4>
            </div>
            
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Tus Ganancias Netas Totales</h5>
                            <h3 class="display-5 mt-2">$<?= number_format($earnings['total_earnings'] ?? 0, 2) ?></h3>
                            <p class="text-muted mb-0">De un total de <?= $earnings['total_sales'] ?? 0 ?> ventas atribuidas a tu red.</p>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="mt-4">Rendimiento de tus Vendedores</h5>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Vendedor</th>
                                    <th>Ventas Generadas</th>
                                    <th>Comisión Total Generada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($sellers_earnings)): ?>
                                    <tr><td colspan="3" class="text-center py-4">Tus vendedores aún no han generado ventas.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($sellers_earnings as $seller_earning): ?>
                                        <tr>
                                            <td><?= esc($seller_earning['seller_name']) ?></td>
                                            <td><?= esc($seller_earning['sales_count']) ?></td>
                                            <td>$<?= number_format($seller_earning['total_commission'], 2) ?></td>
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
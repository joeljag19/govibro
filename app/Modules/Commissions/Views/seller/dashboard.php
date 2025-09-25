<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Panel de Vendedor</h4>
            </div>
            
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-muted">Mis Ganancias Totales</h5>
                            <h3 class="display-5 mt-2">$<?= number_format($earnings['total_earnings'] ?? 0, 2) ?></h3>
                            <p class="text-muted mb-0">De un total de <?= $earnings['total_sales'] ?? 0 ?> ventas generadas.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="alert alert-info mt-3" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                Utiliza tu enlace de seguimiento desde la sección "Mis Enlaces" para asegurar que tus ventas se registren correctamente.
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
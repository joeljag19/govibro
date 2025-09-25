<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Dashboard de Administración</h4>
            </div>
            
            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title text-muted">Ingresos Brutos Totales</h5>
                            <h3 class="display-5 mt-2">$<?= number_format($summary['gross_revenue'] ?? 0, 2) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title text-muted">Pagado a Dueños</h5>
                            <h3 class="display-5 mt-2 text-info">-$<?= number_format($summary['total_paid_to_owners'] ?? 0, 2) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title text-muted">Pagado a Afiliados</h5>
                            <h3 class="display-5 mt-2 text-warning">-$<?= number_format($summary['total_paid_to_affiliates'] ?? 0, 2) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h5 class="card-title text-white-50">Ganancia Neta GoVibro</h5>
                            <h3 class="display-5 mt-2">$<?= number_format($summary['platform_net_profit'] ?? 0, 2) ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aquí se podrían añadir más gráficos o tablas de resumen en el futuro -->

        </div>
    </div>
</div>
<?= $this->endSection() ?>
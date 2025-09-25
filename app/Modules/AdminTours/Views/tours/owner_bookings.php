<?= $this->extend('layouts/main_dashboard') ?>

<?= $this->section('content') ?>

<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Mis Reservas</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);" class="text-primary">Dusty</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin Tours</a></li>
                        <li class="breadcrumb-item active">Mis Reservas</li>
                    </ol>
                </div>
            </div>

            <!-- Start Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Reservas</h5>
                                </div>
                            </div>

                            <?php if (session()->has('error')): ?>
                                <div class="alert alert-danger">
                                    <?= session('error') ?>
                                </div>
                            <?php endif; ?>
                            <?php if (session()->has('success')): ?>
                                <div class="alert alert-success">
                                    <?= session('success') ?>
                                </div>
                            <?php endif; ?>

                            <table class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tour</th>
                                        <th>Cliente</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Número de Personas</th>
                                        <th>Precio Total</th>
                                        <th>Estado</th>
                                        <th>Pago</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($bookings)): ?>
                                        <?php foreach ($bookings as $booking): ?>
                                            <tr>
                                                <td>#BK-<?= esc($booking['id']) ?></td>
                                                <td><?= esc($booking['tour_title']) ?></td>
                                                <td><?= esc($booking['customer_name']) ?> (<?= esc($booking['customer_email']) ?>)</td>
                                                <td><?= esc($booking['start_date']) ?></td>
                                                <td><?= esc($booking['end_date']) ?></td>
                                                <td><?= esc($booking['number_of_guests']) ?></td>
                                                <td>$<?= number_format($booking['total_price'], 2) ?></td>
                                                <td>
                                                    <span class="badge <?= $booking['status'] == 'confirmed' ? 'bg-success' : ($booking['status'] == 'pending' ? 'bg-warning' : 'bg-danger') ?>">
                                                        <?= ucfirst($booking['status']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge <?= $booking['payment_status'] == 'completed' ? 'bg-success' : ($booking['payment_status'] == 'pending' ? 'bg-warning' : 'bg-danger') ?>">
                                                        <?= ucfirst($booking['payment_status']) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" class="text-center">No hay reservas para tus tours.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Table -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

<?= $this->endSection() ?>
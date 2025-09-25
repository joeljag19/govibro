<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Detalles de la Reserva #<?= esc($booking['id']) ?></h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Información del Tour</h5>
                            <p><strong>Tour:</strong> <?= esc($booking['tour_title']) ?></p>
                            <p><strong>Dueño del Servicio:</strong> <?= esc($booking['owner_name']) ?></p>
                            <p><strong>Fechas:</strong> <?= date('d/m/Y', strtotime($booking['start_date'])) ?> al <?= date('d/m/Y', strtotime($booking['end_date'])) ?></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Información del Cliente</h5>
                            <p><strong>Nombre:</strong> <?= esc($booking['first_name'] . ' ' . $booking['last_name']) ?></p>
                            <p><strong>Email:</strong> <?= esc($booking['email']) ?></p>
                            <p><strong>Teléfono:</strong> <?= esc($booking['phone'] ?? 'No proporcionado') ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Detalles de la Reserva</h5>
                            <p><strong>Total de Personas:</strong> <?= esc($booking['total_guests']) ?></p>
                            <p><strong>Monto Total:</strong> $<?= number_format($booking['total'], 2) ?></p>
                            <p><strong>Estado:</strong> <span class="badge bg-success"><?= esc(ucfirst($booking['status'])) ?></span></p>
                        </div>
                        <div class="col-md-6">
                            <h5>Notas del Cliente</h5>
                            <p><?= esc($booking['customer_notes'] ?? 'Sin notas.') ?></p>
                        </div>
                    </div>
                    <hr>
                    <a href="<?= base_url('admin/bookings') ?>" class="btn btn-secondary">Volver a la Lista</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

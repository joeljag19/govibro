<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-body">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="75" height="75" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.06 1.06l2.75-2.75a.75.75 0 0 0-1.06-1.06L7.5 9.44 6.47 8.41a.75.75 0 0 0-1.06 1.06l1.56 1.56z"/>
                        </svg>
                    </div>
                    <h2 class="card-title">¡Reserva Confirmada!</h2>
                    <p class="card-text">Gracias, <?= esc($booking['first_name']) ?>. Tu reserva para el tour <strong>"<?= esc($tour['title']) ?>"</strong> ha sido realizada exitosamente.</p>
                    <p>Hemos enviado un correo de confirmación a <strong><?= esc($booking['email']) ?></strong> con todos los detalles.</p>

                    <div class="card mt-4">
                        <div class="card-header">
                            Resumen de tu Reserva
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>ID de Reserva:</span>
                                <strong>#<?= esc($booking['id']) ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tour:</span>
                                <strong><?= esc($tour['title']) ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Fecha:</span>
                                <strong><?= date('d/m/Y', strtotime($booking['start_date'])) ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Número de Personas:</span>
                                <strong><?= esc($booking['total_guests']) ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Monto Total:</span>
                                <strong>$<?= number_format($booking['total'], 2) ?></strong>
                            </li>
                        </ul>
                    </div>

                    <a href="<?= base_url('/tours') ?>" class="btn btn-primary mt-4">Ver más Tours</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

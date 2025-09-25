<?= $this->extend('layouts/main_dashboard') ?>

<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Perfil de Usuario</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Información del Usuario</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nombre:</strong> <?= esc($user['name']) ?></p>
                                    <p><strong>Email:</strong> <?= esc($user['email']) ?></p>
                                    <p><strong>Rol:</strong> <?= esc($user['role']) ?></p>
                                    <p><strong>Idioma:</strong> <?= esc($user['language'] ?? 'en') ?></p>
                                </div>
                            </div>

                            <!-- Reservas -->
                            <h5 class="card-title mt-4 mb-3">Reservas</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tour</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($bookings)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No hay reservas.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($bookings as $booking): ?>
                                            <tr>
                                                <td>#BK-<?= esc($booking['id']) ?></td>
                                                <td><?= esc($booking['object_id']) ?></td>
                                                <td><?= esc($booking['start_date']) ?></td>
                                                <td><?= esc($booking['end_date']) ?></td>
                                                <td>$<?= number_format($booking['total'], 2) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- Reseñas -->
                            <h5 class="card-title mt-4 mb-3">Reseñas</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tour</th>
                                        <th>Título</th>
                                        <th>Puntuación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($reviews)): ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No hay reseñas.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($reviews as $review): ?>
                                            <tr>
                                                <td>#RV-<?= esc($review['id']) ?></td>
                                                <td><?= esc($review['object_id']) ?></td>
                                                <td><?= esc($review['title']) ?></td>
                                                <td><?= esc($review['rate_number']) ?>/5</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                            <!-- Lista de Deseos -->
                            <h5 class="card-title mt-4 mb-3">Lista de Deseos</h5>
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tour</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($wishlist)): ?>
                                        <tr>
                                            <td colspan="2" class="text-center">No hay elementos en la lista de deseos.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($wishlist as $item): ?>
                                            <tr>
                                                <td>#WL-<?= esc($item['id']) ?></td>
                                                <td><?= esc($item['tour_title']) ?></td>
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
</div>
<?= $this->endSection() ?>
<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Gestión de Todas las Reservas</h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID Reserva</th>
                                    <th>Tour</th>
                                    <th>Cliente</th>
                                    <th>Dueño del Tour</th>
                                    <th>Fechas</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($bookings)): ?>
                                    <tr><td colspan="8" class="text-center py-4">No hay reservas en el sistema.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($bookings as $booking): ?>
                                        <tr>
                                            <td><strong>#<?= esc($booking['id']) ?></strong></td>
                                            <td><?= esc($booking['tour_title']) ?></td>
                                            <td><?= esc($booking['customer_name'] ?? 'N/A') ?></td>
                                            <td><?= esc($booking['owner_name'] ?? 'N/A') ?></td>
                                            <td><?= date('d/m/Y', strtotime($booking['start_date'])) ?></td>
                                            <td><strong>$<?= number_format($booking['total'], 2) ?></strong></td>
                                            <td><span class="badge bg-success"><?= esc(ucfirst($booking['status'])) ?></span></td>
                                            <td>
                                                <a href="<?= base_url('admin/bookings/view/' . $booking['id']) ?>" class="btn btn-sm btn-info">Ver Detalles</a>
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

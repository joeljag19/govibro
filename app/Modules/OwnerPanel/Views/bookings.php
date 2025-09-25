<?= $this->extend('layouts/main_dashboard') ?>
<?= $this->section('content') ?>
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="py-3">
                <h4 class="fs-18 fw-semibold m-0">Mis Reservas</h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Reserva ID</th>
                                    <th>Tour</th>
                                    <th>Cliente</th>
                                    <th>Fechas</th>
                                    <th>Personas</th>
                                    <th>Total</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($bookings)): ?>
                                    <tr><td colspan="8" class="text-center py-4">No tienes ninguna reserva.</td></tr>
                                <?php else: ?>
                                    <?php foreach ($bookings as $booking): ?>
                                        <tr>
                                            <td><strong>#<?= esc($booking['id']) ?></strong></td>
                                            <td><?= esc($booking['tour_title']) ?></td>
                                            <td>
                                                <div><?= esc($booking['first_name'] . ' ' . $booking['last_name']) ?></div>
                                                <small class="text-muted"><?= esc($booking['email']) ?></small>
                                            </td>
                                            <td><?= date('d/m/Y', strtotime($booking['start_date'])) ?></td>
                                            <td><?= esc($booking['total_guests']) ?></td>
                                            <td><strong>$<?= number_format($booking['total'], 2) ?></strong></td>
                                            <td><span class="badge bg-success"><?= esc(ucfirst($booking['status'])) ?></span></td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal" data-booking-id="<?= $booking['id'] ?>" data-customer-name="<?= esc($booking['first_name'] . ' ' . $booking['last_name']) ?>">
                                                    Contactar
                                                </button>
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

<!-- Modal para Contactar Cliente -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Enviar Mensaje a Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('owner/bookings/send-message') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" name="booking_id" id="modalBookingId">
                    <p>Enviando mensaje a: <strong id="modalCustomerName"></strong></p>
                    <div class="mb-3">
                        <label for="message" class="form-label">Tu Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('custom-scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const contactModal = document.getElementById('contactModal');
    contactModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const bookingId = button.getAttribute('data-booking-id');
        const customerName = button.getAttribute('data-customer-name');
        
        const modalTitle = contactModal.querySelector('.modal-title');
        const modalCustomerName = contactModal.querySelector('#modalCustomerName');
        const modalBookingIdInput = contactModal.querySelector('#modalBookingId');

        modalTitle.textContent = `Enviar Mensaje sobre Reserva #${bookingId}`;
        modalCustomerName.textContent = customerName;
        modalBookingIdInput.value = bookingId;
    });
});
</script>
<?= $this->endSection() ?>

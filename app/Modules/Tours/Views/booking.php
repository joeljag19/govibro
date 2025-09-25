<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
    <!-- CSS para flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <?php if (session()->has('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <h3 class="card-title text-center mb-4">Reservar Tour: <?= esc($tour['title']) ?></h3>

                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger"><?= session('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('tours/saveBooking/' . $tour['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <h5 class="mt-4">Detalles de la Reserva</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date">Fecha de Reserva</label>
                                <!-- Este input será mejorado por flatpickr -->
                                <input type="text" name="start_date" id="start_date" class="form-control" required placeholder="Selecciona una fecha...">
                                <input type="hidden" name="end_date" id="end_date">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="number_of_people">Número de Personas</label>
                                <input type="number" name="number_of_people" id="number_of_people" class="form-control" min="1" required>
                            </div>
                        </div>
                        <p><strong>Precio por Persona:</strong> $<?= number_format($tour['price'], 2) ?></p>
                        
                        <hr>
                        <h5 class="mt-4">Tus Datos</h5>
                        <div class="form-group mb-3">
                            <label for="customer_name">Nombre Completo</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="customer_email">Email</label>
                                <input type="email" name="customer_email" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="customer_phone">Teléfono</label>
                                <input type="tel" name="customer_phone" class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">Confirmar y Pagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('custom-scripts') ?>
<!-- JS para flatpickr -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtenemos la lista de fechas disponibles desde PHP
        const availableDates = <?= json_encode($availableDates) ?>;

        // Inicializamos flatpickr
        flatpickr("#start_date", {
            dateFormat: "Y-m-d",
            // La opción 'enable' es la clave: solo habilita las fechas en nuestro array
            enable: availableDates,
            // Opcional: deshabilita todas las demás fechas para que no se puedan clickear
            disable: [
                function(date) {
                    // Devuelve true si la fecha NO está en nuestra lista de disponibles
                    return !availableDates.includes(date.toISOString().substring(0, 10));
                }
            ],
            onChange: function(selectedDates, dateStr, instance) {
                // Sincronizamos la fecha de fin (para tours de un día)
                document.getElementById('end_date').value = dateStr;
            }
        });
    });
</script>
<?= $this->endSection() ?>

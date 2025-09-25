<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <div class="row">
        <!-- Columna Principal -->
        <div class="col-md-8">
            <h1><?= $service['title'] ?></h1>
            <img src="/path/to/image/<?= $service['image_id'] ?>" alt="Hotel Image" class="hotel-image mb-4">
            <h2>Descripción</h2>
            <p><?= $service['description'] ?></p>
            <h2>Highlights</h2>
            <ul>
                <li>Visita el Museo de Arte Moderno en Manhattan</li>
                <li>Explora obras contemporáneas, incluyendo "La Noche Estrellada" de Vincent van Gogh</li>
                <li>Disfruta de audioguías gratuitas en varios idiomas</li>
            </ul>
            <h2>Habitaciones Disponibles</h2>
            <div class="card p-3 mb-4">
                <form method="post" action="/sales/store">
                    <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Entrada</label>
                            <input type="date" name="check_in" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Salida</label>
                            <input type="date" name="check_out" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Huéspedes</label>
                            <div class="d-flex">
                                <select name="adults" class="form-control me-2">
                                    <option>1 Adulto</option>
                                    <option>2 Adultos</option>
                                    <option>3 Adultos</option>
                                </select>
                                <select name="children" class="form-control">
                                    <option>0 Niños</option>
                                    <option>1 Niño</option>
                                    <option>2 Niños</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Revisar Disponibilidad</button>
                </form>
            </div>
        </div>

        <!-- Columna Lateral -->
        <div class="col-md-4">
            <div class="sidebar">
                <h3>Property Type</h3>
                <p><?= $details['property_type'] ?></p>
                <h3>Facilities</h3>
                <ul>
                    <?php foreach (json_decode($details['facilities'], true) as $facility): ?>
                        <li><i class="fas fa-check-circle text-success"></i> <?= $facility ?></li>
                    <?php endforeach; ?>
                </ul>
                <h3>Hotel Services</h3>
                <ul>
                    <?php foreach (json_decode($details['hotel_services'], true) as $service): ?>
                        <li><i class="fas fa-check-circle text-success"></i> <?= $service ?></li>
                    <?php endforeach; ?>
                </ul>
                <h3>Hoteles Relacionados</h3>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Crown Plaza Hotel</h5>
                        <p class="card-text">$900/noche</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Ver Detalle</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
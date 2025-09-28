<?= $this->extend('layouts/mainlayout') ?>

<?= $this->section('title') ?>
<?= esc($tour['title']) ?>
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Slick CSS (para la galería) -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/slick/slick.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fancybox/jquery.fancybox.min.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Breadcrumb -->
<!-- <div class="breadcrumb-bar breadcrumb-bg-0 text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title mb-2">Detalles del Tour</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('/tours') ?>">Tours</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= esc($tour['title']) ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div> -->
<!-- /Breadcrumb -->

<div class="content">
    <div class="container">
        <?php if (session()->has('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                <?php foreach (session('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-xl-8">
                <!-- Slider de Galería -->
                <div>
                    <div class="service-wrap mb-4">
                        <div class="slider-wrap vertical-slider tour-vertical-slide d-flex align-items-center">

<?php
$all_images = [];
if (!empty($tour['image_id'])) {
    $all_images[] = $tour['image_id'];
}

// --- ¡ESTA ES LA CORRECCIÓN CLAVE! ---
// Nos aseguramos de que $gallery sea siempre un array.
$gallery = json_decode($tour['gallery'] ?? '[]', true);
if (!is_array($gallery)) {
    $gallery = []; // Si la decodificación falla, lo forzamos a ser un array vacío.
}

$all_images = array_merge($all_images, $gallery);
?>

<div class="slider-for nav-center" id="large-img">
    <?php if (!empty($all_images)): ?>
        <?php foreach ($all_images as $image): ?>
            <div class="service-img">
                <a href="<?= base_url('uploads/tours/' . $image) ?>" data-fancybox="gallery">
                    <img src="<?= base_url('uploads/tours/' . $image) ?>" class="img-fluid" alt="Gallery Image">
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <?php endif; ?>
</div>

<div class="slider-nav nav-center" id="small-img">
    <?php if (count($all_images) > 1): ?>
        <?php foreach ($all_images as $imageName): ?>
            <?php
            $thumbName = pathinfo($imageName, PATHINFO_FILENAME) . '_thumb.' . pathinfo($imageName, PATHINFO_EXTENSION);
            $thumbUrl = base_url('uploads/tours/' . $thumbName);
            ?>
            <div><img src="<?= $thumbUrl ?>" class="img-fluid" alt="Slider Thumb"></div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="mb-2">
                            <h4 class="mb-1 d-flex align-items-center flex-wrap mb-2"><?= esc($tour['title']) ?></h4>
                            <div class="d-flex align-items-center flex-wrap">
                                <p class="fs-14 mb-2 me-3 pe-3 border-end"><i class="isax isax-receipt text-primary me-2"></i><?= esc($tour['category_name']) ?></p>
                                <p class="fs-14 mb-2 me-3 pe-3 border-end"><i class="isax isax-location5 me-2"></i><?= esc($tour['location_name']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Slider -->

                <!-- Description -->
                <div class="bg-light-200 card-bg-light mb-4 p-4 rounded">
                    <h5 class="fs-18 mb-3">Descripción</h5>
                    <div class="mb-2">
                        <!-- <?= nl2br(esc($tour['content'])) ?> -->
                        <?= $tour['content'] ?>

                    </div>
                </div>
                <!-- /Description -->

                <!-- Itinerary -->
                <div class="bg-light-200 card-bg-light mb-4 p-4 rounded">
                    <h5 class="fs-18 mb-3">Itinerario</h5>
                    <?php $itinerary = json_decode($tour['itinerary'] ?? '[]', true); ?>
                    <?php if (!empty($itinerary)): ?>
                        <div class="stage-flow">
                            <?php foreach ($itinerary as $index => $item): ?>
                                <div class="d-flex align-items-center flows-step">
                                    <span class="flow-step"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></span>
                                    <div class="flow-content">
                                        <h6 class="fw-medium mb-1"><?= esc($item['title']) ?></h6>
                                        <p><?= esc($item['comment']) ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>No hay itinerario disponible.</p>
                    <?php endif; ?>
                </div>
                <!-- /Itinerary -->

                <!-- Includes & Excludes -->
                <div class="bg-light-200 card-bg-light mb-4 p-4 rounded">
                    <h5 class="fs-18 mb-3">Incluye y No Incluye</h5>
                    <div class="row gy-2">
                        <div class="col-md-6">
                            <?php $includes = json_decode($tour['include'] ?? '[]', true); ?>
                             <?php if(!empty($includes)): ?>
                                <?php foreach($includes as $item): ?>
                                    <p class="d-flex align-items-center mb-2"><i class="isax isax-tick-square5 text-success me-2"></i> <?= esc($item['item']) ?></p>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                             <?php $excludes = json_decode($tour['exclude'] ?? '[]', true); ?>
                             <?php if(!empty($excludes)): ?>
                                <?php foreach($excludes as $item): ?>
                                    <p class="d-flex align-items-center mb-2"><i class="isax isax-close-square5 text-danger me-2"></i> <?= esc($item['item']) ?></p>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- /Includes & Excludes -->
                
                <!-- CORRECCIÓN: Sección del Mapa Añadida -->
                <?php if (!empty($tour['map_lat']) && !empty($tour['map_lng'])): ?>
                    <div class="bg-light-200 card-bg-light mb-4 p-4 rounded" id="location">
                        <h5 class="fs-18 mb-3">Ubicación</h5>
                        <div>
                            <iframe 
                                width="100%" 
                                height="450" 
                                style="border:0; border-radius: 5px;" 
                                loading="lazy" 
                                allowfullscreen
                                src="https://maps.google.com/maps?q=<?= esc($tour['map_lat']) ?>,<?= esc($tour['map_lng']) ?>&z=<?= esc($tour['map_zoom'] ?? 14) ?>&output=embed">
                            </iframe>

                            <!-- <iframe
                            width="100%"
                            height="450"
                            style="border:0;"
                            loading="lazy"
                            allowfullscreen
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD6adZVdzTvBpE2yBRK8cDfsss8QXChK0I&q=<?= esc($tour['map_lat']) ?>,<?= esc($tour['map_lng']) ?>&zoom=<?= esc($tour['map_zoom'] ?? 14) ?>">
                        </iframe> -->
                        </div>
                    </div>
                <?php endif; ?>
                <!-- /CORRECCIÓN -->

                <!-- FAQ -->
                <div class="bg-light-200 card-bg-light mb-4 p-4 rounded">
                     <h5 class="fs-18 mb-3">Preguntas Frecuentes</h5>
                    <?php $faqs = json_decode($tour['faqs'] ?? '[]', true); ?>
                    <?php if(!empty($faqs)): ?>
                    <div class="accordion faq-accordion" id="accordionFaq">
                        <?php foreach($faqs as $index => $faq): ?>
                        <div class="accordion-item mb-2">
                            <div class="accordion-header">
                                <button class="accordion-button fw-medium <?= $index > 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faq-<?= $index ?>">
                                    <?= esc($faq['question']) ?>
                                </button>
                            </div>
                            <div id="faq-<?= $index ?>" class="accordion-collapse collapse <?= $index == 0 ? 'show' : '' ?>" data-bs-parent="#accordionFaq">
                                <div class="accordion-body"><p class="mb-0"><?= nl2br(esc($faq['answer'])) ?></p></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php else: ?>
                    <p>No hay preguntas frecuentes para este tour.</p>
                    <?php endif; ?>
                </div>
                <!-- /FAQ -->
            </div>

            <!-- Tour Sidebar -->
            <div class="col-xl-4 theiaStickySidebar">
                <div class="card bg-light-200">
                    <div class="card-body">
                        <h5 class="d-flex align-items-center fs-18 mb-3"><span class="avatar avatar-md rounded-circle bg-primary me-2"><i class="isax isax-signpost5"></i></span>Detalles del Tour</h5>
                        <div>
                            <div class="d-flex align-items-center justify-content-between details-info">
                                <h6 class="fw-medium">Duración</h6>
                                <p class="flex-fill"><?= esc($tour['duration']) ?> horas</p>
                            </div>
                             <!-- (Puedes añadir más detalles aquí en el futuro) -->
                        </div>
                    </div>
                </div>
                <div class="card shadow-none">
                    <div class="card-body">
                        <div class="mb-3">
                            <p class="fs-13 fw-medium mb-1">Desde</p>
                            <h5 class="text-primary mb-1">$<?= number_format($tour['price_base'], 2) ?> <span class="fs-14 text-default fw-normal">/ por persona</span></h5>
                        </div>
                        <div class="banner-form">
                            <form action="<?= base_url('tours/saveBooking/' . $tour['id']) ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-info border-0">
                                    <div class="form-item border rounded p-3 mb-3 w-100">
                                        <label class="form-label fs-14 text-default mb-0">Fecha</label>
                                        <input type="text" name="start_date" id="booking_date" class="form-control" placeholder="Selecciona una fecha" required>
                                        <input type="hidden" name="end_date" id="end_date">
                                    </div>
                                    <div class="form-item border rounded p-3 mb-3 w-100">
                                        <label class="form-label fs-14 text-default mb-0">Número de Personas</label>
                                        <input type="number" name="number_of_people" class="form-control" value="1" min="1" required>
                                    </div>
                                    <hr>
                                    <h6 class="mt-3">Tus Datos</h6>
                                    <div class="mb-3"><label class="form-label">Nombre Completo</label><input type="text" name="customer_name" class="form-control" required></div>
                                    <div class="mb-3"><label class="form-label">Email</label><input type="email" name="customer_email" class="form-control" required></div>
                                    <div class="mb-3"><label class="form-label">Teléfono</label><input type="tel" name="customer_phone" class="form-control"></div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg search-btn ms-0 w-100 fs-14">Reservar Ahora</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Tour Sidebar -->
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Slick Slider -->
<script src="<?= base_url('assets/plugins/slick/slick.min.js') ?>"></script>
<!-- FancyBox JS -->
<script src="<?= base_url('assets/plugins/fancybox/jquery.fancybox.min.js') ?>"></script>
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
$(document).ready(function() {

    // Inicializar Flatpickr
    const availableDates = <?= json_encode($availableDates) ?>;
    flatpickr("#booking_date", {
        enable: availableDates,
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
            document.getElementById('end_date').value = dateStr;
        }
    });
});
</script>
<?= $this->endSection() ?>
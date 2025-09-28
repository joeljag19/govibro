<?php if (empty($tours)): ?>
    <div class="col-12 text-center py-5">
        <p>No se encontraron tours con los filtros seleccionados.</p>
    </div>
<?php else: ?>
    <?php foreach ($tours as $tour): ?>
        
        <!-- CORRECCIÓN: Usando la estructura exacta de la plantilla -->
        <div class="col-xxl-4 col-md-6 d-flex">
            <div class="place-item mb-4 flex-fill">
                <div class="place-img">
                    <a href="<?= base_url('tours/' . $tour['slug']) ?>">
                        <img src="<?= $tour['image_id'] ? base_url('uploads/tours/' . $tour['image_id']) : 'https://via.placeholder.com/400x300.png?text=Tour' ?>" class="img-fluid" alt="<?= esc($tour['title']) ?>">
                    </a>
                    <!-- Aquí puedes añadir el carrusel de imágenes si lo necesitas -->
                </div>
                <div class="place-content">
                    <h5 class="mb-1 text-truncate"><a href="<?= base_url('tours/' . $tour['slug']) ?>"><?= esc($tour['title']) ?></a></h5>
                    <p class="d-flex align-items-center mb-3"><i class="isax isax-location5 me-2"></i><?= esc($tour['location_name']) ?></p>
                    <div class="d-flex align-items-center justify-content-between border-top pt-3">
                        <h6 class="d-flex align-items-center text-gray-6 fs-14 fw-normal">Desde <span class="ms-1 fs-18 fw-semibold text-primary">$<?= number_format($tour['price_base'], 2) ?></span></h6>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
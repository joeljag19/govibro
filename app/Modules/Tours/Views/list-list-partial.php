<?php if (empty($tours)): ?>
    <div class="col-12 text-center py-5"><p>No se encontraron tours con los filtros seleccionados.</p></div>
<?php else: ?>
    <?php foreach ($tours as $tour): ?>
        <div class="col-12 tour-item">
            <div class="place-item-list mb-4">
                <div class="row align-items-center">
                    <div class="col-lg-4 col-md-5">
                        <div class="place-img">
                            <a href="<?= base_url('tours/' . $tour['slug']) ?>">
                                <img src="<?= $tour['image_id'] ? base_url('uploads/tours/' . $tour['image_id']) : 'https://via.placeholder.com/400x300.png?text=Tour' ?>" class="img-fluid" alt="<?= esc($tour['title']) ?>">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="place-content">
                            <h5 class="mb-1 text-truncate"><a href="<?= base_url('tours/' . $tour['slug']) ?>"><?= esc($tour['title']) ?></a></h5>
                            <p class="d-flex align-items-center mb-2"><i class="isax isax-location5 me-2"></i><?= esc($tour['location_name'] ?? 'Sin Ubicación') ?></p>
                            <p class="fs-14 text-gray-6"><?= esc(word_limiter($tour['short_desc'], 20)) ?></p>
                            <div class="d-flex align-items-center justify-content-between border-top pt-3">
                                <h6 class="d-flex align-items-center text-gray-6 fs-14 fw-normal">Desde <span class="ms-1 fs-18 fw-semibold text-primary">$<?= number_format($tour['price'], 2) ?></span></h6>
                                <a href="<?= base_url('tours/' . $tour['slug']) ?>" class="btn btn-primary btn-sm">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

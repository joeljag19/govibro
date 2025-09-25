<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<div class="bravo_search_tour">
    <div class="bravo_banner" style="background-image: url('')">
        <div class="container">
            <h1>Buscar tours</h1>
        </div>
    </div>
    <div class="bravo_form_search">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <form action="<?= base_url('tour') ?>" class="form bravo_form" method="get">
                        <div class="g-field-search">
                            <div class="row">
                                <div class="col-md-6 border-right">
                                    <div class="form-group">
                                        <i class="field-icon fa icofont-map"></i>
                                        <div class="form-content">
                                            <label>Ubicación</label>
                                            <div class="smart-search">
                                                <input type="text" class="smart-search-location parent_text form-control" readonly placeholder="¿A dónde vas?" value="" data-onLoad="Cargando..." data-default='[]'>
                                                <input type="hidden" class="child_id" name="location_id" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 border-right">
                                    <div class="form-group">
                                        <i class="field-icon icofont-wall-clock"></i>
                                        <div class="form-content">
                                            <div class="form-date-search">
                                                <div class="date-wrapper">
                                                    <div class="check-in-wrapper">
                                                        <label>De - A</label>
                                                        <div class="render check-in-render"></div>
                                                        <span> - </span>
                                                        <div class="render check-out-render"></div>
                                                    </div>
                                                </div>
                                                <input type="hidden" class="check-in-input" name="start">
                                                <input type="hidden" class="check-out-input" name="end">
                                                <input type="text" class="check-in-out" name="date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="g-button-submit">
                            <button class="btn btn-primary btn-search" type="submit">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <div class="bravo_filter">
                    <form action="<?= base_url('tour') ?>" class="bravo_form_filter">
                        <div class="filter-title">FILTRADO POR</div>
                        <!-- Filtro: Precio -->
                        <div class="g-filter-item">
                            <div class="item-title">
                                <h3>Filtrar Precio</h3>
                                <i class="fa fa-angle-up" aria-hidden="true"></i>
                            </div>
                            <div class="item-content">
                                <div class="bravo-filter-price">
                                    <input type="hidden" class="filter-price irs-hidden-input" name="price_range"
                                        data-symbol="$"
                                        data-min="100"
                                        data-max="200"
                                        data-from="100"
                                        data-to="200"
                                        readonly="" value="">
                                    <button type="submit" class="btn btn-link btn-apply-price-range">APLICAR</button>
                                </div>
                            </div>
                        </div>
                        <!-- Filtro: Puntuación de la Reseña -->
                        <div class="g-filter-item">
                            <div class="item-title">
                                <h3>Puntuación de la Reseña</h3>
                                <i class="fa fa-angle-up" aria-hidden="true"></i>
                            </div>
                            <div class="item-content">
                                <ul>
                                    <li>
                                        <div class="bravo-checkbox">
                                            <label>
                                                <input name="review_score[]" type="checkbox" value="5">
                                                <span class="checkmark"></span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="bravo-checkbox">
                                            <label>
                                                <input name="review_score[]" type="checkbox" value="4">
                                                <span class="checkmark"></span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="bravo-checkbox">
                                            <label>
                                                <input name="review_score[]" type="checkbox" value="3">
                                                <span class="checkmark"></span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="bravo-checkbox">
                                            <label>
                                                <input name="review_score[]" type="checkbox" value="2">
                                                <span class="checkmark"></span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="bravo-checkbox">
                                            <label>
                                                <input name="review_score[]" type="checkbox" value="1">
                                                <span class="checkmark"></span>
                                                <i class="fa fa-star"></i>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Filtro: Duración -->
                        <div class="g-filter-item">
                            <div class="item-title">
                                <h3>Duración</h3>
                                <i class="fa fa-angle-up" aria-hidden="true"></i>
                            </div>
                            <div class="item-content">
                                <ul>
                                    <!-- Aquí irán las opciones de duración dinámicas -->
                                </ul>
                            </div>
                        </div>
                        <!-- Filtro: Estilo de Tour -->
                        <div class="g-filter-item">
                            <div class="item-title">
                                <h3>Estilo de Tour</h3>
                                <i class="fa fa-angle-up" aria-hidden="true"></i>
                            </div>
                            <div class="item-content">
                                <ul>
                                    <!-- Aquí irán las opciones de estilo de tour dinámicas -->
                                </ul>
                                <button type="button" class="btn btn-link btn-more-item">Más <i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                        <!-- Filtro: Travel Styles -->
                        <div class="g-filter-item">
                            <div class="item-title">
                                <h3>Travel Styles</h3>
                                <i class="fa fa-angle-up" aria-hidden="true"></i>
                            </div>
                            <div class="item-content">
                                <ul>
                                    <!-- Aquí irán las opciones de estilos de viaje dinámicas -->
                                </ul>
                                <button type="button" class="btn btn-link btn-more-item">Más <i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                        <!-- Filtro: Facilities -->
                        <div class="g-filter-item">
                            <div class="item-title">
                                <h3>Facilities</h3>
                                <i class="fa fa-angle-up" aria-hidden="true"></i>
                            </div>
                            <div class="item-content">
                                <ul>
                                    <!-- Aquí irán las opciones de instalaciones dinámicas -->
                                </ul>
                                <button type="button" class="btn btn-link btn-more-item">Más <i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="bravo-list-item">
                    <div class="topbar-search">
                        <h2 class="text result-count">
                            <!-- Aquí irá el conteo de tours dinámico -->
                        </h2>
                        <div class="control bc-form-order">
                            <div class="item">
                                <a href="<?= base_url('tour?_layout=map') ?>" target="_blank">Mostrar en el mapa</a>
                            </div>
                            <div class="item orderby">
                                <div class="item-title">Ordenar por:</div>
                                <input type="hidden" name="orderby" value="">
                                <div class="dropdown">
                                    <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Recomendado
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#" data-value="">Recomendado</a>
                                        <a class="dropdown-item" href="#" data-value="price_low_high">Precio (Bajo a Alto)</a>
                                        <a class="dropdown-item" href="#" data-value="price_high_low">Precio (Alto a Bajo)</a>
                                        <a class="dropdown-item" href="#" data-value="rate_high_low">Calificación (Alta a Baja)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ajax-search-result">
                        <div class="list-item">
                            <div class="row">
                                <!-- Aquí irán los tours dinámicos -->
                            </div>
                        </div>
                        <div class="bravo-pagination">
                            <nav class="mt-2">
                                <!-- Aquí irá la paginación dinámica -->
                            </nav>
                            <span class="count-string">
                                <!-- Aquí irá el texto de paginación dinámico -->
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
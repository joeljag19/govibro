<?= $this->extend('layouts/mainlayout') ?>

<?= $this->section('title') ?>
Lista de Tours
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?= base_url('assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css') ?>">
    <style>
        #mapContainer { height: 600px; width: 100%; display: none; }
        .view-switcher.active { color: #0d6efd; /* O el color primario de tu tema */ }
    </style>
    
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/css/ion.rangeSlider.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>


    <div class="content">
        <div class="container">
            <div class="row">
                <!-- Sidebar de Filtros -->
                <div class="col-xl-3 col-lg-4 theiaStickySidebar">
                    <div class="card filter-sidebar mb-4 mb-lg-0">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5>Filtros</h5>
                            <a href="javascript:void(0);" class="fs-14 link-primary reset-filters">Reiniciar</a>
                        </div>
                        <div class="card-body p-0">
                            <form id="filterForm" onsubmit="return false;">
                                <div class="p-3 border-bottom">
                                    <label class="form-label fs-16">Buscar por Nombre</label>
                                    <div class="input-icon">
                                        <span class="input-icon-addon"><i class="isax isax-search-normal"></i></span>
                                        <input type="text" name="search" class="form-control" id="searchInput" placeholder="Nombre del tour..." value="<?= esc($search ?? '') ?>">
                                    </div>
                                </div>
                                <div class="accordion accordion-list">
                                <!-- Filtro de Precio -->
                                <div class="accordion-item border-bottom p-3">
                                    <h2 class="accordion-header"><div class="accordion-button p-0" data-bs-toggle="collapse" data-bs-target="#accordion-price"><i class="isax isax-coin me-2 text-primary"></i>Precio</div></h2>
                                    <div id="accordion-price" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <div class="filter-range"><input type="hidden" id="range_price" name="price_range"></div>
                                            <div class="filter-range-amount"><p class="fs-14">Rango: <span class="text-gray-9 fw-medium" id="priceRangeDisplay">$0 - $10000</span></p></div>
                                        </div>
                                    </div>
                                </div>
                                    <!-- Filtro de Categorías -->
                                    <div class="accordion-item border-bottom p-3">
                                        <h2 class="accordion-header"><div class="accordion-button p-0" data-bs-toggle="collapse" data-bs-target="#accordion-categories">Tipo de Tour</div></h2>
                                        <div id="accordion-categories" class="accordion-collapse collapse show">
                                            <div class="accordion-body">
                                                <?php foreach ($categories as $category): ?>
                                                    <div class="form-check d-flex align-items-center ps-0 mb-2">
                                                        <input class="form-check-input ms-0 mt-0 filter-input" type="checkbox" name="categories[]" value="<?= $category['id'] ?>" id="category<?= $category['id'] ?>" <?= in_array($category['id'], $selectedCategories ?? []) ? 'checked' : '' ?>>
                                                        <label class="form-check-label ms-2" for="category<?= $category['id'] ?>"><?= esc($category['name']) ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Sidebar -->

                <div class="col-xl-9 col-lg-8 theiaStickySidebar">
                    <div class="d-flex align-items-center justify-content-between flex-wrap">
                        <h6 class="mb-3" id="tourCount">Cargando...</h6>
                        <div class="d-flex align-items-center flex-wrap">
                            <div class="list-item d-flex align-items-center mb-3">
                                <a href="#" class="list-icon me-2 view-switcher active" data-view="grid" title="Cuadrícula"><i class="isax isax-grid-1"></i></a>
                                <a href="#" class="list-icon me-2 view-switcher" data-view="list" title="Lista"><i class="isax isax-firstline"></i></a>
                                <a href="#" class="list-icon view-switcher" data-view="map" title="Mapa"><i class="isax isax-map-1"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div id="resultsContainer">
                        <div class="row" id="toursContainer">
                            <!-- Los tours se cargarán aquí vía AJAX -->
                        </div>
                        <nav id="paginationNav" class="pagination-nav"></nav>
                    </div>
                    
                    <div id="mapContainer"></div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3Seb2ELTehVAZLE06PegKtPtvzyD0mdM&callback=initMap" async defer></script>
<script>
    let map;
    let markers = [];
    let currentView = 'grid';

    // Esta función es llamada por el script de Google Maps una vez que se ha cargado.
    // Se define fuera de $(document).ready() para que sea global y accesible.
    function initMap() {
        if (document.getElementById('mapContainer')) {
            map = new google.maps.Map(document.getElementById('mapContainer'), {
                center: { lat: 18.7357, lng: -70.1627 }, // Rep. Dominicana
                zoom: 8
            });
            // Si la vista inicial es 'map', iniciamos el filtro una vez el mapa está listo.
            if(currentView === 'map') {
                $(document).ready(function() {
                    applyFilters(1);
                });
            }
        }
    }

    // Todo el código que depende de jQuery debe estar dentro de $(document).ready()
    $(document).ready(function() {
        let currentPage = 1;
        var priceSlider = $("#range_price").ionRangeSlider({
            type: "double", min: 0, max: 10000, from: 0, to: 10000, prefix: "$",
            onFinish: function(data) {
                $("#priceRangeDisplay").text("$" + data.from + " - $" + data.to);
                currentPage = 1;
                applyFilters();
            }
        }).data("ionRangeSlider");
            

        
        function applyFilters(page = 1) {
            let search = $('#searchInput').val().trim();
            let priceRange = priceSlider.result;
            let categories = $('input[name="categories[]"]:checked').map(function() { return $(this).val(); }).get();

            const filterData = { search: search, price_min: priceRange.from, price_max: priceRange.to, categories: categories.join(','), view: currentView, page: page };

            if (currentView === 'map') {
                $('#resultsContainer').hide();
                $('#paginationNav').hide();
                $('#mapContainer').show();
                if (typeof google !== 'undefined' && map) {
                    google.maps.event.trigger(map, 'resize');
                }
                $.ajax({
                    url: '<?= base_url('tours/filter') ?>', type: 'GET', data: filterData,
                    success: function(response) {
                        $('#tourCount').text(response.tours.length + ' Tours Encontrados');
                        updateMap(response.tours);
                    },
                    error: function(xhr) { console.error("Error en AJAX (mapa):", xhr.responseText); }
                });
            } else {
                $('#resultsContainer').show();
                $('#paginationNav').show();
                $('#mapContainer').hide();
                $.ajax({
                    url: '<?= base_url('tours/filter') ?>', type: 'GET', data: filterData,
                    beforeSend: function() { $('#toursContainer').html('<div class="col-12 text-center p-5"><div class="spinner-border text-primary" role="status"></div></div>'); },
                    success: function(response) {
                        $('#toursContainer').html(response.tours_html);
                        $('#paginationNav').html(response.pagination_html);
                        $('#tourCount').text(response.total_tours + ' Tours Encontrados');
                        if ($.fn.owlCarousel) { $('.owl-carousel').owlCarousel({ loop: true, margin: 10, nav: true, dots: false, items: 1 }); }
                    },
                    error: function(xhr) { console.error("Error en AJAX (grid/list):", xhr.responseText); }
                });
            }
        }
        
        function updateMap(tours) {
            markers.forEach(marker => marker.setMap(null));
            markers = [];
            const bounds = new google.maps.LatLngBounds();
            
            tours.forEach(tour => {
                if (tour.map_lat && tour.map_lng) {
                    const latLng = new google.maps.LatLng(parseFloat(tour.map_lat), parseFloat(tour.map_lng));
                    const marker = new google.maps.Marker({ position: latLng, map: map, title: tour.title });
                    markers.push(marker);
                    bounds.extend(latLng);
                    
                    const infowindow = new google.maps.InfoWindow({
                        content: `<h6><a href="${'<?= base_url('tours/') ?>' + tour.slug}">${tour.title}</a></h6><p>$${tour.price}</p>`
                    });
                    marker.addListener('click', () => infowindow.open(map, marker));
                }
            });
            if (markers.length > 0) {
                map.fitBounds(bounds);
            }
        }

        $('.view-switcher').on('click', function(e) {
            e.preventDefault();
            currentView = $(this).data('view');
            $('.view-switcher').removeClass('active');
            $(this).addClass('active');
            applyFilters(1);
        });

        applyFilters(currentPage);
        
        $('#searchInput').on('keyup', function() { currentPage = 1; applyFilters(); });
        $('.filter-input').on('change', function() { currentPage = 1; applyFilters(); });
        $(document).on('click', '.pagination-nav a', function(e) { e.preventDefault(); const href = $(this).attr('href'); if (!href || href === '#') return; try { const url = new URL(href); const page = url.searchParams.get("page_tours"); if (page) { currentPage = page; applyFilters(page); } } catch(e) { console.error("URL de paginación inválida:", href); } });
        $('.reset-filters').click(function(e) { e.preventDefault(); $('#filterForm')[0].reset(); priceSlider.reset(); $("#priceRangeDisplay").text("$0 - $10000"); currentPage = 1; applyFilters(); });
    });
</script>
<?= $this->endSection() ?>




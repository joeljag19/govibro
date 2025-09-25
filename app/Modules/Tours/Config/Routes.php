<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('tours', ['namespace' => 'App\Modules\Tours\Controllers'], function($routes) {
    
    $routes->get('/', 'Tours::index');           // Lista de tours (https://govibro.com/tours)
    //$routes->get('detail/(:num)', 'Tours::detail/$1'); // Detalle de un tour (https://govibro.com/tours/detail/123)
    

    $routes->get('book/(:num)', 'Tours::book/$1');     // Formulario de reserva de un tour (https://govibro.com/tours/book/123)
    $routes->post('saveBooking/(:num)', 'Tours::saveBooking/$1');
    $routes->get('booking-confirmation/(:num)', 'Tours::confirmation/$1'); // Confirmación de reserva (https://govibro.com/tours/booking-confirmation/123)
    $routes->get('filter', 'Tours::filter');     // Filtros dinámicos via AJAX (https://govibro.com/tours/filter)

    //$routes->get('admin', 'Tours::AdminIndex'); // Panel de administración de tours (https://govibro.com/tours/admin)

    //este debe ir al final para no interferir con otras rutas
    $routes->get('(:segment)', 'Tours::detail/$1'); // Detalle de un tour usando slug (https://govibro.com/tours/amazing-tour)


});
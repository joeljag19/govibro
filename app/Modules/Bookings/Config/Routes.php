<?php
// En Modules/Bookings/Config/Routes.php

$routes->group('admin/bookings', ['namespace' => 'App\Modules\Bookings\Controllers', 'filter' => 'auth:super_admin'], function($routes) {
    
    $routes->get('/', 'AdminBookingsController::index');
    $routes->get('view/(:num)', 'AdminBookingsController::view/$1');
    
});

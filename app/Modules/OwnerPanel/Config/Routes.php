<?php
// En Modules/OwnerPanel/Config/Routes.php

$routes->group('owner', ['namespace' => 'App\Modules\OwnerPanel\Controllers', 'filter' => 'auth:owner,super_admin'], function($routes) {
    
    $routes->get('dashboard', 'DashboardController::dashboard');
    $routes->get('bookings', 'DashboardController::bookings');

    $routes->get('tours/availability/(:num)', 'OwnerToursController::showAvailability/$1');
    $routes->get('tours/availability/events/(:num)', 'OwnerToursController::getAvailabilityEvents/$1');
    $routes->post('tours/availability/save', 'OwnerToursController::saveAvailability');
    $routes->post('tours/availability/delete', 'OwnerToursController::deleteAvailability');

    // Ruta para enviar el mensaje desde el panel de reservas
    $routes->post('bookings/send-message', 'OwnerBookingsController::sendMessage');



});
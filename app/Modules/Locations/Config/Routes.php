<?php
// En Modules/Locations/Config/Routes.php

$routes->group('admin/locations', ['namespace' => 'App\Modules\Locations\Controllers', 'filter' => 'auth:super_admin'], function($routes) {
    
    $routes->get('/', 'LocationsController::index');
    $routes->get('create', 'LocationsController::create');
    $routes->post('store', 'LocationsController::store');
    $routes->get('edit/(:num)', 'LocationsController::edit/$1');
    $routes->post('update/(:num)', 'LocationsController::update/$1');
    $routes->get('delete/(:num)', 'LocationsController::delete/$1');
    
});

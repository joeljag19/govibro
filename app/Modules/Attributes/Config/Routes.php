<?php
// En Modules/Attributes/Config/Routes.php

$routes->group('admin/attributes', ['namespace' => 'App\Modules\Attributes\Controllers', 'filter' => 'auth:super_admin'], function($routes) {
    
    $routes->get('/', 'AttrsController::index');
    $routes->get('create', 'AttrsController::create');
    $routes->post('store', 'AttrsController::store');
    $routes->get('edit/(:num)', 'AttrsController::edit/$1');
    $routes->post('update/(:num)', 'AttrsController::update/$1');
    $routes->get('delete/(:num)', 'AttrsController::delete/$1');
    
});

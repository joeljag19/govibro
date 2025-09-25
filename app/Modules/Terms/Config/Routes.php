<?php
// En Modules/Terms/Config/Routes.php

$routes->group('admin/terms', ['namespace' => 'App\Modules\Terms\Controllers', 'filter' => 'auth:super_admin'], function($routes) {
    
    $routes->get('/', 'TermsController::index');
    $routes->get('create', 'TermsController::create');
    $routes->post('store', 'TermsController::store');
    $routes->get('edit/(:num)', 'TermsController::edit/$1');
    $routes->post('update/(:num)', 'TermsController::update/$1');
    $routes->get('delete/(:num)', 'TermsController::delete/$1');
    
});

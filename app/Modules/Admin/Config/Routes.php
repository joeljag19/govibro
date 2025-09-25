<?php
// En Modules/Admin/Config/Routes.php

$routes->group('admin', ['namespace' => 'App\Modules\Admin\Controllers', 'filter' => 'auth:super_admin'], function($routes) {
    
    $routes->get('dashboard', 'DashboardController::index');
    
    $routes->get('users', 'UserController::index');
    $routes->get('users/create', 'UserController::showCreateUser');
    $routes->post('users/create', 'UserController::createUser');
    $routes->post('users/approve-owner/(:num)', 'UserController::approveOwner/$1');
});
<?php
namespace App\Modules\Services\Config;

use CodeIgniter\Router\RouteCollection;

$routes = service('routes');

// $routes->get('tour', 'ServiceController::index');
$routes->get('tour', 'ServiceController::index', ['namespace' => 'App\Modules\Services\Controllers']);
$routes->get('hotel/(:any)', 'ServiceController::show/$1');
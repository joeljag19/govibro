<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('auth', ['namespace' => 'App\Modules\Auth\Controllers'], function($routes) {
    $routes->get('login', 'AuthController::showLoginForm'); // Mostrar formulario de login
    $routes->post('login', 'AuthController::processLogin'); // Procesar el login
    $routes->get('logout', 'AuthController::logout');
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::register');
    $routes->get('profile', 'AuthController::profile');

    $routes->get('register-candidate', 'AuthController::showRegisterCandidate');
    $routes->get('register-candidate/(:segment)', 'AuthController::showRegisterCandidate/$1');
    $routes->post('register-candidate', 'AuthController::registerCandidate');

    $routes->get('register-owner', 'AuthController::showRegisterOwner');
    $routes->post('register-owner', 'AuthController::registerOwnerCandidate');
});

    $routes->get('admin', 'Home::dashboard'); // Mostrar Dashboard de administrador

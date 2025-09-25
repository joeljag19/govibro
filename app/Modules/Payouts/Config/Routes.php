<?php
// En Modules/Payouts/Config/Routes.php

$routes->group('payouts/admin', ['namespace' => 'App\Modules\Payouts\Controllers', 'filter' => 'auth:super_admin'], function($routes) {
    
    // Página principal para generar un nuevo pago
    $routes->get('/', 'AdminPayoutController::index');
    
    // Procesa el formulario para generar el reporte de comisiones pendientes
    $routes->post('generate-report', 'AdminPayoutController::generateReport');
    
    // Crea el lote de pago final
    $routes->post('create', 'AdminPayoutController::createPayout');
    
    // Muestra el historial de pagos realizados
    $routes->get('history', 'AdminPayoutController::history');

    
    
});

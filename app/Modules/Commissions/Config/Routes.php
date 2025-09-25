<?php
use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('commissions', ['namespace' => 'App\Modules\Commissions\Controllers'], function($routes) {
    $routes->post('generate-link/(:num)', 'TrackingController::generateLink/$1');
    $routes->post('generate-link/(:num)/(:num)', 'TrackingController::generateLink/$1/$2');
    $routes->post('delete-link/(:num)', 'TrackingController::deleteLink/$1');
    $routes->get('track/(:segment)', 'TrackingController::track/$1');
    $routes->post('process-sale', 'SaleController::processSale');

    $routes->get('admin/candidates', 'AdminCommissionController::showCandidates');
    $routes->get('admin/create-reseller', 'AdminCommissionController::showCreateReseller');
    $routes->post('admin/create-reseller', 'AdminCommissionController::createReseller');
    $routes->get('admin/create-seller', 'AdminCommissionController::showCreateSeller');
    $routes->post('admin/create-seller', 'AdminCommissionController::createSeller');
    $routes->post('admin/approve-candidate/(:num)/(:segment)', 'AdminCommissionController::approveCandidate/$1/$2');
    $routes->get('admin/reject-candidate/(:num)', 'AdminCommissionController::rejectCandidate/$1');
    $routes->get('admin/settings', 'AdminCommissionController::showSettings');
    $routes->post('admin/update-settings', 'AdminCommissionController::updateSettings');
    $routes->get('admin/reports', 'AdminCommissionController::showReports');
    $routes->get('admin/get-reports', 'AdminCommissionController::getReports');
    $routes->get('admin/profiles', 'AdminCommissionController::showProfiles');
    $routes->get('admin/create-profile', 'AdminCommissionController::showCreateProfile');
    $routes->post('admin/create-profile', 'AdminCommissionController::createProfile');
    $routes->get('admin/edit-profile/(:num)', 'AdminCommissionController::showEditProfile/$1');
    $routes->post('admin/update-profile/(:num)', 'AdminCommissionController::updateProfile/$1');
    $routes->get('admin/assign-profiles', 'AdminCommissionController::showAssignProfiles');
    $routes->post('admin/assign-profile/(:num)', 'AdminCommissionController::assignProfile/$1');
    // Muestra el reporte maestro de ventas para el super_admin.
    $routes->get('admin/sales-report', 'AdminCommissionController::salesReport');

    // --- RUTAS DEL PANEL DE REVENDEDOR ---
    // Muestra el panel principal de ganancias.
    $routes->get('reseller/dashboard', 'ResellerController::dashboard');
    // Muestra la lista de vendedores del revendedor.
    $routes->get('reseller/sellers', 'ResellerController::showSellers');
    // Muestra el formulario para invitar y la lista de invitaciones enviadas.
    $routes->get('reseller/invitations', 'ResellerController::showInvitations');
    // Procesa el envío del formulario de invitación.
    $routes->post('reseller/send-invitation', 'ResellerController::sendInvitation');
    // Muestra el dashboard de enlaces (propios y de vendedores) y el historial de clics.
    $routes->get('reseller/links', 'ResellerController::links'); 
    $routes->post('reseller/create-link', 'ResellerController::createLink'); 
    // Ruta para mostrar la lista de vendedores del revendedor
    $routes->get('reseller/sellers', 'ResellerController::showSellers');
    // Ruta para mostrar el historial de pagos del revendedor
    $routes->get('reseller/payment-history', 'ResellerController::paymentHistory');
    // Ruta para mostrar el historial de pagos del Vendedor
    $routes->get('seller/payment-history', 'SellerController::paymentHistory');
  
    // Muestra el reporte detallado de ventas en la red del revendedor.
    $routes->get('reseller/sales-report', 'ResellerController::salesReport');




    // --- RUTAS DEL PANEL DE VENDEDOR ---
    $routes->get('seller/dashboard', 'SellerController::dashboard');
    $routes->get('seller/links', 'SellerController::links');

    // Ruta temporal para generar links retroactivos
    $routes->get('test/generate-links-retro', 'TestController::generateLinksRetro');
    $routes->get('test/makesale', 'TestController::simulateSale');
    $routes->get('test/makeguestsale', 'TestController::simulateGuestSale');
});
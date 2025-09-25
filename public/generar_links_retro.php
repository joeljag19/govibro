<?php
// Script temporal: generar_links_retro.php
// Colocar en /www/wwwroot/govibro.com/public/generar_links_retro.php
// Ejecutar: https://govibro.com/generar_links_retro.php
// Eliminar después de usar

// Cargar CodeIgniter
require '../app/Config/Bootstrap.php';

// Iniciar la aplicación
$app = \Config\Services::app();

// Crear instancia del controlador
$trackingController = new \App\Modules\Commissions\Controllers\TrackingController();

// Generar tracking links para vendedores existentes (seller_id=1 y 2)
try {
    $response1 = $trackingController->generateLink(4, 1); // reseller_user_id=4, seller_id=1
    $result1 = json_decode($response1->getBody(), true);
    if ($result1['success']) {
        echo 'Link generado para vendedor ID=1: ' . $result1['link'] . '<br>';
    } else {
        echo 'Error para vendedor ID=1: ' . $result1['message'] . '<br>';
    }

    $response2 = $trackingController->generateLink(4, 2); // reseller_user_id=4, seller_id=2
    $result2 = json_decode($response2->getBody(), true);
    if ($result2['success']) {
        echo 'Link generado para vendedor ID=2: ' . $result2['link'] . '<br>';
    } else {
        echo 'Error para vendedor ID=2: ' . $result2['message'] . '<br>';
    }
} catch (\Exception $e) {
    echo 'Error general: ' . $e->getMessage();
}
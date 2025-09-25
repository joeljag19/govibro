<?php
$routes->group('admin/tours', ['namespace' => 'App\Modules\AdminTours\Controllers', 'filter' => 'auth:super_admin,owner'], function($routes) {
    // Listar todos los tours
    $routes->get('/', 'ToursController::index');

    // Crear un nuevo tour
    $routes->get('create', 'ToursController::create');

    $routes->post('store', 'ToursController::store');

    // Editar un tour existente
    $routes->get('edit/(:num)', 'ToursController::edit/$1');
    $routes->post('update/(:num)', 'ToursController::update/$1');

    // Eliminar un tour
    $routes->get('delete/(:num)', 'ToursController::delete/$1');

    // Ver detalles del tour (para super_admin)
    $routes->get('view/(:num)', 'ToursController::view/$1');

    // Gestionar imágenes
    $routes->post('upload-image/(:num)', 'ToursController::uploadImage/$1'); // Subir imagen para un tour

    $routes->get('delete-image/(:num)/(:segment)', 'ToursController::deleteImage/$1/$2'); // Eliminar imagen específica de la galería

    // Esta ruta captura el ID del tour y el nombre del archivo de la imagen de la galería


    // Gestionar disponibilidad
    $routes->get('manage-availability/(:num)', 'ToursController::manageAvailability/$1'); // Ver disponibilidad
    $routes->post('add-availability/(:num)', 'ToursController::addAvailability/$1'); // Agregar fecha de disponibilidad
    $routes->get('edit-availability/(:num)', 'ToursController::editAvailability/$1'); // Editar fecha de disponibilidad
    $routes->post('update-availability/(:num)', 'ToursController::updateAvailability/$1'); // Actualizar fecha de disponibilidad
    $routes->get('delete-availability/(:num)', 'ToursController::deleteAvailability/$1'); // Eliminar fecha de disponibilidad

    // Aprobar/Rechazar tour (para super_admin)bulk-edit
    $routes->get('approve/(:num)', 'ToursController::approve/$1');
    $routes->get('reject/(:num)', 'ToursController::reject/$1');

    // Publicar tour
    $routes->get('publish/(:num)', 'ToursController::publish/$1');

    // Gestionar comisiones (para super_admin)
    $routes->get('commissions', 'ToursController::commissions');
    $routes->post('add-commission', 'ToursController::addCommission');
    $routes->post('update-commission/(:num)', 'ToursController::updateCommission/$1');
    $routes->get('delete-commission/(:num)', 'ToursController::deleteCommission/$1');


    // Edición masiva
    $routes->get('bulk-edit', 'ToursController::bulkEdit'); // Mostrar formulario de edición masiva
    $routes->post('bulk-update', 'ToursController::bulkUpdate'); // Procesar cambios masivos

    // Clonar tour
    $routes->get('clone-tour/(:num)', 'ToursController::cloneTour/$1');

    // Restaurar tour
    $routes->get('restore/(:num)', 'ToursController::restore/$1');
    
    // Owner bookings
    $routes->get('owner-bookings', 'ToursController::ownerBookings'); // Confirmar que está presente

 


    // --- RUTAS AÑADIDAS PARA LA GESTIÓN DE CATEGORÍAS ---
    $routes->group('categories', ['filter' => 'auth:super_admin'], function($routes) {
            $routes->get('/', 'CategoryController::index');
            $routes->get('create', 'CategoryController::create');
            $routes->post('store', 'CategoryController::store');
            $routes->get('edit/(:num)', 'CategoryController::edit/$1');
            $routes->post('update/(:num)', 'CategoryController::update/$1');
            $routes->get('delete/(:num)', 'CategoryController::delete/$1');
        });

});

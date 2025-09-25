<?php
try {
    $session = session();
    $userRole = $session->get('user')['role'] ?? null;
    log_message('debug', 'Sidebar: user_role = ' . ($userRole ?? 'null'));

    // Mapa de módulos con secciones y submenús
    $moduleMenuMap = [
        'dashboard' => [
            'name' => 'Dashboard',
            'icon' => 'solar:home-2-bold-duotone',
            'url' => '/admin/dashboard',
            'roles' => ['admin', 'super_admin'],
            'submenus' => [
                ['name' => 'Home', 'url' => '/admin/dashboard', 'icon' => 'solar:chart-square-bold-duotone'],
                ['name' => 'Sales', 'url' => '/admin/sales', 'icon' => 'solar:chart-square-bold-duotone'],
                ['name' => 'Analytics', 'url' => '/admin/analytics', 'icon' => 'solar:graph-bold-duotone'],
            ]
        ],
        'comisiones' => [
            'name' => 'Comisiones',
            'icon' => 'solar:calculator-bold-duotone',
            'url' => '#sidebarComisiones',
            'roles' => ['admin', 'super_admin'],
            'submenus' => [
                ['name' => 'Candidatos', 'url' => '/commissions/admin/candidates', 'icon' => 'solar:user-id-bold-duotone'],
                ['name' => 'Crear Reseller', 'url' => '/commissions/admin/create-reseller', 'icon' => 'solar:shield-user-bold-duotone'],
                ['name' => 'Crear Seller', 'url' => '/commissions/admin/create-seller', 'icon' => 'solar:user-id-bold-duotone'],
                ['name' => 'Configuración', 'url' => '/commissions/admin/settings', 'icon' => 'solar:settings-2-bold-duotone'],
                ['name' => 'Reportes', 'url' => '/commissions/admin/reports', 'icon' => 'solar:chart-square-bold-duotone'],
                ['name' => 'Lista de Perfiles', 'url' => '/commissions/admin/profiles', 'icon' => 'solar:document-bold-duotone'],
                ['name' => 'Crear Perfil', 'url' => '/commissions/admin/create-profile', 'icon' => 'solar:document-add-bold-duotone'],
                ['name' => 'Asignar Perfiles', 'url' => '/commissions/admin/assign-profiles', 'icon' => 'solar:link-bold-duotone'],
                ['name' => 'Reporte de Ventas', 'url' => '/commissions/admin/sales-report', 'icon' => 'solar:document-text-bold-duotone'], 

            ]
        ],
        'reseller' => [
            'name' => 'Panel Reseller',
            'icon' => 'solar:shield-user-bold-duotone',
            'url' => '#sidebarReseller',
            'roles' => ['reseller'],
            'submenus' => [
                // --- AÑADE ESTA LÍNEA ---
                ['name' => 'Dashboard', 'url' => '/commissions/reseller/dashboard', 'icon' => 'solar:home-2-bold-duotone'],
                // --- FIN ---
                ['name' => 'Vendedores', 'url' => '/commissions/reseller/sellers', 'icon' => 'solar:users-group-two-rounded-bold-duotone'],
                ['name' => 'Invitaciones', 'url' => '/commissions/reseller/invitations', 'icon' => 'solar:letter-bold-duotone'],
                ['name' => 'Enlaces', 'url' => '/commissions/reseller/links', 'icon' => 'solar:link-bold-duotone'],
                ['name' => 'Historial de Pagos', 'url' => '/commissions/reseller/payment-history', 'icon' => 'solar:wallet-bold-duotone'],
                ['name' => 'Reporte de Ventas', 'url' => '/commissions/reseller/sales-report', 'icon' => 'solar:document-text-bold-duotone'],

            ]
        ],
        'tours' => [
            'name' => 'Tours',
            'icon' => 'solar:map-point-bold-duotone',
            'url' => '/admin/tours',
            'roles' => ['admin', 'super_admin'],
            'submenus' => [
                ['name' => 'Lista de Tours', 'url' => '/admin/tours', 'icon' => 'solar:map-bold-duotone'],
                ['name' => 'Crear Tour', 'url' => '/admin/tours/create', 'icon' => 'solar:document-add-bold-duotone'],
            ]
        ],
        'seller' => [
            'name' => 'Panel de Vendedor',
            'icon' => 'solar:user-hand-up-bold-duotone',
            'url' => '#sidebarSeller',
            'roles' => ['seller'],
            'submenus' => [
                ['name' => 'Dashboard', 'url' => '/commissions/seller/dashboard', 'icon' => 'solar:home-2-bold-duotone'],
                ['name' => 'Mis Enlaces', 'url' => '/commissions/seller/links', 'icon' => 'solar:link-bold-duotone'],
                ['name' => 'Historial de Pagos', 'url' => '/commissions/seller/payment-history', 'icon' => 'solar:wallet-bold-duotone'],

            ]
        ],
        'users' => [
            'name' => 'Gestión de Usuarios',
            'icon' => 'solar:users-group-rounded-bold-duotone',
            'url' => '#sidebarUsers',
            'roles' => ['super_admin'], // Solo para super_admin
            'submenus' => [
                ['name' => 'Ver Todos', 'url' => '/admin/users', 'icon' => 'solar:list-bold-duotone'],
                ['name' => 'Crear Usuario', 'url' => '/admin/users/create', 'icon' => 'solar:user-plus-rounded-bold-duotone'],
            ]
        ],
        
        'payouts' => [
            'name' => 'Pagos',
            'icon' => 'solar:wallet-money-bold-duotone',
            'url' => '#sidebarPayouts',
            'roles' => ['super_admin'],
            'submenus' => [
                ['name' => 'Generar Pago', 'url' => '/payouts/admin', 'icon' => 'solar:card-send-bold-duotone'],
                ['name' => 'Historial', 'url' => '/payouts/admin/history', 'icon' => 'solar:bill-list-bold-duotone'],
            ]
        ],
        'owner_panel' => [
            'name' => 'Panel de Dueño',
            'icon' => 'solar:case-bold-duotone',
            'url' => '#sidebarOwner',
            'roles' => ['owner'],
            'submenus' => [
                ['name' => 'Dashboard', 'url' => '/owner/dashboard', 'icon' => 'solar:graph-bold-duotone'],
                ['name' => 'Mis Reservas', 'url' => '/owner/bookings', 'icon' => 'solar:ticket-bold-duotone'],
                ['name' => 'Mis Tours', 'url' => '/admin/tours', 'icon' => 'solar:map-bold-duotone'],
                ['name' => 'Crear Tour', 'url' => '/admin/tours/create', 'icon' => 'solar:document-add-bold-duotone'],
            ]
        ],
        'content_management' => [
        'name' => 'Gestión de Contenido',
        'icon' => 'solar:folder-with-files-bold-duotone',
        'url' => '#sidebarContent',
        'roles' => ['super_admin'],
        'submenus' => [
            ['name' => 'Ubicaciones', 'url' => '/admin/locations', 'icon' => 'solar:map-point-wave-bold-duotone'],
            ['name' => 'Categorías de Tours', 'url' => '/admin/tours/categories', 'icon' => 'solar:tag-bold-duotone'],
            ['name' => 'Atributos', 'url' => '/admin/attributes', 'icon' => 'solar:settings-bold-duotone'],
            ['name' => 'Términos', 'url' => '/admin/terms', 'icon' => 'solar:checklist-bold-duotone'],
        ]
    ],
    'bookings_management' => [
        'name' => 'Reservas',
        'icon' => 'solar:ticket-bold-duotone',
        'url' => '/admin/bookings',
        'roles' => ['super_admin']
    ],



    ];
} catch (\Exception $e) {
    log_message('error', 'Sidebar: Error al cargar módulos: ' . $e->getMessage());
    $moduleMenuMap = [];
}
?>

<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <div class="logo-box">
                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/assets/backend/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/backend/images/logo-light.png" alt="" height="24">
                    </span>
                </a>
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/assets/backend/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/backend/images/logo-dark.png" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">
                <li class="menu-title">Menú</li>

                <?php foreach ($moduleMenuMap as $module => $config): ?>
                    <?php if (in_array($userRole, $config['roles'])): ?>
                        <li>
                            <a href="<?php echo isset($config['submenus']) ? '#' . 'sidebarModule' . esc(ucfirst($module)) : base_url($config['url']); ?>" 
                               <?php echo isset($config['submenus']) ? 'data-bs-toggle="collapse"' : ''; ?>>
                                <span class="nav-icon">
                                    <iconify-icon icon="<?php echo esc($config['icon']); ?>"></iconify-icon>
                                </span>
                                <span><?php echo esc($config['name']); ?></span>
                                <?php if (!empty($config['submenus'])): ?>
                                    <span class="menu-arrow"></span>
                                <?php endif; ?>
                            </a>
                            <?php if (!empty($config['submenus'])): ?>
                                <div class="collapse" id="<?php echo 'sidebarModule' . esc(ucfirst($module)); ?>">
                                    <ul class="nav-second-level">
                                        <?php foreach ($config['submenus'] as $submenu): ?>
                                            <li>
                                                <a href="<?php echo base_url($submenu['url']); ?>" class="tp-link">
                                                    <iconify-icon icon="<?php echo esc($submenu['icon']); ?>"></iconify-icon>
                                                    <?php echo esc($submenu['name']); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>

                <li class="menu-title mt-2">Administración</li>
                <li>
                    <a href="#sidebarAdministracion" data-bs-toggle="collapse">
                        <span class="nav-icon"><iconify-icon icon="solar:settings-bold-duotone"></iconify-icon></span>
                        <span>Configuración</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAdministracion">
                        <ul class="nav-second-level">
                            <li>
                                <a href="<?php echo base_url('admin/settings'); ?>" class="tp-link">
                                    <iconify-icon icon="solar:user-id-bold-duotone"></iconify-icon>
                                    General
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

               
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
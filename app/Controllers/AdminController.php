<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AdminController extends Controller
{
    protected $menuItems;

    public function __construct()
    {
        // Verificar si el usuario está autenticado y tiene permisos de administrador
        $session = session();
        if (!$session->has('user') || !in_array($session->get('user')['role'], ['admin', 'super_admin'])) {
            return redirect()->to('/auth/login')->with('error', 'Acceso denegado.');
        }

        // Definir los elementos del menú
        $userRole = $session->get('user')['role'];
        $allMenuItems = [
            [
                'title' => 'Dashboard',
                'icon' => 'solar:home-2-bold-duotone',
                'link' => '/admin/dashboard',
                'roles' => ['admin', 'super_admin'],
                'subitems' => [
                    ['title' => 'Sales', 'link' => '/admin/sales'],
                    ['title' => 'Analytics', 'link' => '/admin/analytics'],
                ],
            ],
            [
                'title' => 'Revendedores',
                'icon' => 'solar:shield-user-bold-duotone',
                'link' => '/admin/resellers',
                'roles' => ['admin', 'super_admin'],
            ],
            [
                'title' => 'Vendedores',
                'icon' => 'solar:shield-user-bold-duotone',
                'link' => '/admin/sellers',
                'roles' => ['admin', 'super_admin'],
            ],
            [
                'title' => 'Comisiones',
                'icon' => 'solar:calculator-bold-duotone',
                'link' => '/admin/commissions',
                'roles' => ['admin', 'super_admin'],
                'subitems' => [
                    ['title' => 'Configuración', 'link' => '/admin/commissions/settings'],
                    ['title' => 'Reportes', 'link' => '/admin/commissions/reports'],
                ],
            ],
        ];

        // Filtrar los elementos del menú según el rol del usuario
        $this->menuItems = array_filter($allMenuItems, function ($item) use ($userRole) {
            return in_array($userRole, $item['roles']);
        });
    }

    protected function renderView($view, $data = [])
    {
        // Asegurarse de que $menuItems esté siempre disponible en las vistas
        $data['menuItems'] = $this->menuItems;
        return view($view, $data);
    }


}
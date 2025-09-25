<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Depurar datos de la sesión
        log_message('debug', 'Filtro AuthFilter ejecutado. Sesión: ' . print_r(session()->get('user'), true));
        log_message('debug', 'Argumentos del filtro: ' . print_r($arguments, true));

        // Verificar si el usuario está autenticado
        if (!session()->has('user')) {
            log_message('debug', 'Usuario no autenticado, redirigiendo a login.');
            return redirect()->to('/auth/login')->with('error', 'Por favor, inicia sesión para continuar.');
        }

        // Verificar el rol del usuario
        $userRole = session('user')['role'];
        $requiredRoles = $arguments ?? [];

        log_message('debug', 'Rol del usuario: ' . $userRole . ', Roles requeridos: ' . print_r($requiredRoles, true));

        if (!empty($requiredRoles) && !in_array($userRole, $requiredRoles)) {
            log_message('debug', 'Usuario no tiene el rol necesario, redirigiendo a página principal.');
            // Redirigir a una página genérica en lugar de /auth/login para evitar el bucle
            return redirect()->to('/')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        log_message('debug', 'Usuario autenticado y autorizado, permitiendo acceso.');
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita lógica después de la solicitud
    }
}
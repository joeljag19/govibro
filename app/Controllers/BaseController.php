<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    /**
     * Instancia del objeto de la solicitud principal.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Un array de helpers para cargar automáticamente al instanciar la clase.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * @var array
     * Almacena datos comunes que se pasarán a todas las vistas.
     */
    protected $data = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // No modificar esta línea
        parent::initController($request, $response, $logger);

        // Establece el idioma para la petición actual basándose en la sesión.
        $session = session();
        if ($session->has('user_locale')) {
            $this->request->setLocale($session->get('user_locale'));
        }

        // Definir valores predeterminados para todas las vistas
        $this->data['page'] = 'index-4'; // Valor por defecto global
        $this->data['assets'] = [
            'css' => [],
            'js'  => [],
        ];
        $this->data['layoutOptions'] = [
            'header_style' => 'default',
            'show_topbar' => true,
        ];
    }

    /**
     * Método para renderizar vistas, pasando assets y opciones de layout.
     */
    protected function render(string $view, array $data = [])
    {
        // Fusiona los datos pasados localmente con los datos globales del BaseController
        $finalData = array_merge($this->data, $data);

        return view($view, $finalData);
    }
}
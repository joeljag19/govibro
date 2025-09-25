<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

     /**
     * @var array
     * Almacena los assets (CSS/JS) que necesita la página actual.
     */
    protected $assets = [
        'css' => [],
        'js'  => [],
    ];

    /**
     * @var array
     * Opciones para la plantilla, como mostrar/ocultar elementos.
     */
    protected $layoutOptions = [
        'show_topbar' => true, // Por defecto, siempre mostramos la barra superior
    ];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Establece el idioma para la petición actual basándose en la sesión.
        $session = session();
        if ($session->has('user_locale')) {
            // Si hay un idioma guardado en la sesión, úsalo.
            $this->request->setLocale($session->get('user_locale'));
        }
        // Si no hay nada en la sesión, CodeIgniter usará el idioma por defecto
        // que configuramos en app/Config/App.php ('es').

            // Preload any models, libraries, etc, here.

            // E.g.: $this->session = \Config\Services::session();
        }

    /**
     * Método helper para renderizar vistas, pasando assets y opciones de layout.
     */
    protected function render(string $view, array $data = [])
    {
        // Pasa la variable $assets a todas las vistas renderizadas con este método.
        $data['assets'] = $this->assets;
        $data['layoutOptions'] = $this->layoutOptions;

        return view($view, $data);
    }
}
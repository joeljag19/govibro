<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CURLRequest;
use CodeIgniter\HTTP\Response;

class CurrencyController extends Controller
{
    /**
     * URL de la API del Banco Popular para consultar la tasa.
     */
    private const API_URL = "https://api.us-east-a.apiconnect.ibmappdomain.cloud/apiportalpopular/bpdsandbox/consultatasa/consultaTasa";

    /**
     * Tiempo en segundos que la respuesta de la API será almacenada en caché (1 hora).
     */
    private const CACHE_TTL = 3600; 

    /**
     * Clave para almacenar la respuesta en la caché.
     */
    private const CACHE_KEY = 'popular_exchange_rates';

    /**
     * Consulta la tasa de cambio de las monedas disponibles desde la API.
     * Implementa cacheo para reducir las llamadas a la API externa.
     * @return Response Retorna una respuesta JSON con las tasas o un mensaje de error.
     */
    public function getExchangeRate(): Response
    {
        // 1. Cargar credenciales desde variables de entorno (.env)
        $bearerToken = getenv('POPULAR_API_BEARER_TOKEN');
        $clientId = getenv('POPULAR_API_CLIENT_ID');
        
        // Verificación básica de credenciales
        if (!$bearerToken || !$clientId) {
            log_message('error', 'Faltan credenciales de API en el archivo .env.');
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Faltan claves de autenticación (POPULAR_API_BEARER_TOKEN o POPULAR_API_CLIENT_ID) en las variables de entorno.'
            ])->setStatusCode(500);
        }

        // 2. Intentar obtener la respuesta de la caché
        $cache = \Config\Services::cache();
        $cachedData = $cache->get(self::CACHE_KEY);

        if ($cachedData) {
            log_message('info', "API Tasa de Cambio [CACHE HIT]: Devolviendo respuesta desde caché.");
            return $this->response->setJSON(json_decode($cachedData))->setStatusCode(200);
        }

        // 3. Inicializar el cliente HTTP de CodeIgniter
        $client = \Config\Services::curlrequest();

        try {
            log_message('debug', "Iniciando consulta a API Tasa de Cambio (CACHE MISS).");

            // 4. Ejecutar la solicitud GET con las cabeceras de autenticación
            $response = $client->get(self::API_URL, [
                'timeout' => 30, // 30 segundos de espera
                'headers' => [
                    "Authorization" => "Bearer " . $bearerToken,
                    "X-IBM-Client-Id" => $clientId,
                    "Accept" => "application/json",
                ],
            ]);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $data = json_decode($body, true);
            
            log_message('debug', "API Tasa de Cambio [STATUS {$statusCode}]: Respuesta recibida.");

            // 5. Manejo de Respuestas Exitosas (200 OK)
            if ($statusCode === 200) {
                // ... (Lógica de procesamiento de datos de monedas igual a la versión anterior) ...
                if (isset($data['monedas']['moneda']) && is_array($data['monedas']['moneda'])) {
                    $rates = [];
                    $fechaConsulta = $data['monedas']['fechaConsulta'] ?? 'Fecha no disponible en API';

                    foreach ($data['monedas']['moneda'] as $currencyData) {
                        if (isset($currencyData['descripcion'], $currencyData['compra'], $currencyData['venta'])) {
                            $rates[$currencyData['descripcion']] = [
                                'compra' => (float)$currencyData['compra'],
                                'venta' => (float)$currencyData['venta'],
                            ];
                        }
                    }

                    if (!empty($rates)) {
                        $finalResponse = [
                            'success' => true,
                            'rates' => $rates,
                            'fechaConsultaAPI' => $fechaConsulta,
                            'fechaProcesamiento' => date('Y-m-d H:i:s')
                        ];
                        
                        // 6. Almacenar la respuesta exitosa en caché
                        $cache->save(self::CACHE_KEY, json_encode($finalResponse), self::CACHE_TTL);
                        log_message('info', "API Tasa de Cambio [CACHE SET]: Tasas almacenadas por " . self::CACHE_TTL . " segundos.");

                        return $this->response->setJSON($finalResponse)->setStatusCode(200);
                    }
                }
                
                // Si el 200 no tiene el formato esperado o no hay datos de moneda
                 log_message('error', "API Tasa de Cambio [ERROR 422]: Formato de respuesta 200 inesperado. Cuerpo: " . $body);
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Respuesta exitosa, pero no se encontraron datos de moneda en el formato esperado (monedas.moneda).',
                    'response_data' => $data
                ])->setStatusCode(422);
            } 
            
            // 7. Manejo de Respuestas de Error de la API (4xx, 5xx)
            else {
                 $errorMessage = "Error {$statusCode} al consultar la tasa. ";

                 if (isset($data['httpMessage'])) {
                    $errorMessage .= $data['httpMessage'] . " - " . ($data['moreInformation'] ?? 'Sin más detalles');
                 } else if (isset($data['error']['descripcion'])) {
                    $errorMessage .= $data['error']['descripcion'];
                 } else {
                     $errorMessage .= "Respuesta API inesperada: " . $body;
                 }
                
                log_message('error', "API Tasa de Cambio [FALLO {$statusCode}]: {$errorMessage}");
                
                return $this->response->setJSON([
                    'success' => false,
                    'code' => $statusCode,
                    'message' => $errorMessage
                ])->setStatusCode($statusCode);
            }

        } catch (\Exception $e) {
            // 8. Manejo de Errores de Conexión (ej. Timeouts o problemas de red)
            log_message('critical', 'Error de conexión (cURL) a la API Tasa de Cambio: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'code' => 503, // Service Unavailable
                'message' => 'Error de conexión (cURL): ' . $e->getMessage()
            ])->setStatusCode(503);
        }
    }
}

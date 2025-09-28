<?php
namespace App\Services;

class CurrencyService
{
    private const API_URL = "https://api.us-east-a.apiconnect.ibmappdomain.cloud/apiportalpopular/bpdsandbox/consultatasa/consultaTasa";
    private const CACHE_TTL = 3600; // 1 hora
    private const CACHE_KEY = 'popular_exchange_rates';

    /**
     * Obtiene la tasa de conversión entre dos monedas.
     *
     * @param string $fromCurrency (ej. 'DOP')
     * @param string $toCurrency   (ej. 'USD')
     * @return float|null La tasa de cambio o null si hay un error.
     */
    public function getConversionRate(string $fromCurrency, string $toCurrency): ?float
    {
        // Si la conversión es a la misma moneda, la tasa es 1.
        if ($fromCurrency === $toCurrency) {
            return 1.0;
        }

        $allRates = $this->getAllRates();

        if (!$allRates) {
            return null; // No se pudieron obtener las tasas
        }

        // Mapeo de nombres de la API a códigos de moneda
        $currencyMap = [
            'DOLAR ESTADOUNIDENSE' => 'USD',
            'EURO' => 'EUR'
        ];

        $fromRate = 1.0;
        $toRate = 1.0;

        // Si la moneda de origen es DOP, su tasa base es 1
        if ($fromCurrency !== 'DOP') {
            $apiKey = array_search($fromCurrency, $currencyMap);
            if ($apiKey && isset($allRates[$apiKey])) {
                $fromRate = (float)$allRates[$apiKey]['venta'];
            } else {
                return null; // Moneda de origen no encontrada
            }
        }
        
        // Si la moneda de destino es DOP, su tasa base es 1
        if ($toCurrency !== 'DOP') {
            $apiKey = array_search($toCurrency, $currencyMap);
             if ($apiKey && isset($allRates[$apiKey])) {
                $toRate = (float)$allRates[$apiKey]['venta'];
            } else {
                return null; // Moneda de destino no encontrada
            }
        }

        return $toRate / $fromRate;
    }


    /**
     * Obtiene todas las tasas desde la caché o la API.
     * @return array|null
     */
    private function getAllRates(): ?array
    {
        $cache = \Config\Services::cache();
        $cachedData = $cache->get(self::CACHE_KEY);

        if ($cachedData) {
            $response = json_decode($cachedData, true);
            return $response['rates'] ?? null;
        }

        $bearerToken = getenv('POPULAR_API_BEARER_TOKEN');
        $clientId = getenv('POPULAR_API_CLIENT_ID');

        if (!$bearerToken || !$clientId) {
            log_message('error', 'Faltan credenciales de API para tasas de cambio.');
            return null;
        }

        try {
            $client = \Config\Services::curlrequest();
            $response = $client->get(self::API_URL, [
                'timeout' => 15,
                'headers' => [
                    "Authorization" => "Bearer " . $bearerToken,
                    "X-IBM-Client-Id" => $clientId,
                    "Accept" => "application/json",
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody(), true);
                if (isset($data['monedas']['moneda'])) {
                    $rates = [];
                    foreach ($data['monedas']['moneda'] as $currency) {
                        $rates[$currency['descripcion']] = [
                            'compra' => (float)$currency['compra'],
                            'venta' => (float)$currency['venta'],
                        ];
                    }
                    // Guardar en caché
                    $cache->save(self::CACHE_KEY, json_encode(['rates' => $rates]), self::CACHE_TTL);
                    return $rates;
                }
            }
        } catch (\Exception $e) {
            log_message('critical', 'Error de conexión a la API de Tasas: ' . $e->getMessage());
            return null;
        }

        return null;
    }
}
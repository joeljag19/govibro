<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class AiTest extends BaseCommand
{
    protected $group       = 'AI';
    protected $name        = 'ai:test';
    protected $description = 'Realiza una prueba de conexión directa con la API de Google AI.';

    public function run(array $params)
    {
        CLI::write('Iniciando prueba de conexión con la API de Google AI...', 'yellow');

        // 1. Verificar la API Key desde el .env
        $apiKey = getenv('GOOGLE_AI_API_KEY');
        if (empty($apiKey) || $apiKey === 'TU_API_KEY_DE_GOOGLE') {
            CLI::error('ERROR: La variable GOOGLE_AI_API_KEY no está configurada en tu archivo .env.');
            return;
        }
        CLI::write('API Key encontrada en .env.', 'green');

        // 2. Definir el Endpoint y el Payload (igual que en tu controlador)
        $apiUrl = 'https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key=' . $apiKey;
        $prompt = "Genera una respuesta JSON con una sola clave llamada 'status' y el valor 'ok'.";
        
        $payload = [
            'contents' => [['parts' => [['text' => $prompt]]]],
            'generationConfig' => [ // Forzamos JSON para una prueba más fiable
                'response_mime_type' => 'application/json',
            ]
        ];

        CLI::write('Enviando petición a: ' . $apiUrl);

        try {
            // 3. Realizar la llamada con cURL
            $client = \Config\Services::curlrequest(['timeout' => 60]);
            $apiResponse = $client->post($apiUrl, [
                'headers' => ['Content-Type' => 'application/json'],
                'json'    => $payload
            ]);

            $statusCode = $apiResponse->getStatusCode();
            $body = $apiResponse->getBody();

            CLI::write('Respuesta recibida. Código de estado: ' . $statusCode, 'yellow');
            
            // 4. Analizar la respuesta
            if ($statusCode === 200) {
                CLI::write('------------------------------------------', 'green');
                CLI::write('ÉXITO: La API respondió correctamente.', 'green');
                CLI::write('------------------------------------------', 'green');
                CLI::write('Cuerpo de la respuesta:');
                CLI::write($body);
            } else {
                CLI::error('------------------------------------------');
                CLI::error('FALLO: La API devolvió un error.');
                CLI::error('------------------------------------------');
                CLI::error('Cuerpo de la respuesta de error:');
                CLI::error($body);
            }

        } catch (\Exception $e) {
            CLI::error('------------------------------------------------------------');
            CLI::error('EXCEPCIÓN CRÍTICA: No se pudo conectar con el servidor de la API.');
            CLI::error('------------------------------------------------------------');
            CLI::error('Mensaje de error: ' . $e->getMessage());
            CLI::write('Posibles causas:');
            CLI::write('- El servidor no tiene salida a internet.');
            CLI::write('- Un firewall está bloqueando la conexión saliente al puerto 443.');
            CLI::write('- Problemas con la configuración de cURL o certificados SSL en tu PHP.');
        }
    }
}
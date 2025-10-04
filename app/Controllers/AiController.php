<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class AiController extends Controller
{
    public function generateTourContent(): ResponseInterface
    {
        $user = session('user');
        if (!$user || !in_array($user['role'], ['owner', 'super_admin'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Acceso denegado.'])->setStatusCode(403);
        }

        $jsonData = $this->request->getJSON();
        $keywords = $jsonData->keywords ?? null;

        if (empty($keywords)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Por favor, proporciona algunas palabras clave.'])->setStatusCode(400);
        }
        
        $apiKey = getenv('GOOGLE_AI_API_KEY');
        if (empty($apiKey) || $apiKey === 'TU_API_KEY_DE_GOOGLE') {
            log_message('error', 'La clave de API de Google AI no está configurada en el archivo .env');
            return $this->response->setJSON(['success' => false, 'message' => 'Error de configuración del servidor [API Key].'])->setStatusCode(500);
        }

        // --- CORRECCIÓN #1: Asegúrate de que la URL usa v1 ---
        $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=' . $apiKey;
        
        $prompt = "Actúa como un experto en marketing de viajes. Basado en estas palabras clave: '{$keywords}', 
            genera una respuesta en formato JSON con las siguientes claves:
            - 'title': Un título atractivo y comercial para el tour.
            - 'short_desc': Una descripción corta y emocionante de 1 o 2 frases.
            - 'content': Una descripción completa y detallada del tour, usando párrafos.
            - 'seo_title': Un título optimizado para SEO, de 50 a 60 caracteres como máximo.
            - 'seo_description': Genera una meta descripción SEO. **El resultado final NO DEBE SUPERAR los 160 caracteres**, ya que Google cortará el texto y afectara el SEO. Asegúrate de contar los caracteres antes de dar la respuesta.

            Asegúrate de que el JSON sea válido.";
            
        // --- CORRECCIÓN #2: Simplifica el payload ---
        $payload = [
            'contents' => [['parts' => [['text' => $prompt]]]]
        ];

        try {
            $client = \Config\Services::curlrequest(['timeout' => 60]);
            $apiResponse = $client->post($apiUrl, [
                'headers' => ['Content-Type' => 'application/json'],
                'json'    => $payload
            ]);

            $statusCode = $apiResponse->getStatusCode();
            $body = json_decode($apiResponse->getBody(), true);

            if ($statusCode !== 200) {
                log_message('error', 'Error de la API de Google: ' . $apiResponse->getBody());
                $errorMessage = $body['error']['message'] ?? 'Error desconocido de la API.';
                return $this->response->setJSON(['success' => false, 'message' => "Error de la API de IA: " . $errorMessage])->setStatusCode(500);
            }
            
            if (isset($body['candidates'][0]['content']['parts'][0]['text'])) {
                $rawText = $body['candidates'][0]['content']['parts'][0]['text'];

                // --- LÍNEA CLAVE PARA EXTRAER EL JSON PURO ---
                // Busca y extrae solo el contenido entre ```json y ```
                if (preg_match('/\{.*\}/s', $rawText, $matches)) {
                    $generatedJson = $matches[0];
                } else {
                    $generatedJson = $rawText;
                }

                $contentData = json_decode($generatedJson, true);

                if (json_last_error() === JSON_ERROR_NONE && isset($contentData['title'])) {
                    // ... Tu lógica de éxito sigue igual aquí ...
                    return $this->response->setJSON(['success' => true, 'data' => $contentData]);
                }
            }
            
            log_message('error', 'Respuesta inesperada o JSON inválido de la API de IA: ' . $apiResponse->getBody());
            return $this->response->setJSON(['success' => false, 'message' => 'La IA no pudo generar el contenido con un formato válido.'])->setStatusCode(500);

        } catch (\Exception $e) {
            log_message('error', 'Excepción en AiController: ' . $e->getMessage());
            return $this->response->setJSON(['success' => false, 'message' => 'Error de conexión con el servicio de IA. Verifica los logs.'])->setStatusCode(500);
        }
    }
}
<?php
// Habilitar todos los errores para el diagnóstico
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "Iniciando prueba de conexión con la API de Google AI...<br><br>";

$apiKey = 'AIzaSyCGN25cuV36D24Td8hO-J3APz__C1K9xms'; // <-- REEMPLAZA ESTO CON TU CLAVE REAL
$apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $apiKey;
$prompt = "Genera un saludo de prueba en español.";

$payload = json_encode([
    'contents' => [
        [
            'parts' => [
                ['text' => $prompt]
            ]
        ]
    ]
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
// --- Línea importante para algunos servidores ---
// Si tienes problemas de SSL, puede que necesites descomentar la siguiente línea:
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo '<h2>Error de cURL:</h2>';
    echo '<pre>' . curl_error($ch) . '</pre>';
    echo "<br><p><b>Solución probable:</b> Esto indica un problema de red o de configuración SSL en tu servidor. Contacta al soporte de tu hosting o busca cómo actualizar los certificados CA en tu servidor.</p>";
} else {
    echo '<h2>Respuesta del Servidor de Google:</h2>';
    echo '<pre>';
    print_r(json_decode($response, true));
    echo '</pre>';
}

curl_close($ch);

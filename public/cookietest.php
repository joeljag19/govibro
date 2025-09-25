<?php
// public/cookietest.php

setcookie('test_cookie', 'it_works', [
    'expires' => time() + 3600,
    'path' => '/',
    'samesite' => 'Lax'
]);

echo "Prueba de cookie finalizada. Revisa las herramientas de desarrollador.";
?>
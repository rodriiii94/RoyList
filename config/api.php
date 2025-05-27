<?php

// Devuelve la URL de la API desde el archivo .env
// o utiliza una URL predeterminada si no está configurada.
return [
    'url' => env('API_URL', 'http://192.168.0.101:3000/api'),
];

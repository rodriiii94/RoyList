<?php

// Devuelve la URL de la API desde el archivo .env
// o utiliza una URL predeterminada si no está configurada.
return [
    'url' => env('API_URL', 'http://localhost:3000/api'),
];

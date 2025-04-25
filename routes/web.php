<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

// ! Rutas de la API
Route::get('/pruebaApi', function () {
    //return view('primera');
    $response = Http::get('http://localhost:3000/api/data');
    $data = $response->json();
    $cont = 1;
    foreach ($data as $product) {
        echo $cont . " - " . $product['name'] . " - " . $product['id'] . '<br>';
        $cont++;
    }
    //dd($data);
});

// Ruta principal de la aplicación, directorio index
Route::get('/', function () {
    return view('index');
});

// Route::get('/login', function (){
//     return view('login');
// });

// Route::get('/register', function (){
//     return view('register');
// });

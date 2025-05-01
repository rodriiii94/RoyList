<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('registerUser');
    Route::post('register', [RegisterController::class, 'store']);
    
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
});

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
})->name('index');

// Ruta de inicio de sesión
Route::get('/login', function (){
    return view('login');
})->name('login');

// Ruta de registro
Route::get('/register', function (){
    return view('register');
})->name('register');

Route::post('/login', [LoginController::class, 'login'])->name('loginProcess');

// Cerrar sesión
// TODO poner ruta de cerrar sesión con middleware auth
Route::get('logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('registerdwd', [RegisterController::class, 'store'])->name('registerUser');

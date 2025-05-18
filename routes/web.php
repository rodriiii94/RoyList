<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ListaCompra_Controller;
use App\Http\Controllers\Supermercado_Controller;

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

// Ruta de los términos de servicio
Route::get('/terminos-de-servicio', function () {
    return view('terminos');
})->name('terminos');

// Página de listas de la compra
Route::get('/mis-listas', [ListaCompra_Controller::class, 'showListView'])->middleware('auth')->name('listas');

// Ruta para crear una nueva lista de compra
Route::get('/crear-lista', [Supermercado_Controller::class, 'showSupermercados'])->middleware('auth')->name('crear_lista');
Route::post('/mis-listas', [ListaCompra_Controller::class, 'create'])->middleware('auth')->name('listas_create');

// Ruta de la política de privacidad
Route::get('/politica-de-privacidad', function () {
    return view('politica');
})->name('politica');

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
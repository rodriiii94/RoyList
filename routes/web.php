<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ListaCompra_Controller;
use App\Http\Controllers\ProductoLista_Controller;
use App\Http\Controllers\Supermercado_Controller;
use App\Http\Controllers\User_Controller;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// ! Rutas de la API
Route::get('/pruebaApi', function () {
    $response = Http::get(config('api.url') . '/data');
    $data = $response->json();
    foreach ($data as $i => $product) {
        echo ($i + 1) . " - " . $product['name'] . " - " . $product['id'] . '<br>';
    }
});

// Rutas para la verificación de email
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', fn() => view('auth.verify-email'))->name('verification.notice');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'verification-link-sent');
    })->middleware('throttle:6,1')->name('verification.send');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('index')->with('verified', 'Email verificado correctamente.');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Rutas públicas
Route::middleware(PreventBackHistory::class)->group(function () {
    Route::view('/', 'index')->name('index');
    Route::view('/terminos-de-servicio', 'terminos')->name('terminos');
    Route::view('/politica-de-privacidad', 'politica')->name('politica');
});

// Rutas de autenticación (solo para invitados)
Route::middleware(['guest', PreventBackHistory::class])->group(function () {
    // Vistas de inicio de sesión y registro
    Route::view('/login', 'login')->name('login');
    Route::view('/register', 'register')->name('register');

    // Procesamiento de inicio de sesión y registro
    Route::post('/login', [LoginController::class, 'login'])->name('loginProcess');
    Route::post('/register', [RegisterController::class, 'register'])->name('registerUser');
});

// Rutas protegidas (usuario autenticado y verificado)
Route::middleware(['auth', 'verified', PreventBackHistory::class])->group(function () {
    // Cerrar sesión
    Route::get('logout', [LoginController::class, 'destroy'])->name('logout');

    // Perfil de usuario
    Route::get('/perfil', [App\Http\Controllers\User_Controller::class, 'show'])->name('perfil');
    Route::put('/perfil', [App\Http\Controllers\User_Controller::class, 'update'])->name('perfil.update');
    Route::delete('/perfil', [App\Http\Controllers\User_Controller::class, 'destroy'])->name('perfil.destroy');

    // Mostrar todas las listas de la compra de un usuario
    Route::get('/mis-listas', [ListaCompra_Controller::class, 'getListas'])->name('listas');

    // Borrar una lista de la compra
    Route::delete('/mis-listas/borrar/{id}', [ListaCompra_Controller::class, 'borrarLista'])->name('borrarLista');

    // Procedimiento de crear una nueva lista de la compra
    Route::post('/crear-lista', [ListaCompra_Controller::class, 'create'])->name('crearLista');

    // Vista para crear una lista de la compra, manda por parámetro los supermercados para que aparezcan en el formulario
    Route::get('/supermercados', [Supermercado_Controller::class, 'showSupermercados'])->name('showCrearLista');

    // Mostrar una lista de la compra específica
    Route::get('/lista/{id}', [ListaCompra_Controller::class, 'mostrarLista'])->name('lista_compra');

    // Borrar un producto de la lista de la compra
    Route::delete('/lista/{id}/producto/{productoId}', [ProductoLista_Controller::class, 'eliminarProducto'])->name('productos.destroy');

    // Rutas para manejar productos en una lista de la compra con la API

    // Obtener productos para una lista de la compra
    Route::get('/api/productos/{lista}', [ProductoLista_Controller::class, 'mostrarProductos'])->name('productos.api');

    //Obtener los productos agrupados por categoría
    Route::get('/productos/por-categoria', [ProductoLista_Controller::class, 'obtenerPorCategoria']);

    // Obtener las categorías de productos
    Route::get('/productos/categorias', [ProductoLista_Controller::class, 'obtenerCategorias']);

    // Guardar un producto directamente de la API a una lista de la compra de la BD
    Route::post('/producto/guardar', [ProductoLista_Controller::class, 'guardarProducto']);
});
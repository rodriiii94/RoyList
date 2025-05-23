<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ListaCompra_Controller;
use App\Http\Controllers\ProductoLista_Controller;
use App\Http\Controllers\Supermercado_Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// ! Rutas de la API
Route::get('/pruebaApi', function () {
    $response = Http::get('http://localhost:3000/api/data');
    $data = $response->json();
    foreach ($data as $i => $product) {
        echo ($i + 1) . " - " . $product['name'] . " - " . $product['id'] . '<br>';
    }
});

// ! Rutas para la verificación de email
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
Route::view('/', 'index')->name('index');
Route::view('/terminos-de-servicio', 'terminos')->name('terminos');
Route::view('/politica-de-privacidad', 'politica')->name('politica');

// Rutas de autenticación (solo para invitados)
Route::middleware('guest')->group(function () {
    Route::view('/login', 'login')->name('login');
    Route::view('/register', 'register')->name('register');
    Route::post('/login', [LoginController::class, 'login'])->name('loginProcess');
    Route::post('/register', [RegisterController::class, 'store'])->name('registerUser');
});

// Cerrar sesión
Route::get('logout', [LoginController::class, 'destroy'])->name('logout');

// Rutas protegidas (usuario autenticado y verificado)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mis-listas', [ListaCompra_Controller::class, 'getListas'])->name('listas');
    Route::delete('/mis-listas/borrar/{id}', [ListaCompra_Controller::class, 'borrarLista'])->name('borrar_lista');
    Route::post('/mis-listas', [ListaCompra_Controller::class, 'create'])->name('listas_create');
    Route::get('/crear-lista', [Supermercado_Controller::class, 'showSupermercados'])->name('crear_lista');
    Route::get('/supermercados', [Supermercado_Controller::class, 'showSupermercados'])->name('supermercados');
    Route::get('/lista/{id}', [ListaCompra_Controller::class, 'mostrarLista'])->name('lista_compra');
    Route::delete('/lista/{id}/producto/{productoId}', [ProductoLista_Controller::class, 'eliminarProducto'])->name('productos.destroy');
    Route::get('/api/productos-sugeridos/{lista}', [ProductoLista_Controller::class, 'mostrarProductos'])->name('productos.api');
});
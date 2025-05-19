<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ListaCompra_Controller;
use App\Http\Controllers\Supermercado_Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

// ! Rutas para la verificación de email
// Ruta para mostrar el mensaje de verificación de email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Ruta que recibe el enlace de verificación de email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // Marca el email como verificado
    return redirect()->route('index')->with('verified', 'Email verificado correctamente.'); // Redirige a la página principal con un mensaje de éxito
})->middleware(['auth', 'signed'])->name('verification.verify');

// Ruta para reenviar el email de verificación
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification(); // Envía el email de verificación
    return back()->with('status', 'verification-link-sent'); // Redirige de vuelta con un mensaje de estado
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Ruta principal de la aplicación, directorio index
Route::get('/', function () {
    return view('index');
})->name('index');

// Ruta de los términos de servicio
Route::get('/terminos-de-servicio', function () {
    return view('terminos');
})->name('terminos');

// Página de listas de la compra
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/mis-listas', [ListaCompra_Controller::class, 'showListView'])->name('listas');
});

// Ruta para crear una nueva lista de compra
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/crear-lista', [Supermercado_Controller::class, 'showSupermercados'])->name('crear_lista');
});

// Ruta para mostrar los supermercados
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/supermercados', [Supermercado_Controller::class, 'showSupermercados'])->name('supermercados');
});

// Ruta para crear una nueva lista de compra
Route::middleware(['auth', 'verified'])->group(function() {
    Route::post('/mis-listas', [ListaCompra_Controller::class, 'create'])->name('listas_create');
});

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
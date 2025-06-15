<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\AuthService;

class LoginController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Maneja un intento de autenticación.
     *
     * Valida la solicitud de inicio de sesión entrante, intenta autenticar al usuario
     * usando las credenciales proporcionadas y redirige según corresponda.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP entrante que contiene las credenciales de inicio de sesión.
     * @return \Illuminate\Http\RedirectResponse  Redirige a la ruta index en caso de éxito, o vuelve atrás con errores en caso de fallo.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($this->authService->attemptLogin($credentials)) {
            return redirect()->route('index');
        } else {
            return back()->withErrors([
                'email' => 'Las credenciales proporcionadas no coinciden.',
            ])->onlyInput('email');
        }
    }

    /**
     * Cierra la sesión del usuario autenticado, invalida la sesión,
     * regenera el token CSRF y redirige a la página principal.
     *
     * @param  \Illuminate\Http\Request  $request  La instancia actual de la solicitud HTTP.
     * @return \Illuminate\Http\RedirectResponse   Redirige a la página principal de la aplicación.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Maneja el registro de un nuevo usuario.
     *
     * Valida los datos recibidos del formulario de registro, crea un nuevo usuario,
     * dispara el evento de registro, inicia sesión automáticamente al usuario y
     * redirige a la página de verificación de correo electrónico.
     *
     * @param  \Illuminate\Http\Request  $request  Solicitud HTTP con los datos de registro.
     * @return \Illuminate\Http\RedirectResponse   Redirección a la notificación de verificación.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::min(size: 8)->letters()->numbers()->symbols()],
            'terms' => ['accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }
}

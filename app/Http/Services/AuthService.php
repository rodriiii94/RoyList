<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;

class AuthService {
    
    // Intentar autenticar al usuario
    public function attemptLogin($credentials){
        return Auth::attempt($credentials);
    }

    // Cerrar sesión
    public function logout() {
        Auth::logout();
    }
}
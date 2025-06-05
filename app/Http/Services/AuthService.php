<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;

class AuthService {
    
    public function attemptLogin($credentials){
        return Auth::attempt($credentials);
    }

    public function logout() {
        Auth::logout();
    }
}
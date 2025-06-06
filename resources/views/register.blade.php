@extends('layouts.app')

@section('title', 'Registro - RoyList')

@section('content')

<div class="min-h-screen bg-gray-50 flex">
    <!-- Left side with logo and welcome message -->
    <div class="hidden lg:block relative w-1/2 bg-gradient-to-br from-emerald-50 to-gray-100">
        <div class="absolute inset-0 flex flex-col justify-center items-center p-12">
            <!-- Your logo here -->
            <div class="mb-8">
                    <img src="{{ asset('images/LogoTrans.png') }}" alt="Logo de RoyList" class="w-36 h-32">
                </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Únete a nosotros</h1>
            <p class="text-lg text-gray-600 text-center max-w-md">Crea tu cuenta para empezar a gestionar tus listas de la compra</p>
        </div>
    </div>

    <!-- Right side with compact form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 border border-gray-100">
            <!-- Logo responsive -->
                <div class="lg:hidden flex justify-center mb-8">
                    <img src="{{ asset('images/LogoTrans.png') }}" alt="Logo de RoyList" class="w-27 h-24">
                </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-3 text-center">Crea tu cuenta</h2>
            
            <form class="space-y-4" action="{{ route('registerUser') }}" method="POST">
                @csrf

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nombre completo
                    </label>
                    <input id="name" name="name" type="text" autocomplete="name" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        Correo electrónico
                    </label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Contraseña
                    </label>
                    <input id="password" name="password" type="password" autocomplete="new-password" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                    <p class="mt-1 text-xs text-gray-500">Mínimo 8 caracteres: caracter especial, minúscula y mayúscula, y número</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirmar contraseña
                    </label>
                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                    </div>
                    <label for="terms" class="ml-2 block text-sm text-gray-700">
                        Acepto los <a href="{{ route('terminos') }}" class="font-medium text-emerald-600 hover:text-emerald-500">Términos de servicio</a> y <a href="{{ route('politica') }}" class="font-medium text-emerald-600 hover:text-emerald-500">Política de privacidad</a>
                    </label>
                </div>

                <!-- Register button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 rounded-lg text-white font-medium transition focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                        Registrarse
                    </button>
                </div>
            </form>

            <!-- Login link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    ¿Ya tienes cuenta? 
                    <a href="{{ route('login') }}" class="font-medium text-emerald-600 hover:text-emerald-500">
                        Inicia sesión
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
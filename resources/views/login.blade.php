@extends('layouts.app')

@section('title', 'Iniciar sesión - RoyList')

@section('content')

    <div class="min-h-screen bg-gray-50 flex dark:bg-gray-900">
        <!-- Columna izquierda con logo y mensaje de bienvenida -->
        <div class="hidden lg:block relative w-1/2 bg-gradient-to-br from-emerald-50 to-gray-100 dark:from-emerald-900 dark:to-gray-800">
            <div class="absolute inset-0 flex flex-col justify-center items-center p-12">
                <div class="mb-8">
                    <img src="{{ asset('images/LogoTrans.png') }}" alt="Logo de RoyList" class="w-27 h-24 block dark:hidden">
                    <img src="{{ asset('images/SoloLogoBlancoBG.png') }}" alt="Logo de RoyList" class="w-38 h-30 hidden dark:block">
                </div>
                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mb-4">Bienvenido de vuelta</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 text-center max-w-md">Inicia sesión para acceder a tu cuenta y gestionar tus
            </div>
        </div>

        <!-- Columna derecha con formulario -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center py-12 px-6">
            <div class="mx-auto w-full max-w-md">
                <!-- Logo responsive -->
                <div class="lg:hidden flex justify-center mb-8">
                    <img src="{{ asset('images/LogoTrans.png') }}" alt="Logo de RoyList" class="w-27 h-24 block dark:hidden">
                    <img src="{{ asset('images/SoloLogoBlancoBG.png') }}" alt="Logo de RoyList" class="w-27 h-24 hidden dark:block">
                </div>

                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-5 text-center">Inicia sesión</h2>

                    <form class="space-y-5" action="{{ route('loginProcess') }}" method="POST">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Correo electrónico
                            </label>
                            <div class="relative">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 outline-none"
                                    value="{{ old('email') }}">
                                    
                            </div>
                            @if ($errors->has('email'))
                                <p class="text-red-600 text-sm mt-2">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                Contraseña
                            </label>
                            <div class="relative">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 outline-none">
                            </div>
                        </div>

                        <!-- Recuerda y contraseña olvidada -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox"
                                    class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 dark:border-gray-700 rounded">
                                <label for="remember_me" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Recordar sesión
                                </label>
                            </div>

                            <div class="text-sm">
                                <a href="#" class="font-medium text-emerald-600 hover:text-emerald-500">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>

                        <!-- Botón de inicio de sesión -->
                        <div>
                            <button type="submit"
                                class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 rounded-lg text-white font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                Iniciar sesión
                            </button>
                        </div>
                    </form>

                    <div class="mt-6 text-center text-sm text-gray-600 dark:text-gray-300">
                        ¿No tienes una cuenta?
                        <a href="{{ route('register') }}" class="font-medium text-emerald-600 hover:text-emerald-500 ml-1">
                            Regístrate aquí
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

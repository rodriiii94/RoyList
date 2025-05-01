@extends('layouts.app')

@section('title', 'Iniciar sesión - RoyList')

@section('content')

<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">

        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
            Inicia sesión en tu cuenta
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
            ¿No tienes una cuenta?
            <a href="{{ route('register') }}" class="font-medium text-emerald-600 hover:text-emerald-500">
                Regístrate aquí
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Correo electrónico
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    </div>
                </div>

                {{-- Contraseña --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Contraseña
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                    </div>
                </div>

                {{-- Recordar sesión y olvidé contraseña --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox"
                            class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                            Recordar sesión
                        </label>
                    </div>

                    <div class="text-sm">
                        <a {{--href="{{ route('password.request') }}" --}} class="font-medium text-emerald-600 hover:text-emerald-500">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>

                {{-- Botón de inicio de sesión --}}
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Iniciar sesión
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
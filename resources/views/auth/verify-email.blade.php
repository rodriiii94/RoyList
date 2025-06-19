@extends('layouts.app')

@section('title', 'Verificación de Email - RoyList')

@section('content')
<section class="bg-white pt-32 dark:bg-gray-900 pb-20 min-h-[60vh]">
    <div class="container mx-auto px-6 min-h-screen">
        <div class="max-w-2xl mx-auto text-center bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-md rounded-xl p-8">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-4">Verifica tu correo electrónico</h1>
            <p class="text-gray-600 dark:text-gray-300 mb-6">
                Antes de continuar, por favor revisa tu bandeja de entrada y haz clic en el enlace de verificación que te hemos enviado.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-900 text-emerald-800 text-sm rounded-lg p-4 mb-6">
                    Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
                @csrf
                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-300">
                    Reenviar correo de verificación
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit" class="text-sm text-gray-500 dark:text-gray-400 underline hover:text-gray-700 dark:hover:text-gray-300 transition">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app')

@section('title', 'Mi Perfil - RoyList')

@section('content')

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 flex">
        <!-- Columna izquierda con logo y mensaje de perfil -->
        <div class="hidden lg:block relative w-1/2 bg-gradient-to-br from-emerald-50 to-gray-100 dark:from-emerald-900 dark:to-gray-800">
            <div class="absolute inset-0 flex flex-col justify-center items-center p-12">
                <div class="mb-8">
                    <img src="{{ asset('images/LogoTrans.png') }}" alt="Logo de RoyList" class="w-36 h-32 block dark:hidden">
                    <img src="{{ asset('images/SoloLogoBlancoBG.png') }}" alt="Logo de RoyList" class="w-36 h-32 hidden dark:block">
                </div>
                <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mb-4">Tu perfil</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300 text-center max-w-md">
                    Aquí puedes modificar tu información y gestionar tu cuenta de RoyList.
                </p>
            </div>
        </div>

        <!-- Columna derecha con datos y formulario -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center py-12 px-6 mt-10">
            <div class="mx-auto w-full max-w-lg">
                <!-- Logo responsive arriba en móvil -->
                <div class="lg:hidden flex justify-center mb-8 mt-10">
                    <img src="{{ asset('images/LogoTrans.png') }}" alt="Logo de RoyList" class="w-27 h-24 block dark:hidden">
                    <img src="{{ asset('images/SoloLogoBlancoBG.png') }}" alt="Logo de RoyList" class="w-27 h-24 hidden dark:block">
                </div>

                <div class="bg-white dark:bg-gray-800 px-8 py-10 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700">                    <div class="flex flex-col items-center mb-8">
                        <div
                            class="w-24 h-24 rounded-full bg-emerald-100 flex items-center justify-center mb-4">
                            <x-heroicon-o-user class="w-14 h-14 text-emerald-600 dark:text-emerald-400" />
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ auth()->user()->name }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                    </div>

                    @if (session('status'))
                        <div
                            class="mb-6 px-4 py-3 text-base text-emerald-700 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-100 dark:border-emerald-900 rounded-lg flex items-center gap-2">
                            <x-heroicon-m-check-circle class="w-5 h-5 text-emerald-500" />
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('perfil.update') }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nombre</label>
                            <input id="name" name="name" type="text"
                                value="{{ old('name', auth()->user()->name) }}" required
                                class="w-full px-4 py-3 text-base rounded-lg border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 outline-none transition" />
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Correo
                                electrónico</label>
                            <input id="email" name="email" type="email"
                                value="{{ old('email', auth()->user()->email) }}" required
                                class="w-full px-4 py-3 text-base rounded-lg border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 outline-none transition" />
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex justify-center">
                            <button type="submit"
                                class="w-full max-w-xs py-3 text-base font-semibold text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 shadow-sm transition">
                                Guardar cambios
                            </button>
                        </div>
                    </form>

                    <div class="mt-10 pt-8 border-t border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-bold text-red-700 dark:text-red-500 mb-3 flex items-center gap-2">
                            <x-heroicon-m-exclamation-triangle class="w-6 h-6 text-red-500" />
                            Zona peligrosa
                        </h3>
                        <p class="text-sm text-gray-600 mb-5 dark:text-gray-300">
                            Si eliminas tu cuenta, <b>todos tus datos serán borrados</b> de forma permanente. Esta acción
                            <b>no se puede deshacer</b>.
                        </p>
                        <!-- Botón para abrir el modal -->
                        <button type="button" onclick="document.getElementById('deleteModal').classList.remove('hidden')"
                            class="flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-red-600 dark:text-red-500 border border-red-600 dark:border-red-500 rounded-2xl bg-white dark:bg-transparent hover:bg-red-500 hover:text-white hover:shadow-sm hover:scale-[1.01] transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-200">
                            <x-heroicon-m-trash class="w-5 h-5" />
                            Eliminar cuenta
                        </button>


                        <!-- Modal de confirmación -->
                        <div id="deleteModal"
                            class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm bg-white/30 dark:bg-gray-900/60 hidden">
                            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full p-6 animate-fade-in">
                                <h4 class="text-lg font-semibold text-red-700 mb-2 flex items-center gap-2">
                                    <x-heroicon-m-exclamation-triangle class="w-6 h-6 text-red-500" />
                                    Confirmar eliminación
                                </h4>
                                <p class="text-gray-600 dark:text-gray-300 mb-6 text-sm leading-relaxed">
                                    ¿Estás seguro de que deseas eliminar tu cuenta? Esta acción es permanente y no se puede
                                    deshacer.
                                </p>
                                <div class="flex justify-end gap-3">
                                    <button type="button"
                                        onclick="document.getElementById('deleteModal').classList.add('hidden')"
                                        class="px-4 py-2 rounded-xl border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                        Cancelar
                                    </button>
                                    <form method="POST" action="{{ route('perfil.destroy') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 rounded-xl bg-red-600 text-white font-semibold hover:bg-red-700 transition">
                                            Sí, eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

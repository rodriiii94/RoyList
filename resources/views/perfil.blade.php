@extends('layouts.app')

@section('title', 'Mi Perfil - RoyList')

@section('content')

<div class="min-h-screen bg-gray-50 flex">
    <!-- Columna izquierda con logo y mensaje de perfil -->
    <div class="hidden lg:block relative w-1/2 bg-gradient-to-br from-emerald-50 to-gray-100">
        <div class="absolute inset-0 flex flex-col justify-center items-center p-12">
            <div class="mb-8">
                <img src="{{ asset('images/LogoTrans.png') }}" alt="Logo de RoyList" class="w-36 h-32">
            </div>
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Tu perfil</h1>
            <p class="text-lg text-gray-600 text-center max-w-md">
                Aquí puedes modificar tu información y gestionar tu cuenta de RoyList.
            </p>
        </div>
    </div>

    <!-- Columna derecha con datos y formulario -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center py-12 px-6">
        <div class="mx-auto w-full max-w-lg">
            <!-- Logo responsive arriba en móvil -->
            <div class="lg:hidden flex justify-center mb-8">
                <img src="{{ asset('images/LogoTrans.png') }}" alt="Logo de RoyList" class="w-27 h-24">
            </div>

            <div class="bg-white px-8 py-10 rounded-2xl shadow-xl border border-gray-100">
                <div class="flex flex-col items-center mb-8">
                    <div class="w-24 h-24 rounded-full bg-emerald-100 flex items-center justify-center mb-4 ring-4 ring-white shadow">
                        <x-heroicon-m-user class="w-14 h-14 text-emerald-600" />
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ auth()->user()->name }}</h2>
                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                </div>
                
                @if(session('status'))
                    <div class="mb-6 px-4 py-3 text-base text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-lg flex items-center gap-2">
                        <x-heroicon-m-check-circle class="w-5 h-5 text-emerald-500" />
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('perfil.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nombre</label>
                        <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required
                            class="w-full px-4 py-3 text-base rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 outline-none transition" />
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Correo electrónico</label>
                        <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required
                            class="w-full px-4 py-3 text-base rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 outline-none transition" />
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

                <div class="mt-10 pt-8 border-t border-gray-100">
                    <h3 class="text-lg font-bold text-red-700 mb-3 flex items-center gap-2">
                        <x-heroicon-m-exclamation-triangle class="w-6 h-6 text-red-500" />
                        Zona peligrosa
                    </h3>
                    <p class="text-sm text-gray-600 mb-5">
                        Si eliminas tu cuenta, <b>todos tus datos serán borrados</b> de forma permanente. Esta acción <b>no se puede deshacer</b>.
                    </p>
                    <form method="POST" action="{{ route('perfil.destroy') }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center gap-2 px-5 py-2.5 text-base font-medium text-red-600 border border-red-600 rounded-lg hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-200 transition">
                            <x-heroicon-m-trash class="w-5 h-5" />
                            Eliminar cuenta
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

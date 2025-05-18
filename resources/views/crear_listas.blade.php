@extends('layouts.app')

@section('title', 'Crear nueva lista - RoyList')

@section('content')

    <div class="min-h-screen bg-gray-50 flex items-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md mx-auto">
            {{-- Encabezado compacto --}}
            <div class="text-center mb-8">
                <svg class="mx-auto h-10 w-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h2 class="mt-4 text-2xl font-bold text-gray-900">Crear nueva lista</h2>
            </div>

            {{-- Tarjeta del formulario --}}
            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <form class="space-y-5" action="{{ route('listas_create') }}" method="POST">
                        @csrf

                        {{-- Campo Nombre --}}
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                            <input type="text" id="nombre" name="nombre" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                placeholder="Ej: Compras semanales">
                        </div>

                        {{-- Selector de Supermercado --}}
                        <div>
                            <label for="supermercado_id" class="block text-sm font-medium text-gray-700 mb-1">Supermercado</label>
                            <select id="supermercado_id" name="supermercado_id" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                                <option value="" disabled selected>Selecciona una opción</option>

                                {{-- ForEach de los supermercados --}}
                                @foreach ($supermercados as $supermercado)
                                    <option value="{{ $supermercado->id }}">{{ $supermercado->getNombre() }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Botones de acción --}}
                        <div class="flex justify-end space-x-3 pt-2">
                            <a href="{{ route('index') }}"
                                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Crear lista
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

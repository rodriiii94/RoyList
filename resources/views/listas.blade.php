@extends('layouts.app')

@section('title', 'Mis Listas de Compra - RoyList')

@section('content')

    <section class="bg-white py-8 min-h-screen dark:bg-gray-900">
        <div class="container mx-auto px-6 mt-14">
            {{-- Encabezado --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">Mis Listas de Compra</h1>
                    <p class="text-gray-600 dark:text-gray-300">Administra tus listas de compra en diferentes supermercados</p>
                </div>
                <a href="{{ route('showCrearLista') }}"
                    class="mt-4 md:mt-0 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg font-semibold shadow-sm transition duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nueva Lista
                </a>
            </div>

            {{-- Listas --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($listas as $lista)
                    <div id="{{ $lista->id }}"
                        class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm hover:shadow-md transition duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $lista->nombre }}</h2>

                                {{-- ! Colores para futuros supermercados --}}
                                @php
                                    $color = [
                                        'Mercadona' => 'bg-green-100 text-green-800',
                                        'Ahorra Más' => 'bg-orange-100 text-orange-800',
                                        'Lidl' => 'bg-yellow-100 text-yellow-800',
                                        'Aldi' => 'bg-indigo-100 text-indigo-800',
                                        'Dia' => 'bg-red-100 text-red-800',
                                        'Carrefour' => 'bg-purple-100 text-purple-800',
                                    ];
                                    $supermercadoNombre = $lista->supermercado->nombre ?? 'Desconocido';
                                    $colorClass = $color[$supermercadoNombre] ?? 'bg-gray-100 text-gray-800';
                                @endphp

                                {{-- ! Mostrar el nombre del supermercado con colores --}}
                                <span
                                    class="inline-block {{ $colorClass }} text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ $supermercadoNombre }}
                                </span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                {{ $productos[$lista->id] ?? 0 }} productos en la lista
                            </p>
                            <div class="flex justify-between items-center text-sm text-gray-500 dark:text-gray-400">
                                <span>Creada: {{ $lista->updated_at->format('d/m/Y') }}</span>
                                <div class="flex space-x-2">
                                    <a href="{{ route('lista_compra', $lista->id) }}">
                                        <button class="text-gray-400 hover:text-emerald-600 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </button>
                                    </a>
                                    <form action="{{ route('borrarLista', $lista->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-red-600 transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-3 border-t border-gray-100 dark:border-gray-600">
                            <a href="{{ route('lista_compra', $lista->id) }}"
                                class="text-emerald-500 hover:text-emerald-600 font-medium flex items-center justify-between transition duration-100">
                                Ver lista completa
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach

                {{-- Nueva Lista --}}
                <div
                    class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl hover:border-emerald-400 transition duration-300">
                    <a href="{{ route('showCrearLista') }}"
                        class="h-full flex flex-col items-center justify-center p-8 text-center">
                        <svg class="w-10 h-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300">Crear nueva lista</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Comienza desde cero</p>
                    </a>
                </div>
            </div>
        </div>
    </section>


@endsection

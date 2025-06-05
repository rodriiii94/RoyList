@extends('layouts.app')

@section('title', 'Productos - RoyList')

@section('content')
    <section class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-6xl mx-auto px-6 mt-16">
            <!-- Encabezado mejorado -->
            <div class="bg-white p-6 rounded-xl shadow-md mb-6 relative">
                <div class="flex items-start gap-4">
                    <!-- Botón de volver atrás -->
                    <a href="{{ route('listas') }}"
                        class="flex items-center justify-center p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200 text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>

                    <!-- Contenido del encabezado -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $lista->nombre }}</h2>
                        <div class="flex items-center mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <p class="text-base text-gray-500">{{ $lista->supermercado->nombre }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs estilo profesional -->
            <div class="bg-white rounded-xl shadow-sm p-2 mb-6 flex justify-center space-x-4">
                <button id="tab-productos" onclick="showTab('productos')"
                    class="w-1/2 py-3 text-base font-semibold rounded-lg transition duration-200 ease-in-out
                text-green-700 bg-green-100 shadow-inner focus:outline-none">
                    Mis productos
                </button>
                <button id="tab-api" onclick="showTab('api')"
                    class="w-1/2 py-3 text-base font-semibold rounded-lg transition duration-200 ease-in-out
                text-gray-600 hover:text-green-700 hover:bg-green-50 focus:outline-none">
                    Añadir productos
                </button>
            </div>

            <!-- Contenido: Mis productos -->
            <div id="tab-content-productos" class="space-y-4">
                @if ($lista->productos->isEmpty())
                    <div class="text-center py-10 bg-white rounded-xl shadow-sm">
                        <p class="text-gray-500">No hay productos en esta lista.</p>
                    </div>
                @else
                    <div class="mt-6">
                        <p class="text-sm text-gray-500">Total:
                            <span class="font-bold text-3xl text-emerald-600">
                                {{ $lista->productos->sum(function ($producto) {
                                    return $producto->precio ? $producto->precio * ($producto->cantidad ?? 1) : 0;
                                }) }}
                                €
                            </span>
                        </p>
                    </div>
                    @foreach ($lista->productos as $producto)
                        <div class="flex items-center justify-between bg-white p-5 rounded-xl shadow-sm">
                            <div class="flex items-start gap-4">
                                @if ($producto->imagen)
                                    <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre_producto }}"
                                        class="w-16 h-16 object-cover rounded">
                                @endif
                                <div>

                                    <p class="text-lg font-medium text-gray-800">{{ $producto->nombre_producto }}</p>

                                    @if ($producto->cantidad > 1)
                                        <p class="text-sm text-gray-500">Cantidad: {{ $producto->cantidad }}</p>
                                    @endif

                                    @if ($producto->notas)
                                        <p class="text-sm text-gray-400 italic"><b class="text-gray-500">Notas:</b>
                                            {{ $producto->notas }}</p>
                                    @endif

                                    @if ($producto->precio)
                                        <p class="text-sm text-emerald-600 font-bold mt-1">{{ $producto->precio }} €</p>
                                    @endif
                                </div>
                            </div>

                            <form
                                action="{{ route('productos.destroy', ['id' => $lista->id, 'productoId' => $producto->id]) }}"
                                method="POST">
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
                    @endforeach
                @endif
            </div>



            <!-- Contenido: Explorar productos -->
            <div id="tab-content-api" class="space-y-8">
                <!-- Buscador y selección de categoría -->
                <div class="mb-4">
                    <div class="flex flex-col md:flex-row md:items-end md:gap-4">
                        <!-- Select de categoría -->
                        <div class="w-full md:w-1/2">
                            <label for="categoriaSelect" class="block font-bold text-lg mb-2">Selecciona una
                                categoría:</label>
                            <select id="categoriaSelect"
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:border-emerald-500">
                                <option disabled selected>Cargando categorías...</option>
                            </select>
                        </div>

                        <!-- Input de búsqueda -->
                        <div class="w-full md:w-1/2 mt-4 md:mt-0">
                            <label for="buscadorInput" class="block font-bold text-lg mb-2">Buscar productos:</label>
                            <input type="text" id="buscadorInput" placeholder="Escribe el nombre de un producto..."
                                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:border-emerald-500" />
                        </div>
                    </div>
                </div>

                <!-- Contenedor de productos -->
                <div id="productosContainer" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"></div>

                <!-- Loader -->
                <div id="loader" class="text-center hidden">
                    <p class="text-gray-500">Cargando productos...</p>
                </div>
            </div>

        </div>

        <!-- Modal para añadir producto: cantidad y notas -->
        <div id="modalNota"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden backdrop-blur-sm px-4 py-6">
            <div
                class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-auto border border-gray-100 overflow-hidden transform transition-all">
                <!-- Header -->
                <div class="border-b border-gray-100 px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">Añadir producto</h2>
                </div>

                <!-- Contenido -->
                <div class="p-6 space-y-5">
                    <!-- Campo Cantidad -->
                    <div class="space-y-2">
                        <label for="cantidadInput" class="block text-sm font-medium text-gray-700">Cantidad</label>
                        <input type="number" id="cantidadInput" min="1" value="1"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>

                    <!-- Campo Notas -->
                    <div class="space-y-2">
                        <label for="notaInput" class="block text-sm font-medium text-gray-700">Notas</label>
                        <textarea id="notaInput" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none"
                            placeholder="Ej: Solo si está en oferta..."></textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                    <div class="flex justify-end gap-3">
                        <button id="cancelarNota"
                            class="px-5 py-2.5 text-gray-600 hover:text-gray-800 font-medium transition-colors">
                            Cancelar
                        </button>
                        <button id="guardarNota"
                            class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    {{-- Obtener el id de la lista para poder usarlo en js/buscadorProd.js --}}
    <script>
        window.LISTA_ID = {{ $lista->id }};
    </script>
@endsection

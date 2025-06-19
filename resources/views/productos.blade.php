@extends('layouts.app')

@section('title', 'Productos - RoyList')

@section('content')
    <section class="bg-gray-50 dark:bg-gray-900 min-h-screen py-12">
        <div class="max-w-6xl mx-auto px-6 mt-16">
            <!-- Encabezado -->
            <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-6 rounded-xl shadow-md mb-6 relative">
                <div class="flex items-start gap-4">
                    <!-- Botón de volver atrás -->
                    <a href="{{ route('listas') }}"
                        class="flex items-center justify-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>

                    <!-- Contenido del encabezado -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $lista->nombre }}</h2>
                        <div class="flex items-center mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 dark:text-gray-500 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <p class="text-base text-gray-500 dark:text-gray-400">{{ $lista->supermercado->nombre }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if (strtolower($lista->supermercado->nombre) !== 'mercadona')
                <div class="mb-6">
                    <div class="flex items-center bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-400 dark:border-yellow-700 p-4 rounded-xl shadow-sm">
                        <svg class="w-8 h-8 md:w-6 md:h-6 text-yellow-400 dark:text-yellow-300 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        <span class="text-yellow-800 dark:text-yellow-100 text-base">
                            El catálogo de este supermercado está en proceso. Pronto estarán disponibles los productos. Mientras tanto, puedes añadir productos personalizados.
                        </span>
                    </div>
                </div>
            @endif

            <!-- Tabs -->
            <div class="bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm p-2 mb-6 flex justify-center space-x-4">
                <button id="tab-productos" onclick="showTab('productos')"
                    class="w-1/2 py-3 text-base font-semibold rounded-lg transition duration-200 ease-in-out
                text-green-700 dark:text-green-400 bg-green-100 dark:bg-gray-700 shadow-inner dark:shadow-none focus:outline-none">
                    Mis productos
                </button>
                <button id="tab-api" onclick="showTab('api')"
                    class="w-1/2 py-3 text-base font-semibold rounded-lg transition duration-200 ease-in-out
                text-gray-600 dark:text-gray-300 hover:text-green-700 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-gray-700 focus:outline-none">
                    Añadir productos
                </button>
            </div>

            <!-- Contenido: Mis productos -->
            <div id="tab-content-productos" class="space-y-4">
                @if ($lista->productos->isEmpty())
                    <div class="text-center py-10 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl shadow-sm">
                        <p class="text-gray-500 dark:text-gray-400">No hay productos en esta lista.</p>
                    </div>
                @else
                    @if (strtolower($lista->supermercado->nombre) === 'mercadona')
                        <div class="mt-6">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Total:
                                <span class="font-bold text-3xl text-emerald-600 dark:text-emerald-400 dark:text-emerald-400">
                                    {{ $lista->productos->sum(function ($producto) {
                                        return $producto->precio ? $producto->precio * ($producto->cantidad ?? 1) : 0;
                                    }) }}
                                    €
                                </span>
                            </p>
                        </div>
                    @endif
                    @foreach ($lista->productos as $producto)
                        <div class="flex items-center justify-between bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-5 rounded-xl shadow-sm">
                            <div class="flex items-start gap-4">
                                @if ($producto->imagen)
                                    <img src="{{ $producto->imagen }}" alt="{{ $producto->nombre_producto }}"
                                        class="w-16 h-16 object-cover rounded">
                                @endif
                                <div>

                                    <p class="text-lg font-medium text-gray-800 dark:text-gray-100">{{ $producto->nombre_producto }}</p>

                                    @if ($producto->cantidad > 1)
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Cantidad: {{ $producto->cantidad }}</p>
                                    @endif

                                    @if ($producto->notas)
                                        <p class="text-sm text-gray-400 dark:text-gray-500 italic"><b class="text-gray-500 dark:text-gray-400">Notas:</b>
                                            {{ $producto->notas }}</p>
                                    @endif

                                    @if ($producto->precio)
                                        <p class="text-sm text-emerald-600 dark:text-emerald-400 font-bold mt-1">{{ $producto->precio }} €</p>
                                    @endif
                                </div>
                            </div>

                            <form
                                action="{{ route('productos.destroy', ['id' => $lista->id, 'productoId' => $producto->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 dark:text-gray-500 hover:text-red-600 transition">
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
                        <button id="btn-personalizado"
                            class="px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl hover:from-emerald-600 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-offset-2 focus:ring-offset-white/90dark:focus:ring-offset-gray-900shadow-md hover:shadow-emerald-200/50 transition-all duration-300 ease-in-out flex items-center gap-2 group">
                            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span class="group-hover:translate-x-1 transition-transform duration-200 text-base">Añadir
                                producto
                                personalizado</span>
                        </button>
                    </div>
                </div>

                @if (strtolower($lista->supermercado->nombre) === 'mercadona')
                    <!-- Buscador y selección de categoría -->
                    <div class="mb-4">
                        <div class="flex flex-col md:flex-row md:items-end md:gap-4">
                            <!-- Select de categoría -->
                            <div class="w-full md:w-1/2">
                                <label for="categoriaSelect" class="block font-bold text-lg mb-2 dark:text-gray-300">Selecciona una
                                    categoría:</label>
                                <select id="categoriaSelect"
                                    class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:border-emerald-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
                                    <option disabled selected>Cargando categorías...</option>
                                </select>
                            </div>

                            <!-- Input de búsqueda -->
                            <div class="w-full md:w-1/2 mt-4 md:mt-0">
                                <label for="buscadorInput" class="block font-bold text-lg mb-2 dark:text-gray-300">Buscar productos:</label>
                                <input type="text" id="buscadorInput" placeholder="Escribe el nombre de un producto..."
                                    class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:border-emerald-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" />
                            </div>
                        </div>
                    </div>

                    <!-- Contenedor de productos -->
                    <div id="productosContainer" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"></div>

                    <!-- Loader -->
                    <div id="loader" class="text-center hidden">
                        <p class="text-gray-500 dark:text-gray-400">Cargando productos...</p>
                    </div>
                @endif
            </div>

        </div>

        <!-- Modal para añadir producto: cantidad y notas -->
        <div id="modalNota"
            class="fixed inset-0 bg-white/30 dark:bg-gray-900/60 flex items-center justify-center z-50 hidden backdrop-blur-sm px-4 py-6">
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-md mx-auto border border-gray-100 dark:border-gray-700 overflow-hidden transform transition-all">
                <!-- Header -->
                <div class="border-b border-gray-100 dark:border-gray-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Añadir producto</h2>
                </div>

                <!-- Contenido -->
                <div class="p-6 space-y-5">
                    <!-- Campo Cantidad -->
                    <div class="space-y-2">
                        <label for="cantidadInput" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad</label>
                        <input type="number" id="cantidadInput" min="1" value="1"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>

                    <!-- Campo Notas -->
                    <div class="space-y-2">
                        <label for="notaInput" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notas</label>
                        <textarea id="notaInput" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none"
                            placeholder="Ej: Solo si está en oferta..."></textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex justify-end gap-3">
                        <button id="cancelarNota"
                            class="px-5 py-2.5 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100 font-medium transition-colors">
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

        <!-- Modal para producto personalizado -->
        <div id="modalPersonalizado"
            class="fixed inset-0 bg-white/30 dark:bg-gray-900/60 flex items-center justify-center z-50 hidden backdrop-blur-sm px-4 py-6">
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-md mx-auto border border-gray-100 dark:border-gray-700 overflow-hidden transform transition-all">
                <div class="border-b border-gray-100 dark:border-gray-700 px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Añadir producto personalizado</h2>
                </div>

                <div class="p-6 space-y-5">
                
                    {{-- Nombre --}}
                    <div class="space-y-2">
                        <label for="nombrePersonalizado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                        <input type="text" id="nombrePersonalizado"
                        class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                        <p id="obligatorio" class="text-xs text-red-400 hidden">Obligatorio</p>
                    </div>

                    {{-- Precio --}}
                    <div class="space-y-2">
                        <label for="precioPersonalizado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Precio
                            (€)</label>
                        <input type="number" step="0.01" id="precioPersonalizado"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>

                    {{-- Cantidad --}}
                    <div class="space-y-2">
                        <label for="cantidadPersonalizado"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cantidad</label>
                        <input type="number" id="cantidadPersonalizado" min="1" value="1"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                    </div>

                    {{-- Notas --}}
                    <div class="space-y-2">
                        <label for="notaPersonalizado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Notas</label>
                        <textarea id="notaPersonalizado" rows="3"
                            class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 dark:bg-gray-800 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all resize-none"></textarea>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                    <div class="flex justify-end gap-3">
                        <button id="cancelarPersonalizado"
                            class="px-5 py-2.5 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100 font-medium transition-colors">
                            Cancelar
                        </button>
                        <button id="guardarPersonalizado"
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

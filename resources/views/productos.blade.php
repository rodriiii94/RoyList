@extends('layouts.app')

@section('title', 'Productos - RoyList')

@section('content')
    <section class="bg-gray-50 min-h-screen py-12">
        <div class="max-w-6xl mx-auto px-6 mt-16">
            <!-- Encabezado -->
            <div class="bg-white p-6 rounded-xl shadow-md mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Lista: {{ $lista->nombre }} </h2>
                <p class="text-base text-gray-500">{{ $lista->supermercado->nombre }}</p>
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
                    @foreach ($lista->productos as $producto)
                        <div class="flex items-center justify-between bg-white p-5 rounded-xl shadow-sm">
                            <div class="flex items-start gap-4">
                                <input type="checkbox" class="mt-1 accent-green-600 w-5 h-5" />
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
                                </div>
                            </div>

                            <form
                                action="{{ route('productos.destroy', ['id' => $producto->id, 'productoId' => $producto->id]) }}"
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
                <!-- Filtro por categoría -->
                <div class="mb-6">
                    <label for="filtroCategoria" class="block text-sm font-medium text-gray-700 mb-1">Filtrar por
                        categoría:</label>
                    <select id="filtroCategoria" onchange="filtrarCategoria()"
                        class="w-full sm:w-64 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                        <option value="todas">Todas</option>
                        @foreach ($productosPorCategoria as $categoria => $productos)
                            <option value="{{ Str::slug($categoria) }}">{{ $categoria }}</option>
                        @endforeach
                    </select>
                </div>
                @foreach ($productosPorCategoria as $categoria => $productos)
                    <div class="categoria-section" data-categoria="{{ Str::slug($categoria) }}">
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">{{ $categoria }}</h2>

                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-6">
                                @foreach ($productos as $producto)
                                    <div
                                        class="bg-gray-50 hover:bg-white p-4 rounded-xl shadow transition duration-200 flex flex-col items-center text-center">
                                        @if (!empty($producto['imagen']))
                                            <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}"
                                                class="w-24 h-24 object-cover rounded mb-3 shadow-sm border border-gray-100">
                                        @else
                                            <div
                                                class="w-24 h-24 bg-gray-200 rounded mb-3 flex items-center justify-center text-gray-400">
                                                <span class="text-xs">Sin imagen</span>
                                            </div>
                                        @endif

                                        <h3 class="text-sm font-semibold text-gray-700">{{ $producto['nombre'] }}</h3>

                                        @if (!empty($producto['precio']))
                                            <p class="text-green-600 font-bold text-sm mt-1">{{ $producto['precio'] }} €
                                            </p>
                                        @endif

                                        <div class="flex flex-col gap-1 mt-2">
                                            @if (!empty($producto['url']))
                                                <a href="{{ $producto['url'] }}" target="_blank"
                                                    class="text-blue-500 text-xs underline hover:text-blue-700">
                                                    Ver más
                                                </a>
                                            @endif

                                            <form action="{{-- {{ route('lista.agregar') }} --}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="nombre" value="{{ $producto['nombre'] }}">
                                                <input type="hidden" name="precio" value="{{ $producto['precio'] }}">
                                                <input type="hidden" name="url" value="{{ $producto['url'] }}">
                                                <button type="submit"
                                                    class="mt-1 text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-xs shadow">
                                                    Añadir a la lista
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </section>

    <script>
        function showTab(tab) {
            const productosTab = document.getElementById('tab-content-productos');
            const sugeridosTab = document.getElementById('tab-content-api');
            const btnProductos = document.getElementById('tab-productos');
            const btnSugeridos = document.getElementById('tab-api');

            if (tab === 'productos') {
                productosTab.classList.remove('hidden');
                sugeridosTab.classList.add('hidden');

                btnProductos.classList.add('text-green-700', 'bg-green-100', 'shadow-inner');
                btnSugeridos.classList.remove('text-green-700', 'bg-green-100', 'shadow-inner');
            } else {
                productosTab.classList.add('hidden');
                sugeridosTab.classList.remove('hidden');

                btnSugeridos.classList.add('text-green-700', 'bg-green-100', 'shadow-inner');
                btnProductos.classList.remove('text-green-700', 'bg-green-100', 'shadow-inner');

                // Cargar productos sugeridos solo una vez
                if (!window.productosSugeridosCargados) {
                    const listaId = {{ $lista->id }};
                    fetch(`/api/productos-sugeridos/${listaId}`)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('contenido-sugeridos').innerHTML = html;
                            window.productosSugeridosCargados = true;
                        })
                        .catch(error => {
                            document.getElementById('contenido-sugeridos').innerHTML =
                                '<p>Error al cargar productos sugeridos.</p>';
                            console.error(error);
                        });
                }
            }
        }

        function filtrarCategoria() {
            const seleccionada = document.getElementById('filtroCategoria').value;
            const secciones = document.querySelectorAll('.categoria-section');

            secciones.forEach(section => {
                if (seleccionada === 'todas' || section.dataset.categoria === seleccionada) {
                    section.classList.remove('hidden');
                } else {
                    section.classList.add('hidden');
                }
            });
        }
    </script>

@endsection

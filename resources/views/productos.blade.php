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
                <!-- Buscador y selección de categoría -->
                <div class="mb-4">
                    <label for="categoriaSelect" class="block font-bold text-lg mb-2">Selecciona una categoría:</label>
                    <select id="categoriaSelect" class="w-full border rounded px-4 py-2">
                        <option disabled selected>Cargando categorías...</option>
                    </select>
                </div>

                <!-- Contenedor de productos -->
                <div id="productosContainer" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"></div>

                <!-- Loader -->
                <div id="loader" class="text-center hidden">
                    <p class="text-gray-500">Cargando productos...</p>
                </div>
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

        document.addEventListener('DOMContentLoaded', () => {
            const categoriaSelect = document.getElementById('categoriaSelect');
            const productosContainer = document.getElementById('productosContainer');
            const loader = document.getElementById('loader');

            // Cargar categorías
            fetch('/productos/categorias')
                .then(res => res.json())
                .then(categorias => {
                    categoriaSelect.innerHTML = '<option disabled selected>Selecciona una categoría</option>';
                    categorias.forEach(cat => {
                        const opt = document.createElement('option');
                        opt.value = cat;
                        opt.textContent = cat;
                        categoriaSelect.appendChild(opt);
                    });
                });

            // Cargar productos cuando se selecciona una categoría
            categoriaSelect.addEventListener('change', () => {
                const categoria = categoriaSelect.value;
                productosContainer.innerHTML = '';
                loader.classList.remove('hidden');

                fetch(`/productos/por-categoria?categoria=${encodeURIComponent(categoria)}`)
                    .then(res => {
                        // console.log('Respuesta:' res);
                        return res.json()
                    })
                    .then(productos => {
                        console.log('Productos recibidos:', productos);
                        loader.classList.add('hidden');
                        productosContainer.innerHTML = productos.map(prod => `
                    <div class="bg-white p-4 rounded shadow flex flex-col items-center">
                        ${prod.imagen ? `<img src="${prod.imagen}" alt="${prod.nombre}" class="w-24 h-24 object-cover rounded mb-2">` : ''}
                        <h3 class="text-sm font-semibold text-center">${prod.nombre}</h3>
                        ${prod.precio ? `<p class="text-green-600 font-bold mt-1">${prod.precio} €</p>` : ''}
                        ${prod.url ? `<a href="${prod.url}" target="_blank" class="text-blue-500 text-sm mt-2 underline">Ver más</a>` : ''}
                    </div>
                `).join('');
                    })
                    .catch(error => {
                        console.error('Error al cargar productos:', error);
                        loader.classList.add('hidden');
                    });
            });
        });

        document.getElementById('categoriaSelect').addEventListener('change', function() {
            const categoria = this.value;

            fetch(`/productos/por-categoria?categoria=${encodeURIComponent(categoria)}`)
                .then(response => response.json())
                .then(data => {
                    const contenedor = document.getElementById('contenedorProductos');
                    contenedor.innerHTML = '';

                    data.forEach(producto => {
                        const div = document.createElement('div');
                        div.innerHTML = `
                    <div class="bg-white p-4 rounded shadow text-center">
                        ${producto.imagen ? `<img src="${producto.imagen}" class="w-24 h-24 mx-auto mb-2" />` : ''}
                        <h3 class="text-sm font-semibold">${producto.nombre}</h3>
                        ${producto.precio ? `<p class="text-green-600 font-bold mt-1">${producto.precio} €</p>` : ''}
                        ${producto.url ? `<a href="${producto.url}" target="_blank" class="text-blue-500 text-sm mt-2 underline">Ver más</a>` : ''}
                    </div>`;
                        contenedor.appendChild(div);
                    });
                });
        });
    </script>

@endsection

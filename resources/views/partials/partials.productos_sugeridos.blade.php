@foreach ($productosPorCategoria as $categoria => $productos)
    <div class="mb-6">
        <h2 class="text-xl font-bold mb-2">{{ $categoria }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($productos as $producto)
                <div class="bg-white p-4 rounded shadow flex flex-col items-center">
                    @if ($producto['imagen'])
                        <img src="{{ $producto['imagen'] }}" alt="{{ $producto['nombre'] }}"
                            class="w-24 h-24 object-cover rounded mb-2">
                    @endif
                    <h3 class="text-sm font-semibold text-center">{{ $producto['nombre'] }}</h3>
                    @if ($producto['precio'])
                        <p class="text-green-600 font-bold mt-1">{{ $producto['precio'] }} €</p>
                    @endif
                    @if ($producto['url'])
                        <a href="{{ $producto['url'] }}" target="_blank"
                            class="text-blue-500 text-sm mt-2 underline">Ver más</a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endforeach

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ListaCompra;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ProductoLista extends Model
{
    protected $fillable = [
        'lista_compra_id',
        'nombre_producto',
        'cantidad',
        'notas',
        'imagen'
    ];

    protected $table = 'producto_lista';

    public function listaDeCompra()
    {
        return $this->belongsTo(ListaCompra::class);
    }

    /**
     * Obtiene todos los productos asociados a una lista de compra específica.
     *
     * @param int $listaId El ID de la lista de compra.
     * @return \Illuminate\Database\Eloquent\Collection Colección de productos pertenecientes a la lista.
     */
    public function obtenerProductos($listaId)
    {
        return self::where('lista_compra_id', $listaId)->get();
    }

    /**
     * Cuenta la cantidad de productos asociados a una lista de compra específica.
     *
     * @param int $listaId El ID de la lista de compra.
     * @return int El número de productos en la lista de compra.
     */
    public static function contarProductos($listaId)
    {
        return self::where('lista_compra_id', $listaId)->count();
    }

    /**
     * Elimina un producto de la base de datos según su ID.
     *
     * @param  int  $productoId  El identificador único del producto a eliminar.
     * @return int  El número de registros eliminados (0 o 1).
     */
    public function eliminarProducto($productoId)
    {
        return self::destroy($productoId);
    }

    /**
     * Obtiene y agrupa productos por categoría desde una API externa.
     *
     * Este método realiza una petición HTTP para obtener una lista global de productos,
     * luego para cada producto obtiene su detalle y lo agrupa según la primera categoría disponible.
     * Si no se encuentra una categoría, se agrupa bajo 'Sin categoría'.
     *
     * @return array Un array asociativo donde las claves son los nombres de las categorías y los valores son arrays de productos.
     */
    public static function obtenerProductosAgrupadosPorCategoria()
    {
        // Cachea durante 1 hora (3600 segundos) con una clave única
        return Cache::remember('productos_api_agrupados', 3600, function () {
            $apiBase = config('api.url');
            $response = Http::get("{$apiBase}/data");

            if (!$response->ok()) {
                return [];
            }

            $productosGlobales = $response->json();
            $productosAgrupados = [];

            foreach ($productosGlobales as $producto) {
                $id = $producto['id'];

                $detalleResponse = Http::get("{$apiBase}/products/{$id}");

                if (!$detalleResponse->ok()) {
                    continue;
                }

                $detalle = $detalleResponse->json();

                $categoria = $detalle['product']['categories'][0]['name']['value'] ?? 'Sin categoría';

                $productosAgrupados[$categoria][] = [
                    'nombre'  => $detalle['product']['display_name']['value'] ?? 'Producto sin nombre',
                    'imagen'  => $detalle['product']['thumbnail']['value'] ?? null,
                    'precio'  => $detalle['product']['price_instructions']['unit_price']['value'] ?? null,
                    'url'     => $detalle['product']['share_url']['value'] ?? null,
                ];
            }

            return $productosAgrupados;
        });
    }
}

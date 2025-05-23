<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoLista;

class ProductoLista_Controller extends Controller
{

    public function eliminarProducto(Request $request, $id, $productoId)
    {
        // Validar el ID del producto
        $request->validate([
            'productoId' => 'required|exists:producto_lista,id',
        ]);

        // Eliminar el producto de la lista
        $productoLista = new ProductoLista();
        $productoLista->eliminarProducto($productoId);

        // Redirigir a la vista de la lista de compra
        return redirect()->route('lista_compra', ['id' => $id])->with('success', 'Producto eliminado de la lista.');
    }

    // Obtener el conteo de productos de una lista
    public static function contarProductos($listaId)
    {
        $productos = ProductoLista::contarProductos($listaId);
        return view('listas', compact('productos'));
    }

    // Muestra los productos de la API
    public function mostrarProductos()
    {
        $productosPorCategoria = ProductoLista::obtenerProductosAgrupadosPorCategoria();
        return $productosPorCategoria;
    }

    /**
     * Obtiene las categorías disponibles para los productos.
     *
     * Este método utiliza el modelo ProductoLista para obtener las categorías
     * disponibles y devuelve una respuesta JSON con la lista de categorías.
     *
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con las categorías disponibles.
     */
    public function obtenerCategorias()
    {
        $productosAgrupados = ProductoLista::obtenerProductosAgrupadosPorCategoria();
        $categorias = array_keys($productosAgrupados);
        return response()->json($categorias);
    }

    /**
     * Obtiene los productos de la lista de compra filtrados por una categoría específica.
     *
     * Este método recibe una solicitud HTTP con el parámetro 'categoria' y retorna
     * un listado de productos que pertenecen a dicha categoría. Si no se especifica
     * la categoría, retorna un error 400.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP entrante que contiene el parámetro 'categoria'.
     * @return \Illuminate\Http\JsonResponse      Respuesta JSON con los productos filtrados o un mensaje de error.
     */
    public function obtenerPorCategoria(Request $request)
    {
        $categoria = $request->query('categoria');

        if (!$categoria) {
            return response()->json(['error' => 'Categoría no especificada'], 400);
        }

        $productos = ProductoLista::obtenerProductosPorCategoria($categoria);
        return response()->json($productos);
    }
}

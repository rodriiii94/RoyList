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
}

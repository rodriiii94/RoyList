<?php

namespace App\Http\Controllers;

use App\Models\ListaCompra;
use App\Models\ProductoLista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ListaCompra_Controller extends Controller
{

    private $user_id;

    public function __construct()
    {
        $this->user_id = FacadesAuth::id();
    }

    public function showListView()
    {
        return view('listas');
    }

    /**
     * Crea una nueva lista de compra para el usuario autenticado.
     *
     * Valida los datos recibidos en la solicitud, crea una nueva instancia de ListaCompra
     * y la guarda utilizando el método crearLista. Posteriormente, redirige a la vista de listas
     * de compra mostrando un mensaje de éxito.
     *
     * @param  \Illuminate\Http\Request  $request  Solicitud HTTP con los datos de la lista de compra.
     * @return \Illuminate\Http\RedirectResponse   Redirección a la ruta 'listas' con mensaje de éxito.
     */
    public function create(Request $request)
    {
        $supermercado = $request->input('supermercado_id');
        $nombre = $request->input('nombre');

        // Validar los datos de la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255',
            'supermercado_id' => 'required|exists:supermercados,id',
        ]);

        // Crear una nueva lista de compra
        $listaCompra = new ListaCompra();
        $listaCompra->crearLista($this->user_id, $supermercado, $nombre);

        // Redirigir a la vista de listas de compra
        return redirect()->route('listas')->with('success', 'Lista de compra creada con éxito.');
    }

    /**
     * Obtiene todas las listas de compra asociadas al usuario actual y cuenta la cantidad de productos en cada una.
     *
     * Recupera las listas de compra del usuario utilizando el modelo ListaCompra y, para cada lista,
     * calcula el número de productos asociados. Luego, retorna la vista 'listas' con las listas y el conteo de productos.
     *
     * @return \Illuminate\View\View Vista que muestra las listas de compra y la cantidad de productos por lista.
     */
    public function getListas()
    {
        $listaCompra = new ListaCompra();
        $listas = $listaCompra->obtenerListas($this->user_id);
        $productos = [];

        foreach ($listas as $lista) {
            $productos[$lista->id] = $this->contarProductos($lista->id);
        }

        return view('listas', compact('listas', 'productos'));
    }

    /**
     * Cuenta la cantidad de productos asociados a una lista de compra específica.
     *
     * @param int $id El identificador de la lista de compra.
     * @return int Número de productos en la lista de compra.
     */
    public function contarProductos($id)
    {
        $productoLista = new ProductoLista();
        $productos = $productoLista->contarProductos($id);
        return $productos;
    }


    /**
     * Elimina una lista de compra por su identificador.
     *
     * Este método crea una nueva instancia de ListaCompra y llama al método borrarLista
     * pasando el ID proporcionado para eliminar la lista correspondiente. Después de la eliminación,
     * redirige al usuario a la ruta 'listas' mostrando un mensaje de éxito.
     *
     * @param int $id Identificador de la lista de compra a eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirección a la vista de listas con mensaje de éxito.
     */
    public function borrarLista($id)
    {
        $listaCompra = new ListaCompra();
        $listaCompra->borrarLista($id);
        return redirect()->route('listas')->with('success', 'Lista de compra eliminada con éxito.');
    }

    /**
     * Muestra la lista de compra por su ID.
     *
     * Este método crea una nueva instancia de ListaCompra y llama al método mostrarLista
     * pasando el ID proporcionado para obtener la lista correspondiente. Luego, carga las
     * categorías disponibles desde el modelo ProductoLista y devuelve la vista 'productos'
     * con los datos de la lista y las categorías.
     *
     * @param int $id Identificador de la lista de compra a mostrar.
     * @return \Illuminate\View\View Vista 'productos' con los datos de la lista y categorías.
     */
    public function mostrarLista($id)
    {
        $listaCompra = new ListaCompra();
        $lista = $listaCompra->mostrarLista($id);

        // Cargar las categorías disponibles desde el modelo
        $categorias = ProductoLista::obtenerCategoriasDisponibles();

        return view('productos', compact('lista', 'categorias'));
    }
}

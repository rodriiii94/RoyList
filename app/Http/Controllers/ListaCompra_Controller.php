<?php

namespace App\Http\Controllers;

use App\Models\ListaCompra;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ListaCompra_Controller extends Controller
{
    public function showListView()
    {
        return view('listas');
    }

    public function create(Request $request)
    {
        $user_id = FacadesAuth::id();
        $supermercado = $request->input('supermercado_id');
        $nombre = $request->input('nombre');

        // Validar los datos de la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255',
            'supermercado_id' => 'required|exists:supermercados,id',
        ]);

        // Crear una nueva lista de compra
        $listaCompra = new ListaCompra();
        $listaCompra->crearLista($user_id, $supermercado, $nombre);

        // Redirigir a la vista de listas de compra
        return redirect()->route('listas')->with('success', 'Lista de compra creada con éxito.');
    }

    public function showList($id)
    {
        // Aquí puedes manejar la lógica para mostrar una lista de compra específica
        // Por ejemplo, buscar en la base de datos o en una API externa

        return view('listas.show', compact('id'));
    }
}
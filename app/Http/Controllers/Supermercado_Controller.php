<?php

namespace App\Http\Controllers;

use App\Models\Supermercado;
use Illuminate\Http\Request;

class Supermercado_Controller extends Controller
{
    public function showSupermercados()
    {
        $supermercados = Supermercado::all();
        return view('crear_listas', compact('supermercados'));
    }
}
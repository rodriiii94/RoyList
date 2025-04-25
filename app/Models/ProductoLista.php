<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ListaCompra;

class ProductoLista extends Model
{
    protected $fillable = ['lista_compra_id', 'nombre_producto', 'cantidad', 'notas'];

    public function listaDeCompra()
    {
        return $this->belongsTo(ListaCompra::class);
    }
}

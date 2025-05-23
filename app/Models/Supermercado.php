<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ListaCompra;

class Supermercado extends Model
{
    protected $fillable = [
        'nombre'
    ];

    public function listasDeCompra()
    {
        return $this->hasMany(ListaCompra::class);
    }

    public function getNombre()
    {
        return ucfirst($this->nombre);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductoLista;
use App\Models\User;
use App\Models\Supermercado;

class ListaCompra extends Model
{
    protected $fillable = ['user_id', 'supermercado_id', 'nombre'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function supermercado()
    {
        return $this->belongsTo(Supermercado::class);
    }

    public function productos()
    {
        return $this->hasMany(ProductoLista::class);
    }
}

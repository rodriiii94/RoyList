<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductoLista;
use App\Models\User;
use App\Models\Supermercado;

class ListaCompra extends Model
{
    protected $fillable = ['user_id', 'supermercado_id', 'nombre'];
    
    // La tabla de la base de datos
    protected $table = 'lista_compra';

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

    // Crear lista de compra
    // Se le pasa el id del usuario, el id del supermercado y el nombre de la lista
    public function crearLista($userId, $supermercadoId, $nombre)
    {
        return self::create([
            'user_id' => $userId,
            'supermercado_id' => $supermercadoId,
            'nombre' => $nombre,
        ]);
    }
}

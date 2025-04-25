<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

// Creacion de la tabla producto_lista (productos dentro de una lista de compra)
Schema::create('producto_lista', function (Blueprint $table) {
    $table->id(); // ID del item
    $table->foreignId('lista_compra_id')->constrained()->onDelete('cascade');
    $table->string('nombre_producto'); // Nombre del producto
    $table->integer('cantidad')->default(1); // Cantidad del producto
    $table->text('notas')->nullable(); // Notas sobre el producto
    $table->timestamps(); // Columnas created_at y updated_at
});

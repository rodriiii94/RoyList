<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        // Creacion de la tabla lista_compra
        Schema::create('lista_compra', function (Blueprint $table) {
            $table->id(); // Columna id
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relacion con la tabla de usuarios
            $table->foreignId('supermercado_id')->constrained('supermercados')->onDelete('cascade'); // Relacion con la tabla de supermercados
            $table->string('nombre'); // Columna nombre
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    public function down()
    {
        // Eliminacion de la tabla lista_compra
        Schema::dropIfExists('lista_compra');
    }
};

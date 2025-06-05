<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {

    public function up()
    {
        // Creacion de la tabla supermercados 
        Schema::create('supermercados', function (Blueprint $table) {
            $table->id(); // Columna id
            $table->string('nombre')->unique(); // Columna nombre, debe ser unico
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    public function down()
    {
        // Eliminacion de la tabla supermercados
        Schema::dropIfExists('supermercados');
    }
};

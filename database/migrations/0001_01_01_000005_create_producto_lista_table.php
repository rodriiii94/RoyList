<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

    public function up()
    {
        // Creacion de la tabla producto_lista (productos dentro de una lista de compra)
        Schema::create('producto_lista', function (Blueprint $table) {
            $table->id(); // ID del item
            $table->foreignId('lista_compra_id')->constrained('lista_compra')->onDelete('cascade');
            $table->string('nombre_producto'); // Nombre del producto
            $table->integer('cantidad')->default(1); // Cantidad del producto
            $table->text('notas')->nullable(); // Notas sobre el producto
            $table->decimal('precio', 8, 2)->nullable(); // Precio del producto
            $table->string('imagen', 500)->nullable(); // Imagen del producto (URL de la imagen)
            $table->timestamps(); // Columnas created_at y updated_at
        });
    }

    public function down()
    {
        // Eliminacion de la tabla producto_lista
        Schema::dropIfExists('producto_lista');
    }
};

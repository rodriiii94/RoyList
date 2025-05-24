<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('lista_compra', function (Blueprint $table) {
            // Eliminar primero la clave foránea si existe una que use user_id y supermercado_id juntos
            $table->dropForeign(['user_id']);
            $table->dropForeign(['supermercado_id']);

            // Ahora se puede eliminar el índice único
            $table->dropUnique('lista_compra_user_id_supermercado_id_unique');
        });
    }

    public function down(): void
    {
        Schema::table('lista_compra', function (Blueprint $table) {
            // Volver a agregar el índice único si haces rollback
            $table->unique(['user_id', 'supermercado_id']);

            // Volver a agregar las claves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('supermercado_id')->references('id')->on('supermercados')->onDelete('cascade');
        });
    }
};


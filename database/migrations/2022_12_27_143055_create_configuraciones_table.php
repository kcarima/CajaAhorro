<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection(name: 'sca')->create(table: 'configuraciones', callback: function (Blueprint $table) {
            $table->comment(comment: 'Tabla que almacenara distintos valores configurables para el sistema');
            $table->id();
            $table->string(column: 'clave')->unique();
            $table->string(column: 'valor');
            $table->enum(column: 'tipo', allowed: ['IMAGEN', 'NUMERO', 'TEXTO', 'ARCHIVO']);
            $table->boolean(column: 'is_public')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'configuraciones');
    }
};

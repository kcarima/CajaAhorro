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
        Schema::connection(name: 'sca')->create(table: 'tipos_conceptos', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'nombre')->unique();
            $table->enum(column: 'accion', allowed: ['SUMA', 'RESTA', 'DIVISIÓN']);
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'tipos_conceptos');
    }
};

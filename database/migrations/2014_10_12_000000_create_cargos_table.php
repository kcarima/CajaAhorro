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
        Schema::connection(name: 'uneg')->create(table: 'cargos', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'codigo', length: 6)->unique();
            $table->string(column: 'nombre');
            $table->uuid();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'uneg')->dropIfExists(table: 'cargos');
    }
};

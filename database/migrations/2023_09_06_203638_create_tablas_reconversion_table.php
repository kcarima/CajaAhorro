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
        Schema::connection('sca')->create('tablas_reconversion', function (Blueprint $table) {
            $table->comment('Catalogo de tablas que se pueden reconvertir');
            $table->id();
            $table->string('descripcion')->unique();
            $table->string('tabla')->unique();
            $table->string('modelo')->unique();
            $table->uuid();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('sca')->dropIfExists('tablas_reconversion');
    }
};

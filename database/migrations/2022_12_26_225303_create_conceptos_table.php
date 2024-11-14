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
        Schema::connection(name: 'sca')->create(table: 'conceptos', callback: function (Blueprint $table) {
            $table->id();
            $table->string('concepto');
            $table->string('descripcion');
            $table->enum(column: 'accion', allowed: ['+', '-', '/','*'])->default('+');
            $table->enum(column: 'status', allowed: ['0', '1'])->default('0')->comment('0: Inactivo, 1:Activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'conceptos');
    }
};

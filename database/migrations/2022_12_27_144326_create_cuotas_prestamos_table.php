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
        Schema::connection(name: 'sca')->create(table: 'cuotas_prestamos', callback: function (Blueprint $table) {
            $table->id();
            $table->foreignId('prestamo_id')->references('id')->on('sca.prestamos')->onUpdate('cascade')->onDelete('restrict');
            $table->decimal(column: 'monto', total: 16, places: 8);
            $table->enum(column: 'status', allowed: ['PAGADO', 'PENDIENTE', 'ATRASADA', 'ANULADA'])->default(value: 'PENDIENTE');
            $table->timestamp(column: 'fecha_vencimiento');
            $table->timestamp(column: 'fecha_pagado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'cuotas');
    }
};

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
        Schema::connection(name: 'sca')->create(table: 'cuotas_pagos', callback: function (Blueprint $table) {
            $table->id();
            $table->decimal(column: 'monto', total: 14, places: 4);
            $table->foreignId(column: 'couta_id')->references(column: 'id')->on(table: 'sca.cuotas_prestamos')->onUpdate(action: 'cascade')->onDelete(action: 'cascade');
            $table->foreignId(column: 'pago_id')->references(column: 'id')->on(table: 'sca.pagos')->onUpdate(action: 'cascade')->onDelete(action: 'cascade');
            $table->foreignId(column: 'moneda_id')->references(column: 'id')->on(table: 'sca.monedas')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->string(column: 'comentarios')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'cuotas_pagos');
    }
};

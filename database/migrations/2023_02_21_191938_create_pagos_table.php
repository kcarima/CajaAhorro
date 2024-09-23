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
        Schema::connection(name: 'sca')->create(table: 'pagos', callback: function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'tipo_pago_id')->references(column: 'id')->on(table: 'sca.tipos_pagos')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->string(column: 'referencia')->nullable();
            $table->date(column: 'fecha');
            $table->decimal(column: 'monto', total: 14, places: 4);
            $table->string(column: 'concepto')->nullable()->comment(comment: 'Comentario de parte del que realiza el pago');
            $table->string(column: 'observaciones')->nullable()->comment(comment: 'Comentario del que recibe el pago');
            $table->boolean(column: 'diferido')->default(value: false);
            $table->boolean(column: 'conciliado')->default(value: false);
            $table->date(column: 'fecha_conciliacion')->nullable();
            $table->foreignId(column: 'moneda_id')->references(column: 'id')->on(table: 'sca.monedas')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->foreignId(column: 'socio_id')->references(column: 'id')->on(table: 'sca.socios')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->foreignId(column: 'cuenta_bancaria_id')->nullable()->references(column: 'id')->on(table: 'sca.cuentas_bancarias')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'pagos');
    }
};

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
        Schema::connection(name: 'sca')->create(table: 'movimientos', callback: function (Blueprint $table) {
            $table->id();
            $table->decimal(column: 'monto', total: 14, places: 4);
            $table->decimal(column: 'saldo_anterior', total: 14, places: 4);
            $table->string(column: 'concepto');
            $table->date(column: 'fecha_pago');
            $table->morphs(name: 'objeto');
            $table->foreignId(column: 'moneda_id')->references(column: 'id')->on(table: 'sca.monedas')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->foreignId(column: 'concepto_id')->references(column: 'id')->on(table: 'sca.conceptos')->onUpdate(action: 'restrict')->onDelete(action: 'restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'movimientos');
    }
};

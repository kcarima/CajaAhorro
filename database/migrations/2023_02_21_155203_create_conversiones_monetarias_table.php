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
        Schema::connection(name: 'sca')->create(table: 'conversiones_monetarias', callback: function (Blueprint $table) {
            $table->comment(comment: 'Almacena todas las conversiones que se debe de hacer de una moneda a otra, siempre es 1 unidad de la moneda principal es la accion (por lo general multiplicacion) por el monto de la moneda secundaria');
            $table->id();
            $table->foreignId(column: 'moneda_principal_id')->references(column: 'id')->on(table: 'sca.monedas')->onUpdate(action: 'cascade')->onDelete(action: 'cascade');
            $table->foreignId(column: 'moneda_secundaria_id')->references(column: 'id')->on(table: 'sca.monedas')->onUpdate(action: 'cascade')->onDelete(action: 'cascade');
            $table->decimal(column: 'cantidad_moneda_secundaria', total: 16, places: 8);
            $table->date('fecha_actualizacion');
            $table->uuid();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'conversiones_monetarias');
    }
};

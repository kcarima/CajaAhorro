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
        Schema::connection(name: 'sca')->create(table: 'historial_conversiones_monetarias', callback: function (Blueprint $table) {
            $table->comment(comment: 'Cuando se realiza un cambio en la tabla conversiones monetarias esta almacenara los valores antes de la actualizacion');
            $table->id();
            $table->foreignId(column: 'conversion_monetaria_id')->references(column: 'id')->on(table: 'sca.conversiones_monetarias')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->decimal(column: 'monto', total: 16, places: 8)->comment(comment: 'El monto de la moneda secundaria');
            $table->date('fecha_actualizacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'historial_conversiones_monetarias');
    }
};

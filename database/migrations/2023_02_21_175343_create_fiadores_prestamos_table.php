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
        Schema::connection(name: 'sca')->create(table: 'fiadores_prestamos', callback: function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'prestamo_id')->references(column: 'id')->on(table: 'sca.prestamos')->onUpdate(action: 'cascade')->onDelete(action: 'cascade');
            $table->foreignId(column: 'socio_id')->references(column: 'id')->on(table: 'sca.socios')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->decimal(column: 'monto', total: 14, places: 4);
            $table->decimal(column: 'pendiente', total: 14, places: 4);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'fiadores_prestamos');
    }
};

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
        Schema::connection('sca')->create('solicitud_prestamo', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'ficha')->unique();
            $table->date(column: 'fecha_solicitud');
            $table->foreignId(column: 'tipo_prestamo')->references(column: 'id')->on(table: 'sca.tipos_prestamos')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->foreignId(column: 'moneda')->references(column: 'id')->on(table: 'sca.monedas')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->decimal(column: 'monto', total: 16, places: 8)->default(value: 0.0);
            $table->enum(column: 'status', allowed: ['PENDIENTE', 'RECHAZADO', 'APROBADO'])->default('PENDIENTE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

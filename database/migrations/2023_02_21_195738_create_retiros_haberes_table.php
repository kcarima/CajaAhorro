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
        Schema::connection(name: 'sca')->create(table: 'retiros_haberes', callback: function (Blueprint $table) {
            $table->id();
            $table->enum(column: 'tipo', allowed: ['PARCIAL', 'TOTAL'])->default(value: 'PARCIAL');
            $table->decimal(column: 'monto', total: 14, places: 4);
            $table->decimal(column: 'porcentaje_retiro', total: 14);
            $table->foreignId(column: 'socio_id')->references(column: 'id')->on(table: 'sca.socios')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->date(column: 'fecha_solicitud');
            $table->enum(column: 'status', allowed: ['APROBADO', 'ESPERA'])->default(value: 'ESPERA');
            $table->date(column: 'fecha_aprobacion')->nullable();
            $table->string(column: 'comentarios')->nullable();
            $table->foreignId(column: 'moneda_id')->references(column: 'id')->on(table: 'sca.monedas')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'retiros_haberes');
    }
};

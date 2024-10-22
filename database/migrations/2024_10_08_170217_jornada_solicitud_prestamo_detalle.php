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
        Schema::connection('sca')->create('jornada_solicitud_prestamo_detalle', function (Blueprint $table){
            $table->id();
            
            $table->foreignId(column: 'jornada_solicitud_prestamo_id')->references(column: 'id')->on(table: 'sca.jornada_solicitud_prestamo_table')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');

            $table->foreignId(column: 'tipo_prestamo_id')->references(column: 'id')->on(table: 'sca.tipos_prestamos')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->foreignId(column: 'moneda_id')->references(column: 'id')->on(table: 'sca.monedas')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->decimal(column: 'monto_tope', total: 16, places: 2)->default(value: 0.00);
            $table->smallInteger('cant_cuotas')->default(value: 0);

            $table->enum(column: 'status', allowed: ['0', '1'])->default('1')->comment('0: Inactivo, 1:activo');

            $table->index(['status']);

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::connection('sca')->dropIfExists('jornada_solicitud_prestamo_detalle');
    }
};

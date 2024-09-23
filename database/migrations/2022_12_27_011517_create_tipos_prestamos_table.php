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
        Schema::connection(name: 'sca')->create(table: 'tipos_prestamos', callback: function (Blueprint $table) {
            $table->comment(comment: 'Tabla que almacenara las plantillas de los prestamos que proporcionará la caja de ahorros');
            $table->id();
            $table->string(column: 'codigo')->unique();
            $table->string(column: 'nombre')->unique();
            $table->unsignedSmallInteger(column: 'cantidad_cuotas')->default(value: 12);
            $table->unsignedTinyInteger(column: 'dias_cuotas')->default(value: 30);
            $table->decimal(column: 'tasa_interes');
            $table->unsignedTinyInteger(column: 'meses_tasa')->default(value: 12);
            $table->unsignedTinyInteger(column: 'plazo_siguiente_solicitud')->default(value: 0);
            $table->boolean(column: 'cuota_especial')->default(value: false);
            $table->boolean(column: 'habilitar')->default(true)->comment('Si los usuarios podran pedir prestamos de este tipo');
            $table->uuid();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'tipos_prestamos');
    }
};

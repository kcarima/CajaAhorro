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
        Schema::connection('sca')->create('jornada_solicitud_prestamo_table', function (Blueprint $table) {
            $table->id();

            $table->text('nombre');
            
            $table->date(column: 'fecha_inicio');
            $table->date(column: 'fecha_cierre');

            $table->text('observacion')->nullable();

            $table->enum(column: 'status', allowed: ['0', '1'])->default('0')->comment('0: Inactiva, 1:Activa');

            $table->index(['fecha_inicio', 'fecha_cierre']);
            $table->index(['status']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('sca')->dropIfExists('jornada_solicitud_prestamo_table');
    }
};
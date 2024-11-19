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
        Schema::connection('sca')->create('archivo_sinu_table', function (Blueprint $table){
            $table->id();
            $table->date('fecha');
            $table->text('descripcion');
            $table->decimal(column: 'monto', total: 16, places: 2)->default(value: 0.00);
            $table->enum('status', allowed: ['0', '1'])->default('0')->comment('0: Cargado, 1:Procesado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('sca')->dropIfExists('archivo_sinu_table');
    }
};

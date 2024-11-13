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
        Schema::create('archivo_sinu_table', function (Blueprint $table) {
            $table->id();
            $table->date(column: 'fecha');
            $table->text('descripcion');
            $table->enum(column: 'status', allowed: ['0', '1'])->default('0')->comment('0: Cargado, 1:Procesado');
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

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
        Schema::connection('sca')->create('documentos_socios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('socio_id')->references('id')->on('sca.socios')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('documento_id')->references('id')->on('sca.documentos')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ruta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('sca')->dropIfExists('documentos_socios');
    }
};

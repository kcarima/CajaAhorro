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
        Schema::connection(name: 'sca')->create(table: 'conceptos', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'concepto');
            $table->string('descripcion');
            $table->foreignId(column: 'tipo_concepto_id')->references(column: 'id')->on(table: 'sca.tipos_conceptos')->onDelete(action: 'restrict')->onUpdate(action: 'restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(table: 'conceptos');
    }
};

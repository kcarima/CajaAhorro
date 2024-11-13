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
        Schema::create('archivo_sinu_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'archivo_sinu_table_id')->references(column: 'id')->on(table: 'sca.archivo_sinu_table')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->foreignId('socio_id')->references('id')->on('sca.socios')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('concepto_id')->default(0);
            $table->decimal(column: 'monto', total: 16, places: 2)->default(value: 0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('sca')->dropIfExists('archivo_sinu_detalle');
    }
};

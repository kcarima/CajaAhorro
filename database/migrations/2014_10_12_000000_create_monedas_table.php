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
        Schema::connection(name: 'sca')->create(table: 'monedas', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'nombre', length: 100);
            $table->string(column: 'abreviatura', length: 5);
            $table->string(column: 'iso_4217', length: 3)->comment(comment: 'Código de 3 letras que identifica a la moneda en ambitos internacionales');
            $table->year(column: 'anio')->nullable();
            $table->boolean(column: 'es_activa')->default(value: true)->comment(comment: 'Si la moneda es de curso legal en la actualidad, esto es mas que todo para filtrar entre las monedas del cono anterior');
            $table->boolean(column: 'es_default')->default(value: false)->comment(comment: 'La moneda que se usa por defecto cuando no se especifica ninguna');
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
        Schema::connection(name: 'sca')->dropIfExists(table: 'monedas');
    }
};

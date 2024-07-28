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
        Schema::connection(name: 'sca')->create(table: 'historico_fichas_socios', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'cedula', length: 11);
            $table->string(column: 'ficha_anterior');
            $table->string(column: 'codigo_cargo', length: 6)->nullable();
            $table->string(column: 'codigo_departamento', length: 6)->nullable();
            $table->foreignId(column: 'relacion_laboral_id')->nullable()->references(column: 'id')->on(table: 'uneg.relaciones_laborales')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->foreignId(column: 'tipo_trabajador_id')->nullable()->references(column: 'id')->on(table: 'uneg.tipos_trabajadores')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->decimal(column: 'sueldo', total: 14, places: 4)->default(value: 0.0);
            $table->foreignId(column: 'moneda_id')->references(column: 'id')->on(table: 'sca.monedas')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->timestamps();

            $table->foreign(columns: 'cedula')->references(columns: 'cedula')->on(table: 'sca.socios')->onDelete(action: 'cascade')->onUpdate(action: 'cascade');
            $table->foreign(columns: 'codigo_cargo')->references(columns: 'codigo')->on(table: 'uneg.cargos')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->foreign(columns: 'codigo_departamento')->references(columns: 'codigo')->on(table: 'uneg.departamentos')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'historico_fichas_socios');
    }
};

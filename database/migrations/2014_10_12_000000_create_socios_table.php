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
        Schema::connection(name: 'sca')->create(table: 'socios', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'nombre');
            $table->string(column: 'ficha')->unique();
            $table->string(column: 'cedula', length: 11)->unique();
            $table->date(column: 'fecha_nac')->nullable();
            $table->decimal(column: 'saldo_haberes', total: 16, places: 8)->default(value: 0.0);
            $table->decimal(column: 'saldo_bloqueado', total: 16, places: 8)->default(value: 0.0);
            $table->date(column: 'fecha_ingreso_uneg');
            $table->date(column: 'fecha_retiro_uneg')->nullable();
            $table->date(column: 'fecha_ingreso_cauneg');
            $table->date(column: 'fecha_retiro_cauneg')->nullable();
            $table->string(column: 'codigo_cargo', length: 6)->nullable();
            $table->string(column: 'codigo_departamento', length: 6)->nullable();
            $table->foreignId(column: 'relacion_laboral_id')->nullable()->references(column: 'id')->on(table: 'uneg.relaciones_laborales')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->foreignId(column: 'tipo_trabajador_id')->nullable()->references(column: 'id')->on(table: 'uneg.tipos_trabajadores')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->foreignId(column: 'sede_id')->nullable()->references(column: 'id')->on('uneg.sedes')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId(column: 'zona_id')->nullable()->references(column: 'id')->on('uneg.zonas')->onUpdate('cascade')->onDelete('restrict');
            $table->decimal(column: 'sueldo', total: 16, places: 8)->default(value: 0.0);
            $table->foreignId(column: 'moneda_id')->references(column: 'id')->on(table: 'sca.monedas')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->boolean(column: 'es_fiador')->default(value: false);
            $table->string(column: 'telefono', length: 20)->nullable();
            $table->string(column: 'telefono_secundario', length: 20)->nullable();
            $table->date(column: 'fecha_fallecido')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign(columns: 'codigo_cargo')->references(columns: 'codigo')->on(table: 'uneg.cargos')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->foreign(columns: 'codigo_departamento')->references(columns: 'codigo')->on(table: 'uneg.departamentos')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'socios');
    }
};
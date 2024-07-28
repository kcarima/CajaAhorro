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
        Schema::connection('sca')->create('solicitudes_ingresos', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'nombres');
            $table->string(column: 'ficha')->unique();
            $table->string(column: 'cedula', length: 11)->unique();
            $table->string(column: 'email');
            $table->date(column: 'fecha_ingreso_uneg');
            $table->string(column: 'codigo_cargo', length: 6);
            $table->string(column: 'codigo_departamento', length: 6);
            $table->foreignId(column: 'relacion_laboral_id')->references(column: 'id')->on(table: 'uneg.relaciones_laborales')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->foreignId(column: 'tipo_trabajador_id')->references(column: 'id')->on(table: 'uneg.tipos_trabajadores')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->foreignId(column: 'sede_id')->nullable()->references(column: 'id')->on(table: 'uneg.sedes')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->foreignId(column: 'zona_id')->nullable()->references(column: 'id')->on(table: 'uneg.zonas')->onDelete(action: 'restrict')->onUpdate('cascade');
            $table->decimal(column: 'sueldo', total: 16, places: 8)->default(value: 0.0);
            $table->string(column: 'telefono', length: 20);
            $table->string(column: 'telefono_secundario', length: 20)->nullable();
            $table->enum(column: 'status', allowed: ['PENDIENTE', 'RECHAZADO', 'APROBADO'])->default('PENDIENTE');
            $table->json(column: 'beneficiarios')->nullable();
            $table->json(column: 'bancos')->nullable();
            $table->string(column: 'doc_cedula')->nullable();
            $table->string(column: 'doc_resolucion')->nullable();
            $table->uuid()->unique();
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
        Schema::connection('sca')->dropIfExists('temporal_socios');
    }
};

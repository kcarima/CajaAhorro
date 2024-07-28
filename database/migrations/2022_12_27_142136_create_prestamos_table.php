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
        Schema::connection(name: 'sca')->create(table: 'prestamos', callback: function (Blueprint $table) {
            $table->id();
            $table->string('cedula', length: 10);
            $table->string('codigo_tipo');
            $table->unsignedTinyInteger(column: 'cantidad_cuotas');
            $table->decimal(column: 'monto', total: 16, places: 8);
            $table->enum(column: 'status', allowed: ['PAGADO', 'REVISIÓN', 'RECHAZADO', 'DEVUELTO', 'APROBADO', 'ATRASADO', 'ANULADO'])->default(value: 'REVISIÓN');
            $table->timestamp(column: 'fecha_aprobacion')->nullable();
            $table->decimal(column: 'tasa_interes');
            $table->unsignedTinyInteger(column: 'dias_cuotas')->default(value: 30);
            $table->unsignedTinyInteger(column: 'meses_tasa')->default(value: 12);
            $table->foreignId(column: 'moneda_id')->references(column: 'id')->on(table: 'sca.monedas')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->string(column: 'observaciones')->nullable()->comment(comment: 'Almacenar comentarios por si se devuelve, anula o rechaza un prestamo');
            $table->uuid();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(columns: 'cedula')->references(columns: 'cedula')->on(table: 'sca.socios')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->foreign(columns: 'codigo_tipo')->references(columns: 'codigo')->on(table: 'sca.tipos_prestamos')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'prestamos');
    }
};

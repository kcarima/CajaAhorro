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
        Schema::connection(name: 'sca')->create(table: 'bancos_socios', callback: function (Blueprint $table) {
            $table->comment(comment: 'Información de las cuentas bancarias que tiene el socio');
            $table->id();
            $table->string(column: 'numero_cuenta');
            $table->string(column: 'codigo_banco');
            $table->string(column: 'cedula_socio', length: 11);
            $table->string(column: 'tipo_cuenta');

            $table->foreign(columns: 'cedula_socio')->references(columns: 'cedula')->on(table: 'sca.socios')->onDelete(action: 'cascade')->onUpdate(action: 'cascade');
            $table->foreign(columns: 'codigo_banco')->references(columns: 'codigo')->on(table: 'sca.bancos')->onDelete(action: 'cascade')->onUpdate(action: 'cascade');
            $table->foreign(columns: 'tipo_cuenta')->references(columns: 'nombre')->on(table: 'sca.tipos_cuentas_bancarias')->onUpdate(action: 'cascade')->onDelete(action: 'cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'bancos_socios');
    }
};

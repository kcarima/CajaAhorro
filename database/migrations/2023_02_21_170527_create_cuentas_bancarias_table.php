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
        Schema::connection(name: 'sca')->create(table: 'cuentas_bancarias', callback: function (Blueprint $table) {
            $table->id();
            $table->foreignId(column: 'banco_id')->references(column: 'id')->on(table: 'sca.bancos')->onUpdate(action: 'cascade')->onDelete(action: 'cascade');
            $table->string(column: 'agencia');
            $table->foreignId(column: 'tipo_cuenta_bancaria_id')->references(column: 'id')->on(table: 'sca.tipos_cuentas_bancarias')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->decimal(column: 'saldo', total: 16, places: 8)->default(value: 0.0);
            $table->string(column: 'numero');
            $table->foreignId(column: 'moneda_id')->references(column: 'id')->on(table: 'sca.monedas')->onDelete(action: 'restrict')->onUpdate(action: 'cascade');
            $table->boolean('is_public')->default(false);
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
        Schema::connection(name: 'sca')->dropIfExists(table: 'cuentas_bancarias');
    }
};

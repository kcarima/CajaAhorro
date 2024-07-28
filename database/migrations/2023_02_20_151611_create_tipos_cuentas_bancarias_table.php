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
        Schema::connection(name: 'sca')->create(table: 'tipos_cuentas_bancarias', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'nombre')->unique();
            $table->boolean(column: 'is_public')->default(true)->comment('Si los usuarios al registrar sus cuentas tienen este tipo de cuenta como opcion');
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
        Schema::connection(name: 'sca')->dropIfExists(table: 'tipos_cuentas_bancarias');
    }
};

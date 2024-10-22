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
        Schema::connection(name: 'sca')->create(table: 'beneficiarios', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'nombre');
            $table->date(column: 'fecha_nacimiento')->nullable();
            $table->string(column: 'cedula', length: 11)->unique();
            $table->string(column: 'email')->nullable();
            $table->string(column: 'telefono', length: 20)->nullable();
            $table->string(column: 'telefono_secundario', length: 20)->nullable();
            $table->string(column: 'cedula_benefactor', length: 11);
            $table->decimal(column: 'porcentaje_adjudicacion', total: 6);
            $table->string(column: 'doc_cedula');
            $table->foreignId(column: 'parentesco_id')->references(column: 'id')->on(table: 'sca.parentescos')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(columns: 'cedula_benefactor')->references(columns: 'cedula')->on(table: 'sca.socios')->onDelete(action: 'cascade')->onUpdate(action: 'cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'beneficiarios');
    }
};

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
        Schema::connection(name: 'sca')->create(table: 'montepios', callback: function (Blueprint $table) {
            $table->id();
            $table->date(column: 'fecha');
            $table->foreignId(column: 'socio_id')->references(column: 'id')->on(table: 'sca.socios')->onDelete(action: 'cascade')->onUpdate(action: 'cascade');
            $table->foreignId(column: 'moneda_id')->references(column: 'id')->on(table: 'sca.monedas')->onUpdate(action: 'cascade')->onDelete(action: 'restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'sca')->dropIfExists(table: 'montepios');
    }
};

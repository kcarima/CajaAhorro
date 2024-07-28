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
        Schema::connection('sca')->create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('carpeta');
            $table->uuid();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('sca')->dropIfExists('documentos');
    }
};

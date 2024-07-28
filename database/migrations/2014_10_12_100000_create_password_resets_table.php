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
        Schema::connection(name: 'seguridad')->create(table: 'password_resets', callback: function (Blueprint $table) {
            $table->string(column: 'email')->index();
            $table->string(column: 'token');
            $table->timestamp(column: 'created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'seguridad')->dropIfExists(table: 'password_resets');
    }
};

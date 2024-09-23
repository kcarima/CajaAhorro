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
        Schema::connection(name: 'seguridad')->create(table: 'block_ips', callback: function (Blueprint $table) {
            $table->id();
            $table->ipAddress(column: 'ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'seguridad')->dropIfExists(table: 'block_ips');
    }
};

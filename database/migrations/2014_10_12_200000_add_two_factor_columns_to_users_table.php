<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Fortify;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection(name: 'seguridad')->table(table: 'users', callback: function (Blueprint $table) {
            $table->text(column: 'two_factor_secret')
                ->after(column: 'password')
                ->nullable();

            $table->text(column: 'two_factor_recovery_codes')
                ->after(column: 'two_factor_secret')
                ->nullable();

            if (Fortify::confirmsTwoFactorAuthentication()) {
                $table->timestamp(column: 'two_factor_confirmed_at')
                    ->after(column: 'two_factor_recovery_codes')
                    ->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(name: 'seguridad')->table(table: 'users', callback: function (Blueprint $table) {
            $table->dropColumn(columns: array_merge([
                'two_factor_secret',
                'two_factor_recovery_codes',
            ], Fortify::confirmsTwoFactorAuthentication() ? [
                'two_factor_confirmed_at',
            ] : []));
        });
    }
};

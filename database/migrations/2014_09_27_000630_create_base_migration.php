<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(query: '
            DROP SCHEMA IF EXISTS seguridad CASCADE;
            CREATE SCHEMA seguridad;
            DROP SCHEMA IF EXISTS sca CASCADE;
            CREATE SCHEMA sca;
            DROP SCHEMA IF EXISTS uneg CASCADE;
            CREATE SCHEMA uneg;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared(query: '
            DROP SCHEMA IF EXISTS seguridad CASCADE;
            DROP SCHEMA IF EXISTS sca CASCADE;
            DROP SCHEMA IF EXISTS uneg CASACADE;
        ');
    }
};

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('sca')->table(table: 'tipos_pagos')->insert(values: [
            ['descripcion' => 'Transferencia'],
        ]);
    }
}

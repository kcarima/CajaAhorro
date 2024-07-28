<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class CuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id_moneda = DB::connection(name: 'sca')->table(table: 'monedas')->where(column: 'es_default', operator: '=', value: true)->value('id');

        DB::connection(name: 'sca')->table(table: 'cuentas')->insert(values: [
            ['nombre' => 'Principal', 'es_principal' => true, 'moneda_id' => $id_moneda],
            ['nombre' => 'Reserva', 'es_principal' => false, 'moneda_id' => $id_moneda],
        ]);
    }
}

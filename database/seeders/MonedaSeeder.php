<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class MonedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection(name: 'sca')->table(table: 'monedas')->insert(values: [
            ['nombre' => 'Bolívar', 'abreviatura' => 'Bs', 'iso_4217' => 'VEB', 'anio' => 1879, 'es_activa' => false, 'es_default' => false, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Bolívar Fuerte', 'abreviatura' => 'Bs.F', 'iso_4217' => 'VEF', 'anio' => 2008, 'es_activa' => false, 'es_default' => false, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Bolívar Soberano', 'abreviatura' => 'Bs.S', 'iso_4217' => 'VES', 'anio' => 2018, 'es_activa' => false, 'es_default' => false, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Bolívar', 'abreviatura' => 'Bs', 'iso_4217' => 'VED', 'anio' => 2021, 'es_activa' => true, 'es_default' => true, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Dolar', 'abreviatura' => '$', 'iso_4217' => 'USD', 'anio' => null, 'es_activa' => true, 'es_default' => false, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}

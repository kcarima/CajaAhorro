<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class RelacionLaboralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection(name: 'uneg')->table(table: 'relaciones_laborales')->insert(values: [
            ['nombre' => 'FIJO', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'CONTRATADO', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'JUBILADO', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'PENSIONADO', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'INCAPACITADO', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}

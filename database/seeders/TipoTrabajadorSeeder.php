<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class TipoTrabajadorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection(name: 'uneg')->table(table: 'tipos_trabajadores')->insert(values: [
            ['nombre' => 'OBRERO', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'ADMINISTRATIVO', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'DOCENTE', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'OBRERO-VIGILANTE', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}

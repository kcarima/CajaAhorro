<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class TipoConceptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection(name: 'sca')->table(table: 'tipos_conceptos')->insert(values: [
            ['nombre' => 'Retencion', 'accion' => 'SUMA'],
            ['nombre' => 'Aporte Universidad', 'accion' => 'SUMA'],
            ['nombre' => 'Cuota Prestamo', 'accion' => 'RESTA'],
            ['nombre' => 'Aporte Montepio', 'accion' => 'RESTA'],
            ['nombre' => 'Plan Corporativo', 'accion' => 'RESTA'],
            ['nombre' => 'Capitalizacion', 'accion' => 'RESTA'],
            ['nombre' => 'Retiro', 'accion' => 'RESTA'],
        ]);
    }
}

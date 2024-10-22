<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('sca')->table('documentos')->insert([
            ['nombre' => 'Cédula', 'carpeta' => 'documentos/socios/cedulas', 'uuid' => str()->uuid()->toString()],
            ['nombre' => 'Resolución', 'carpeta' => 'documentos/socios/resoluciones', 'uuid' => str()->uuid()->toString()],
        ]);
    }
}

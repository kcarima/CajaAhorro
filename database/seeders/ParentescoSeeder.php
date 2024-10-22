<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class ParentescoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('sca')->table('parentescos')->insert([
            [
                'nombre' => 'Esposo(a)',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'nombre' => 'Hijo(a)',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'nombre' => 'Padre',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'nombre' => 'Madre',
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'nombre' => 'Hermano(a)',
                'uuid' => Str::uuid()->toString(),
            ]
        ]);
    }
}

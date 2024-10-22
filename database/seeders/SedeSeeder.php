<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('uneg')->table('sedes')->insert([
            ['nombre' => 'Edificio Administrativo', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Chilemex', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Villa Asia', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Atlántico', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Santa Elena de Uairén', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'El Callao', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Guasipati', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Upata', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Upata (Recría)', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Jardín Botánico', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Caicara del Orinoco', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nombre' => 'Otros', 'uuid' => str()->uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}

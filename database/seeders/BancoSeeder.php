<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class BancoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection(name: 'sca')->table(table: 'bancos')->insert(values: [
            ['codigo' => '0001', 'nombre' => 'Banco Central de Venezuela', 'abreviatura' => 'BCV', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0102', 'nombre' => 'Banco de Venezuela', 'abreviatura' => 'BDV', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0104', 'nombre' => 'Banco Venezolano de Crédito', 'abreviatura' => 'BVC', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0105', 'nombre' => 'Banco Mercantil', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0108', 'nombre' => 'Banco Provincial', 'abreviatura' => 'BBVA', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0114', 'nombre' => 'Bancaribe', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0115', 'nombre' => 'Banco Exterior', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0128', 'nombre' => 'Banco Caroní', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0134', 'nombre' => 'Banesco Banco Universal', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0137', 'nombre' => 'Sofitasa', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0138', 'nombre' => 'Banco Plaza', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0146', 'nombre' => 'Bangente', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0151', 'nombre' => 'Banco Fondo Común', 'abreviatura' => 'BFC', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0156', 'nombre' => '100% Banco', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0157', 'nombre' => 'Del Sur Banco Universal', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0163', 'nombre' => 'Banco del Tesoro', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0166', 'nombre' => 'Banco Agrícola de Venezuela', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0168', 'nombre' => 'Bancrecer', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0169', 'nombre' => 'Mi Banco, Banco Microfinanciero C.A', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0171', 'nombre' => 'Banco Activo', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0172', 'nombre' => 'Bancamiga', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0174', 'nombre' => 'Banplus', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0175', 'nombre' => 'Banco Bicentenario del Pueblo', 'abreviatura' => null, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0177', 'nombre' => 'Banco de la Fuerza Armada Nacional Bolivariana', 'abreviatura' => 'BANFANB', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['codigo' => '0191', 'nombre' => 'Banco Nacional de Crédito', 'abreviatura' => 'BNC', 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}

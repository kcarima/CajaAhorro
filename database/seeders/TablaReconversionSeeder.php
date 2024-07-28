<?php

namespace Database\Seeders;

use App\Models\SCA\CuentaBancaria;
use App\Models\SCA\Socio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class TablaReconversionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection('sca')->table('tablas_reconversion')->insert([
            [
                'descripcion' => 'Saldo Cuentas Bancarias',
                'tabla' => 'sca.cuentas_bancarias',
                'modelo' => CuentaBancaria::class,
                'uuid' => Str::uuid()->toString(),
            ],
            [
                'descripcion' => 'Saldo y Sueldo Socios',
                'tabla' => 'sca.socios',
                'modelo' => Socio::class,
                'uuid' => Str::uuid()->toString(),
            ],
        ]);
    }
}

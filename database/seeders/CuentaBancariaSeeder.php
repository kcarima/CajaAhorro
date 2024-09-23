<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class CuentaBancariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id_moneda = DB::connection(name: 'sca')->table(table: 'monedas')->where(column: 'es_default', operator: '=', value: true)->first(['id'])->id;

        DB::connection(name: 'sca')->table(table: 'cuentas_bancarias')->insert(values: [
            ['banco_id' => 5, 'agencia' => 'LA LLOVIZNA', 'tipo_cuenta_bancaria_id' => 2, 'numero' => '01080905350100000075', 'moneda_id' => $id_moneda, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['banco_id' => 15, 'agencia' => 'PRINCIPAL', 'tipo_cuenta_bancaria_id' => 2, 'numero' => '01570010643810200158', 'moneda_id' => $id_moneda, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['banco_id' => 2, 'agencia' => 'PUERTO ORDAZ, EDIF. BANVENEZ', 'tipo_cuenta_bancaria_id' => 2, 'numero' => '01020427520000029366', 'moneda_id' => $id_moneda, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['banco_id' => 8, 'agencia' => 'PUERTO ORDAZ', 'tipo_cuenta_bancaria_id' => 2, 'numero' => '01280046134600480109', 'moneda_id' => $id_moneda, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['banco_id' => 25, 'agencia' => 'PORTOFINO', 'tipo_cuenta_bancaria_id' => 2, 'numero' => '01910118562100000952', 'moneda_id' => $id_moneda, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['banco_id' => 15, 'agencia' => 'PRINCIPAL', 'tipo_cuenta_bancaria_id' => 4, 'numero' => '01570010643810200158', 'moneda_id' => $id_moneda, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['banco_id' => 6, 'agencia' => 'PUERTO ORDAZ', 'tipo_cuenta_bancaria_id' => 2, 'numero' => '01140510025107000145', 'moneda_id' => $id_moneda, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['banco_id' => 6, 'agencia' => 'PUERTO ORDAZ', 'tipo_cuenta_bancaria_id' => 4, 'numero' => '01140510025107000145', 'moneda_id' => $id_moneda, 'uuid' => Str::uuid()->toString(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}

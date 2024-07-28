<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ConfiguracionSeeder::class,
            MonedaSeeder::class,
            CargoSeeder::class,
            DepartamentoSeeder::class,
            SocioSeeder::class,
            UserSeeder::class,
            TipoPrestamoSeeder::class,
            CuentaSeeder::class,
            BancoSeeder::class,
            TipoCuentaBancariSeeder::class,
            BancoSocioSeeder::class,
            CuentaBancariaSeeder::class,
            HistoricoFichaSocioSeeder::class,
            TipoTrabajadorSeeder::class,
            RelacionLaboralSeeder::class,
            TipoConceptoSeeder::class,
            TipoPagoSeeder::class,
            TablaReconversionSeeder::class,
            // PrestamoSeeder::class,
            ParentescoSeeder::class,
            DocumentoSeeder::class,
            SedeSeeder::class,
        ]);
    }
}

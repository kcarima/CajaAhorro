<?php

namespace Database\Seeders;

use App\Classes\Enums\TipoConfiguracion;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

final class ConfiguracionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection(name: 'sca')->table(table: 'configuraciones')->insert(values: [
            ['clave' => 'Nombre Sistema', 'valor' => 'Sistema Caja de Ahorros UNEG', 'tipo' => TipoConfiguracion::TEXTO, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'Logo Sistema', 'valor' => '', 'tipo' => TipoConfiguracion::IMAGEN, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'UT', 'valor' => '0.4', 'tipo' => TipoConfiguracion::NUMERO, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'Siglas Sistema', 'valor' => 'CAUNEG', 'tipo' => TipoConfiguracion::TEXTO, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'Imagen Encabezado', 'valor' => '', 'tipo' => TipoConfiguracion::IMAGEN, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'Referencia Dolar', 'valor' => 'https://www.bcv.org.ve/', 'tipo' => TipoConfiguracion::TEXTO, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'ISO-4217 Moneda Principal', 'valor' => 'VED', 'tipo' => TipoConfiguracion::TEXTO, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'ISO-4217 Moneda Secundaria', 'valor' => 'USD', 'tipo' => TipoConfiguracion::TEXTO, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'Cantidad Intentos Login', 'valor' => '3', 'tipo' => TipoConfiguracion::NUMERO, 'is_public' => false,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'Cantidad Intentos Sospechosos', 'valor' => '3', 'tipo' => TipoConfiguracion::NUMERO, 'is_public' => false,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'XPATH Referencia Dolar', 'valor' => '//*[@id="dolar"]/div/div/div[2]/strong', 'tipo' => TipoConfiguracion::TEXTO, 'is_public' => false,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'Direccion', 'valor' => 'Av. Las Américas Edificio General de Seguros - Mezzanina', 'tipo' => TipoConfiguracion::TEXTO, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'Telefono', 'valor' => '0286-8897989 - 7137284', 'tipo' => TipoConfiguracion::TEXTO, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'Email', 'valor' => 'cauneg@uneg.edu.ve', 'tipo' => TipoConfiguracion::TEXTO, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'Estado', 'valor' => 'Estado Bolívar', 'tipo' => TipoConfiguracion::TEXTO, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['clave' => 'Ciudad', 'valor' => 'Puerto Ordaz', 'tipo' => TipoConfiguracion::TEXTO, 'is_public' => true,'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

    }
}

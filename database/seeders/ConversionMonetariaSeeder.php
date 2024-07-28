<?php

namespace Database\Seeders;

use App\Classes\Enums\Operaciones;
use App\Models\SCA\ConversionMonetaria;
use App\Models\SCA\Moneda;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

final class ConversionMonetariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Container::getInstance()->make(Generator::class);

        for ($i = 0; $i < 10000; $i++) {
            $moneda_1 = Moneda::inRandomOrder()->value('id');
            $moneda_2 = Moneda::where('id', '!=', $moneda_1)->inRandomOrder()->value('id');

            $conversion = ConversionMonetaria::where('moneda_principal_id', $moneda_1)->where('moneda_secundaria_id', $moneda_2)->first();

            if ($conversion) {
                $conversion->cantidad_moneda_secundaria = $faker->randomFloat(2, 1, 100_000_000);
                $conversion->save();
            } else {
                ConversionMonetaria::create([
                    'moneda_principal_id' => $moneda_1,
                    'moneda_secundaria_id' => $moneda_2,
                    'cantidad_moneda_secundaria' => $faker->randomFloat(2, 1, 100_000_000),
                    'accion' => Operaciones::MULTIPLICACION,
                ]);
            }

        }
    }
}

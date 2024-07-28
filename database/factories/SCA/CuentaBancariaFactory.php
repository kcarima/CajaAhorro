<?php

namespace Database\Factories\SCA;

use App\Models\SCA\Banco;
use App\Models\SCA\Moneda;
use App\Models\SCA\TipoCuentaBancaria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SCA\CuentaBancaria>
 */
final class CuentaBancariaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $moneda_id = Moneda::where('es_default', true)->value('id');

        return [
            'banco_id' => Banco::inRandomOrder()->value('id'),
            'agencia' => $this->faker->words(asText: true),
            'tipo_cuenta_bancaria_id' => TipoCuentaBancaria::inRandomOrder()->value('id'),
            'saldo' => $this->faker->randomFloat(2, 1, 100_000_000),
            'numero' => $this->faker->numerify('####################'),
            'moneda_id' => $moneda_id,
        ];
    }
}

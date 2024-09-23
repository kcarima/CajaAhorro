<?php

namespace Database\Factories\SCA;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SCA\Moneda>
 */
final class MonedaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->words(2, true),
            'abreviatura' => $this->faker->lexify('???'),
            'iso_4217' => $this->faker->bothify('??#'),
            'anio' => 2023,
            'es_activa' => $this->faker->boolean(),
        ];
    }
}

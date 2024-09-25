<?php

namespace Database\Factories\SCA;

use App\Models\SCA\Moneda;
use App\Models\UNEG\Cargo;
use App\Models\UNEG\Departamento;
use App\Models\UNEG\RelacionLaboral;
use App\Models\UNEG\Sede;
use App\Models\UNEG\TipoTrabajador;
use App\Models\UNEG\Zona;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SCA\Socio>
 */
final class SocioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fecha_ingreso_uneg = $this->faker->date();
        $fecha_retiro_uneg = $this->faker->date();
        $fecha_ingreso_cauneg = $this->faker->date();
        $fecha_retiro_cauneg = $this->faker->date();

        return [
            'nombre' => $this->faker->name(),
            'ficha' => $this->faker->numerify('#####'),
            'cedula' => $this->faker->numerify('V########'),
            'saldo_haberes' => $this->faker->randomFloat(nbMaxDecimals: 2, max: 99_999_999),
            'saldo_bloqueado' => $this->faker->randomFloat(nbMaxDecimals: 2, max: 99_999_999),
            'fecha_ingreso_uneg' => $this->faker->date(),
            'fecha_retiro_uneg' => $fecha_ingreso_uneg < $fecha_retiro_uneg ? $fecha_retiro_uneg : null,
            'fecha_ingreso_cauneg' => $fecha_ingreso_cauneg,
            'fecha_retiro_cauneg' => $fecha_ingreso_cauneg < $fecha_retiro_cauneg ? $fecha_retiro_cauneg : null,
            'codigo_cargo' => Cargo::inRandomOrder()->value('codigo'),
            'codigo_departamento' => Departamento::inRandomOrder()->value('codigo'),
            'relacion_laboral_id' => RelacionLaboral::inRandomOrder()->value('id'),
            'tipo_trabajador_id' => TipoTrabajador::inRandomOrder()->value('id'),
            'sede_id' => Sede::inRandomOrder()->value('id'),
            'zona_id' => Zona::inRandomOrder()->value('id'),
            'sueldo' => $this->faker->randomFloat(nbMaxDecimals: 2, max: 10_000_000),
            'moneda_id' => Moneda::activa()->value('id'),
            'es_fiador' => $this->faker->boolean(25),
            'telefono' => $this->faker->numerify('0##########'),
            'telefono_secundario' => $this->faker->boolean(25) ? $this->faker->numerify('0##########') : null,
            'fecha_nacimiento' => $this->faker->boolean(5) ? $this->faker->date() : null,
            'fecha_fallecido' => $this->faker->boolean(5) ? $this->faker->date() : null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
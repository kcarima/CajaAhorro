<?php

namespace Database\Factories\SCA;

use App\Models\UNEG\Cargo;
use App\Models\UNEG\Departamento;
use App\Models\UNEG\RelacionLaboral;
use App\Models\UNEG\Sede;
use App\Models\UNEG\TipoTrabajador;
use App\Models\UNEG\Zona;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SCA\TemporalSocio>
 */
final class SolicitudIngresoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $beneficiarios = [];
        $cedula = $this->faker->numerify('V########');

        for ($i = 0; $i < $this->faker->randomDigit(0, 10); $i++) {
            $beneficiarios[] = [
                'nombres' => $this->faker->name(),
                'fecha_nacimiento' => $this->faker->date(),
                'cedula' => $this->faker->numerify('V########'),
                'email' => $this->faker->freeEmail(),
                'telefono' => $this->faker->phoneNumber(),
                'telefono_secundario' => $this->faker->phoneNumber(),
                'cedula_benefactor' => $cedula,
            ];
        }

        return [
            'nombres' => $this->faker->name(),
            'ficha' => $this->faker->numerify('#####'),
            'cedula' => $cedula,
            'email' => $this->faker->freeEmail(),
            'fecha_ingreso_uneg' => $this->faker->date(),
            'codigo_cargo' => Cargo::inRandomOrder()->value('codigo'),
            'codigo_departamento' => Departamento::inRandomOrder()->value('codigo'),
            'relacion_laboral_id' => RelacionLaboral::inRandomOrder()->value('id'),
            'tipo_trabajador_id' => TipoTrabajador::inRandomOrder()->value('id'),
            'sede_id' => Sede::inRandomOrder()->value('id'),
            'zona_id' => Zona::inRandomOrder()->value('id'),
            'sueldo' => $this->faker->randomFloat(2, 1, 1000),
            'telefono' => $this->faker->phoneNumber(),
            'telefono_secundario' => $this->faker->phoneNumber(),
            'uuid' => Str::uuid()->toString(),
            'beneficiarios' => json_encode($beneficiarios),
            'doc_cedula' => $this->faker->imageUrl(),
            'doc_resolucion' => $this->faker->imageUrl(),
        ];
    }
}

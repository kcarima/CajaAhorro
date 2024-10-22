<?php

namespace App\Http\Requests\API\UNEG\Cargos;

use App\Classes\ApiFormRequest;
use App\Models\UNEG\Cargo;
use Closure;
use Illuminate\Validation\Rule;

final class UpdateCargosRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $cargo = Cargo::where('uuid', $this->uuid)->firstOrFail();

        return [
            'codigo' => [
                'required',
                'size:6',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (! is_numeric($value)) {
                        $fail('El código debe ser un número');
                    }
                },
                Rule::unique('uneg.cargos')->ignore($cargo),
            ],
            'nombre' => ['required', Rule::unique('uneg.cargos', 'nombre')->ignore($cargo->nombre)],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'codigo.required' => 'El código es obligatorio',
            'codigo.size' => 'El código debe tener un tamaño de 6 números',
            'nombre.required' => 'El nombre es obligatorio',
        ];
    }
}

<?php

namespace App\Http\Requests\API\UNEG\Cargos;

use App\Classes\ApiFormRequest;
use Closure;

final class StoreCargosRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'codigo' => [
                'required',
                'size:6',
                'unique:uneg.cargos,codigo',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (! is_numeric($value)) {
                        $fail('El código debe ser un número');
                    }
                },
            ],
            'nombre' => ['required', 'unique:uneg.cargos,nombre'],
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
            'codigo.unique' => 'Ya existe un cargo con ese código',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'Ya existe un cargo con ese nombre',
        ];
    }
}

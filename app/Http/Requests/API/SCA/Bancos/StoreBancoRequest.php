<?php

namespace App\Http\Requests\API\SCA\Bancos;

use App\Classes\ApiFormRequest;

final class StoreBancoRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'codigo' => ['required', 'numeric', 'unique:sca.bancos'],
            'nombre' => ['required', 'unique:sca.bancos'],
            'abreviatura' => ['nullable', 'unique:sca.bancos'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'codigo.required' => 'El código es obligatorio.',
            'codigo.numeric' => 'El código debe de estar compuesto solo por números.',
            'codigo.size' => 'El código debe contener cuatro números.',
            'codigo.unique' => 'Ya existe banco con el código proporcionado.',
            'nombre.required' => 'El nombre del banco es obligatorio',
            'nombre.unique' => 'El nombre del banco debe de ser unico',
            'abreviatura.unique' => 'La abreviatura debe ser unica',
        ];
    }
}

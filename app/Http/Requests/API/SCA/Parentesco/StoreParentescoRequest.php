<?php

namespace App\Http\Requests\API\SCA\Parentesco;

use App\Classes\ApiFormRequest;

final class StoreParentescoRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'unique:sca.parentescos,nombre'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'Ya existe un parentesco con ese nombre.',
        ];
    }
}

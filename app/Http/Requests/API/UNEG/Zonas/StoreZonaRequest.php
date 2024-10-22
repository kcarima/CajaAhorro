<?php

namespace App\Http\Requests\API\UNEG\Zonas;

use App\Classes\ApiFormRequest;

final class StoreZonaRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'unique:uneg.zonas,nombre'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'Ya existe una zona con ese nombre.',
        ];
    }
}

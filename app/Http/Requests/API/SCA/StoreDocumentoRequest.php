<?php

namespace App\Http\Requests\API\SCA;

use App\Classes\ApiFormRequest;

final class StoreDocumentoRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'unique:sca.documentos,nombre'],
            'carpeta' => ['required'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es un campo obligatorio.',
            'nombre.unique' => 'Ya existe un documento con el nombre proporcionado.',
            'carpeta.required' => 'La carpeta es un campo obligatorio.',
        ];
    }
}

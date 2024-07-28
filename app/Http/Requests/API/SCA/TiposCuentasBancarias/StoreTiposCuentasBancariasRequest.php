<?php

namespace App\Http\Requests\API\SCA\TiposCuentasBancarias;

use App\Classes\ApiFormRequest;

final class StoreTiposCuentasBancariasRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'unique:sca.tipos_cuentas_bancarias,nombre'],
            'publico' => ['nullable', 'in:true,false'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'Ya existe un tipo de cuenta con ese nombre',
            'publico.in' => 'Valor del campo publico proporcionado no es válido',
        ];
    }
}

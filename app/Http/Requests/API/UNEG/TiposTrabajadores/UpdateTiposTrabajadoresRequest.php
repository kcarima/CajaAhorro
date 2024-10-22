<?php

namespace App\Http\Requests\API\UNEG\TiposTrabajadores;

use App\Classes\ApiFormRequest;
use App\Models\UNEG\TipoTrabajador;
use Illuminate\Validation\Rule;

final class UpdateTiposTrabajadoresRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $tipo_trabajador = TipoTrabajador::where('uuid', $this->uuid)->firstOrFail();

        return [
            'nombre' => ['required', Rule::unique('uneg.tipos_trabajadores')->ignore($tipo_trabajador)],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'Ya existe un tipo trabajador con ese nombre',
        ];
    }
}

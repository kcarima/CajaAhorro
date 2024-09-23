<?php

namespace App\Http\Requests\API\UNEG\Sedes;

use App\Classes\ApiFormRequest;
use App\Models\UNEG\Sede;
use Illuminate\Validation\Rule;

final class UpdateSedeRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $sede = Sede::where('uuid', $this->uuid)->firstOrFail();

        return [
            'nombre' => ['required', Rule::unique('uneg.sedes')->ignore($sede)],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'Ya existe una sede con ese nombre',
        ];
    }
}

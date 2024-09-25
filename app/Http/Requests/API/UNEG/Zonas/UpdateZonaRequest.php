<?php

namespace App\Http\Requests\API\UNEG\Zonas;

use App\Classes\ApiFormRequest;
use App\Models\UNEG\Zona;
use Illuminate\Validation\Rule;

final class UpdateZonaRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $zona = Zona::where('id', $this->id)->firstOrFail();

        return [
            'nombre' => ['required', Rule::unique('uneg.sedes')->ignore($zona)],
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

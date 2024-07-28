<?php

namespace App\Http\Requests\API\UNEG\RelacionesLaborales;

use App\Classes\ApiFormRequest;
use App\Models\UNEG\RelacionLaboral;
use Illuminate\Validation\Rule;

final class UpdateRelacionesLaborales extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $relacion_laboral = RelacionLaboral::where('uuid', $this->uuid)->firstOrFail();

        return [
            'nombre' => ['required', Rule::unique('uneg.relaciones_laborales')->ignore($relacion_laboral)],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.unique' => 'Ya existe una relacion laboral con ese nombre',
        ];
    }
}

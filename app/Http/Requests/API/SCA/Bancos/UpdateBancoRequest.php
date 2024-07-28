<?php

namespace App\Http\Requests\API\SCA\Bancos;

use App\Classes\ApiFormRequest;
use App\Models\SCA\Banco;
use Illuminate\Validation\Rule;

final class UpdateBancoRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $banco = Banco::where('uuid', $this->uuid)->firstOrFail();

        return [
            'codigo' => ['required', 'numeric', Rule::unique('sca.bancos')->ignore($banco)],
            'nombre' => ['required', Rule::unique('sca.bancos')->ignore($banco)],
            'abreviatura' => ['nullable', Rule::unique('sca.bancos')->ignore($banco)],
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

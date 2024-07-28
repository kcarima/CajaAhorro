<?php

namespace App\Http\Requests\API\SCA\Parentesco;

use App\Classes\ApiFormRequest;
use App\Models\SCA\Parentesco;
use Illuminate\Validation\Rule;

final class UpdateParentescoRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $parentesco = Parentesco::where('uuid', $this->uuid)->firstOrFail();

        return [
            'nombre' => ['required', Rule::unique('sca.parentesco')->ignore($parentesco)],
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

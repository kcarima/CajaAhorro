<?php

namespace App\Http\Requests\API\Seguridad\User;

use App\Classes\ApiFormRequest;
use Illuminate\Validation\Rule;

final class UpdateUserRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', Rule::unique('seguridad.users')->ignore(auth()->user()->id)],
            'telefono' => ['regex:/\d{11}/', 'required'],
            'telefono_secundario' => ['regex:/\d{11}/', 'nullable'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'El correo electronico es obligatorio',
            'email.email' => 'El correo electronico posee un formato invalido',
            'email.unique' => 'El correo electronico ya esta siendo utilizado por otro usuario',
            'telefono.required' => 'El número de teléfono es obligatorio',
            'telefono.regex' => 'Formato de número de teléfono invalido',
            'telefono_secundario.regex' => 'Formato de número de teléfono invalido',
        ];
    }
}

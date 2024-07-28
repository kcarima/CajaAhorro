<?php

namespace App\Http\Requests\Seguridad;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['confirmed', 'min:8'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'password.min' => 'La contraseña debe tener por lo menos 8 caracteres',
            'password.confirmed' => 'Las constraseñas proporcionadas no coinciden',
        ];
    }
}

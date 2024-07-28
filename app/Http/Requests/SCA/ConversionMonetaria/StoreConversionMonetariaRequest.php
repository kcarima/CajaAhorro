<?php

namespace App\Http\Requests\SCA\ConversionMonetaria;

use Illuminate\Foundation\Http\FormRequest;

final class StoreConversionMonetariaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'moneda1' => ['required', 'exists:sca.monedas,uuid'],
            'moneda2' => ['required', 'exists:sca.monedas,uuid'],
            'cantidad' => ['required', 'numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'moneda1.required' => 'La moneda principal es un campo obligatorio',
            'moneda1.exists' => 'La moneda principal proporcionada no es valida',
            'moneda2.required' => 'La moneda secundaria es un campo obligatorio',
            'moneda2.exists' => 'La moneda secundaria proporcionada no es valida',
            'cantidad.required' => 'La cantidad es un campo obligatorio',
            'cantidad.numeric' => 'La cantidad debe ser un número',
        ];
    }
}

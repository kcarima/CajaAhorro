<?php

namespace App\Http\Requests\API\SCA\Monedas;

use App\Classes\ApiFormRequest;
use Carbon\Carbon;
use Closure;

final class UpdateMonedaRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required'],
            'abreviatura' => ['required'],
            'iso' => ['required'],
            'anio' => [
                'nullable',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (intval($value) > Carbon::now()->year) {
                        $fail('El año debe ser el actual o anterior a este');
                    }
                },
            ],
            'activa' => ['in:true,false'],
            'default' => ['in:true,false'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la moneda es obligatorio',
            'abreviatura.required' => 'La abreviatura de la moneda es obligatorio',
            'iso.required' => 'El código ISO 4217 es obligatorio',
            'activa.in' => 'El campo activo debe de ser verdadero o falso',
            'default.in' => 'El campo default debe de ser verdadero o falso',
        ];
    }
}

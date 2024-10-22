<?php

namespace App\Http\Requests\SCA\CuentaBancaria;

use App\Models\SCA\CuentaBancaria;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateCuentaBancaria extends FormRequest
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
        $cuenta = CuentaBancaria::where('uuid', $this->cuenta)->firstOrFail();

        return [
            'banco' => ['exists:sca.bancos,codigo', 'required'],
            'tipo_cuenta' => ['exists:sca.tipos_cuentas_bancarias,uuid', 'required'],
            'numero' => ['regex:/\d{20}/', 'required', Rule::unique('sca.cuentas_bancarias')->ignore($cuenta)],
            'saldo' => ['nullable', 'decimal:0,2'],
            'moneda' => ['nullable', 'exists:sca.monedas,uuid'],
            'public' => ['nullable', 'in:on,off'],
            'agencia' => ['nullable', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'banco.exists' => 'El banco seleccionado no existe',
            'banco.required' => 'El banco es un campo obligatorio',
            'tipo_cuenta.exists' => 'El tipo de cuenta seleccionado no existe',
            'tipo_cuenta.required' => 'El tipo de cuenta es obligatorio',
            'numero.regex' => 'El número de cuenta proporcionado contiene un formato invalido',
            'numero.required' => 'El número de cuenta es un campo obligatorio',
            'numero.unique' => 'Número de cuenta bancaria proporcionado ya existe',
            'saldo.decimal' => 'Saldo proporcionado no contiene un formato válido',
            'moneda.exists' => 'La moneda seleccionada no existe',
            'public.in' => 'El campo cuenta publica contiene un valor no válido',
            'agencia.max' => 'La agencia debe de contener una cantidad maxima de :max caracteres',
        ];
    }
}

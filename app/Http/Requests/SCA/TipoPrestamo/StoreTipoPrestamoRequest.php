<?php

namespace App\Http\Requests\SCA\TipoPrestamo;

use Illuminate\Foundation\Http\FormRequest;

final class StoreTipoPrestamoRequest extends FormRequest
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
            'nombre' => ['required', 'unique:sca.tipos_prestamos,nombre'],
            'codigo' => ['required', 'unique:sca.tipos_prestamos,codigo'],
            'cuotas' => ['required', 'integer', 'min:1'],
            'dias_cuotas' => ['nullable', 'integer', 'min:1'],
            'interes' => ['required', 'numeric', 'min:1'],
            'meses_tasa' => ['nullable', 'integer', 'min:1'],
            'plazo' => ['nullable', 'integer', 'min:0'],
            'especial' => ['nullable', 'in:on,off'],
            'habilitado' => ['nullable', 'in:on,off'],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del tipo de prestamo es un campo obligatorio.',
            'nombre.unique' => 'Ya existe un tipo de prestamo con ese nombre.',
            'codigo.required' => 'El código del tipo de prestamo es un campo obligatorio.',
            'codigo.unique' => 'Ya existe un tipo de prestamo con ese código.',
            'cuotas.required' => 'La cantidad de cuotas es un campo obligatorio.',
            'cuotas.integer' => 'La cantidad de cuotas debe ser un número entero.',
            'cuotas.min' => 'El mínimo de cantidad de cuotas debe ser 1.',
            'dias_cuotas.integer' => 'Los días de las cuotas deben ser un número entero.',
            'dias_cuotas.min' => 'La cantidad mínima de dias de cuotas es 1.',
            'interes.required' => 'La tasa de interes es un campo obligatorio.',
            'interes.numeric' => 'La tasa de interes debe ser un número.',
            'interes.min' => 'La tasa de interes debe ser por lo menos de 1.',
            'meses_tasa.integer' => 'Los meses de la tasa de interes debe ser un número entero.',
            'meses_tasa.min' => 'Los meses de la tasa de interes debe ser por lo menos 1.',
            'plazo.integer' => 'El plazo debe de ser un número entero.',
            'plazo.min' => 'El plazo debe de ser un número positivo.',
            'especial.in' => 'Valor de cuota especial proporcionado es invalido',
            'habilitado.in' => 'Valor de habilitado proporcionado es invalido',
        ];
    }
}

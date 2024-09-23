<?php

namespace App\Http\Requests\SCA\ConversionMonetaria;

use App\Models\SCA\ConversionMonetaria;
use App\Models\SCA\Moneda;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

final class ReconversionRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'moneda1.required' => 'La moneda principal es un campo obligatorio',
            'moneda1.exists' => 'La moneda principal proporcionada no es valida',
            'moneda2.required' => 'La moneda secundaria es un campo obligatorio',
            'moneda2.exists' => 'La moneda secundaria proporcionada no es valida',
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($this->validarConversion()) {
                    $validator->errors()->add(
                        'field',
                        'No existe una conversión monetaria para el par de monedas proporcionadas.'
                    );
                }
            },
        ];
    }

    public function validarConversion()
    {
        $data = $this->request->all();
        $moneda1 = Moneda::where('uuid', $data['moneda1'])->value('id');
        $moneda2 = Moneda::where('uuid', $data['moneda2'])->value('id');
        $conversion = ConversionMonetaria::where('moneda_principal_id', $moneda1)->where('moneda_secundaria_id', $moneda2)->first();

        return $conversion == null;
    }
}

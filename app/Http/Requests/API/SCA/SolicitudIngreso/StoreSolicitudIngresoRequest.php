<?php

namespace App\Http\Requests\API\SCA\SolicitudIngreso;

use App\Classes\ApiFormRequest;
use App\Models\SCA\Socio;
use Illuminate\Contracts\Validation\Validator;

final class StoreSolicitudIngresoRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nombres' => ['required', 'min:3'],
            'ficha' => ['required', 'unique:sca.socios,ficha'],
            'nacionalidad' => ['required', 'alpha:ascii', 'in:v,e'],
            'cedula' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if (Socio::where('cedula', 'like', "%$value")->first()) {
                        $fail('Ya existe un usuario con ese número de cédula.');
                    }
                },
            ],
            'email' => ['required', 'unique:seguridad.users,email', 'email'],
            'telefono' => ['regex:/\d{11}/', 'required'],
            'telefono_secundario' => ['regex:/\d{11}/', 'nullable'],
            'ingreso_uneg' => ['date', 'after:1982-03-08', 'required', 'before:tomorrow'],
            'cargo' => ['exists:uneg.cargos,nombre', 'required'],
            'departamento' => ['exists:uneg.departamentos,nombre', 'required'],
            'tipo' => ['exists:uneg.tipos_trabajadores,uuid', 'required'],
            'relacion_laboral' => ['exists:uneg.relaciones_laborales,uuid', 'required'],
            'sueldo' => ['decimal:0,2', 'required', 'min:0'],
            'zona' => ['exists:uneg.zonas,id', 'nullable'],
            'sede' => ['exists:uneg.sedes,id', 'nullable'],
            'banco.*.banco' => ['exists:sca.bancos,codigo', 'required'],
            'banco.*.tipo' => ['exists:sca.tipos_cuentas_bancarias,nombre', 'required'],
            'banco.*.numero' => ['distinct', 'regex:/\d{20}/', 'required'],
            'beneficiarios.*.nombre' => ['required', 'min:3'],
            'beneficiarios.*.fecha_nacimiento' => ['required', 'date', 'before:today'],
            'beneficiarios.*.nacionalidad' => ['required', 'alpha:ascii', 'in:v,e'],
            'beneficiarios.*.cedula' => ['required', 'numeric'],
            'beneficiarios.*.email' => ['required', 'email'],
            'beneficiarios.*.telefono' => ['regex:/\d{11}/', 'required'],
            'beneficiarios.*.telefono_secundario' => ['regex:/\d{11}/', 'nullable'],
            'beneficiarios.*.parentesco' => ['required', 'exists:sca.parentescos,uuid'],
            'beneficiarios.*.porcentaje' => ['required', 'numeric'],
            'beneficiarios.*.doc_cedula' => ['mimes:jpg,png,webp,pdf', 'required', 'max:100'],
            'doc_cedula' => ['mimes:jpg,png,webp,pdf', 'nullable', 'max:100'],
            'doc_resolucion' => ['mimes:pdf', 'nullable', 'max:100'],
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (! $this->validarPorcentajeAdjudicacion()) {
                    $validator->errors()->add(
                        'field',
                        'El % de adjudicación de todos los beneficiarios debe dar como total 100.'
                    );
                }
            },
        ];
    }

    private function validarPorcentajeAdjudicacion(): bool
    {
        if (isset($this->request->all()['beneficiarios'])) {
            $beneficiarios = $this->request->all()['beneficiarios'];
            $porcentaje = array_reduce(array_map(fn ($el) => $el['porcentaje'], $beneficiarios), fn ($carry, $item) => $carry + $item, 0);

            return $porcentaje == 100;
        }

        return true;
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nombres.required' => 'El nombre es obligatorio.',
            'nombres.min' => 'El nombre debe tener un minimo de 3 caracteres.',
            'ficha.required' => 'La ficha es obligatoria.',
            'ficha.unique' => 'La ficha ya esta siendo utilizada por otro usuario.',
            'nacionalidad.required' => 'La nacionalidad es obligatoria.',
            'nacionalidad.alpha' => 'La nacionalidad no debe contener ni números caracteres especiales.',
            'nacionalidad.in' => 'Proporcionar un valor válido para la nacionalidad.',
            'cedula.required' => 'El número de cédula es obligatorio.',
            'cedula.numeric' => 'El número de cédula solo puede contener números.',
            'cedula.min' => 'El número de cédula debe ser minimo :min.',
            'cedula.max' => 'El número de cédula debe ser máximo :max.',
            'email.required' => 'El correo electronico es obligatorio.',
            'email.unique' => 'El correo electronico ya esta siendo utilizado por otro usuario.',
            'email.email' => 'El correo electronico posee un formato invalido.',
            'telefono.required' => 'El número de teléfono es obligatorio.',
            'telefono.regex' => 'Formato de número de teléfono invalido.',
            'telefono_secundario.regex' => 'Formato de número de teléfono invalido.',
            'ingreso_uneg.date' => 'Formato de fecha de ingreso UNEG invalido.',
            'ingreso_uneg.after' => 'La fecha de ingreso UNEG debe ser mayor o igual al 09 de marzo de 1982.',
            'ingreso_uneg.required' => 'La fecha de ingreso UNEG es obligatorio.',
            'ingreso_uneg.before' => 'La fecha de ingreso UNEG no puede ser en el futuro.',
            'cargo.exists' => 'Cargo especificado no existe.',
            'cargo.required' => 'El cargo es un campo obligatorio.',
            'departamento.exists' => 'Departamento especificado no existe.',
            'departamento.required' => 'El departamento es un campo obligatorio.',
            'tipo.exists' => 'El tipo de empleado no es valido.',
            'tipo.required' => 'El tipo de empleado es un campo obligatorio.',
            'relacion_laboral.exists' => 'La condición del trabajador no es valido.',
            'relacion_laboral.required' => 'La condición del trabajador es un campo obligatorio.',
            'sueldo.decimal' => 'Formato de sueldo invalido.',
            'sueldo.required' => 'Formato de sueldo invalido.',
            'sueldo.min' => 'El sueldo debe ser un valor positivo.',
            'retiro_uneg.date' => 'Formato de fecha de retiro UNEG invalido.',
            'retiro_uneg.gt' => 'La fecha de retiro UNEG debe ser mayor a la fecha de ingreso.',
            'retiro_uneg.before' => 'La fecha de retiro UNEG no puede ser en el futuro.',
            'ingreso_cauneg.date' => 'Formato de fecha de ingreso CAUNEG invalido.',
            'ingreso_cauneg.after' => 'La fecha de ingreso CAUNEG debe ser mayor o igual al 09 de marzo de 1982.',
            'ingreso_cauneg.required' => 'La fecha de ingreso CAUNEG es obligatorio.',
            'ingreso_cauneg.before' => 'La fecha de ingreso CAUNEG no puede ser en el futuro.',
            'retiro_cauneg.date' => 'Formato de fecha de retiro CAUNEG invalido.',
            'retiro_cauneg.gt' => 'La fecha de retiro CAUNEG debe ser mayor a la fecha de ingreso.',
            'retiro_cauneg.before' => 'La fecha de retiro CAUNEG no puede ser en el futuro.',
            'zona.exists' => 'La zona proporcionada no esta en nuestros registros.',
            'zona.required' => 'La zona es un campo obligatorio.',
            'sede.exists' => 'La sede proporcionada no esta en nuestros registros.',
            'sede.required' => 'La sede es un campo obligatorio.',
            'banco.*.banco.required' => 'El banco #:position es obligatorio.',
            'banco.*.banco.exists' => 'El banco #:position no es valido.',
            'banco.*.tipo.required' => 'El tipo del banco #:position es obligatorio.',
            'banco.*.tipo.exists' => 'El tipo del banco #:position no es valido.',
            'banco.*.numero.distinct' => 'El número de cuenta del banco #:position esta repetido.',
            'banco.*.numero.required' => 'El número de cuenta del banco #:position es obligatorio.',
            'banco.*.numero.regex' => 'El número de cuenta del banco #:position tiene un formato invalido.',
            'beneficiarios.*.nombre.required' => 'El nombre del beneficiario #:position es obligatorio.',
            'beneficiarios.*.nombre.min' => 'El nombre del beneficiario #:position debe tener como mínimo 3 caracteres.',
            'beneficiarios.*.fecha_nacimiento.required' => 'La fecha de nacimiento del beneficiario #:position es obligatorio.',
            'beneficiarios.*.fecha_nacimiento.date' => 'La fecha de nacimiento del beneficiario #:position tiene un formato invalido.',
            'beneficiarios.*.fecha_nacimiento.before' => 'El beneficiario #:position debe tener una fecha de nacimiento anterior a hoy.',
            'beneficiarios.*.nacionalidad.required' => 'La nacionalidad del beneficiario #:position es obligatoria.',
            'beneficiarios.*.nacionalidad.alpha' => 'Formato de cédula del beneficiario #:position debe tener solo una letra.',
            'beneficiarios.*.nacionalidad.in' => 'La nacionalidad del beneficiario #:position no es válida.',
            'beneficiarios.*.cedula.required' => 'El número de cédula del beneficiario #:position es obligatorio.',
            'beneficiarios.*.cedula.numeric' => 'El número de cédula del beneficiario #:position debe ser solo números.',
            'beneficiarios.*.cedula.max' => 'El número de cédula del beneficiario #:position especificado no es válido.',
            'beneficiarios.*.email.required' => 'El correo electronico del beneficiario #:position es obligatorio.',
            'beneficiarios.*.email.email' => 'El correo electronico del beneficiario #:position tiene un formato invalido.',
            'beneficiarios.*.telefono.regex' => 'El teléfono del beneficiario #:position no tiene un formato válido.',
            'beneficiarios.*.telefono.required' => 'El teléfono del beneficiario #:position es obligatorio.',
            'beneficiarios.*.telefono_secundario.regex:/\d{11}/' => 'El teléfono secundario del beneficiario #:position no tiene un formato válido.',
            'beneficiarios.*.parentesco.required' => 'El parentesco del beneficiario #:position es obligatorio.',
            'beneficiarios.*.parentesco.exists' => 'El parentesco del beneficiario #:position proporcionado no es válido.',
            'beneficiarios.*.porcentaje.required' => 'El porcentaje de adjudicación del beneficiario #:position es obligatorio.',
            'beneficiarios.*.porcentaje.numeric' => 'El porcentaje de adjudicación del beneficiario #:position debe ser un número.',
            'beneficiarios.*.doc_cedula.mimes' => 'La copia de la cédula proporcionada tiene un formato inválido (formatos permitidos: pdf, jpg, webp y png).',
            'beneficiarios.*.doc_cedula.required' => 'Por favor proporcione la copia de la cédula.',
            'beneficiarios.*.doc_cedula.max' => 'El tamaño máximo de la copia de la cédula es de :maxkb.',
            'doc_cedula.mimes' => 'La copia de la cédula proporcionada tiene un formato inválido (formatos permitidos: pdf, jpg, webp y png).',
            'doc_cedula.required' => 'Por favor proporcione la copia de la cédula.',
            'doc_cedula.max' => 'El tamaño máximo de la copia de la cédula es de :maxkb.',
            'doc_resolucion.mimes' => 'La resolución proporcionada tiene un formato inválido (formatos permitidos pdf).',
            'doc_resolucion.required' => 'La resolución es un campo obligatorio.',
            'doc_resolucion.max' => 'La resolución debe tener un tamaño menor de :maxkb.',
        ];
    }
}
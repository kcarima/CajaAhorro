<?php

namespace App\Http\Requests\API\Seguridad\User;

use App\Classes\ApiFormRequest;
use App\Classes\Enums\TipoUsuario;
use App\Models\Seguridad\User;
use Illuminate\Validation\Rule;

final class UpdateUserAdminRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $user = User::where('uuid', 'like', $this->request->all()['user'])->firstOrFail();

        $roles = TipoUsuario::cases();
        /* Agarramos los roles que estan disponibles y los convertimos en un array con sus nombres en miniscula para
        compararlo con el valor que proporciono el usuario
        */
        $roles_validacion = [];

        foreach ($roles as $rol) {
            if ($rol != TipoUsuario::ROOT) {
                $roles_validacion[] = strtolower($rol->value);
            }
        }

        return [
            'nombres' => ['required', 'min:3'],
            'ficha' => ['required',  Rule::unique('sca.socios', 'ficha')->ignore($user->socio->id, 'id')],
            'nacionalidad' => ['required', 'alpha:ascii', 'in:v,e'],
            'cedula' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($user) {
                    if (User::where('cedula', 'like', '%value')->where('id', '!=', $user->id)->first()) {
                        $fail('Ya existe un usuario con ese número de cédula');
                    }
                },
            ],
            'email' => ['required', 'email', Rule::unique('seguridad.users')->ignore($user)],
            'telefono' => ['regex:/\d{11}/', 'required'],
            'telefono_secundario' => ['regex:/\d{11}/', 'nullable'],
            'fecha_fallecido' => ['date', 'nullable', 'before:tomorrow'],
            'ingreso_uneg' => ['date', 'after:1982-03-08', 'required', 'before:tomorrow'],
            'cargo' => ['exists:uneg.cargos,nombre'],
            'departamento' => ['exists:uneg.departamentos,nombre'],
            'tipo' => ['exists:uneg.tipos_trabajadores,id'],
            'relacion_laboral' => ['exists:uneg.relaciones_laborales,id'],
            'sueldo' => ['decimal:0,2', 'required', 'min:0'],
            'retiro_uneg' => ['date', 'nullable', 'before:tomorrow'],
            'ingreso_cauneg' => ['date', 'after:1982-03-08', 'required', 'before:tomorrow'],
            'retiro_cauneg' => ['date', 'gt:ingreso_cauneg', 'nullable', 'before:tomorrow'],
            'rol' => ['required', Rule::in($roles_validacion)],
            'banco.*.banco' => ['exists:sca.bancos,codigo', 'required'],
            'banco.*.tipo' => ['exists:sca.tipos_cuentas_bancarias,nombre', 'required'],
            'banco.*.numero' => ['regex:/\d{20}/', 'required'],
            'beneficiario.*.nombre' => ['required', 'min:3'],
            'beneficiario.*.fecha_nacimiento' => ['required', 'date', 'before:today'],
            'beneficiario.*.nacionalidad' => ['required', 'alpha:ascii', 'in:v,e'],
            'beneficiario.*.cedula' => ['required', 'numeric'],
            'beneficiario.*.email' => ['required', 'email'],
            'beneficiario.*.telefono' => ['regex:/\d{11}/', 'required'],
            'beneficiario.*.telefono_secundario' => ['regex:/\d{11}/', 'nullable'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nombres.required' => 'El nombre es obligatorio',
            'nombres.min' => 'El nombre debe tener un minimo de 3 caracteres',
            'ficha.required' => 'La ficha es obligatoria',
            'ficha.unique' => 'La ficha ya esta siendo utilizada por otro usuario',
            'nacionalidad.required' => 'La nacionalidad es obligatoria',
            'nacionalidad.alpha' => 'La nacionalidad no debe contener ni números caracteres especiales',
            'nacionalidad.in' => 'Proporcionar un valor válido para la nacionalidad',
            'cedula.required' => 'El número de cédula es obligatorio',
            'cedula.numeric' => 'El número de cédula solo puede contener números',
            'cedula.min' => 'El número de cédula debe ser minimo :min',
            'cedula.max' => 'El número de cédula debe ser máximo :max',
            'email.required' => 'El correo electronico es obligatorio',
            'email.email' => 'El correo electronico posee un formato invalido',
            'email.unique' => 'El correo electronico ya esta siendo utilizado por otro usuario',
            'telefono.required' => 'El número de teléfono es obligatorio',
            'telefono.regex' => 'Formato de número de teléfono invalido',
            'telefono_secundario.regex' => 'Formato de número de teléfono invalido',
            'fecha_fallecido.date' => 'Formato de fecha de fallecido invalido',
            'fecha_fallecido.before' => 'La fecha de fallecido no puede ser en el futuro',
            'ingreso_uneg.date' => 'Formato de fecha de ingreso UNEG invalido',
            'ingreso_uneg.after' => 'La fecha de ingreso UNEG debe ser mayor o igual al 09 de marzo de 1982',
            'ingreso_uneg.required' => 'La fecha de ingreso UNEG es obligatorio',
            'ingreso_uneg.before' => 'La fecha de ingreso UNEG no puede ser en el futuro',
            'cargo.exists' => 'Cargo especificado no existe',
            'cargo.required' => 'El cargo es un campo obligatorio',
            'departamento.exists' => 'Departamento especificado no existe',
            'departamento.required' => 'El departamento es un campo obligatorio',
            'tipo.exists' => 'El tipo de empleado no es valido',
            'tipo.required' => 'El tipo de empleado es un campo obligatorio',
            'relacion_laboral.exists' => 'La condición del trabajador no es valido',
            'relacion_laboral.required' => 'La condición del trabajador es un campo obligatorio',
            'sueldo.decimal' => 'Formato de sueldo invalido',
            'sueldo.required' => 'Formato de sueldo invalido',
            'sueldo.min' => 'El sueldo debe ser un valor positivo',
            'retiro_uneg.date' => 'Formato de fecha de retiro UNEG invalido',
            'retiro_uneg.gt' => 'La fecha de retiro UNEG debe ser mayor a la fecha de ingreso',
            'retiro_uneg.before' => 'La fecha de retiro UNEG no puede ser en el futuro',
            'ingreso_cauneg.date' => 'Formato de fecha de ingreso CAUNEG invalido',
            'ingreso_cauneg.after' => 'La fecha de ingreso CAUNEG debe ser mayor o igual al 09 de marzo de 1982',
            'ingreso_cauneg.required' => 'La fecha de ingreso CAUNEG es obligatorio',
            'ingreso_cauneg.before' => 'La fecha de ingreso CAUNEG no puede ser en el futuro',
            'retiro_cauneg.date' => 'Formato de fecha de retiro CAUNEG invalido',
            'retiro_cauneg.gt' => 'La fecha de retiro CAUNEG debe ser mayor a la fecha de ingreso',
            'retiro_cauneg.before' => 'La fecha de retiro CAUNEG no puede ser en el futuro',
            'rol.required' => 'El rol es obligatorio',
            'rol.in' => 'Rol proporcionado invalido',
            'banco.*.banco.required' => 'El banco #:index es obligatorio',
            'banco.*.banco.exists' => 'El banco #:index no es valido',
            'banco.*.tipo.required' => 'El tipo del banco #:index es obligatorio',
            'banco.*.tipo.exists' => 'El tipo del banco #:index no es valido',
            'banco.*.numero.required' => 'El número de cuenta del banco #:index es obligatorio',
            'banco.*.numero.regex' => 'El número de cuenta del banco #:index tiene un formato invalido',
            'beneficiario.*.nombre.required' => 'El nombre del beneficiario #:index es obligatorio',
            'beneficiario.*.nombre.min' => 'El nombre del beneficiario #:index debe tener como mínimo 3 caracteres',
            'beneficiario.*.fecha_nacimiento.required' => 'La fecha de nacimiento del beneficiario #:index es obligatorio',
            'beneficiario.*.fecha_nacimiento.date' => 'La fecha de nacimiento del beneficiario #:index tiene un formato invalido',
            'beneficiario.*.fecha_nacimiento.before' => 'El beneficiario #:index debe tener una fecha de nacimiento anterior a hoy',
            'beneficiario.*.nacionalidad.required' => 'La nacionalidad del beneficiario #:index es obligatoria',
            'beneficiario.*.nacionalidad.alpha' => 'Formato de cédula del beneficiario #:index debe tener solo una letra',
            'beneficiario.*.nacionalidad.in' => 'La nacionalidad del beneficiario #:index no es válida',
            'beneficiario.*.cedula.required' => 'El número de cédula del beneficiario #:index es obligatorio',
            'beneficiario.*.cedula.numeric' => 'El número de cédula del beneficiario #:index debe ser solo números',
            'beneficiario.*.cedula.max' => 'El número de cédula del beneficiario #:index especificado no es válido',
            'beneficiario.*.email.required' => 'El correo electronico del beneficiario #:index es obligatorio',
            'beneficiario.*.email.email' => 'El correo electronico del beneficiario #:index tiene un formato invalido',
            'beneficiario.*.telefono.regex' => 'El teléfono del beneficiario #:index no tiene un formato válido',
            'beneficiario.*.telefono.required' => 'El teléfono del beneficiario #:index es obligatorio',
            'beneficiario.*.telefono_secundario.regex:/\d{11}/' => 'El teléfono secundario del beneficiario #:index no tiene un formato válido',
        ];
    }
}

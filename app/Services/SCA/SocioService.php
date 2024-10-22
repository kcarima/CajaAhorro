<?php

namespace App\Services\SCA;

use App\Classes\Enums\StatusPassword;
use App\Mail\Seguridad\Usuarios\WelcomeEmail;
use App\Models\SCA\Documento;
use App\Models\SCA\HistoricoFichaSocio;
use App\Models\SCA\Parentesco;
use App\Models\SCA\Socio;
use App\Models\Seguridad\User;
use App\Models\UNEG\Cargo;
use App\Models\UNEG\Departamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

final readonly class SocioService
{
    public const BENEFICIARIO_DOC_CEDULA_PATH = 'documentos/beneficiarios/cedulas';

    public static function createSocio(array $data): Socio
    {

        $codigo_cargo = Cargo::where('nombre', 'like', $data['cargo'])->value('codigo');
        $codigo_departamento = Departamento::where('nombre', 'like', $data['departamento'])->value('codigo');
        $zona = null;

        if(isset($data['sede'])){
            $sede = DB::connection('uneg')->table('sedes')->where('id', $data['sede'])->value('id');
        }else{
            $sede = null;
        }

        if(isset($data['zona'])){
            $zona = DB::connection('uneg')->table('zonas')->where('id', $data['zona'])->value('id');
        }

        $id_moneda = DB::connection('sca')->table('monedas')->where('es_default', true)->value('id');

        $cedula = get_cedula(nacionalidad: $data['nacionalidad'], numero: $data['cedula']);

        $socioData = [
            'nombre' => $data['nombres'],
            'ficha' => $data['ficha'],
            'cedula' => $cedula,
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'fecha_ingreso_uneg' => $data['ingreso_uneg'],
            'fecha_retiro_uneg' => $data['retiro_uneg'] ?? null,
            'fecha_ingreso_cauneg' => $data['ingreso_cauneg'],
            'fecha_retiro_cauneg' => $data['retiro_cauneg'] ?? null,
            'codigo_cargo' => $codigo_cargo,
            'codigo_departamento' => $codigo_departamento,
            'relacion_laboral_id' => $data['relacion_laboral'],
            'tipo_trabajador_id' => $data['tipo'],
            'sueldo' => $data['sueldo'],
            'moneda_id' => $id_moneda,
            'es_fiador' => $data['fiador'] ?? false,
            'telefono' => $data['telefono'],
            'telefono_secundario' => $data['telefono_secundario'],
            'zona_id' => $zona,
            'sede_id' => $sede,
        ];

        return Socio::create($socioData);
    }

    public static function createBeneficiarios(Socio $socio, array $data)
    {
        $parentesco_id = Parentesco::where('uuid', $data['parentesco'])->value('id');
        $beneficiarios = collect($data)->map(function ($beneficiario) use ($socio, $parentesco_id) {
            return [
                'nombre' => $beneficiario['nombre'],
                'cedula' => get_cedula(nacionalidad: $beneficiario['nacionalidad'], numero: $beneficiario['cedula']),
                'email' => $beneficiario['email'],
                'telefono' => $beneficiario['telefono'],
                'telefono_secundario' => $beneficiario['telefono_secundario'],
                'fecha_nacimiento' => $beneficiario['fecha_nacimiento'],
                'cedula_benefactor' => $socio->cedula,
                'parentesto_id' => $parentesco_id,
                'doc_cedula' => $beneficiario['doc_cedula']->store(self::BENEFICIARIO_DOC_CEDULA_PATH),
            ];
        });

        $socio->beneficiarios()->createMany($beneficiarios->toArray());
    }

    public static function createBancos(Socio $socio, array $data)
    {
        $bancos = collect($data)->map(function ($banco) {
            return [
                'codigo_banco' => $banco['banco'],
                'numero_cuenta' => $banco['numero'],
                'tipo_cuenta' => $banco['tipo'],
            ];
        })->toArray();

        $socio->bancos()->sync($bancos);
    }

    public static function createUser(Socio $socio, array $data): User
    {
        $userData = [
            'cedula' => $socio->cedula,
            'tipo' => strtoupper($data['rol']),
            'email' => $data['email'],
            'password' => Hash::make($data['cedula']),
            'status_password' => StatusPassword::CAMBIAR,
        ];

        return User::create($userData);
    }

    public static function createDocuments(Socio $socio, array $data): void
    {

        $doc_cedula = Documento::where('nombre', 'like', 'Cédula')->first();
        $doc_resolucion = Documento::where('nombre', 'like', 'Resolución')->first();
        $docData = [];

        if(isset($data['doc_cedula'])) {
            $docData[$doc_cedula->id] = [
                'ruta' => $data['doc_cedula']->store($doc_cedula->carpeta),
            ];
        }

        if(isset($data['doc_resolucion'])) {
            $docData[$doc_resolucion->id] = [
                'ruta' => $data['doc_resolucion']->store($doc_resolucion->carpeta),
            ];
        }

        if(count($docData) > 0) {
            $socio->documentos()->attach($docData);
        }

    }

    public static function generarPlanillas(Socio $socio): void
    {
        PlanillasService::generarPlanillaInscripcion($socio);
    }

    public static function sendWelcomeEmail(User $user)
    {
        Mail::to($user->email)->send(new WelcomeEmail($user));
    }

    public static function updateSocio(Socio $socio, array $data)
    {
        $codigo_cargo = Cargo::where('nombre', 'like', $data['cargo'])->value('codigo');
        $codigo_departamento = Departamento::where('nombre', 'like', $data['departamento'])->value('codigo');

        $socio->fill([
            'cedula' => get_cedula(nacionalidad: $data['nacionalidad'], numero: $data['cedula']),
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'fecha_ingreso_uneg' => $data['ingreso_uneg'],
            'fecha_retiro_uneg' => $data['retiro_uneg'],
            'fecha_ingreso_cauneg' => $data['ingreso_cauneg'],
            'fecha_retiro_cauneg' => $data['retiro_cauneg'] ?? null,
            'codigo_cargo' => $codigo_cargo,
            'codigo_departamento' => $codigo_departamento,
            'relacion_laboral_id' => $data['relacion_laboral'],
            'tipo_trabajador_id' => $data['tipo'],
            'sueldo' => $data['sueldo'],
            'es_fiador' => $data['fiador'] ?? false,
            'telefono' => $data['telefono'],
            'telefono_secundario' => $data['telefono_secundario'] ?? null,
            'nombre' => $data['nombres'],
            'ficha' => $data['ficha'],
            'fecha_fallecido' => $data['fecha_fallecido'] ?? null,
            'sede_id' => $data['sede'],
            'zona_id' => $data['zona'],
        ]);

        $socio->save();
    }

    public static function updateUser(Socio $socio, array $data)
    {
        $usuario = $socio->user;

        $usuario->fill([
            'tipo' => strtoupper($data['rol']),
            'email' => $data['email'],
        ]);

        $usuario->save();
    }

    public static function updateBancos(Socio $socio, array $data)
    {

        $cuentas_bancarias = collect($data['banco'] ?? []);
        $numeros_cuentas = $cuentas_bancarias->pluck('numero')->toArray();

        $bancos_a_eliminar = $socio->bancos()->whereNotIn('numero_cuenta', $numeros_cuentas)->pluck('bancos_socios.id')->toArray();

        DB::connection('sca')->table('bancos_socios')->whereIn('id', $bancos_a_eliminar)->delete();

        $cuentas_bancarias_a_agregar = $cuentas_bancarias->reject(function ($banco) use ($socio) {
            return $socio->bancos->contains(function ($b) use ($banco) {
                return $b->pivot->numero_cuenta == $banco['numero'];
            });
        });

        $data_bancos = $cuentas_bancarias_a_agregar->map(function ($banco) {
            return [
                'codigo_banco' => $banco['banco'],
                'numero_cuenta' => $banco['numero'],
                'tipo_cuenta' => $banco['tipo'],
            ];
        });

        $socio->bancos()->attach($data_bancos->toArray());
    }

    public static function updateBeneficiarios(Socio $socio, array $data)
    {

        $beneficiarios = collect($data['beneficiario'] ?? []);
        $cedulas_beneficiarios = $beneficiarios->pluck('cedula')->toArray();

        $beneficiarios_a_eliminar = $socio->beneficiarios()->whereNotIn('cedula', $cedulas_beneficiarios)->pluck('id')->toArray();

        DB::connection('sca')->table('beneficiarios')->whereIn('id', $beneficiarios_a_eliminar)->delete();

        $beneficiarios_a_agregar = $beneficiarios->reject(function ($beneficiario) use ($socio) {
            return $socio->beneficiarios->contains(function ($b) use ($beneficiario) {
                return $b->cedula == $beneficiario['cedula'];
            });
        });

        $data_beneficiarios = $beneficiarios_a_agregar->map(function ($beneficiario) use ($socio) {
            return [
                'nombre' => $beneficiario['nombre'],
                'cedula' => get_cedula(nacionalidad: $beneficiario['nacionalidad'], numero: $beneficiario['cedula']),
                'email' => $beneficiario['email'],
                'telefono' => $beneficiario['telefono'],
                'telefono_secundario' => $beneficiario['telefono_secundario'],
                'fecha_nacimiento' => $beneficiario['fecha_nacimiento'],
                'cedula_benefactor' => $socio->cedula,
            ];
        });

        $socio->beneficiarios()->createMany($data_beneficiarios->toArray());
    }

    public static function createHistoricoFicha(array $data)
    {
        HistoricoFichaSocio::create($data);
    }

    public static function getDataFicha(Socio $socio): array
    {
        return [
            'ficha_anterior' => $socio->ficha,
            'codigo_cargo' => $socio->codigo_cargo,
            'codigo_departamento' => $socio->codigo_departamento,
            'relacion_laboral_id' => $socio->relacion_laboral_id,
            'tipo_trabajador_id' => $socio->tipo_trabajador_id,
            'sueldo' => $socio->sueldo,
            'moneda_id' => $socio->moneda_id,
            'sede' => $socio->sede_id,
            'zona' => $socio->zona_id,
        ];
    }
}

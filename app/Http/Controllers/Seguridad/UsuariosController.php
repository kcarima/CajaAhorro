<?php

namespace App\Http\Controllers\Seguridad;

use App\Classes\Enums\StatusPassword;
use App\Classes\Enums\TipoUsuario;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\Seguridad\User\StoreUsersRequest;
use App\Http\Requests\API\Seguridad\User\UpdateUserAdminRequest;
use App\Http\Requests\API\Seguridad\User\UpdateUserRequest;
use App\Models\SCA\Banco;
use App\Models\SCA\Parentesco;
use App\Models\SCA\Socio;
use App\Models\SCA\TipoCuentaBancaria;
use App\Models\Seguridad\User;
use App\Models\UNEG\Cargo;
use App\Models\UNEG\Departamento;
use App\Models\UNEG\RelacionLaboral;
use App\Models\UNEG\Sede;
use App\Models\UNEG\TipoTrabajador;
use App\Models\UNEG\Zona;
use App\Services\SCA\SocioService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

final class UsuariosController extends Controller
{
    use ApiResponse;

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('seguridad.usuarios.index');
    }

    public function show(User $user): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('seguridad.usuarios.show', ['usuario' => $user]);
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        $cargos = Cargo::pluck('nombre');
        $departamentos = Departamento::pluck('nombre');
        $tipos_empleados = TipoTrabajador::all(['id', 'nombre']);
        $condiciones_laborales = RelacionLaboral::all(['id', 'nombre']);
        $bancos = Banco::all(['codigo', 'nombre', 'abreviatura']);
        $tipos_cuentas = TipoCuentaBancaria::public()->pluck('nombre');
        $parentescos = Parentesco::all(['uuid', 'nombre']);
        $zonas = Zona::all(['uuid', 'nombre']);
        $sedes = Sede::all(['uuid', 'nombre']);

        $roles = [];

        foreach (TipoUsuario::cases() as $rol) {
            if ($rol != TipoUsuario::ROOT) {
                $roles[] = $rol;
            }
        }

        return view(
            'auth.register',
            [
                'cargos' => $cargos,
                'departamentos' => $departamentos,
                'tipos_empleados' => $tipos_empleados,
                'condiciones_laborales' => $condiciones_laborales,
                'bancos' => $bancos,
                'tipos_cuentas' => $tipos_cuentas,
                'roles' => $roles,
                'parentescos' => $parentescos,
                'zonas' => $zonas,
                'sedes' => $sedes,
            ]
        );
    }

    public function store(StoreUsersRequest $request): JsonResponse
    {

        try {
            $socio = SocioService::createSocio($request->all());

            if ($request->beneficiario) {
                SocioService::createBeneficiarios($socio, $request->beneficiario);
            }

            if ($request->banco) {
                SocioService::createBancos($socio, $request->banco);
            }

            SocioService::createDocuments($socio, $request->all());

            $user = SocioService::createUser($socio, $request->all());
        } catch (Exception $e) {

            if (isset($socio)) {
                $socio->beneficiarios()->forceDelete();
                $socio->bancos()->delete();
                if ($socio->documentos()->exists()) {
                    $documentos = $socio->documentos;
                    foreach ($documentos as $documento) {
                        Storage::delete($documento->ruta);
                    }
                }
                $socio->forceDelete();
            }

            if (isset($user)) {
                $user->forceDelete();
            }

            $mensaje = 'Error al crear al usuario.';
            throw $e;

            return $this->errorMessage(message: $mensaje, code: 500);
        }

        try {
            SocioService::sendWelcomeEmail($user);
        } catch (Exception $e) {
            $mensaje = 'El usuario se ha registrado correctamente, pero ha habido un problema con el envío del correo electrónico.';

            return $this->successMessage(message: $mensaje, data: ['redirect' => route('usuarios.index')]);
        }

        $mensaje = "Usuario $socio->nombre ($socio->ficha) creado satisfactoriamente. (usuario es la cédula con la nacionalidad la clave el número de cédula sin la nacionalidad)";

        return $this->successMessage(message: $mensaje, data: ['redirect' => route('usuarios.index')]);
    }

    public function edit(string $cedula): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {

        $usuario = User::where('cedula', $cedula)->firstOrFail();

        $cargos = Cargo::pluck('nombre');
        $departamentos = Departamento::pluck('nombre');
        $tipos_empleados = TipoTrabajador::all(['id', 'nombre']);
        $condiciones_laborales = RelacionLaboral::all(['id', 'nombre']);
        $bancos = Banco::all(['codigo', 'nombre', 'abreviatura']);
        $tipos_cuentas = TipoCuentaBancaria::public()->pluck('nombre');
        $sedes = Sede::all(['uuid', 'nombre']);
        $zonas = Zona::all(['uuid', 'nombre']);
        $parentescos = Parentesco::all(['uuid', 'nombre']);


        $roles = [];

        foreach (TipoUsuario::cases() as $rol) {
            if ($rol != TipoUsuario::ROOT) {
                $roles[] = $rol;
            }
        }

        return view(
            'auth.edit-user-admin',
            [
                'usuario' => $usuario,
                'cargos' => $cargos,
                'departamentos' => $departamentos,
                'tipos_empleados' => $tipos_empleados,
                'condiciones_laborales' => $condiciones_laborales,
                'bancos' => $bancos,
                'tipos_cuentas' => $tipos_cuentas,
                'roles' => $roles,
                'sedes' => $sedes,
                'zonas' => $zonas,
                'parentescos' => $parentescos
            ]
        );
    }

    public function editUser(string $cedula): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {

        $usuario = User::where('cedula', $cedula)->firstOrFail();

        $cargos = Cargo::pluck('nombre');
        $departamentos = Departamento::pluck('nombre');
        $tipos_empleados = TipoTrabajador::all(['id', 'nombre']);
        $condiciones_laborales = RelacionLaboral::all(['id', 'nombre']);
        $bancos = Banco::all(['codigo', 'nombre', 'abreviatura']);
        $tipos_cuentas = TipoCuentaBancaria::public()->pluck('nombre');

        $roles = [];

        foreach (TipoUsuario::cases() as $rol) {
            if ($rol != TipoUsuario::ROOT) {
                $roles[] = $rol;
            }
        }

        return view(
            'auth.edit-user',
            [
                'usuario' => $usuario,
                'cargos' => $cargos,
                'departamentos' => $departamentos,
                'tipos_empleados' => $tipos_empleados,
                'condiciones_laborales' => $condiciones_laborales,
                'bancos' => $bancos,
                'tipos_cuentas' => $tipos_cuentas,
                'roles' => $roles,
            ]
        );
    }

    public function update(UpdateUserAdminRequest $request, string $cedula): JsonResponse
    {

        try {

            $socio = Socio::where('cedula', 'like', '%'.$cedula.'%')->firstOrFail();

            $data_ficha = SocioService::getDataFicha($socio);

            SocioService::updateSocio($socio, $request->all());

            $data_ficha_actual = SocioService::getDataFicha($socio);

            if ($data_ficha['ficha_anterior'] != $data_ficha_actual['ficha_anterior']) {
                $data_ficha['cedula'] = $socio->cedula;
                SocioService::createHistoricoFicha($data_ficha);
            }

            SocioService::updateUser($socio, $request->all());

            // Actualizar bancos
            SocioService::updateBancos($socio, $request->all());

            // Actualizar beneficiarios
            SocioService::updateBeneficiarios($socio, $request->all());

        } catch (ModelNotFoundException $e) {

            $mensaje = 'Usuario no encontrado.';

            return $this->errorMessage(message: $mensaje, code: 404);

        } catch (Exception $e) {

            $mensaje = "Error al editar al usuario $socio->nombre ($socio->ficha) por favor intentelo de nuevo.";

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Usuario $socio->nombre ($socio->ficha) editado satisfactoriamente.";

        return $this->successMessage(message: $mensaje);
    }

    public function updateUser(UpdateUserRequest $request): JsonResponse
    {
        $user = auth()->user();
        $socio = $user->socio;

        try {

            $user->email = $request->email;
            $user->save();

            $socio->fill([
                'telefono' => $request->telefono,
                'telefono_secundario' => $request->telefono_secundario,
            ]);

            $socio->save();

        } catch (Exception $e) {

            $mensaje = "Error al editar al usuario $socio->nombre ($socio->ficha) por favor intentelo de nuevo.";

            return $this->errorMessage(message: $mensaje, code: 500);
        }

        $mensaje = "Usuario $socio->nombre ($socio->ficha) editado satisfactoriamente.";

        return $this->successMessage(message: $mensaje, data: ['redirect' => route('usuario.user.edit', auth()->user()->cedula)]);
    }

    public function resetPassword(Request $request): JsonResponse
    {

        try {
            $usuario = User::where('cedula', 'like', $request->cedula)->firstOrFail();
            $usuario->password = Hash::make($usuario->numero_cedula);
            $usuario->status_password = StatusPassword::CAMBIAR;
            $usuario->intentos_login = 0;
            $usuario->fecha_intentos_login = null;

            $usuario->save();
        } catch (ModelNotFoundException $e) {

            $mensaje = 'Error al encontrar al usuario.';

            return $this->errorMessage(message: $mensaje, code: 404);

        } catch (Exception $e) {

            $mensaje = 'Ha ocurrido un error. Intentelo de nuevo.';

            return $this->errorMessage(message: $mensaje, code: 500);
        }

        return $this->successMessage(message: 'Contraseña reestablecida correctamente.', data: ['redirect' => route('usuarios.index')]);
    }
}
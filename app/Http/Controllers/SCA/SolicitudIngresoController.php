<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SCA\SolicitudIngreso\StoreSolicitudIngresoRequest;
use App\Models\SCA\Banco;
use App\Models\SCA\Parentesco;
use App\Models\SCA\SolicitudIngreso;
use App\Models\SCA\TipoCuentaBancaria;
use App\Models\UNEG\Cargo;
use App\Models\UNEG\Departamento;
use App\Models\UNEG\RelacionLaboral;
use App\Models\UNEG\Sede;
use App\Models\UNEG\TipoTrabajador;
use App\Models\UNEG\Zona;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Support\Facades\Storage;

final class SolicitudIngresoController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('sca.solicitud-ingreso.index');
    }

    public function create()
    {

        $cargos = Cargo::pluck('nombre');
        $departamentos = Departamento::pluck('nombre');
        $tipos_empleados = TipoTrabajador::all(['uuid', 'nombre']);
        $condiciones_laborales = RelacionLaboral::all(['uuid', 'nombre']);
        $bancos = Banco::all(['codigo', 'nombre', 'abreviatura']);
        $tipos_cuentas = TipoCuentaBancaria::public()->pluck('nombre');
        $parentescos = Parentesco::all(['uuid', 'nombre']);
        $zonas = Zona::all(['uuid', 'nombre']);
        $sedes = Sede::all(['uuid', 'nombre']);

        $data = [
            'cargos' => $cargos,
            'departamentos' => $departamentos,
            'tipos_empleados' => $tipos_empleados,
            'condiciones_laborales' => $condiciones_laborales,
            'bancos' => $bancos,
            'tipos_cuentas' => $tipos_cuentas,
            'parentescos' => $parentescos,
            'zonas' => $zonas,
            'sedes' => $sedes,
        ];

        return view('sca.solicitud-ingreso.create', $data);
    }

    public function store(StoreSolicitudIngresoRequest $request)
    {

        $cargo = Cargo::where('nombre', 'ilike', '%'.$request->cargo.'%')->value('codigo');
        $departamento = Departamento::where('nombre', 'ilike', '%'.$request->departamento.'%')->value('codigo');
        $relacion_laboral = RelacionLaboral::where('uuid', $request->relacion_laboral)->value('id');
        $sede = null;
        $zona = null;
        $tipo_trabajador = TipoTrabajador::where('uuid', $request->tipo)->value('id');
        $doc_cedula = null;
        $doc_resolucion = null;

        if(isset($request->sede)) {
            $sede = Sede::where('uuid', $request->sede)->value('id');
        }

        if(isset($request->zona)) {
            $zona = Zona::where('uuid', $request->zona)->value('id');
        }

        if($request->doc_cedula) {
            $doc_cedula = $request->doc_cedula->store('solicitudes/socios/cedulas/');
        }

        if($request->doc_resolucion) {
            $doc_resolucion = $request->doc_resolucion->store('solicitudes/socios/resoluciones/');
        }

        $data_beneficiarios = $request->beneficiarios;

        if ($data_beneficiarios) {
            foreach ($data_beneficiarios as $beneficiario) {
                $doc_cedula = eliminar_elemento_asociativo($beneficiario, 'doc_cedula');
                $beneficiario['doc_cedula'] = $doc_cedula->store('solicitudes/beneficiarios/cedulas/');
            }
        }

        try {

            SolicitudIngreso::create([
                'nombres' => $request->nombres,
                'ficha' => $request->ficha,
                'cedula' => get_cedula(nacionalidad: $request->nacionalidad, numero: $request->cedula),
                'email' => $request->email,
                'fecha_ingreso_uneg' => $request->ingreso_uneg,
                'codigo_cargo' => $cargo,
                'codigo_departamento' => $departamento,
                'relacion_laboral_id' => $relacion_laboral,
                'tipo_trabajador_id' => $tipo_trabajador,
                'sueldo' => $request->sueldo,
                'telefono' => $request->telefono,
                'telefono_secundario' => $request->telefono_secundario,
                'beneficiarios' => isset($data_beneficiarios) ? json_encode($data_beneficiarios) : null,
                'bancos' => isset($request->banco) ? json_encode($request->banco) : null,
                'doc_cedula' => $doc_cedula,
                'doc_resolucion' => $doc_resolucion,
                'sede_id' => $sede,
                'zona_id' => $zona,
            ]);

        } catch (Exception $e) {
            if ($doc_cedula) {
                Storage::delete($doc_cedula);
            }
            if ($doc_resolucion) {
                Storage::delete($doc_resolucion);
            }
            
            throw_if(env('APP_DEBUG'), $e);

            return $this->errorMessage(message: 'Error al registrar la solicitud.');
        }

        return $this->successMessage(message: 'Solicitud registrada con exito');
    }
}

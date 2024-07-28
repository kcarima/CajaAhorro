<?php

namespace App\Http\Controllers\UNEG;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UNEG\TiposTrabajadores\StoreTiposTrabajadoresRequest;
use App\Http\Requests\API\UNEG\TiposTrabajadores\UpdateTiposTrabajadoresRequest;
use App\Models\UNEG\TipoTrabajador;
use App\Traits\ApiResponse;
use Exception;

final class TiposTrabajadoresController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('uneg.tipos-trabajadores.index');
    }

    public function store(StoreTiposTrabajadoresRequest $request)
    {

        try {
            $tipo_trabajador = TipoTrabajador::create([
                'nombre' => $request->nombre,
            ]);
        } catch (Exception $e) {

            $mensaje = 'Error al crear el tipo de trabajador.';

            return $this->errorMessage(message: $mensaje, code: 500);
        }

        $mensaje = "Tipo trabajador $tipo_trabajador->nombre creado satisfactoriamente.";

        return $this->successMessage(message: $mensaje, data: ['id' => $tipo_trabajador->uuid]);
    }

    public function update(UpdateTiposTrabajadoresRequest $request, $uuid)
    {
        $tipo_trabajador = TipoTrabajador::where('uuid', $uuid)->firstOrFail();

        try {
            $tipo_trabajador->nombre = $request->nombre;
            $tipo_trabajador->save();
        } catch (Exception $e) {

            $mensaje = 'Error al actualizar el tipo de trabajador.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Tipo trabajador $tipo_trabajador->nombre actualizado satisfactoriamente.";

        return $this->successMessage(message: $mensaje);
    }
}

<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SCA\TiposCuentasBancarias\StoreTiposCuentasBancariasRequest;
use App\Http\Requests\API\SCA\TiposCuentasBancarias\UpdateTiposCuentasBancariasRequest;
use App\Models\SCA\TipoCuentaBancaria;
use App\Traits\ApiResponse;
use Exception;

final class TiposCuentasBancariasController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('sca.tipos-cuentas-bancarias.index');
    }

    public function store(StoreTiposCuentasBancariasRequest $request)
    {

        try {
            $tipo_cuenta = TipoCuentaBancaria::create([
                'nombre' => $request->nombre,
                'is_public' => $request->publico,
            ]);
        } catch (Exception $e) {

            $mensaje = 'Error al crear el tipo de cuenta.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Tipo cuenta $tipo_cuenta->nombre creado satisfactoriamente.";

        return $this->successMessage(message: $mensaje, data: ['id' => $tipo_cuenta->uuid]);
    }

    public function update(UpdateTiposCuentasBancariasRequest $request, string $uuid)
    {
        $tipo_cuenta_bancaria = TipoCuentaBancaria::where('uuid', $uuid)->firstOrFail();

        try {

            $tipo_cuenta_bancaria->fill([
                'nombre' => $request->nombre,
                'is_public' => $request->publico,
            ]);
            $tipo_cuenta_bancaria->save();
        } catch (Exception $e) {
            throw $e;
            $mensaje = 'Error al actualizar el tipo de cuenta bancaria.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Tipo trabajador $tipo_cuenta_bancaria->nombre actualizado satisfactoriamente.";

        return $this->successMessage(message: $mensaje);
    }
}

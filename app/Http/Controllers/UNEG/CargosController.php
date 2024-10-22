<?php

namespace App\Http\Controllers\UNEG;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UNEG\Cargos\StoreCargosRequest;
use App\Http\Requests\API\UNEG\Cargos\UpdateCargosRequest;
use App\Models\UNEG\Cargo;
use App\Traits\ApiResponse;
use Exception;

final class CargosController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('uneg.cargos.index');
    }

    public function store(StoreCargosRequest $request)
    {

        try {
            $cargo = Cargo::create([
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
            ]);
        } catch (Exception $e) {
            $mensaje = 'Error al crear el cargo.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Cargo $cargo->nombre ($cargo->codigo) creado satisfactoriamente.";

        return $this->successMessage(message: $mensaje, data: ['id' => $cargo->uuid, 'codigo' => $cargo->codigo]);
    }

    public function update(UpdateCargosRequest $request, string $uuid)
    {
        $cargo = Cargo::where('uuid', $uuid)->firstOrFail();
        try {
            $cargo->codigo = $request->codigo;
            $cargo->nombre = $request->nombre;
            $cargo->save();
        } catch (Exception $e) {
            $mensaje = 'Error al actualizar el cargo.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Cargo $cargo->nombre ($cargo->codigo) actualizado satisfactoriamente.";

        return $this->successMessage(message: $mensaje);
    }
}

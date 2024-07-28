<?php

namespace App\Http\Controllers\UNEG;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UNEG\Departamentos\StoreDepartamentosRequest;
use App\Http\Requests\API\UNEG\Departamentos\UpdateDepartamentosRequest;
use App\Models\UNEG\Departamento;
use App\Traits\ApiResponse;
use Exception;

final class DepartamentosController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('uneg.departamentos.index');
    }

    public function store(StoreDepartamentosRequest $request)
    {

        try {

            $departamento = Departamento::create([
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
            ]);

        } catch (Exception $e) {
            throw $e;
            $mensaje = 'Error al crear el departamento.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Departamento $departamento->nombre ($departamento->codigo) creado satisfactoriamente.";

        return $this->successMessage(message: $mensaje, data: ['id' => $departamento->uuid, 'codigo' => $departamento->codigo]);

    }

    public function update(UpdateDepartamentosRequest $request, string $uuid)
    {

        $departamento = Departamento::where('uuid', $uuid)->firstOrFail();
        try {
            $departamento->codigo = $request->codigo;
            $departamento->nombre = $request->nombre;
            $departamento->save();

        } catch (Exception $e) {
            $mensaje = 'Error al actualizar el cargo.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Departamento $departamento->nombre ($departamento->codigo) actualizado satisfactoriamente.";

        return $this->successMessage(message: $mensaje);
    }
}

<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SCA\Parentesco\StoreParentescoRequest;
use App\Http\Requests\API\SCA\Parentesco\UpdateParentescoRequest;
use App\Models\SCA\Parentesco;
use App\Traits\ApiResponse;
use Exception;

final class ParentescoController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('sca.parentesco.index');
    }

    public function store(StoreParentescoRequest $request)
    {

        try {

            $parentesco = Parentesco::create([
                'nombre' => $request->nombre,
            ]);

        } catch (Exception $e) {
            $mensaje = 'Error al crear el parentesco.';

            return $this->errorMessage(message: $mensaje, code: 500);
        }

        $mensaje = "Parentesco $parentesco->nombre creado satisfactoriamente.";

        return $this->successMessage(message: $mensaje, data: ['id' => $parentesco->uuid]);
    }

    public function update(UpdateParentescoRequest $request, $uuid)
    {
        $parentesco = Parentesco::where('uuid', $uuid)->firstOrFail();

        try {
            $parentesco->nombre = $request->nombre;
            $parentesco->save();
        } catch (Exception $e) {
            $mensaje = 'Error al actualizar el parentesco.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Parentesco $parentesco->nombre actualizado satisfactoriamente.";

        return $this->successMessage(message: $mensaje);
    }
}

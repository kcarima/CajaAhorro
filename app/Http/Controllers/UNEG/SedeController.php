<?php

namespace App\Http\Controllers\UNEG;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UNEG\Sedes\StoreSedeRequest;
use App\Http\Requests\API\UNEG\Sedes\UpdateSedeRequest;
use App\Models\UNEG\Sede;
use App\Traits\ApiResponse;
use Exception;

final class SedeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('uneg.sedes.index');
    }

    public function store(StoreSedeRequest $request)
    {

        try {
            $sede = Sede::create([
                'nombre' => $request->nombre,
            ]);

        } catch (Exception $e) {
            $mensaje = 'Error al crear la sede.';

            return $this->errorMessage(message: $mensaje, code: 500);
        }

        $mensaje = "Sede $sede->nombre creado satisfactoriamente.";

        return $this->successMessage(message: $mensaje, data: ['id' => $sede->uuid]);
    }

    public function update(UpdateSedeRequest $request, string $uuid)
    {
        $sede = Sede::where('uuid', $uuid)->firstOrFail();

        try {
            $sede->nombre = $request->nombre;
            $sede->save();
        } catch (Exception $e) {

            $mensaje = 'Error al actualizar la sede.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Sede $sede->nombre actualizado satisfactoriamente.";

        return $this->successMessage(message: $mensaje);
    }
}

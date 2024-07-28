<?php

namespace App\Http\Controllers\UNEG;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UNEG\Zonas\StoreZonaRequest;
use App\Http\Requests\API\UNEG\Zonas\UpdateZonaRequest;
use App\Models\UNEG\Zona;
use App\Traits\ApiResponse;
use Exception;

final class ZonaController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('uneg.zonas.index');
    }

    public function store(StoreZonaRequest $request)
    {

        try {
            $zona = Zona::create([
                'nombre' => $request->nombre,
            ]);

        } catch (Exception $e) {
            $mensaje = 'Error al crear la zona.';

            return $this->errorMessage(message: $mensaje, code: 500);
        }

        $mensaje = "Zona $zona->nombre creado satisfactoriamente.";

        return $this->successMessage(message: $mensaje, data: ['id' => $zona->uuid]);
    }

    public function update(UpdateZonaRequest $request, string $uuid)
    {
        $zona = Zona::where('uuid', $uuid)->firstOrFail();

        try {
            $zona->nombre = $request->nombre;
            $zona->save();
        } catch (Exception $e) {

            $mensaje = 'Error al actualizar la zona.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Zona $zona->nombre actualizado satisfactoriamente.";

        return $this->successMessage(message: $mensaje);
    }
}

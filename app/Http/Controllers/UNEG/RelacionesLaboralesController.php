<?php

namespace App\Http\Controllers\UNEG;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UNEG\RelacionesLaborales\StoreRelacionesLaboralesRequest;
use App\Http\Requests\API\UNEG\RelacionesLaborales\UpdateRelacionesLaborales;
use App\Models\UNEG\RelacionLaboral;
use App\Traits\ApiResponse;
use Exception;

final class RelacionesLaboralesController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('uneg.relaciones-laborales.index');
    }

    public function store(StoreRelacionesLaboralesRequest $request)
    {

        try {
            $relacion_laboral = RelacionLaboral::create([
                'nombre' => $request->nombre,
            ]);
        } catch (Exception $e) {
            throw $e;
            $mensaje = 'Error al crear la relación laboral.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Relación laboral $relacion_laboral->nombre creado satisfactoriamente.";

        return $this->successMessage(message: $mensaje, data: ['id' => $relacion_laboral->uuid]);
    }

    public function update(UpdateRelacionesLaborales $request, string $uuid)
    {
        $relacion_laboral = RelacionLaboral::where('uuid', $uuid)->firstOrFail();

        try {
            $relacion_laboral->nombre = $request->nombre;
            $relacion_laboral->save();

        } catch (Exception $e) {
            throw $e;
            $mensaje = 'Error al actualizar la relación laboral.';

            return $this->errorMessage(message: $mensaje);
        }

        $mensaje = "Relación laboral $relacion_laboral->nombre actualizado satisfactoriamente.";

        return $this->successMessage(message: $mensaje);
    }
}

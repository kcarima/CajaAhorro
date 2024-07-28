<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SCA\Monedas\StoreMonedaRequest;
use App\Http\Requests\API\SCA\Monedas\UpdateMonedaRequest;
use App\Models\SCA\Moneda;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class MonedasController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return view('sca.monedas.index');
    }

    public function store(StoreMonedaRequest $request)
    {
        try {

            if ($request->default == 'true') {
                Moneda::where('es_default', true)->update(['es_default' => false]);
            }

            $moneda = Moneda::create([
                'nombre' => $request->nombre,
                'abreviatura' => $request->abreviatura,
                'iso_4217' => $request->iso,
                'anio' => $request->anio,
                'es_activa' => $request->activa,
                'es_default' => $request->default,
            ]);

        } catch (Exception $e) {
            $mensaje = 'Error al crear la moneda.';
            throw $e;

            return $this->errorMessage(message: $mensaje, code: 500);
        }

        $mensaje = "Moneda $moneda->nombre creada satisfactoriamente.";

        return $this->successMessage(message: $mensaje, data: ['id' => $moneda->uuid]);
    }

    public function update(UpdateMonedaRequest $request)
    {

        try {
            $moneda = Moneda::where('uuid', $request->uuid)->firstOrFail();

            if ($request->default) {
                Moneda::where('es_default', true)->update(['es_default' => false]);
            }

            $moneda->fill([
                'nombre' => $request->nombre,
                'abreviatura' => $request->abreviatura,
                'iso_4217' => $request->iso,
                'anio' => $request->anio,
                'es_activa' => $request->activa,
                'es_default' => $request->default,
            ]);

            $moneda->save();

        } catch (ModelNotFoundException $e) {

            return $this->errorMessage(message: 'Moneda no encontrada', code: 404);

        } catch (Exception $e) {
            throw $e;
            $mensaje = 'Error al actualizar la moneda.';

            return $this->errorMessage(message: $mensaje, code: 500);
        }

        $mensaje = "Moneda $moneda->nombre actualizada satisfactoriamente.";

        return $this->successMessage(message: $mensaje);
    }
}

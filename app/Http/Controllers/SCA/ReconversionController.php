<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use App\Http\Requests\SCA\ConversionMonetaria\ReconversionRequest;
use App\Models\SCA\ConversionMonetaria;
use App\Models\SCA\Moneda;
use App\Models\SCA\TablaReconversion;
use Exception;

final class ReconversionController extends Controller
{
    public function index()
    {
        return view('sca.reconversion.index');
    }

    public function reconversion(TablaReconversion $tabla)
    {

        $class = app($tabla->modelo);
        $monedas = $class::distinct('moneda_id')->pluck('moneda_id')->toArray();
        $conversiones = ConversionMonetaria::whereIn('moneda_principal_id', $monedas)->pluck('moneda_secundaria_id')->toArray();
        $monedas_modelo = Moneda::whereIn('id', $monedas)->get(['uuid', 'nombre', 'abreviatura']);
        $monedas_conversiones = Moneda::whereIn('id', $conversiones)->get(['uuid', 'nombre', 'abreviatura']);

        return view('sca.reconversion.reconversion', ['monedas_modelo' => $monedas_modelo, 'monedas_conversiones' => $monedas_conversiones, 'tabla' => $tabla]);
    }

    public function update(ReconversionRequest $request, TablaReconversion $tabla)
    {

        try {
            $class = app($tabla->modelo);
            $moneda_actual = Moneda::where('uuid', $request->moneda1)->first();
            $moneda_nueva = Moneda::where('uuid', $request->moneda2)->first();

            $class->convertir($moneda_nueva, $moneda_actual);
        } catch (Exception $e) {
            throw $e;

            return back()->withErrors('Error al reconvertir');
        }

        return to_route('reconversion.index')->with('success', 'Reconversion realizada exitosamente');
    }
}

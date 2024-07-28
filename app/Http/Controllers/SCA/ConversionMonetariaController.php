<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use App\Http\Requests\SCA\ConversionMonetaria\StoreConversionMonetariaRequest;
use App\Http\Requests\SCA\ConversionMonetaria\UpdateConversionMonetariaRequest;
use App\Models\SCA\ConversionMonetaria;
use App\Models\SCA\Moneda;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class ConversionMonetariaController extends Controller
{
    public function index()
    {
        return view('sca.conversion-monetaria.index');
    }

    public function create()
    {
        $monedas = Moneda::activa()->get(['uuid', 'nombre', 'abreviatura']);

        return view('sca.conversion-monetaria.create', ['monedas' => $monedas]);
    }

    public function store(StoreConversionMonetariaRequest $request)
    {

        try {
            $monedaPrincipal = Moneda::where('uuid', $request->moneda1)->value('id');
            $monedaSecundaria = Moneda::where('uuid', $request->moneda2)->value('id');

            $conversionMonetaria = ConversionMonetaria::where('moneda_principal_id', $monedaPrincipal)->where('moneda_secundaria_id', $monedaSecundaria)->first();

            if ($conversionMonetaria) {
                $conversionMonetaria->cantidad_moneda_secundaria = $request->cantidad;
                $conversionMonetaria->save();
            } else {
                ConversionMonetaria::create([
                    'moneda_principal_id' => $monedaPrincipal,
                    'moneda_secundaria_id' => $monedaSecundaria,
                    'cantidad_moneda_secundaria' => $request->cantidad,
                    'fecha_actualizacion' => Carbon::now()->format('Y-m-d')
                ]);
            }
        } catch (Exception $e) {
            throw $e;
            return back()->withErrors('Error al crear la conversion monetaria.');
        }

        return to_route('conversion-monetaria.index')->with('success', 'Conversion monetaria registrada satisfactoriamente.');
    }

    public function edit(string $uuid)
    {
        $conversion = ConversionMonetaria::where('uuid', $uuid)->first();
        $monedas = Moneda::activa()->get(['uuid', 'nombre', 'abreviatura']);

        return view('sca.conversion-monetaria.edit', ['monedas' => $monedas, 'conversion' => $conversion]);
    }

    public function update(UpdateConversionMonetariaRequest $request)
    {

        try {
            $monedaPrincipal = Moneda::where('uuid', $request->moneda1)->value('id');
            $monedaSecundaria = Moneda::where('uuid', $request->moneda2)->value('id');

            $conversionMonetaria = ConversionMonetaria::where('moneda_principal_id', $monedaPrincipal)->where('moneda_secundaria_id', $monedaSecundaria)->firstOrFail();
            $conversionMonetaria->cantidad_moneda_secundaria = $request->cantidad;
            $conversionMonetaria->save();

        } catch (ModelNotFoundException $e) {
            return back()->withErrors('Conversion monetaria no encontrada.');
        } catch (Exception $e) {
            return back()->withErrors('Error al actualizar la conversion monetaria.');
        }

        return to_route('conversion-monetaria.index')->with('success', 'Conversion monetaria actualizada satisfactoriamente.');
    }
}

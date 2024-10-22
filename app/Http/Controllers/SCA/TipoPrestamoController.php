<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use App\Http\Requests\SCA\TipoPrestamo\StoreTipoPrestamoRequest;
use App\Http\Requests\SCA\TipoPrestamo\UpdateTipoPrestamoRequest;
use App\Models\SCA\TipoPrestamo;
use Exception;

final class TipoPrestamoController extends Controller
{
    public function index()
    {
        return view('sca.tipo-prestamo.index');
    }

    public function create()
    {
        return view('sca.tipo-prestamo.create');
    }

    public function store(StoreTipoPrestamoRequest $request)
    {
        try {
            TipoPrestamo::create(
                [
                    'codigo' => $request->codigo,
                    'nombre' => $request->nombre,
                    'cantidad_cuotas' => $request->cuotas,
                    'dias_cuotas' => $request->dias_cuotas,
                    'tasa_interes' => $request->interes,
                    'meses_tasa' => $request->meses_tasa,
                    'plazo_siguiente_solicitud' => $request->plazo,
                    'cuota_especial' => isset($request->especial) ? true : false,
                    'habilitar' => isset($request->habilitado) ? true : false,
                ]
            );
        } catch (Exception $e) {
            return back()->withErrors('Error al crear el tipo de prestamo');
        }

        return to_route('tipo-prestamo.index')->with('success', 'Tipo de Prestamo creado satisfactoriamente');
    }

    public function edit(TipoPrestamo $tipo)
    {
        return view('sca.tipo-prestamo.edit', ['tipo' => $tipo]);
    }

    public function update(UpdateTipoPrestamoRequest $request, TipoPrestamo $tipo)
    {

        try {
            $tipo->fill(
                [
                    'codigo' => $request->codigo,
                    'nombre' => $request->nombre,
                    'cantidad_cuotas' => $request->cuotas,
                    'dias_cuotas' => $request->dias_cuotas,
                    'tasa_interes' => $request->interes,
                    'meses_tasa' => $request->meses_tasa,
                    'plazo_siguiente_solicitud' => $request->plazo,
                    'cuota_especial' => isset($request->especial) ? true : false,
                    'habilitar' => isset($request->habilitado) ? true : false,
                ]
            );
            $tipo->save();
        } catch (Exception $e) {
            return back()->withErrors('Error al actualizar el tipo de prestamo');
        }

        return to_route('tipo-prestamo.index')->with('success', 'Tipo de Prestamo actualizado satisfactoriamente');
    }
}

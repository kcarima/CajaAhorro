<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use App\Http\Requests\SCA\CuentaBancaria\StoreCuentaBancaria;
use App\Http\Requests\SCA\CuentaBancaria\UpdateCuentaBancaria;
use App\Models\SCA\Banco;
use App\Models\SCA\CuentaBancaria;
use App\Models\SCA\Moneda;
use App\Models\SCA\TipoCuentaBancaria;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class CuentaBancariaController extends Controller
{
    public function index()
    {
        return view('sca.cuentas-bancarias.index');
    }

    public function create()
    {

        $bancos = Banco::all(['nombre', 'abreviatura', 'codigo']);
        $tiposCuentasBancarias = TipoCuentaBancaria::all(['uuid', 'nombre']);
        $monedas = Moneda::activa()->get(['nombre', 'abreviatura', 'uuid', 'es_default']);

        return view('sca.cuentas-bancarias.create', [
            'bancos' => $bancos,
            'tiposCuentasBancarias' => $tiposCuentasBancarias,
            'monedas' => $monedas,
        ]);
    }

    public function store(StoreCuentaBancaria $request)
    {

        $banco = Banco::where('codigo', 'like', $request->banco)->value('id');
        $tipo_cuenta_bancaria = TipoCuentaBancaria::where('uuid', $request->tipo_cuenta)->value('id');
        $moneda = Moneda::where('uuid', $request->moneda)->value('id');

        if (! $moneda) {
            $moneda = Moneda::where('es_default', true)->value('id');
        }

        try {
            CuentaBancaria::create([
                'banco_id' => $banco,
                'agencia' => $request->agencia,
                'tipo_cuenta_bancaria_id' => $tipo_cuenta_bancaria,
                'numero' => $request->numero,
                'saldo' => $request->saldo,
                'moneda_id' => $moneda,
                'is_public' => isset($request->public),
            ]);
        } catch (Exception $e) {
            throw $e;

            return back()->withInput()->withErrors('Error al registrar la cuenta bancaria');
        }

        return to_route('cuenta-bancaria.index')->with('success', 'Cuenta bancaria creada satisfactoriamente.');
    }

    public function edit(string $uuid)
    {

        $cuenta = CuentaBancaria::where('uuid', $uuid)->first();
        $bancos = Banco::all(['nombre', 'abreviatura', 'codigo']);
        $tiposCuentasBancarias = TipoCuentaBancaria::all(['uuid', 'nombre']);
        $monedas = Moneda::activa()->get(['nombre', 'abreviatura', 'uuid', 'es_default']);

        return view('sca.cuentas-bancarias.edit', [
            'bancos' => $bancos,
            'tiposCuentasBancarias' => $tiposCuentasBancarias,
            'monedas' => $monedas,
            'cuenta' => $cuenta,
        ]);
    }

    public function update(UpdateCuentaBancaria $request)
    {

        $banco = Banco::where('codigo', 'like', $request->banco)->value('id');
        $tipo_cuenta_bancaria = TipoCuentaBancaria::where('uuid', $request->tipo_cuenta)->value('id');
        $moneda = Moneda::where('uuid', $request->moneda)->value('id');

        if (! $moneda) {
            $moneda = Moneda::where('es_default', true)->value('id');
        }

        try {
            $cuenta = CuentaBancaria::where('uuid', $request->cuenta)->firstOrFail();
            $cuenta->fill([
                'banco_id' => $banco,
                'agencia' => $request->agencia,
                'tipo_cuenta_bancaria_id' => $tipo_cuenta_bancaria,
                'numero' => $request->numero,
                'saldo' => $request->saldo,
                'moneda_id' => $moneda,
                'is_public' => isset($request->public),
            ]);

            $cuenta->save();

        } catch (ModelNotFoundException $e) {
            return back()->withInput()->withErrors('Cuenta bancaria no encontrada.');
        } catch (Exception $e) {
            return back()->withInput()->withErrors('Error al actualizar la cuenta bancaria.');
        }

        return to_route('cuenta-bancaria.index')->with('success', 'Cuenta bancaria editada satisfactoriamente.');
    }
}

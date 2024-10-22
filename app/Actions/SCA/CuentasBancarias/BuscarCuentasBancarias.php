<?php

namespace App\Actions\SCA\CuentasBancarias;

use App\Models\SCA\CuentaBancaria;

final class BuscarCuentasBancarias
{
    public static function handle(?string $busqueda = null)
    {

        $select = ['banco_id', 'agencia', 'tipo_cuenta_bancaria_id', 'saldo', 'numero', 'moneda_id', 'is_public', 'deleted_at', 'uuid'];
        $with = [];

        $cuentasBancarias = CuentaBancaria::query();

        if (auth()->user()->is_root()) {
            $cuentasBancarias->withTrashed()->select($select);
        } else {
            $cuentasBancarias->select($select);
        }

        if ($busqueda) {
            $cuentasBancarias->whereHas('banco', function ($q) use ($busqueda) {
                $q->where('nombre', 'ilike', '%'.$busqueda.'%');
            });

            $cuentasBancarias->whereHas('tipoCuentaBancaria', function ($q) use ($busqueda) {
                $q->orWhere('nombre', 'ilike', '%'.$busqueda.'%');
            });
        }

        return $cuentasBancarias->orderBy('id')->paginate(15);

    }
}

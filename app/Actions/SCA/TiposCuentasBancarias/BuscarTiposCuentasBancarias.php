<?php

namespace App\Actions\SCA\TiposCuentasBancarias;

use App\Models\SCA\TipoCuentaBancaria;

final class BuscarTiposCuentasBancarias
{
    public static function handle(?string $busqueda = null)
    {
        $select = ['id', 'nombre', 'is_public', 'uuid', 'deleted_at'];
        $with = [];

        if (auth()->user()->is_root()) {
            $tipo_cuenta = TipoCuentaBancaria::withTrashed()->select($select);
        } else {
            $tipo_cuenta = TipoCuentaBancaria::select($select);
        }

        if ($busqueda) {
            $tipo_cuenta = $tipo_cuenta->where('nombre', 'ilike', '%'.$busqueda.'%');
        }

        return $tipo_cuenta->orderBy('nombre')->paginate(15);
    }
}

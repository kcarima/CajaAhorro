<?php

namespace App\Actions\SCA\Bancos;

use App\Models\SCA\Banco;

final class BuscarBancos
{
    public static function handle(?string $busqueda = null)
    {

        $select = ['codigo', 'nombre', 'uuid', 'abreviatura', 'deleted_at'];
        $with = [];

        if (auth()->user()->is_root()) {
            $banco = Banco::withTrashed()->select($select);
        } else {
            $banco = Banco::select($select);
        }

        if ($busqueda) {
            $banco = $banco->where('nombre', 'ilike', '%'.$busqueda.'%');
        }

        return $banco->orderBy('nombre')->paginate(15);

    }
}

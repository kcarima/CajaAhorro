<?php

namespace App\Actions\UNEG\Cargos;

use App\Models\UNEG\Cargo;

final class BuscarCargos
{
    public static function handle(?string $busqueda = null)
    {
        $select = ['codigo', 'nombre', 'uuid', 'deleted_at'];
        $with = [];

        if (auth()->user()->is_root()) {
            $cargos = Cargo::withTrashed()->select($select);
        } else {
            $cargos = Cargo::select($select);
        }

        if ($busqueda) {
            $cargos = $cargos->where('codigo', 'like', '%'.$busqueda.'%')->orWhere('nombre', 'ilike', '%'.$busqueda.'%');
        }

        return $cargos->orderBy('nombre')->paginate(15);
    }
}

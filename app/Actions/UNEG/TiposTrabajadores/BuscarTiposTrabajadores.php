<?php

namespace App\Actions\UNEG\TiposTrabajadores;

use App\Models\UNEG\TipoTrabajador;

final class BuscarTiposTrabajadores
{
    public static function handle(?string $busqueda = null)
    {
        $select = ['id', 'nombre', 'uuid', 'deleted_at'];
        $with = [];

        if (auth()->user()->is_root()) {
            $tipo_trabajador = TipoTrabajador::withTrashed()->select($select);
        } else {
            $tipo_trabajador = TipoTrabajador::select($select);
        }

        if ($busqueda) {
            $tipo_trabajador = $tipo_trabajador->where('nombre', 'ilike', '%'.$busqueda.'%');
        }

        return $tipo_trabajador->orderBy('nombre')->paginate(15);
    }
}

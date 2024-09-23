<?php

namespace App\Actions\UNEG\Sedes;

use App\Models\UNEG\Sede;

final class BuscarSedes
{
    public static function handle(?string $busqueda = null)
    {
        $select = ['id', 'nombre', 'uuid', 'deleted_at'];
        $with = [];

        if (auth()->user()->is_root()) {
            $sede = Sede::withTrashed()->select($select);
        } else {
            $sede = Sede::select($select);
        }

        if ($busqueda) {
            $sede = $sede->where('nombre', 'ilike', '%'.$busqueda.'%');
        }

        return $sede->orderBy('nombre')->paginate(15);
    }
}

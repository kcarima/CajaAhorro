<?php

namespace App\Actions\UNEG\Zonas;

use App\Models\UNEG\Zona;

final class BuscarZonas
{
    public static function handle(?string $busqueda = null)
    {
        $select = ['id', 'nombre', 'uuid', 'deleted_at'];
        $with = [];

        if (auth()->user()->is_root()) {
            $zona = Zona::withTrashed()->select($select);
        } else {
            $zona = Zona::select($select);
        }

        if ($busqueda) {
            $zona = $zona->where('nombre', 'ilike', '%'.$busqueda.'%');
        }

        return $zona->orderBy('nombre')->paginate(15);
    }
}

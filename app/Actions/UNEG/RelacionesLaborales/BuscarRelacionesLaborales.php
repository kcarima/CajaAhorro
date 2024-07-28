<?php

namespace App\Actions\UNEG\RelacionesLaborales;

use App\Models\UNEG\RelacionLaboral;

final class BuscarRelacionesLaborales
{
    public static function handle(?string $busqueda = null)
    {
        $select = ['id', 'nombre', 'uuid', 'deleted_at'];
        $with = [];

        if (auth()->user()->is_root()) {
            $relaciones_laborales = RelacionLaboral::withTrashed()->select($select);
        } else {
            $relaciones_laborales = RelacionLaboral::select($select);
        }

        if ($busqueda) {
            $relaciones_laborales = $relaciones_laborales->where('nombre', 'ilike', '%'.$busqueda.'%');
        }

        return $relaciones_laborales->orderBy('nombre')->paginate(15);
    }
}

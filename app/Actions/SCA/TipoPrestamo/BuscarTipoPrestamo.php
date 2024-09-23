<?php

namespace App\Actions\SCA\TipoPrestamo;

use App\Models\SCA\TipoPrestamo;

final class BuscarTipoPrestamo
{
    public static function handle(?string $search = null)
    {

        $select = ['codigo', 'nombre', 'cantidad_cuotas', 'tasa_interes', 'cuota_especial', 'uuid', 'habilitar', 'deleted_at'];
        $query = TipoPrestamo::query();

        $query->select($select);

        if (auth()->user()->is_root()) {
            $query->withTrashed();
        }

        if ($search) {
            $query->where('nombre', 'ilike', '%'.$search.'%');
        }

        return $query->paginate();
    }
}

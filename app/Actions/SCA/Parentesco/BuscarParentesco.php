<?php

namespace App\Actions\SCA\Parentesco;

use App\Models\SCA\Parentesco;

final class BuscarParentesco
{
    public static function handle(?string $busqueda = null)
    {
        $select = ['id', 'nombre', 'uuid', 'deleted_at'];
        $with = [];

        if (auth()->user()->is_root()) {
            $parentesco = Parentesco::withTrashed()->select($select);
        } else {
            $parentesco = Parentesco::select($select);
        }

        if ($busqueda) {
            $parentesco = $parentesco->where('nombre', 'ilike', '%'.$busqueda.'%');
        }

        return $parentesco->orderBy('nombre')->paginate(15);
    }
}

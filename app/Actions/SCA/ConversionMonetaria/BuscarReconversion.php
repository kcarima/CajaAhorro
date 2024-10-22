<?php

namespace App\Actions\SCA\ConversionMonetaria;

use App\Models\SCA\TablaReconversion;

final class BuscarReconversion
{
    public static function handle(?string $search = null)
    {

        $select = ['descripcion', 'uuid'];

        $query = TablaReconversion::query();

        $query->select($select);
        if ($search) {
            $query->where('descripcion', 'ilike', '%'.$search.'%');
        }

        return $query->orderByDesc('id')->paginate();
    }
}

<?php

namespace App\Actions\SCA\Documentos;

use App\Models\SCA\Documento;

final class BuscarDocumentos
{
    public static function handle(?string $busqueda = null)
    {
        $select = ['id', 'nombre', 'carpeta', 'uuid', 'deleted_at'];
        $with = [];

        if (auth()->user()->is_root()) {
            $documento = Documento::withTrashed()->select($select);
        } else {
            $documento = Documento::select($select);
        }

        if ($busqueda) {
            $documento = $documento->where('nombre', 'ilike', '%'.$busqueda.'%');
        }

        return $documento->orderBy('nombre')->paginate(15);
    }
}

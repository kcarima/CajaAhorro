<?php

namespace App\Actions\UNEG\Departamentos;

use App\Models\UNEG\Departamento;

final class BuscarDepartamentos
{
    public static function handle(?string $busqueda = null)
    {
        $select = ['codigo', 'nombre', 'deleted_at', 'uuid'];
        $with = [];

        if (auth()->user()->is_root()) {
            $departamento = Departamento::withTrashed()->select($select);
        } else {
            $departamento = Departamento::select($select);
        }

        if ($busqueda) {
            $departamento = $departamento->where('codigo', 'like', '%'.$busqueda.'%')->orWhere('nombre', 'ilike', '%'.$busqueda.'%');
        }

        return $departamento->orderBy('nombre')->paginate(15);
    }
}

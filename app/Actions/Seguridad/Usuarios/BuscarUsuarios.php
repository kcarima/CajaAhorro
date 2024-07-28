<?php

namespace App\Actions\Seguridad\Usuarios;

use App\Classes\CollectionHelper;
use App\Models\Seguridad\User;

final class BuscarUsuarios
{
    public static function handle(?string $busqueda = null, array $status = [], array $roles = [])
    {
        $select = ['seguridad.users.cedula', 'seguridad.users.email', 'seguridad.users.status', 'seguridad.users.last_login', 'seguridad.users.tipo', 'sca.socios.ficha', 'seguridad.users.deleted_at'];
        $with = [];

        if (auth()->user()->is_root()) {
            $usuarios = User::withTrashed()->select($select)->join('sca.socios', 'sca.socios.cedula', '=', 'seguridad.users.cedula');
        } else {
            $usuarios = User::select($select)->where('seguridad.users.cedula', 'NOT LIKE', 'root')->join('sca.socios', 'sca.socios.cedula', '=', 'seguridad.users.cedula');
        }

        if ($busqueda) {
            $usuarios = $usuarios->where('sca.socios.nombre', 'ILIKE', '%'.$busqueda.'%')->orWhere('seguridad.users.email', 'like', '%'.$busqueda.'%');

            return CollectionHelper::paginate($usuarios->orderBy('seguridad.users.id')->take(150)->get(), 15);
        }

        return $usuarios->orderBy('seguridad.users.id')->paginate(15);
    }
}

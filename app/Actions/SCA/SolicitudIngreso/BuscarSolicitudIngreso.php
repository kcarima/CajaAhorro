<?php

namespace App\Actions\SCA\SolicitudIngreso;

use App\Classes\Enums\StatusSolicitudIngreso;
use App\Models\SCA\SolicitudIngreso;

final class BuscarSolicitudIngreso
{
    public static function handle(?string $search = null)
    {

        $query = SolicitudIngreso::query();

        $query->where('status', '=', StatusSolicitudIngreso::PENDIENTE->value);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'ilike', '%'.$search.'%')
                    ->orWhere('ficha', 'ilike', '%'.$search.'%')
                    ->orWhere('cedula', 'ilike', '%'.$search.'%')
                    ->orWhere('email', 'ilike', '%'.$search.'%');
            });
        }

        return $query->paginate();
    }
}

<?php

namespace App\Actions\SCA\Monedas;

use App\Models\SCA\Moneda;

final class BuscarMonedas
{
    public static function handle(?string $search = null)
    {
        $moneda = Moneda::query();

        if (auth()->user()->is_root()) {
            $moneda->withTrashed();
        }

        $moneda->where('nombre', 'ilike', '%'.$search.'%');

        return $moneda->orderByDesc('anio')->paginate();
    }
}

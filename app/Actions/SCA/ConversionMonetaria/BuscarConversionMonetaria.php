<?php

namespace App\Actions\SCA\ConversionMonetaria;

use App\Models\SCA\ConversionMonetaria;

final class BuscarConversionMonetaria
{
    public static function handle(?string $search = null)
    {

        $select = ['moneda_principal_id', 'moneda_secundaria_id', 'cantidad_moneda_secundaria', 'uuid', 'fecha_actualizacion'];

        $query = ConversionMonetaria::query();

        $query->select($select);

        $query->whereHas('monedaPrincipal', function ($q) {
            $q->where('es_activa', true);
        })->whereHas('monedaSecundaria', function ($q) {
            $q->where('es_activa', true);
        });

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('monedaPrincipal', function ($q2) use ($search) {
                    $q2->where('nombre', 'ilike', '%'.$search.'%');
                })->orWhereHas('monedaSecundaria', function ($q2) use ($search) {
                    $q2->where('nombre', 'ilike', '%'.$search.'%');
                });
            });
        }

        return $query->orderByDesc('id')->paginate();
    }
}

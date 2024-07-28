<?php

namespace App\Actions\SCA\ConversionMonetaria;

use App\Models\SCA\HistorialConversionMonetaria;

final class BuscarHistorialConversionMonetaria
{
    public static function handle(?string $search = null)
    {

        $select = ['conversion_monetaria_id', 'monto', 'fecha_actualizacion'];

        $historico = HistorialConversionMonetaria::query();

        $historico->select($select);

        if ($search) {
            $historico->whereHas('conversionMonetaria', function ($query) use ($search) {
                $query->whereHas('monedaPrincipal', function ($q) use ($search) {
                    $q->where('nombre', 'ilike', '%'.$search.'%');
                })->orWhereHas('monedaSecundaria', function ($q) use ($search) {
                    $q->where('nombre', 'ilike', '%'.$search.'%');
                });
            });
        }

        return $historico->orderByDesc('created_at')->paginate();
    }
}

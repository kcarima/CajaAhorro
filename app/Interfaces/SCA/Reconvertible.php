<?php

namespace App\Interfaces\SCA;

use App\Models\SCA\Moneda;

interface Reconvertible
{
    public static function convertir(Moneda $moneda_nueva, ?Moneda $moneda_actual = null);
}

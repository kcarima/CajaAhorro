<?php

namespace App\Classes\Enums;

enum TipoUsuario: string
{
    case ROOT = 'ROOT';
    case ADMINISTRADOR = 'ADMINISTRADOR';
    case ASOCIADO = 'ASOCIADO';

    public static function defaultCase()
    {
        return self::ASOCIADO;
    }
}

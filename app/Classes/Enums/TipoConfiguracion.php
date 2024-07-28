<?php

namespace App\Classes\Enums;

enum TipoConfiguracion: string
{
    case ARCHIVO = 'ARCHIVO';
    case TEXTO = 'TEXTO';
    case NUMERO = 'NUMERO';
    case IMAGEN = 'IMAGEN';

}

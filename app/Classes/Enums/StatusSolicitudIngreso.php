<?php

namespace App\Classes\Enums;

enum StatusSolicitudIngreso: string
{
    case PENDIENTE = 'PENDIENTE';
    case APROBADO = 'APROBADO';
    case RECHAZADO = 'RECHAZADO';

}

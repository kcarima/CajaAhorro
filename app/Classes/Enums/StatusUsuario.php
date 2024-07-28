<?php

namespace App\Classes\Enums;

enum StatusUsuario: string
{
    case SUSPENDIDO = 'SUSPENDIDO';
    case ACTIVO = 'ACTIVO';
    case INACTIVO = 'INACTIVO';
    case ELIMINADO = 'ELIMINADO';

    public function text_color()
    {
        return match ($this->value) {
            'SUSPENDIDO' => 'text-zinc-600',
            'ACTIVO' => 'text-green-600',
            'INACTIVO' => 'text-red-600',
            'ELIMINADO' => 'text-gray-600',
            default => 'text-purple-600'
        };
    }
}

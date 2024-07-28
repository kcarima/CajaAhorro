<?php

namespace App\Classes\Enums;

enum LogEvent: string
{
    case CREATED = 'created';
    case UPDATED = 'updated';
    case DELETED = 'deleted';
    case RESTORED = 'restored';
    case DEFAULT = 'desconocido';

    public function displayName()
    {
        return match ($this->value) {
            'created' => 'Crear',
            'updated' => 'Actualizar',
            'deleted' => 'Eliminar',
            'restored' => 'Restaurar',
            'desconocido' => 'Desconocido'
        };
    }
}

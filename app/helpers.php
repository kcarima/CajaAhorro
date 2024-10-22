<?php

use App\Models\SCA\Configuracion;
use App\Models\SCA\Documento;
use App\Models\SCA\Parentesco;
use App\Models\SCA\TipoPrestamo;
use App\Models\UNEG\Sede;
use App\Models\UNEG\TipoTrabajador;
use App\Models\UNEG\Zona;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

// Funcion para establecer un formato estandar para mostrar las fechas
if (! function_exists('standart_date_time_format')) {
    function standart_date_time_format(string $value): string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d-m-Y H:i:s');
    }
}

// Funcion para establecer un formato estandar para mostrar las fechas
if (! function_exists('standart_date_format')) {
    function standart_date_format(string $value): string
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d-m-Y');
    }
}

if (! function_exists('mask_email')) {
    function mask_email(string $email, int $char_shown_front = 1, int $char_shown_back = 1): string
    {
        $mail_parts = explode('@', $email);
        $username = $mail_parts[0];
        $len = strlen($username);

        if ($len < $char_shown_front or $len < $char_shown_back) {
            return implode('@', $mail_parts);
        }

        //Logic: show asterisk in middle, but also show the last character before @
        $mail_parts[0] = substr($username, 0, $char_shown_front)
            .str_repeat('*', $len - $char_shown_front - $char_shown_back)
            .substr($username, $len - $char_shown_back, $char_shown_back);

        return implode('@', $mail_parts);
    }
}

if (! function_exists('get_nombre_archivo')) {
    function get_nombre_archivo(string $archivo)
    {

        $extension = pathinfo($archivo, PATHINFO_EXTENSION);
        $archivo_sin_extension = str_replace('.'.$extension, '', $archivo);

        return Str::slug($archivo_sin_extension).'.'.$extension;

    }
}

if (! function_exists('get_cedula')) {
    function get_cedula(int|string $numero, string $nacionalidad = 'V'): string
    {

        if (intval(value: $numero) < 1_000_000) {
            return strtoupper($nacionalidad).'00'.$numero;
        } elseif (intval(value: $numero) < 10_000_000) {
            return strtoupper($nacionalidad).'0'.$numero;
        } else {
            return strtoupper($nacionalidad).$numero;
        }
    }
}

if (! function_exists('get_logo_sistema')) {
    function get_logo_sistema(): string
    {
        $image = Configuracion::where('clave', 'ilike', '%Logo Sistema%')->value('valor');

        return Storage::url($image);
    }
}

if (! function_exists('get_imagen_encabezado')) {
    function get_imagen_encabezado(): string
    {
        $image = Configuracion::where('clave', 'ilike', '%Imagen Encabezado%')->value('valor');

        return $image;
    }
}

// Funcion para establecer un formato estandar para mostrar las fechas
if (! function_exists('standart_currency_format')) {
    function standart_currency_format($value): string
    {
        if ($value >= 0.01) {
            return number_format($value, 2, ',', '.');
        }

        if ($value < 0.01 && $value > 0.001) {
            return number_format($value, 4, ',', '.');
        }

        if ($value < 0.001 && $value > 0.0001) {
            return number_format($value, 6, ',', '.');
        }

        return number_format($value, 8, ',', '.');
    }
}

if (! function_exists('getModelNotFoundExceptionMessage')) {
    function getModelNotFoundExceptionMessage(string $modelo): string
    {
        return match ($modelo) {
            TipoPrestamo::class => 'No se encontró el tipo de prestamo.',
            Parentesco::class => 'No se encontró el parentesco.',
            Sede::class => 'No se encontró la sede.',
            Zona::class => 'No se encontró la zona.',
            Documento::class => 'No se encontró el documento.',
            TipoTrabajador::class => 'No se encontró el tipo de trabajador',
            default => 'No se encontró el modelo'
        };
    }
}

if (! function_exists('getNombreSistema')) {
    function getNombreSistema(): string
    {
        return Configuracion::where('clave', 'ilike', '%Nombre Sistema%')->value('valor');
    }
}

if (! function_exists('eliminar_elemento_asociativo')) {
    function eliminar_elemento_asociativo(&$array, $key)
    {
        // Buscamos el elemento con la clave especificada
        $elemento = array_key_exists($key, $array) ? $array[$key] : null;

        // Eliminamos el elemento del array
        unset($array[$key]);

        // Devolvemos el elemento eliminado
        return $elemento;
    }

}

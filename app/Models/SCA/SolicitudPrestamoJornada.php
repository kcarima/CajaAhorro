<?php

namespace App\Models\sca;

use App\Models\SCA\SolicitudPrestamoJornadaDetalle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudPrestamoJornada extends Model
{
    use HasFactory;

    protected $table = 'sca.jornada_solicitud_prestamo_table';

    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_cierre',
        'observacion',
        'status'
    ];

    public function SolicitudPrestamoJornadaDetalle()
    {
        return $this->hasMany(SolicitudPrestamoJornadaDetalle::class);
    }
}

<?php

namespace App\Models\SCA;

use App\Models\SCA\SolicitudPrestamoJornadaDetalle;
use App\Models\SCA\Socio;
use App\Models\SCA\TipoPrestamo;
use App\Models\SCA\Moneda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudPrestamo extends Model
{
    use HasFactory;

    protected $table = 'sca.solicitud_prestamo_table';

    protected $fillable = [
        'fecha_solicitud',
        'jornada_solicitud_prestamo_detalle_id',
        'socio_id',
        'tipo_prestamo_id',
        'moneda_id',
        'monto',
        'cant_cuotas',
        'status'
    ];


    public function socio()
    {
        return $this->belongsTo(Socio::class, 'socio_id', 'id');
    }

    public function TipoPrestamo()
    {
        return $this->belongsTo(TipoPrestamo::class, 'tipo_prestamo_id', 'id');
    }

    public function Moneda()
    {
        return $this->belongsTo(Moneda::class, 'moneda_id', 'id');
    }

    public function JornadaDetalle()
    {
        return $this->belongsTo(SolicitudPrestamoJornadaDetalle::class, 'jornada_solicitud_prestamo_detalle_id', 'id');
    }
}

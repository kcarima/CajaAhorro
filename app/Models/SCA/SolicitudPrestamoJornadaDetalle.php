<?php

namespace App\Models\sca;

use App\Models\SCA\SolicitudPrestamoJornada;
use App\Models\SCA\Socio;
use App\Models\SCA\TipoPrestamo;
use App\Models\SCA\Moneda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudPrestamoJornadaDetalle extends Model
{
    use HasFactory;

    protected $table = 'sca.jornada_solicitud_prestamo_detalle';

    protected $fillable = [
        'jornada_solicitud_prestamo_id',
        'tipo_prestamo_id',
        'moneda_id',
        'monto_tope',
        'cant_cuotas'
    ];

    public function SolicitudPrestamoJornada()
    {
        return $this->belongsTo(SolicitudPrestamoJornada::class, 'jornada_solicitud_prestamo_id', 'id');
    }
    
    public function TipoPrestamo()
    {
        return $this->belongsTo(TipoPrestamo::class, 'tipo_prestamo_id', 'id');
    }

    public function Moneda()
    {
        return $this->belongsTo(Moneda::class, 'moneda_id', 'id');
    }

}

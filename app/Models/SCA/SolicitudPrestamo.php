<?php

namespace App\Models\SCA;

use App\Interfaces\SCA\Socio;
use App\Interfaces\SCA\TipoPrestamo;
use App\Interfaces\SCA\Moneda;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudPrestamo extends Model
{
    use HasFactory;

    protected $table = 'sca.solicitud_prestamo';

    protected $fillable = [
        'ficha',
        'fecha_solicitud',
        'tipo_prestamo',
        'moneda',
        'monto',
        'status'
    ];


    public function socio()
    {
        return $this->belongsTo(Socio::class, 'ficha', 'ficha');
    }

    public function TipoPrestamo()
    {
        return $this->belongsTo(TipoPrestamo::class, 'tipo_prestamo', 'id');
    }

    public function Moneda()
    {
        return $this->belongsTo(Moneda::class, 'moneda', 'id');
    }
}

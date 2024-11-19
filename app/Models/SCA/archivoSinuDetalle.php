<?php

namespace App\Models\SCA;

use App\Models\SCA\archivoSinu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class archivoSinuDetalle extends Model
{
    use HasFactory;

    protected $table = 'sca.archivo_sinu_detalle';

    protected $fillable = [
        'archivo_sinu_id',
        'socio_id',
        'concepto_id',
        'monto'
    ];

    public function archivoSinu()
    {
        return $this->belongsTo(archivoSinu::class, 'archivo_sinu_id', 'id');
    }
}

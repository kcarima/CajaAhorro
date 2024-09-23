<?php

namespace App\Models\SCA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class HistorialConversionMonetaria extends Model
{
    use HasFactory;

    protected $connection = 'sca';

    protected $table = 'historial_conversiones_monetarias';

    protected $fillable = ['conversion_monetaria_id', 'monto', 'fecha_actualizacion'];

    protected $with = ['conversionMonetaria'];

    public function conversionMonetaria()
    {
        return $this->belongsTo(ConversionMonetaria::class);
    }
}

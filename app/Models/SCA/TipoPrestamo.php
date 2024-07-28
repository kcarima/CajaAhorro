<?php

namespace App\Models\SCA;

use App\Traits\GenerateUuid;
use App\Traits\RouteUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class TipoPrestamo extends Model
{
    use GenerateUuid;
    use HasFactory;
    use RouteUuid;
    use SoftDeletes;

    protected $connection = 'sca';

    protected $table = 'tipos_prestamos';

    protected $fillable = ['codigo', 'nombre', 'cantidad_cuotas', 'dias_cuotas', 'tasa_interes', 'meses_tasa', 'plazo_siguiente_solicitud', 'cuota_especial', 'habilitar'];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}

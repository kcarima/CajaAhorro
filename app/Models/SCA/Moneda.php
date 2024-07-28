<?php

namespace App\Models\SCA;

use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Moneda extends Model
{
    use GenerateUuid;
    use HasFactory;
    use SoftDeletes;

    protected $connection = 'sca';

    protected $fillable = ['nombre', 'abreviatura', 'iso_4217', 'anio', 'es_activa', 'es_default'];

    public function scopeActiva($query)
    {
        return $query->where('es_activa', true);
    }
}

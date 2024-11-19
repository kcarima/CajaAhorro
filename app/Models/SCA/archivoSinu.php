<?php

namespace App\Models\SCA;

use App\Models\SCA\archivoSinuDetalle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class archivoSinu extends Model
{
    use HasFactory;

    protected $table = 'sca.archivo_sinu_table';

    protected $fillable = [
        'fecha',
        'descripcion',
        'monto',
        'status'
    ];

    public function archivoSinuDetalle()
    {
        return $this->hasMany(archivoSinuDetalle::class, 'archivo_sinu_id', 'id');
    }

}

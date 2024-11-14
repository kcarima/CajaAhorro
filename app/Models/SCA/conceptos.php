<?php

namespace App\Models\SCA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conceptos extends Model
{
    use HasFactory;

    protected $table = 'sca.archivo_sinu';

    protected $fillable = [
        'concepto',
        'descripcion',
        'accion',
        'status'
    ];
}

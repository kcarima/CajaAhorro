<?php

namespace App\Models\SCA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conceptos extends Model
{
    use HasFactory;

    protected $table = 'sca.conceptos';

    protected $fillable = [
        'codigo',
        'descripcion',
        'accion',
        'status'
    ];
}

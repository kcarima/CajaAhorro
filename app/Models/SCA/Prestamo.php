<?php

namespace App\Models\SCA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Prestamo extends Model
{
    use HasFactory;

    protected $connection = 'sca';
}

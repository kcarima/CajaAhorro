<?php

namespace App\Models\SCA;

use App\Traits\RouteUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class TablaReconversion extends Model
{
    use HasFactory;
    use RouteUuid;

    protected $connection = 'sca';

    protected $table = 'tablas_reconversion';
}

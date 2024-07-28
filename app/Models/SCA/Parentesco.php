<?php

namespace App\Models\SCA;

use App\Traits\GenerateUuid;
use App\Traits\RouteUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Parentesco extends Model
{
    use GenerateUuid;
    use HasFactory;
    use RouteUuid;
    use SoftDeletes;

    protected $connection = 'sca';

    protected $fillable = ['nombre', 'uuid'];

    public function beneficiarios()
    {
        return $this->hasMany(Beneficiario::class);
    }
}

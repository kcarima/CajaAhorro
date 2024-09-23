<?php

namespace App\Models\SCA;

use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

final class TipoCuentaBancaria extends Model
{
    use CausesActivity;
    use GenerateUuid;
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;

    protected $connection = 'sca';

    protected $table = 'tipos_cuentas_bancarias';

    protected $fillable = ['nombre', 'is_public'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'sca')
            ->logOnly(['nombre', 'is_public'])
            ->logOnlyDirty()
            ->dontLogIfAttributesChangedOnly(attributes: ['updated_at'])
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(callback: function (string $eventName) {
                $evento = match ($eventName) {
                    'created' => 'creado',
                    'updated' => 'actualizado',
                    'deleted' => 'eliminado',
                    'restored' => 'restaurado',
                    default => 'desconocido',
                };

                return "El tipo de cuenta bancaria :subject.nombre ha sido $evento";
            });
    }

    public function bancos_socios()
    {
        return $this->hasMany(BancoSocio::class, 'tipo_cuenta', 'nombre');
    }

    public function cuentas_bancarias()
    {
        return $this->hasMany(CuentaBancaria::class);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', '=', true);
    }
}

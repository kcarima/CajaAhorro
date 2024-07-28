<?php

namespace App\Models\SCA;

use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

final class Banco extends Model
{
    use CausesActivity;
    use GenerateUuid;
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;

    protected $connection = 'sca';

    protected $fillable = ['codigo', 'nombre', 'abreviatura'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'sca')
            ->logOnly(['codigo', 'nombre', 'abreviatura'])
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

                return "El banco :subject.nombre ha sido $evento";
            });
    }

    public function bancos_socios()
    {
        return $this->hasMany(BancoSocio::class, 'codigo_banco', 'codigo');
    }

    public function cuentas_bancarias()
    {
        return $this->hasMany(CuentaBancaria::class);
    }
}

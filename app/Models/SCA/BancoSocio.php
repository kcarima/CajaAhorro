<?php

namespace App\Models\SCA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

final class BancoSocio extends Model
{
    use CausesActivity;
    use HasFactory;
    use LogsActivity;

    protected $connection = 'sca';

    protected $table = 'bancos_socios';

    protected $fillable = ['numero_cuenta', 'codigo_banco', 'cedula_socio', 'tipo_cuenta'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'sca')
            ->logOnly(['numero_cuenta', 'codigo_banco', 'cedula_socio', 'tipo_cuenta'])
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

                return "El banco :subject.codigo_banco del socio :subject.cedula ha sido $evento";
            });
    }
}

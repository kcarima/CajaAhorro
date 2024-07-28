<?php

namespace App\Models\SCA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use TipoConfiguracion;

final class Configuracion extends Model
{
    use CausesActivity;
    use HasFactory;
    use LogsActivity;

    protected $connection = 'sca';

    protected $table = 'configuraciones';

    protected $fillable = [
        'valor',
    ];

    protected $cast = [
        'tipo' => TipoConfiguracion::class,
    ];

    protected static $recordEvents = ['updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'sca')
            ->logOnly(['valor'])
            ->logOnlyDirty()
            ->dontLogIfAttributesChangedOnly(attributes: ['updated_at'])
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(callback: function (string $eventName) {
                $evento = match ($eventName) {
                    'updated' => 'actualizado',
                    default => 'desconocido',
                };

                return "La configuracion :subject.clave ha sido $evento";
            });
    }
}

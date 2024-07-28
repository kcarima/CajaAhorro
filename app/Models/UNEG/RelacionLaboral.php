<?php

namespace App\Models\UNEG;

use App\Models\SCA\Socio;
use App\Traits\GenerateUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

final class RelacionLaboral extends Model
{
    use CausesActivity;
    use GenerateUuid;
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;

    protected $connection = 'uneg';

    protected $table = 'relaciones_laborales';

    protected $fillable = ['nombre'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'uneg')
            ->logOnly(['nombre'])
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

                return "La relacion laboral :subject.nombre ha sido $evento";
            });
    }

    public function socios()
    {
        return $this->hasMany(Socio::class);
    }
}

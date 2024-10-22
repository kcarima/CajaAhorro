<?php

namespace App\Models\SCA;

use App\Traits\DataCedula;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

final class Beneficiario extends Model
{
    use CausesActivity;
    use DataCedula;
    use HasFactory;
    use LogsActivity;

    protected $connection = 'sca';

    protected $fillable = [
        'nombre', 'cedula', 'email', 'telefono', 'telefono_secundario', 'fecha_nacimiento', 'cedula_benefactor',
        'porcentaje_adjudicacion', 'doc_cedula', 'parentesco_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'sca')
            ->logOnly(['nombre', 'cedula', 'email', 'telefono', 'telefono_secundario', 'fecha_nacimiento', 'cedula_benefactor'])
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

                return "El beneficiario :subject.nombre del beneficiario :subject.cedula_benefactor ha sido $evento";
            });
    }

    public function anios(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes) {
                $fecha_nacimiento = Carbon::parse($attributes['fecha_nacimiento']);

                return $fecha_nacimiento->diffInYears(Carbon::now());
            }
        );
    }

    public function parentesco()
    {
        return $this->belongsTo(Parentesco::class);
    }
}

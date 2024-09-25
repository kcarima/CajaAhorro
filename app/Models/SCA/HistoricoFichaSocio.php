<?php

namespace App\Models\SCA;

use App\Models\UNEG\Cargo;
use App\Models\UNEG\Departamento;
use App\Models\UNEG\RelacionLaboral;
use App\Models\UNEG\TipoTrabajador;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

final class HistoricoFichaSocio extends Model
{
    use CausesActivity;
    use HasFactory;
    use LogsActivity;

    protected $connection = 'sca';

    protected $table = 'historico_fichas_socios';

    protected $fillable = [
        'cedula',
        'codigo_cargo',
        'codigo_departamento',
        'relacion_laboral_id',
        'tipo_trabajador_id',
        'sueldo',
        'moneda_id',
        'ficha_anterior',
        'sede_id',
        'zona_id',
    ];

    protected $with = ['cargo', 'departamento', 'tipo_trabajador', 'relacion_laboral', 'moneda'];

    protected static $recordEvents = ['created'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'sca')
            ->logOnly(['cedula', 'codigo_cargo', 'codigo_departamento', 'relacion_laboral_id', 'tipo_trabajador_id', 'sueldo', 'moneda_id', 'ficha_anterior'])
            ->logOnlyDirty()
            ->dontLogIfAttributesChangedOnly(attributes: ['updated_at'])
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(callback: function (string $eventName) {
                return 'El socio :subject.cedula ha cambiado su ficha :subject.ficha_anterior';
            });
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'codigo_cargo', 'codigo');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'codigo_departamento', 'codigo');
    }

    public function beneficiarios()
    {
        return $this->hasMany(Beneficiario::class, 'cedula_benefactor', 'cedula');
    }

    public function tipo_trabajador()
    {
        return $this->belongsTo(TipoTrabajador::class);
    }

    public function relacion_laboral()
    {
        return $this->belongsTo(RelacionLaboral::class);
    }

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }
}
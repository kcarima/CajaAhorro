<?php

namespace App\Models\SCA;

use App\Interfaces\SCA\Reconvertible;
use App\Traits\GenerateUuid;
use App\Traits\RouteUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

final class CuentaBancaria extends Model implements Reconvertible
{
    use CausesActivity;
    use GenerateUuid;
    use HasFactory;
    use LogsActivity;
    use RouteUuid;
    use SoftDeletes;

    protected $connection = 'sca';

    protected $table = 'cuentas_bancarias';

    protected $fillable = ['banco_id', 'agencia', 'tipo_cuenta_bancaria_id', 'saldo', 'numero', 'moneda_id', 'is_public'];

    protected $with = ['banco', 'tipoCuentaBancaria', 'moneda'];

    protected $columnsReconvert = ['saldo'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'sca')
            ->logOnly(['banco_id', 'agencia', 'tipo_cuenta_bancaria_id', 'saldo', 'numero', 'moneda_id', 'is_public'])
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

                return "La cuenta bancaria :subject.agencia ha sido $evento";
            });
    }

    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    public function tipoCuentaBancaria()
    {
        return $this->belongsTo(TipoCuentaBancaria::class);
    }

    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }

    public static function convertir(Moneda $moneda_nueva, ?Moneda $moneda_actual = null)
    {
        $moneda_anterior = $moneda_actual?->id ?? CuentaBancaria::value('moneda_id');
        $moneda_nueva = $moneda_nueva->id;
        $usuario = auth()->user()->id;
        $class = CuentaBancaria::class;

        $query = "with valores_anteriores as (
            select saldo as saldo_anterior, moneda_id as moneda_anterior, updated_at as updated_anterior, id as val_id
            from sca.cuentas_bancarias cb
        ), rows as (
            update sca.cuentas_bancarias
                set
                    saldo = saldo * (select cantidad_moneda_secundaria from sca.conversiones_monetarias cm where cm.moneda_principal_id = $moneda_anterior and cm.moneda_secundaria_id = $moneda_nueva),
                    moneda_id = $moneda_nueva,
                    updated_at = now()
            returning saldo, moneda_id, updated_at, id, agencia
        ) insert into seguridad.activity_log(log_name, description, subject_type, subject_id, causer_type, causer_id, properties, created_at, updated_at, event)
        (select 'reconversion' as log_name, concat('Se ha reconvertido la cuenta bancaria ', agencia, '.') as description,
        '$class' as subject_type, id as subject_id, 'App\Models\Seguridad\User' as causer_type, $usuario as causer_id,
        json_build_object('attributes', json_build_object('saldo', saldo, 'moneda_id', moneda_id, 'updated_at', updated_at), 'old', json_build_object('saldo', valores_anteriores.saldo_anterior, 'moneda_id', moneda_anterior, 'updated_at', updated_anterior))  as properties,
        now() as created_at, now() as updated_at, 'updated' as event
        from rows, valores_anteriores where rows.id = val_id);";

        DB::statement($query);
    }
}

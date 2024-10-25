<?php

namespace App\Models\SCA;

use App\Interfaces\SCA\Reconvertible;
use App\Interfaces\SCA\SolicitudPrestamo;
use App\Models\Seguridad\User;
use App\Models\UNEG\Cargo;
use App\Models\UNEG\Departamento;
use App\Models\UNEG\RelacionLaboral;
use App\Models\UNEG\Sede;
use App\Models\UNEG\Zona;
use App\Models\UNEG\TipoTrabajador;
use App\Traits\DataCedula;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;



final class Socio extends Model implements Reconvertible
{
    use CausesActivity;
    use DataCedula;
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;

    protected $table = 'sca.socios';

    protected $fillable = [
        'nombre',
        'ficha',
        'cedula',
        'fecha_ingreso_uneg',
        'fecha_retiro_uneg',
        'saldo_haberes',
        'saldo_bloqueado',
        'fecha_ingreso_cauneg',
        'fecha_retiro_cauneg',
        'codigo_cargo',
        'codigo_departamento',
        'relacion_laboral_id',
        'tipo_trabajador_id',
        'sede',
        'zona',
        'sueldo',
        'moneda_id',
        'es_fiador',
        'telefono',
        'telefono_secundario',
        'fecha_nac',
        'fecha_fallecido',

    ];

    protected $with = [
        'cargo',
        'departamento',
        'tipo_trabajador',
        'relacion_laboral',
        'sede',
        'zona',
        'moneda',
        'bancos',
        'beneficiarios',
        'historico_fichas',

    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(logName: 'sca')
            ->logOnly(
                ['nombre', 'ficha', 'cedula', 'fecha_ingreso_uneg', 'fecha_retiro_uneg', 'saldo_haberes', 'saldo_bloqueado',
                    'fecha_ingreso_cauneg', 'fecha_retiro_cauneg', 'codigo_cargo', 'codigo_departamento', 'relacion_laboral_id',
                    'sede','tipo_trabajador_id','sede_id','zona_id', 'sueldo', 'moneda_id', 'es_fiador', 'telefono', 'telefono_secundario',
                    'fecha_fallecido'])
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

                return "El socio :subject.nombre ha sido $evento";
            });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'cedula', 'cedula');
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

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id', 'id');
    }
    public function zona()
    {
         return $this->belongsTo(Zona::class);
    }
    public function moneda()
    {
        return $this->belongsTo(Moneda::class);
    }

    public function bancos()
    {
        return $this->belongsToMany(Banco::class, 'bancos_socios', 'cedula_socio', 'codigo_banco', 'cedula', 'codigo')->withPivot(['tipo_cuenta', 'numero_cuenta', 'id']);
    }

    public function historico_fichas()
    {
        return $this->hasMany(HistoricoFichaSocio::class, 'cedula', 'cedula');
    }

    public function SolicitudPrestamo()
    {
        return $this->hasMany(SolicitudPrestamo::class, 'ficha', 'ficha');
    }

    public function documentos(): BelongsToMany
    {
        return $this->belongsToMany(Documento::class, 'documentos_socios');
    }

    public static function convertir(Moneda $moneda_nueva, ?Moneda $moneda_actual = null)
    {
        $moneda_anterior = $moneda_actual?->id ?? Socio::value('moneda_id');
        $moneda_nueva = $moneda_nueva->id;
        $usuario = auth()->user()->id;
        $class = Socio::class;

        $query = "with valores_anteriores as (
            select saldo_haberes as saldo_anterior, moneda_id as moneda_anterior, updated_at as updated_anterior, id as val_id, saldo_bloqueado as saldo_bloqueado_anterior, sueldo as sueldo_anterior
            from sca.socios
        ), rows as (
            update sca.socios
                set
                    saldo_haberes = saldo_haberes * (select cantidad_moneda_secundaria from sca.conversiones_monetarias cm where cm.moneda_principal_id = $moneda_anterior and cm.moneda_secundaria_id = $moneda_nueva),
                    saldo_bloqueado = saldo_bloqueado * (select cantidad_moneda_secundaria from sca.conversiones_monetarias cm where cm.moneda_principal_id = $moneda_anterior and cm.moneda_secundaria_id = $moneda_nueva),
                    sueldo = sueldo * (select cantidad_moneda_secundaria from sca.conversiones_monetarias cm where cm.moneda_principal_id = $moneda_anterior and cm.moneda_secundaria_id = $moneda_nueva),
                    moneda_id = $moneda_nueva,
                    updated_at = now()
            returning saldo_haberes, moneda_id, updated_at, id, nombre, saldo_bloqueado, sueldo
        ) insert into seguridad.activity_log(log_name, description, subject_type, subject_id, causer_type, causer_id, properties, created_at, updated_at, event)
        (select 'reconversion' as log_name, concat('Se ha reconvertido el saldo haberes, saldo bloqueado y sueldo del socio ', rows.nombre, '.') as description,
        '$class' as subject_type, id as subject_id, 'App\Models\Seguridad\User' as causer_type, $usuario as causer_id,
        json_build_object('attributes', json_build_object('saldo_haberes', saldo_haberes, 'saldo_bloqueado', saldo_bloqueado, 'sueldo', sueldo, 'moneda_id', moneda_id, 'updated_at', updated_at), 'old', json_build_object('saldo_haberes', valores_anteriores.saldo_anterior, 'saldo_bloqueado', valores_anteriores.saldo_bloqueado_anterior, 'sueldo', valores_anteriores.sueldo_anterior, 'moneda_id', moneda_anterior, 'updated_at', updated_anterior))  as properties,
        now() as created_at, now() as updated_at, 'updated' as event
        from rows, valores_anteriores where rows.id = val_id);";

        DB::statement($query);
    }
}
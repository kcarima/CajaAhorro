<?php

namespace App\Models\SCA;

use App\Traits\GenerateUuid;
use App\Traits\RouteUuid;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class ConversionMonetaria extends Model
{
    use GenerateUuid;
    use HasFactory;
    use RouteUuid;

    protected $connection = 'sca';

    protected $table = 'conversiones_monetarias';

    protected $fillable = ['moneda_principal_id', 'moneda_secundaria_id', 'cantidad_moneda_secundaria', 'uuid', 'fecha_actualizacion'];

    protected $with = ['monedaPrincipal', 'monedaSecundaria'];

    public static function booted()
    {

        self::created(function (ConversionMonetaria $conversion) {
            DB::connection('sca')->table('conversiones_monetarias')->insert([
                'moneda_principal_id' => $conversion->moneda_secundaria_id,
                'moneda_secundaria_id' => $conversion->moneda_principal_id,
                'cantidad_moneda_secundaria' => bcdiv('1', strval($conversion->cantidad_moneda_secundaria), 8),
                'fecha_actualizacion' => Carbon::now()->format('Y-m-d'),
                'uuid' => Str::uuid()->toString(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        });

        self::updating(function (ConversionMonetaria $conversion) {
            if ($conversion->getOriginal('cantidad_moneda_secundaria') != $conversion->cantidad_moneda_secundaria) {
                HistorialConversionMonetaria::create([
                    'conversion_monetaria_id' => $conversion->id,
                    'monto' => $conversion->getOriginal('cantidad_moneda_secundaria'),
                    'fecha_actualizacion' => $conversion->getOriginal('fecha_actualizacion'),
                ]);

                $query = DB::connection('sca')->table('conversiones_monetarias')->where('moneda_principal_id', $conversion->moneda_secundaria_id)
                    ->where('moneda_secundaria_id', $conversion->moneda_principal_id);

                $data = $query->first();

                $query->update(
                    [
                        'cantidad_moneda_secundaria' => bcdiv('1', strval($conversion->cantidad_moneda_secundaria), 8),
                        'updated_at' => Carbon::now()
                ]);

                HistorialConversionMonetaria::create([
                    'conversion_monetaria_id' => $data->id,
                    'monto' => $data->cantidad_moneda_secundaria,
                    'fecha_actualizacion' => $conversion->getOriginal('fecha_actualizacion'),
                ]);
            }
        });

        self::deleting(function (ConversionMonetaria $conversion) {
            DB::connection('sca')->table('conversiones_monetarias')->where(function ($query) use ($conversion) {
                $query->where('moneda_principal_id', '=', $conversion->moneda_secundaria_id)->where('moneda_secundaria_id', '=', $conversion->moneda_principal_id);
            })->delete();
        });

    }

    public function monedaPrincipal()
    {
        return $this->belongsTo(Moneda::class, 'moneda_principal_id', 'id');
    }

    public function monedaSecundaria()
    {
        return $this->belongsTo(Moneda::class, 'moneda_secundaria_id', 'id');
    }

    public function historial()
    {
        return $this->hasMany(HistorialConversionMonetaria::class);
    }
}

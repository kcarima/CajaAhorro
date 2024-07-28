<?php

namespace App\Models\SCA;

use App\Classes\Enums\StatusSolicitudIngreso;
use App\Traits\GenerateUuid;
use App\Traits\RouteUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class SolicitudIngreso extends Model
{
    use GenerateUuid;
    use HasFactory;
    use RouteUuid;

    protected $connection = 'sca';

    protected $table = 'solicitudes_ingresos';

    protected $fillable = [
        'nombres', 'ficha', 'cedula', 'email', 'fecha_ingreso_uneg', 'codigo_cargo', 'codigo_departamento',
        'relacion_laboral_id', 'tipo_trabajador_id', 'sueldo', 'telefono', 'telefono_secundario', 'uuid', 'status',
        'beneficiarios', 'doc_cedula', 'doc_resolucion', 'bancos', 'sede_id', 'zona_id',
    ];

    protected $cast = [
        'status' => StatusSolicitudIngreso::class,
    ];
}

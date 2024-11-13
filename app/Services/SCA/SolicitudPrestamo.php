<?php

namespace App\Services\SCA;

use App\Models\SCA\Socio;
use App\Models\SCA\SolicitudPrestamo;

final readonly class SolicitudPrestamoService
{
    public function contar_status($id_det_jornada,$status){
        return SolicitudPrestamo::where('jornada_solicitud_prestamo_detalle_id', '=', $id_det_jornada)
                                  ->where('status', '=', $status)
                                  ->count();
    }
}

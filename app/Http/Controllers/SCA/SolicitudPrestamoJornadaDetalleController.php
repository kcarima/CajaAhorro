<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SolicitudPrestamoJornadaDetalleController extends Controller
{
    //
    public function index()
    {
        return view('sca.solicitud-prestamo-jornada-detalle.index');
    }
}

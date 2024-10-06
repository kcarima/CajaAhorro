<?php

namespace App\Http\Controllers\SCA;

use App\Models\SCA\SolicitudPrestamo;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SolicitudPrestamoController extends Controller
{
    //
    public function index()
    {
        return view('sca.solicitud-prestamos.index');
    }
}

<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;

final class HistorialConversionMonetariaController extends Controller
{
    public function __invoke()
    {
        return view('sca.historial-conversiones-monetarias.index');
    }
}

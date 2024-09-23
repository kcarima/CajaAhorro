<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SCA\Configuracion;

class LoginController extends Controller
{
    public function __invoke()
    {
        $nombre_sistema = Configuracion::where('clave', 'like', 'Nombre Sistema')->first(['valor']);
        $logo_sistema = Configuracion::where('clave', 'like', 'Logo Sistema')->first(['valor']);

        return view('auth.login', ['nombre_sistema' => $nombre_sistema, 'logo_sistema' => $logo_sistema]);
    }
}

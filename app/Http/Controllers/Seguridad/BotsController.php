<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;

final class BotsController extends Controller
{
    public function botLog()
    {
        return view('seguridad.bots.bot-log');
    }

    public function blockIp()
    {
        return view('seguridad.bots.block-ip');
    }
}

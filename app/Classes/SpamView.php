<?php

namespace App\Classes;

use App\Models\SCA\Configuracion;
use App\Models\Seguridad\BlockIp;
use App\Models\Seguridad\BotLog;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Spatie\Honeypot\SpamResponder\SpamResponder;

final class SpamView implements SpamResponder
{
    public function respond(Request $request, Closure $next)
    {

        $ip_bot = request()->ip();

        // Buscamos la ip y cuantas veces se ha registrado en la BD en el dia actual
        $cant_intentos = BotLog::where('ip', request()->ip())->whereDate('created_at', Carbon::now()->startOfDay()->toDateTimeString())->count();
        $cant_max_intentos = Configuracion::where('clave', 'like', 'Cantidad Intentos Sospechosos')->value('valor');

        if ($cant_intentos >= $cant_max_intentos) {
            BlockIp::create([
                'ip' => $ip_bot,
            ]);
        } else {
            BotLog::create([
                'ip' => $ip_bot,
                'user_agent' => $request->header('User-Agent'),
            ]);
        }

        return abort(403);
    }
}

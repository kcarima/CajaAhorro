<?php

namespace App\Actions\Fortify;

use App\Models\SCA\Configuracion;
use App\Models\Seguridad\User;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;

final class CheckBlockPassword
{
    public function __invoke(Request $request, $next)
    {
        $user = User::where(Fortify::username(), 'like', $request->{Fortify::username()})->first();

        if ($user) {
            $cantidad_intentos = Configuracion::where('clave', 'like', 'Cantidad Intentos Login')->value('valor');
            if ($user->intentos_login >= $cantidad_intentos) {
                return to_route('login')->withErrors('Usuario bloqueado');
            }
        }

        return $next($request);
    }
}

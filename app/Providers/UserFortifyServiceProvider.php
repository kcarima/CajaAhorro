<?php

namespace App\Providers;

use App\Models\Seguridad\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

final class UserFortifyServiceProvider extends FortifyServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services
     */
    public function boot()
    {
        //
        Fortify::authenticateUsing(function (LoginRequest $request) {
            $cedulaRequest = $request->cedula;
            $nacionalidades = ['V', 'v', 'E', 'e'];
            $cedula = $request->cedula;

            if(in_array($cedulaRequest[0], $nacionalidades)) {
                $nacionalidad = substr($cedulaRequest, 0, 1);
                $numeroCedula = substr($cedulaRequest, 1);
                $cedula = get_cedula(nacionalidad: strtoupper($nacionalidad), numero: $numeroCedula);

            } else if (ctype_digit($cedulaRequest)) {
                $cedula = get_cedula(numero: $cedulaRequest);
            }

            $user = User::where('cedula', $cedula)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

        });
    }
}

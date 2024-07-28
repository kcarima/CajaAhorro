<?php

namespace App\Http\Responses;

use App\Classes\Enums\StatusPassword;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as ContractsLoginResponse;

final class LoginResponse implements ContractsLoginResponse
{
    public function toResponse($request)
    {
        if (Auth::user()->status_password == StatusPassword::CAMBIAR) {
            return to_route('reiniciar.password');
        } else {
            return $request->wantsJson() ? response()->json(['two_factor' => false]) : redirect()->intended(config('fortify.home'));
        }
    }
}

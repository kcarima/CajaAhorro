<?php

namespace App\Http\Middleware;

use App\Classes\Enums\StatusPassword;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyStatusPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->status_password == StatusPassword::CAMBIAR) {
            return to_route('reiniciar.password');
        }

        return $next($request);
    }
}

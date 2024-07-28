<?php

namespace App\Http\Middleware\Seguridad;

use Closure;
use Illuminate\Http\Request;

final readonly class UserProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_string($request->user)) {
            $boolean = ! auth()->user()->is_admin() && $request->user != auth()->user()->cedula;
        } else {
            $boolean = ! auth()->user()->is_admin() && $request->user->cedula != auth()->user()->cedula;
        }

        abort_if($boolean, code: 404);

        return $next($request);
    }
}

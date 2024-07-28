<?php

namespace App\Http\Middleware;

use App\Models\Seguridad\BlockIp;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class RestrictIpAddressMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $start_date = Carbon::now()->subMonths(value: 3)->toDateString();
        $end_date = Carbon::now();

        $ip_restringida = BlockIp::whereBetween('created_at', [$start_date, $end_date])->pluck('ip')->toArray();

        if (in_array(needle: $request->ip(), haystack: $ip_restringida)) {
            return abort(code: 403);
        }

        return $next($request);
    }
}

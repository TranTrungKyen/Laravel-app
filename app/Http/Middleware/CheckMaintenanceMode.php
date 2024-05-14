<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (env('MAINTENANCE_MODE', false)) {
            return response()->json(['message' => 'The system is currently under maintenance. Please try again later.'], 503);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isActive = filter_var(Setting::get('site_active', '1'), FILTER_VALIDATE_BOOLEAN);

        if (!$isActive) {
            return response()->view('errors.maintenance', [], 503);
        }

        return $next($request);
    }
}

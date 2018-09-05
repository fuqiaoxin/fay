<?php

namespace App\Http\Middleware;

use Closure;

class AdminRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->getHost() == config('app.admin_domain')) {
            //return $request->getHost();
        }
        return $next($request);
    }
}

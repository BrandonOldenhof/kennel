<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    /**
     * Forces all requests to use HTTPS by redirecting all HTTP requests to HTTPS.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (! $request->secure() && config('app.env') === 'production') {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        return $next($request);
    }
}

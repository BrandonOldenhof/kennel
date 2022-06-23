<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RemovePoweredByHeader
{
    public function handle(Request $request, Closure $next): mixed
    {
        $request->headers->remove('X-Powered-By');

        return $next($request);
    }
}

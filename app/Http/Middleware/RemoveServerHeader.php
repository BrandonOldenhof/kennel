<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RemoveServerHeader
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $request->headers->remove('Server');

        return $next($request);
    }
}

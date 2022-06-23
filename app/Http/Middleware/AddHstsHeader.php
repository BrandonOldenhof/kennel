<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddHstsHeader
{
    /**
     * The HTTP Strict-Transport-Security response header (often abbreviated as HSTS) lets a web site
     * tell browsers that it should only be accessed using HTTPS, instead of using HTTP.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Strict-Transport-Security#description
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);
        $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubdomains');

        return $response;
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddReferrerPolicyHeader
{
    /**
     * The Referrer-Policy HTTP header controls how much referrer information should be included with requests.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Referrer-Policy
     * @link https://developer.mozilla.org/en-US/docs/Web/Security/Referer_header:_privacy_and_security_concerns
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);
        $response->header('Referrer-Policy', 'same-origin');

        return $response;
    }
}

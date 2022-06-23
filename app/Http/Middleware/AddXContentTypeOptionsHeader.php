<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddXContentTypeOptionsHeader
{
    /**
     * The X-Content-Type-Options response HTTP header is a marker used by the server to indicate that the MIME types advertised
     * in the Content-Type headers should be followed and not be changed.
     * The header allows you to avoid MIME type sniffing by saying that the MIME types are deliberately configured.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/X-Content-Type-Options
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);
        $response->header('X-Content-Type-Options', 'nosniff');

        return $response;
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;

class BasicAuth extends AuthenticateWithBasicAuth
{
    /**
     * Automatically display basic authentication prompt for all visitors
     * when the BASIC_AUTH env key === true
     *
     * @inheritDoc
     * @link https://laravel.com/docs/authentication#http-basic-authentication
     */
    public function handle($request, Closure $next, $guard = null, $field = null): mixed
    {
        if (config('rox.basic_auth') === true) {
            $this->auth->guard($guard)->basic($field ?: 'email');
        }

        return $next($request);
    }
}

<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Attempting;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\CurrentDeviceLogout;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\OtherDeviceLogout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Validated;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class AuthEventSubscriber implements ShouldQueue
{
    public $queue = 'auth-events';

    /**
     * Register the listeners for the subscriber.
     */
    public function subscribe(): array
    {
        return [
            Login::class => 'logUserLogin',
            Logout::class => 'logUserLogout',
            Registered::class => 'logRegisteredUser',
            Attempting::class => 'logAuthenticationAttempt',
            Authenticated::class => 'logAuthenticated',
            Failed::class => 'logFailedLogin',
            Validated::class => 'logValidated',
            Verified::class => 'logVerified',
            CurrentDeviceLogout::class => 'logCurrentDeviceLogout',
            OtherDeviceLogout::class => 'logOtherDeviceLogout',
            Lockout::class => 'logLockout',
            PasswordReset::class => 'logPasswordReset',
        ];
    }

    public function logUserLogin(Login $event): void
    {
        self::logAuthEvent("Auth event: User {$event->user->email} logged in.", $event->user->toArray());
    }

    public function logUserLogout(Logout $event): void
    {
        self::logAuthEvent("Auth event: User {$event->user->email} logged out.", $event->user->toArray());
    }

    public function logRegisteredUser(Registered $event): void
    {
        self::logAuthEvent("Auth event: new {$event->user->email} user registered.", $event->user->toArray());
    }

    public function logAuthenticationAttempt(Attempting $event): void
    {
        self::logAuthEvent('Auth event: visitor made authentication attempt.', Arr::except($event->credentials, ['password']));
    }

    public function logAuthenticated(Authenticated $event): void
    {
        self::logAuthEvent("Auth event: user {$event->user->email} authenticated", $event->user->toArray());
    }

    public function logFailedLogin(Failed $event): void
    {
        self::logAuthEvent("Auth event: login {$event->credentials['email']} failed.", Arr::except($event->credentials, ['password']));
    }

    public function logValidated(Validated $event): void
    {
        self::logAuthEvent("Auth event: user {$event->user->email} validated.", $event->user->toArray());
    }

    public function logVerified(Verified $event): void
    {
        self::logAuthEvent("Auth event: user {$event->user->email} verified.", $event->user->toArray());
    }

    public function logCurrentDeviceLogout(CurrentDeviceLogout $event): void
    {
        self::logAuthEvent("Auth event: user {$event->user->email}'s current device logged out.", $event->user->toArray());
    }

    public function logOtherDeviceLogout(OtherDeviceLogout $event): void
    {
        self::logAuthEvent("Auth event: user {$event->user->email}'s other device logged out.", $event->user->toArray());
    }

    public function logLockout(Lockout $event): void
    {
        self::logAuthEvent('Auth event: user locked out.', (array) $event->request);
    }

    public function logPasswordReset(PasswordReset $event): void
    {
        self::logAuthEvent("Auth event: user {$event->user->email} password reset.", $event->user->toArray());
    }

    private static function logAuthEvent(string $message, array $context): void
    {
        Log::channel('audit')->info($message, self::defaultEventData($context), );
    }

    private static function defaultEventData(array $context): array
    {
        return [
            'context' => $context,
            'url' => request()->fullUrl(),
            'ip_address' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
        ];
    }
}

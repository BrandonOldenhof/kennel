<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AddContentSecurityPolicyHeader
{
    /**
     * Content Security Policy (CSP) is an added layer of security that helps to detect and mitigate certain types of attacks,
     * including Cross-Site Scripting (XSS) and data injection attacks.
     * These attacks are used for everything from data theft, to site defacement, to malware distribution.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP
     * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        $response->header('Report-To', self::generateReportToPolicy());
        $response->header('Reporting-Endpoints', self::generateReportingEndpoints());
        $response->header(self::generateCspPolicyHeader(), self::generatePolicyArray());

        return $response;
    }

    public static function generateReportToPolicy(): string
    {
        return json_encode([
            'group' => 'csp-endpoint',
            'max_age' => 3600,
            'endpoints' => [
                ['url' => route('logging.csp.to')],
            ],
        ], JSON_UNESCAPED_SLASHES);
    }

    public static function generateReportingEndpoints(): string
    {
        return 'csp-endpoint="'.route('logging.csp.to').'"';
    }

    /**
     * Returns string string of the Content Security policies.
     * This string is used in the tests/Feature/Middleware/ContentSecurityPolicyTest.php as well
     */
    public static function generatePolicyArray(): string
    {
        return collect(self::defaults())
            ->mergeRecursive(self::vimeo())
            ->mergeRecursive(self::cookiebot())
            ->mergeRecursive(self::youtube())
            ->mergeRecursive(self::googleFonts())
            ->mergeRecursive(self::googleAnalytics())
            ->mergeRecursive(self::gtm())
            ->map(function (string|array $value): string {
                return is_array($value) ? Arr::join($value, ' ') : $value;
            })
            ->map(function (string|array $value, string $policy): string {
                return "{$policy} {$value}";
            })
            ->join('; ');
    }

    /**
     * THis method toggles between the report-only header and the normal header.
     * This means that it will only report issues, not block requests, in development but block requests in production.
     */
    private static function generateCspPolicyHeader(): string
    {
        return config('app.env') === 'production' ? 'Content-Security-Policy' : 'Content-Security-Policy-Report-Only';
    }

    private static function defaults(): array
    {
        return [
            'report-uri' => route('logging.csp.uri'),
            'report-to' => 'csp-endpoint',
            'default-src' => "'none'",
            'img-src' => "'self' data:",
            'script-src-elem' => "'self' 'unsafe-inline'",
            'style-src' => "'self' 'unsafe-inline' https://rsms.me",
            'font-src' => "'self' https://rsms.me data:",
            'connect-src' => "'self'",
            'frame-src' => "'self'",
            'object-src' => "'none'",
            'frame-ancestors' => "'self'",
            'base-uri' => "'self'",
            'manifest-src' => "'self'",
        ];
    }

    /**
     * List the CSP policies that need to be added for Vimeo embeds to be allowed in the site.
     */
    private static function vimeo(): array
    {
        return [
            'child-src' => '*.vimeo.com vimeo.com',
            'connect-src' => 'vimeo.com',
            'frame-src' => '*.vimeo.com vimeo.com',
            'media-src' => '*.vimeo.com vimeo.com',
            'script-src-elem' => 'https://player.vimeo.com https://www.vimeo.com https://f.vimeocdn.com',
            'img-src' => '*.vimeocdn.com *.vimeo.com',
        ];
    }

    /**
     * List the CSP policies that need to be added for the Cookiebot popup to be allowed in the site.
     */
    private static function cookiebot(): array
    {
        return [
            'connect-src' => 'https://consentcdn.cookiebot.com',
            'frame-src' => 'https://consentcdn.cookiebot.com',
        ];
    }

    /**
     * List the CSP policies that need to be added for Youtube embeds to be allowed in the site.
     */
    private static function youtube(): array
    {
        return [
            'frame-src' => 'youtube.com www.youtube.com',
        ];
    }

    /**
     * List the CSP policies that need to be added for Google Fonts to be allowed in the site.
     */
    private static function googleFonts(): array
    {
        return [
            'font-src' => 'fonts.gstatic.com',
            'style-src' => 'fonts.googleapis.com',
        ];
    }

    /**
     * List the CSP policies that need to be added for Google Analytics scripts to be allowed in the site.
     */
    private static function googleAnalytics(): array
    {
        return [
            'connect-src' => '*.google-analytics.com *.analytics.google.com',
            'img-src' => '*.google-analytics.com',
        ];
    }

    /**
     * List the CSP policies that need to be added for GTM scripts to be allowed in the site.
     */
    private static function gtm(): array
    {
        return [
            'connect-src' => '*.googletagmanager.com',
            'img-src' => '*.googletagmanager.com',
            'script-src-elem' => '*.googletagmanager.com https://www.googletagmanager.com',
        ];
    }
}

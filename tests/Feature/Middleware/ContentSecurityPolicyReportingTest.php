<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;

class ContentSecurityPolicyReportingTest extends TestCase
{
    private array $invalidReportUriPayload;

    private array $validReportUriPayload = [
        'csp-report' => [
            'document-uri' => 'https://base-laravel-template.test/users',
            'referrer' => '',
            'violated-directive' => 'script-src-elem',
            'effective-directive' => 'script-src',
            'original-policy' => "report-uri https://base-laravel-template.test/logging/csp/report-uri; report-to csp-endpoint; default-src 'none'; img-src 'self' data: *.vimeocdn.com *.vimeo.com *.google-analytics.com *.googletagmanager.com; script-src-elem 'self' 'unsafe-inline' https://player.vimeo.com https://www.vimeo.com https://f.vimeocdn.com *.googletagmanager.com https://www.googletagmanager.com; style-src 'self' 'unsafe-inline' https://rsms.me fonts.googleapis.com; font-src 'self' https://rsms.me data: fonts.gstatic.com; connect-src 'self' vimeo.com https://consentcdn.cookiebot.com *.google-analytics.com *.analytics.google.com *.googletagmanager.com; frame-src 'self' *.vimeo.com vimeo.com https://consentcdn.cookiebot.com youtube.com www.youtube.com; object-src 'none'; frame-ancestors 'self'; base-uri 'self'; manifest-src 'self'; child-src *.vimeo.com vimeo.com; media-src *.vimeo.com vimeo.com",
            'blocked-uri' => 'https://www.googletagmanager.com/gtag/js?id=test',
            'status-code' => 0,
        ],
    ];

    private array $invalidReportToPayload;

    private array $validReportToPayload = [
        [
            'age' => 420,
            'body' => [
                'columnNumber' => 12,
                'disposition' => 'enforce',
                'lineNumber' => 11,
                'message' => 'Document policy violation: document-write is not allowed in this document.',
                'policyId' => 'document-write',
                'sourceFile' => 'https://dummy.example/script.js',
            ],
            'type' => 'document-policy-violation',
            'url' => 'https://dummy.example/',
            'user_agent' => 'xxx',
        ],
        [
            'age' => 510,
            'body' => [
                'blockedURL' => 'https://dummy.example/img.jpg',
                'destination' => 'image',
                'disposition' => 'enforce',
                'type' => 'corp',
            ],
            'type' => 'coep',
            'url' => 'https://dummy.example/',
            'user_agent' => 'xxx',
        ],
    ];

    public function setUp(): void
    {
        parent::setUp();

        $reportUriPayload = $this->validReportUriPayload;
        unset($reportUriPayload['csp-report']['document-uri']);
        $this->invalidReportUriPayload = $reportUriPayload;

        $validReportToPayload = $this->validReportToPayload;
        unset($validReportToPayload[0]['body']);
        $this->invalidReportToPayload = $validReportToPayload;
    }

    public function test_valid_dummy_report_can_be_submitted_to_the_report_uri_method(): void
    {
        $this->json('post', route('logging.csp.uri'), $this->validReportUriPayload)
            ->assertValid()
            ->assertSuccessful();
    }

    public function test_invalid_dummy_report_cant_be_submitted_to_the_report_uri_method(): void
    {
        $this->json('post', route('logging.csp.uri'), $this->invalidReportUriPayload)
            ->assertInvalid(['document-uri'])
            ->assertUnprocessable();
    }

    public function test_valid_dummy_report_can_be_submitted_to_the_report_to_method(): void
    {
        $this->json('post', route('logging.csp.to'), $this->validReportToPayload)
            ->assertValid()
            ->assertSuccessful();
    }

    public function test_invalid_dummy_report_cant_be_submitted_to_the_report_to_method(): void
    {
        $this->json('post', route('logging.csp.to'), $this->invalidReportToPayload)
            ->assertInvalid(['reports.0.body'])
            ->assertUnprocessable();
    }
}

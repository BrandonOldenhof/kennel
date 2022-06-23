<?php

namespace Tests\Feature\Middleware;

use App\Http\Middleware\AddContentSecurityPolicyHeader;
use Tests\TestCase;

class ContentSecurityPolicyTest extends TestCase
{
    private string $policies;

    private string $reportTo;

    private string $reportingEndpoints;

    public function setUp(): void
    {
        parent::setUp();

        $this->policies = AddContentSecurityPolicyHeader::generatePolicyArray('test_token');
        $this->reportTo = AddContentSecurityPolicyHeader::generateReportToPolicy();
        $this->reportingEndpoints = AddContentSecurityPolicyHeader::generateReportingEndpoints();
    }

    public function test_policy_array_is_generated() :void
    {
        $this->assertIsString($this->policies);
        $this->assertStringContainsString('default-src', $this->policies);
        $this->assertStringContainsString('img-src', $this->policies);
        $this->assertStringContainsString('script-src', $this->policies);
        $this->assertStringContainsString('script-src-elem', $this->policies);
        $this->assertStringContainsString('style-src', $this->policies);
        $this->assertStringContainsString('font-src', $this->policies);
        $this->assertStringContainsString('connect-src', $this->policies);
        $this->assertStringContainsString('frame-src', $this->policies);
        $this->assertStringContainsString('object-src', $this->policies);
        $this->assertStringContainsString('frame-ancestors', $this->policies);
        $this->assertStringContainsString('base-uri', $this->policies);
        $this->assertStringContainsString('media-src', $this->policies);
        $this->assertStringContainsString('child-src', $this->policies);
        $this->assertStringContainsString('manifest-src', $this->policies);
    }

    public function test_content_security_policy_header_is_set_when_in_production(): void
    {
        config(['app.env' => 'production']);

        $response = $this->withSession(['_token' => 'test_token'])
            ->get(route('home'));

        $response->assertHeader('Content-Security-Policy', $this->policies)
            ->assertHeader('Report-To', $this->reportTo)
            ->assertHeader('Reporting-Endpoints', $this->reportingEndpoints);
    }

    public function test_content_security_policy_header_is_set_when_not_in_production(): void
    {
        config(['app.env' => 'local']);

        $this->withSession(['_token' => 'test_token'])
            ->get(route('home'))
            ->assertHeader('Content-Security-Policy-Report-Only', $this->policies)
            ->assertHeader('Report-To', $this->reportTo)
            ->assertHeader('Reporting-Endpoints', $this->reportingEndpoints);
    }
}

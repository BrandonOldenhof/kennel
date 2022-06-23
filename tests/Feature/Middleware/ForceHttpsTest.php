<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;

class ForceHttpsTest extends TestCase
{
    private string $unsafeUrl;

    private string $safeUrl;

    public function setUp(): void
    {
        parent::setUp();

        $this->safeUrl = preg_replace('/^http:/i', 'https:', url('/'));
        $this->unsafeUrl = preg_replace('/^https:/i', 'http:', url('/'));

        config(['app.env' => 'production']);
    }

    public function test_safe_url_is_not_redirected_when_in_production(): void
    {
        $this->get($this->safeUrl)
            ->assertSuccessful();
    }

    public function test_unsafe_url_is_redirected_to_safe_url_when_in_production(): void
    {
        $this->get($this->unsafeUrl)
            ->assertRedirect($this->safeUrl);
    }

    public function test_unsafe_url_is_not_redirected_when_not_in_production(): void
    {
        config(['app.env' => 'local']);

        $this->get($this->unsafeUrl)
            ->assertSuccessful();
    }

    public function test_safe_url_is_not_redirected_when_not_in_production(): void
    {
        config(['app.env' => 'local']);

        $this->get($this->safeUrl)
            ->assertSuccessful();
    }
}

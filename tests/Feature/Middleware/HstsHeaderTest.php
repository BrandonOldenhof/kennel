<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;

class HstsHeaderTest extends TestCase
{
    public function test_hsts_header_is_set(): void
    {
        $this->get(route('home'))
            ->assertHeader('Strict-Transport-Security', 'max-age=31536000; includeSubdomains');
    }
}

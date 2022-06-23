<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;

class ReferrerPolicyHeaderTest extends TestCase
{
    public function test_referrer_policy_header_is_set(): void
    {
        $this->get(route('home'))
            ->assertHeader('Referrer-Policy', 'same-origin');
    }
}

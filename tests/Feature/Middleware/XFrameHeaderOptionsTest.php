<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;

class XFrameHeaderOptionsTest extends TestCase
{
    public function test_xframe_header_is_set(): void
    {
        $this->get(route('home'))
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN');
    }
}

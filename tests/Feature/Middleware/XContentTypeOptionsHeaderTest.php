<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;

class XContentTypeOptionsHeaderTest extends TestCase
{
    public function test_x_content_type_options_header_is_set(): void
    {
        $this->get(route('home'))
            ->assertHeader('X-Content-Type-Options', 'nosniff');
    }
}

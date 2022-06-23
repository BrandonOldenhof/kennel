<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;

class RemoveServerHeaderTest extends TestCase
{
    public function test_server_header_is_removed(): void
    {
        $this->withHeaders([
            'Server' => 'Apache',
        ])
            ->get(route('home'))
            ->assertHeaderMissing('Server');
    }
}

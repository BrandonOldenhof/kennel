<?php

namespace Tests\Feature\Middleware;

use Tests\TestCase;

class RemovePoweredByHeaderTest extends TestCase
{
    public function test_x_powered_by_header_is_removed(): void
    {
        $this->withHeaders([
            'X-Powered-By' => 'PHP',
        ])
            ->get(route('home'))
            ->assertHeaderMissing('X-Powered-By');
    }
}

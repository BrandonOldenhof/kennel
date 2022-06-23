<?php

namespace Tests\Feature\Crud;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_home_route_shows_markdown(): void
    {
        $this->get(route('home'))
            ->assertStatus(200)
            ->assertViewIs('pages.home.home');
    }

    public function test_cookies_page_shows_cookies(): void
    {
        $this->get(route('cookies'))
            ->assertStatus(200)
            ->assertViewIs('pages.cookies.cookies');
    }
}

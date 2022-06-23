<?php

namespace Tests\Feature\Middleware;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class BasicAuthTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory([
            'name' => 'ROX',
            'email' => 'webmaster@rox.nl',
            'password' => bcrypt(config('rox.users.rox')),
        ])
            ->isAdmin()
            ->create();

        config(['rox.basic_auth' => true]);
    }

    public function test_logged_out_user_doesnt_see_prompt_when_disabled(): void
    {
        config(['rox.basic_auth' => false]);

        $this->get(route('home'))
            ->assertStatus(200);

        $this->assertGuest();
    }

    public function test_logged_out_user_sees_prompt_when_enabled(): void
    {
        $this->get(route('home'))
            ->assertUnauthorized()
            ->assertSee(401);

        $this->assertGuest();
    }

    public function test_invalid_credentials_dont_allow_access(): void
    {
        $this->withHeaders([
            'PHP_AUTH_USER' => $this->user->email,
            'PHP_AUTH_PW' => 'invalid password',
        ])
            ->get(route('home'))
            ->assertUnauthorized()
            ->assertSee(401);

        $this->assertGuest();
    }

    public function test_valid_credentials_allow_access(): void
    {
        $this->withHeaders([
            'PHP_AUTH_USER' => $this->user->email,
            'PHP_AUTH_PW' => config('rox.users.rox'),
        ])
            ->get(route('home'))
            ->assertStatus(200);

        $this->assertAuthenticated();
    }

    public function test_logged_in_user_doesnt_see_prompt(): void
    {
        Auth::login($this->user);

        $this->get(route('home'))
            ->assertStatus(200);

        $this->assertAuthenticated();
    }
}

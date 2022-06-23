<?php

namespace Tests\Feature\Policies;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserPolicyTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private User $adminUser;

    private User $guestUser;

    public function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::factory()
            ->isAdmin()
            ->create();

        $this->guestUser = User::factory()
            ->create();
    }

    public function test_admin_user_can_list_users(): void
    {
        $this->actingAs($this->adminUser);
        $this->assertTrue($this->adminUser->can('viewAny', User::class));
    }

    public function test_admin_user_can_view_users(): void
    {
        $this->actingAs($this->adminUser);
        $this->assertTrue($this->adminUser->can('view', User::class));
    }

    public function test_admin_user_can_create_users(): void
    {
        $this->actingAs($this->adminUser);
        $this->assertTrue($this->adminUser->can('create', User::class));
    }

    public function test_admin_user_can_update_users(): void
    {
        $this->actingAs($this->adminUser);
        $this->assertTrue($this->adminUser->can('update', User::class));
    }

    public function test_admin_user_can_delete_users(): void
    {
        $this->actingAs($this->adminUser);
        $this->assertTrue($this->adminUser->can('delete', User::class));
    }

    public function test_guest_user_cannot_list_users(): void
    {
        $this->actingAs($this->guestUser);
        $this->assertTrue($this->guestUser->cannot('viewAny', User::class));
    }

    public function test_guest_user_cannot_view_users(): void
    {
        $this->actingAs($this->guestUser);
        $this->assertTrue($this->guestUser->cannot('view', User::class));
    }

    public function test_guest_user_cannot_create_users(): void
    {
        $this->actingAs($this->guestUser);
        $this->assertTrue($this->guestUser->cannot('create', User::class));
    }

    public function test_guest_user_cannot_update_users(): void
    {
        $this->actingAs($this->guestUser);
        $this->assertTrue($this->guestUser->cannot('update', User::class));
    }

    public function test_guest_user_cannot_delete_users(): void
    {
        $this->actingAs($this->guestUser);
        $this->assertTrue($this->guestUser->cannot('delete', User::class));
    }
}

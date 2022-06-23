<?php

namespace Tests\Feature\Crud;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
            ->isAdmin()
            ->create();

        $this->actingAs($this->user);
    }

    public function test_index_view_works(): void
    {
        $this->get(route('users.index'))
            ->assertStatus(200)
            ->assertViewIs('pages.users.index')
            ->assertSee($this->user->name);
    }

    public function test_create_crud_view_works(): void
    {
        $this->get(route('users.create'))
            ->assertStatus(200)
            ->assertViewIs('pages.users.create');
    }

    public function test_store_crud_method_works(): void
    {
        $userFactory = User::factory()->make()->toArray();

        $request = array_merge($userFactory, [
            'password' => 'SafePassword!123',
            'password_confirmation' => 'SafePassword!123',
        ]);

        $this->post(route('users.store'), $request)
            ->assertRedirect(route('users.index'));

        $userFactory['notification_objects'] = json_encode($userFactory['notification_objects']);

        $this->assertDatabaseHas('users', $userFactory);
    }

    public function test_show_crud_view_works(): void
    {
        $this->get(route('users.show', $this->user))
            ->assertStatus(200)
            ->assertViewIs('pages.users.show')
            ->assertSee($this->user->name);
    }

    public function test_edit_crud_view_works(): void
    {
        $this->get(route('users.edit', $this->user))
            ->assertStatus(200)
            ->assertViewIs('pages.users.edit')
            ->assertSee($this->user->name);
    }

    public function test_update_crud_method_works(): void
    {
        $userFactory = User::factory()->make()->toArray();

        $this->patch(route('users.update', $this->user), $userFactory)
            ->assertRedirect(route('users.index'));

        $userFactory['notification_objects'] = json_encode($userFactory['notification_objects']);

        $this->assertDatabaseHas('users', $userFactory);
    }

    public function test_destroy_crud_method_works(): void
    {
        $this->delete(route('users.destroy', $this->user), $this->user->only('id'))
            ->assertRedirect(route('users.index'));

        $this->assertModelMissing($this->user);
    }
}

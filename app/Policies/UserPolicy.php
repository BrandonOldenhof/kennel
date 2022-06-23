<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks. This method is run before any of the other methods.
     * If this method returns true then the user has permission to access the resource.
     * If this method returns null then the other methods are used to determine if the user can access the resource.
     *
     * @link https://laravel.com/docs/authorization#generating-policies
     */
    public function before(User $user): ?bool
    {
        return $user->isAdmin() ?: null;
    }

    /**
     * Is the user allowed to view users.index?
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Is the user allowed to view users.show?
     */
    public function view(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Is the user allowed to view users.create OR store new users?
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Is the user allowed to view users.edit OR update existing users?
     */
    public function update(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Is the user allowed to destroy existing users?
     */
    public function delete(User $user): bool
    {
        return $user->isAdmin();
    }
}

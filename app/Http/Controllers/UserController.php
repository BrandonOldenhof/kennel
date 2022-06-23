<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDestroyRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Create the controller instance.
     * This also applies the UserPolicy to the resource.
     * Note: This only works after authentication has been implemented and a user has been logged in.
     */
    public function __construct()
    {
        // Log in the ROX user to test the authentication.
        // Auth::login(User::find(1));
        // $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the User.
     */
    public function index(): View
    {
        return view('pages.users.index', [
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new User.
     */
    public function create(): View
    {
        return view('pages.users.create');
    }

    /**
     * Store a newly created User in storage.
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', "Gebruiker {$user->name} is aangemaakt.");
    }

    /**
     * Display the specified User.
     */
    public function show(User $user): View
    {
        return view('pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified User.
     */
    public function edit(User $user): View
    {
        return view('pages.users.edit', compact('user'));
    }

    /**
     * Update the specified User in storage.
     */
    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        User::findOrFail($user->id)->update($request->validated());

        return redirect()
            ->route('users.index')
            ->with('success', "Gebruiker {$user->name} is bijgewerkt.");
    }

    /**
     * Remove the specified User from storage.
     */
    public function destroy(UserDestroyRequest $request, User $user): RedirectResponse
    {
        $user->findOrFail($request->validated('id'))->delete();

        return redirect()
            ->route('users.index')
            ->with('success', "Gebruiker {$user->name} is verwijderd.");
    }
}

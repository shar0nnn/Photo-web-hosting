<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::all()->sortBy('name');

        return view('admin.users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        $user = User::create([
            'name' => $credentials['name'],
            'group_id' => $credentials['group'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($credentials['role']);

        return redirect()->route('users.index')->with('success', 'Користувач був успішно створений!');
    }

    /**
     * Display the specified resource.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $credentials = $request->validated();

        $user->update([
            'name' => $credentials['name'],
            'group_id' => $credentials['group'],
            'email' => $credentials['email'],
        ]);

        $user->syncRoles($credentials['role']);

        return redirect()->route('users.index')->with('success', 'Користувач був успішно відредагований!');
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return back()->with('success', 'Користувач був успішно видалений!');
    }
}

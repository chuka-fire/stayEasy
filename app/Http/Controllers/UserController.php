<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'is_staff' => true,
            'is_manager' => $request->has('is_manager'),
        ]);

        return redirect()->route('users.index')
            ->with('message', 'Staff account created for '.$user->name.'.');
    }

    public function edit($id): View
    {
        $user = User::find($id);

        abort_unless($user, 404);

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        abort_unless($user, 404);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:8',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_staff' => $request->has('is_staff'),
            'is_manager' => $request->has('is_manager'),
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => $validated['password']]);
        }

        return redirect()->route('users.index')
            ->with('message', 'Staff account updated.');
    }

    public function destroy($id): RedirectResponse
    {
        $user = User::find($id);

        abort_unless($user, 404);

        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('warning', 'You cannot remove your own account.');
        }

        if ($user->bookings()->exists()) {
            return redirect()->route('users.index')
                ->with('warning', $user->name.' has bookings and cannot be removed.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('message', 'Staff account removed.');
    }
}

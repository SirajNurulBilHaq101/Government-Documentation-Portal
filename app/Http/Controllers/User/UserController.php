<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('username', 'like', '%' . $request->search . '%')
                  ->orWhere('nip', 'like', '%' . $request->search . '%')
                  ->orWhere('department', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'username'   => 'required|string|max:50|unique:users,username|alpha_dash',
            'nip'        => 'nullable|string|max:30|unique:users,nip',
            'position'   => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'role'       => 'required|in:admin,staff,viewer',
            'password'   => ['required', 'confirmed', Password::min(8)],
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'username'   => $request->username,
            'nip'        => $request->nip,
            'position'   => $request->position,
            'department' => $request->department,
            'role'       => $request->role,
            'password'   => Hash::make($request->password),
            'is_active'  => true,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'username'   => 'required|string|max:50|unique:users,username,' . $user->id . '|alpha_dash',
            'nip'        => 'nullable|string|max:30|unique:users,nip,' . $user->id,
            'position'   => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'role'       => 'required|in:admin,staff,viewer',
            'is_active'  => 'required|boolean',
            'password'   => ['nullable', 'confirmed', Password::min(8)],
        ]);

        $data = [
            'name'       => $request->name,
            'email'      => $request->email,
            'username'   => $request->username,
            'nip'        => $request->nip,
            'position'   => $request->position,
            'department' => $request->department,
            'role'       => $request->role,
            'is_active'  => $request->is_active,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Soft deactivate instead of hard delete
        $user->update(['is_active' => false]);

        return redirect()->route('users.index')
            ->with('success', 'User has been deactivated.');
    }
}

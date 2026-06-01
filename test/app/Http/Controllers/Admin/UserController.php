<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('username', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->role) {
            $query->where('role', $request->role);
        }

        if ($request->is_active) {
            $query->where('is_active', $request->is_active);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.user.index', compact('users'));
    }

    public function store(Request $request) : RedirectResponse
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:editor,admin'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'slug' => Str::slug($request->name . '-' . Str::random(6)),
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    public function update(Request $request, User $user) : RedirectResponse
    {
        if ($user->role === 'superAdmin') {
            return redirect()->route('admin.users')->with('error', 'You cannot update a super admin account.');
        }
        request()->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,editor'
        ]);

        $user->update([
            'name' => $request->name,
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function lock(User $user) : RedirectResponse
    {
        if ($user->role === 'superAdmin') {
            return redirect()->route('admin.users')->with('error', 'You cannot lock a super admin account.');
        }

        $user->update(['is_active' => false]);

        return redirect()->route('admin.users')->with('success', 'User locked successfully');
    }

    public function unlock(User $user) : RedirectResponse
    {
        if ($user->role === 'superAdmin') {
            return redirect()->route('admin.users')->with('error', 'You cannot unlock a super admin account.');
        }

        $user->update(['is_active' => true]);

        return redirect()->route('admin.users')->with('success', 'User unlocked successfully');
    }

    public function destroy(User $user) : RedirectResponse
    {

        if ($user->role === 'superAdmin') {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
}

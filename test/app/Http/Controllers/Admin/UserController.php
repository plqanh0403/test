<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::all();

        return view('admin.user.index', compact('users'));
    }

    public function detail(User $user): View
    {
        return view('admin.user.detail', compact('user'));
    }
    
    public function create(): View
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:editor,user'
        ]);
        
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    public function edit(User $user): View
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->role === 'superAdmin') {
            return redirect()->route('admin.users')->with('error', 'You cannot update a super admin account.');
        }
        request()->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,editor,user'
        ]);

        $user->update([
            'name' => $request->name,
            'role' => $request->role
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function lock(User $user)
    {
        if ($user->role === 'superAdmin') {
            return redirect()->route('admin.users')->with('error', 'You cannot lock a super admin account.');
        }

        $user->update(['is_active' => false]);

        return redirect()->route('admin.users')->with('success', 'User locked successfully');
    }

    public function unlock(User $user)
    {
        if ($user->role === 'superAdmin') {
            return redirect()->route('admin.users')->with('error', 'You cannot unlock a super admin account.');
        }

        $user->update(['is_active' => true]);

        return redirect()->route('admin.users')->with('success', 'User unlocked successfully');
    }

    public function destroy(User $user)
    {
        
        if ($user->role === 'superAdmin') {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account.');
        } 

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
}

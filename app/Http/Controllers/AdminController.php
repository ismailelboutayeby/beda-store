<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    // 1. View all users
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    // 2. Edit user & role
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // 3. Update user role
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User role updated successfully.');
    }

    // 4. Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }

    // 5. Admin dashboard
    public function dashboard()
    {
        // You can add summary data here for the dashboard view
        return view('admin.dashboard');
    }
}

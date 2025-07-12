<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    public function show($id)
{
    $user = User::findOrFail($id);

    return view('admin.users.show', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,noc,customer'
    ]);

    // Kalau customer, role tidak boleh diubah
    if ($user->role === 'customer') {
        $request->merge(['role' => 'customer']);
    }

    $user->update([
        'full_name' => $request->full_name,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return back()->with('success', 'User updated successfully.');
}

public function destroy($id)
{
    $user = User::findOrFail($id);

    // Jangan izinkan admin menghapus diri sendiri
    if (auth()->id() == $user->id) {
        return back()->with('error', 'You cannot delete your own account.');
    }

    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
}

//user create
public function create()
{
    return view('admin.users.create');
}

public function store(Request $request)
{
    $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role' => 'required|in:admin,noc',
    ]);

    User::create([
        'full_name' => $request->full_name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => $request->role,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
}


}

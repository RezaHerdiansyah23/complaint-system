<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserManagementController extends Controller
{
    public function index(Request $request)
{
    // Ambil input untuk sortir, defaultnya urutkan berdasarkan nama
    $sortBy = $request->input('sort_by', 'full_name');
    $sortDir = $request->input('sort_dir', 'asc');

    // Ambil input untuk pencarian
    $search = $request->input('search', '');

    // Buat query untuk mengambil data pengguna
    $usersQuery = User::query()
        ->when($search, function($query, $search) {
            // Cari berdasarkan nama atau email
            $query->where('full_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
        });

    // Terapkan sortir dan pagination
    $users = $usersQuery->orderBy($sortBy, $sortDir)->paginate(10)->withQueryString();

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
        'role' => 'required|in:admin,noc,customer',
        'password' => 'nullable|min:6|confirmed',
    ]);

     // Siapkan data untuk diupdate
    $data = [
        'full_name' => $request->full_name,
        'email' => $request->email,
    ];

    // Jika password diisi, hash dan tambahkan ke data update
    if ($request->filled('password')) {
        $data['password'] = bcrypt($request->password);
    }
    
    // Kalau bukan customer, role bisa diubah
    if ($user->role !== 'customer') {
        $data['role'] = $request->role;
    }

    $user->update($data);

    $message = 'User updated successfully.';
    if ($request->filled('password')) {
        $message = 'User information and password updated successfully.';
    }

    return back()->with('success', $message);
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

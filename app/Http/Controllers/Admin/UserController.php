<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // LIST USERS
    public function index(Request $request)
    {
        $query = User::with('role');

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        // 🎯 ROLE FILTER
        if ($request->role_id) {
            $query->where('role_id', $request->role_id);
        }

        $users = $query->latest()->paginate(10);

        // 📊 CHART DATA
        $chart = User::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $roles = Role::all();

        return view('admin.users.index', compact('users', 'chart', 'roles'));
    }

    public function team()
    {
        $pharmaciens = User::with('role')
            ->whereHas('role', function ($q) {
                $q->where('name', 'pharmacien');
            })
            ->latest()
            ->paginate(12);

        return view('admin.team.index', compact('pharmaciens'));
    }

    // CREATE PAGE
    public function create()
    {
        $roles = Role::all(); // ✅ FIX (you forgot this)
        return view('admin.users.create', compact('roles'));
    }

    // STORE USER
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created');
    }

    // SHOW USER
    public function show($id)
    {
        $user = User::with('role')->findOrFail($id); // ✅ FIX
        return view('admin.users.show', compact('user'));
    }

    // EDIT USER
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    // UPDATE USER
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'role_id' => 'required|exists:roles,id',
        ]);

        $data = $request->only('name', 'email', 'role_id');

        // ✅ FIX: password optional
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated');
    }

    // DELETE USER
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted');
    }
}

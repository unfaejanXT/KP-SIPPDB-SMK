<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $roleFilter = $request->input('role');

        $users = User::with('roles')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($roleFilter, function ($query, $role) {
                if ($role && $role !== 'Semua Role') {
                    return $query->role($role);
                }
                return $query;
            })
            ->paginate(10); 

        $totalUsers = User::count();
        $totalAdmin = User::role('admin')->count();
        $totalOperator = User::role('user')->count(); // Assuming 'user' is the other main role acting as operator/student
        // In this context, maybe we just count distinct roles found.
        
        $roles = Role::pluck('name'); 

        return view('admin.users.index', compact('users', 'search', 'roleFilter', 'totalUsers', 'totalAdmin', 'totalOperator', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|min:8',
            'role' => 'required|exists:roles,name',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri yang sedang aktif.');
        }

        try {
            \Illuminate\Support\Facades\DB::beginTransaction();

            // Hapus role terlebih dahulu untuk menghindari constraint integrity
            $user->syncRoles([]);
            
            $user->delete();

            \Illuminate\Support\Facades\DB::commit();

            return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}

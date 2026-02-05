<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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
            ->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'calon_siswa');
            })
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
        $totalAdmin = User::role('operator_sekolah')->count();
        $totalOperator = User::role('calon_siswa')->count(); 
        $totalActive = User::where('is_active', true)->count();
        
        $filterRoles = Role::where('name', '!=', 'calon_siswa')->pluck('name'); 
        $allRoles = Role::all();

        return view('admin.users.index', compact('users', 'search', 'roleFilter', 'totalUsers', 'totalAdmin', 'totalOperator', 'totalActive', 'filterRoles', 'allRoles'));
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

        // Cek apakah user yang akan dihapus adalah operator_sekolah
        if ($user->hasRole('operator_sekolah')) {
            // Hitung jumlah user dengan role operator_sekolah
            $totalOperators = User::role('operator_sekolah')->count();
            
            // Jika hanya tinggal 1 operator, jangan izinkan penghapusan
            if ($totalOperators <= 1) {
                return back()->with('error', 'Tidak dapat menghapus akun Operator Sekolah terakhir. Sistem harus memiliki minimal satu Operator Sekolah.');
            }
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
    public function toggleStatus(User $user)
    {
        if ($user->id == auth()->id()) {
            return back()->with('error', 'Anda tidak dapat mengubah status akun sendiri.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "Akun pengguna berhasil $status.");
    }
}

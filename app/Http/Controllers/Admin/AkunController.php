<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Operator;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;

class AkunController extends Controller
{
    public function index(Request $request)
    {
        $data = User::query();
        dd($data);
        if ($request->ajax()) {

            

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
       
                            $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
      
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.akun.index');
    }

    public function create()
    {
        // Menampilkan form untuk membuat akun baru
        $roles = Role::all(); // Menampilkan semua role yang tersedia
        return view('admin.akun.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'nohp' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        // Menyimpan data pengguna baru
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'nohp' => $request->nohp,
            'password' => Hash::make($request->password),
        ]);

        // Assign role ke pengguna baru
        $role = Role::where('name', $request->role)->first();
        $user->assignRole($role);

        // Membuat data operator terkait user (opsional)
        Operator::create([
            'user_id' => $user->id,
            'nama_operator' => $request->name,
            'is_active' => true,
        ]);

        return redirect()->route('admin.kelolaakun.index')->with('success', 'Akun berhasil dibuat.');
    }

    public function edit($id)
    {
        // Menampilkan form untuk mengedit akun pengguna
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.akun.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $id . '|max:255',
            'nohp' => 'required|string|max:15',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,name',
        ]);

        // Mengambil data pengguna berdasarkan ID
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'nohp' => $request->nohp,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // Menghapus semua role lama dan assign role baru
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.kelolaakun.index')->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Menghapus akun pengguna berdasarkan ID
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.kelolaakun.index')->with('success', 'Akun berhasil dihapus.');
    }
}

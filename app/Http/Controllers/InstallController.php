<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class InstallController extends Controller
{
    public function index()
    {
        // If users strictly exist (> 0), redirect to home
        if (User::count() > 0) {
            return redirect('/');
        }
        
        return view('breeze.auth.install-admin');
    }

    public function store(Request $request)
    {
        if (User::count() > 0) {
            return redirect('/');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Create Admin User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Create Role if doesn't exist (handling fresh migration without seed)
        $role = Role::firstOrCreate(['name' => 'admin']);
        
        // Assign Role
        $user->assignRole($role);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }
}

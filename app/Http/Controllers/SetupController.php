<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class SetupController extends Controller
{
    public function index()
    {
        // Double check to prevent access if already setup
        if (User::count() > 0) {
            return redirect('/');
        }
        return view('breeze.setup');
    }

    public function store(Request $request)
    {
        // Final check to prevent overwrite
        if (User::count() > 0) {
            return redirect('/');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        // User model has 'hashed' cast for password, so we pass plain text
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        
        // Assign admin role
        // We use App\Models\Role since it extends Spatie Role
        try {
            if (class_exists(\App\Models\Role::class)) {
                 $role = \App\Models\Role::firstOrCreate(['name' => 'admin']);
                 if (method_exists($user, 'assignRole')) {
                     $user->assignRole($role);
                 }
            }
        } catch (\Exception $e) {
            // Log error or ignore if permission system not ready
        }

        // Login the user
        Auth::login($user);

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
             //'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required','string','regex:/^\d{10,16}$/','unique:users,username'],
            'nohp' => ['required','string','regex:/^(08|628|8)\d{8,11}$/','unique:users,nohp'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        

        $user = User::create([
            // 'email' => $request->email,
            'username' => $request->username,
            'nohp' => $request->nohp,
            'password' => Hash::make($request->password),
        ])->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('register.student', absolute: false));
    }
}

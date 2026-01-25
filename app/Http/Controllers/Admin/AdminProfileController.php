<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(AdminProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        // Handle File Upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $path = $request->file('foto')->store('profile-photos', 'public');
            $validatedData['foto'] = $path;
        }

        // Update User info
        $user->fill([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        // Update Staff info
        $staffData = [
            'nomor_telepon' => $validatedData['nomor_telepon'] ?? null,
            'jabatan' => $validatedData['jabatan'] ?? 'Administrator',
        ];
        
        if (isset($validatedData['foto'])) {
            $staffData['foto'] = $validatedData['foto'];
        }

        // Use updateOrCreate to ensure staff record exists
        $user->staff()->updateOrCreate(
            ['user_id' => $user->id],
            $staffData
        );

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }
}

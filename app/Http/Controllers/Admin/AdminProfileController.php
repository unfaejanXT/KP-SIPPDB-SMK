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
     * Menampilkan formulir profil pengguna.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Memperbaharui informasi profil pengguna.
     */
    public function update(AdminProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        // Menangani unggah file
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $path = $request->file('foto')->store('profile-photos', 'public');
            $validatedData['foto'] = $path;
        }

        // Memperbaharui informasi pengguna
        $user->fill([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        // Memperbaharui informasi staf
        $staffData = [
            'nomor_telepon' => $validatedData['nomor_telepon'] ?? null,
            'jabatan' => $validatedData['jabatan'] ?? 'Administrator',
        ];
        
        if (isset($validatedData['foto'])) {
            $staffData['foto'] = $validatedData['foto'];
        }

        // Gunakan updateOrCreate untuk memastikan data staf ada
        $user->staff()->updateOrCreate(
            ['user_id' => $user->id],
            $staffData
        );

        return Redirect::route('admin.profile.edit')->with('status', 'profile-updated');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class AdminPeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::withCount('gelombangs')->orderBy('created_at', 'desc')->get();

        // Calculate stats
        $totalPeriode = $periodes->count();
        $sedangAktif = $periodes->where('is_active', true)->count();
        
        return view('admin.periode.index', compact('periodes', 'totalPeriode', 'sedangAktif'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:100',
            'tahun_ajaran' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        // If this one is active, maybe deactivate others? 
        // For now let's just create it.
        Periode::create($validated);

        return redirect()->back()->with('success', 'Periode PPDB berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $periode = Periode::findOrFail($id);
        
        $validated = $request->validate([
            'nama_periode' => 'required|string|max:100',
            'tahun_ajaran' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $periode->update($validated);

        return redirect()->back()->with('success', 'Periode PPDB berhasil diperbarui');
    }

    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        
        // Prevent delete if has gelombangs? Or cascade?
        if ($periode->gelombangs()->count() > 0) {
            return redirect()->back()->with('error', 'Periode tidak dapat dihapus karena memiliki data gelombang');
        }

        $periode->delete();

        return redirect()->back()->with('success', 'Periode PPDB berhasil dihapus');
    }

    public function toggleStatus($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->is_active = !$periode->is_active;
        $periode->save();

        return redirect()->back()->with('success', 'Status periode berhasil diubah');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PeriodePPDB;
use Illuminate\Http\Request;

class AdminGelombangController extends Controller
{
    public function index()
    {
        $gelombang = PeriodePPDB::withCount('pendaftarans')->orderBy('created_at', 'asc')->get();

        // Calculate stats
        $totalGelombang = $gelombang->count();
        // Active logic: check if today is within range OR is_active flag is true.
        // Let's use the explicit is_active flag as secondary check or primary?
        // Reference says "Gelombang 2 Aktif" badge.
        // Let's assume is_active is the database flag for "soft" active, but "real" active depends on date too?
        // Actually, let's just use the boolean flag for the "Aktif" count for now, or check date.
        // Reference HTML card logic:
        // Card 2 is "Aktif" and has dates Mar-Apr.
        // If we want to strictly follow the "Aktif" count box:
        $sedangAktif = $gelombang->filter(function ($g) {
            return $g->is_active && $g->isBerlaku();
        })->count();

        $totalKuota = $gelombang->sum('kuota');
        $totalPendaftar = $gelombang->sum('pendaftarans_count');
        $sisaKuota = $totalKuota - $totalPendaftar;

        return view('admin.gelombang.index', compact('gelombang', 'totalGelombang', 'sedangAktif', 'totalKuota', 'sisaKuota'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tahun_ajaran' => 'required|string',
            'kuota' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean', // checkbox usually sends '1' or nothing
        ]);

        $validated['is_active'] = $request->has('is_active');

        PeriodePPDB::create($validated);

        return redirect()->back()->with('success', 'Gelombang berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $periode = PeriodePPDB::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tahun_ajaran' => 'required|string',
            'kuota' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $periode->update($validated);

        return redirect()->back()->with('success', 'Gelombang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $periode = PeriodePPDB::findOrFail($id);
        $periode->delete(); // Soft delete allowed? No soft delete trait in model. So permanent.

        return redirect()->back()->with('success', 'Gelombang berhasil dihapus');
    }
}

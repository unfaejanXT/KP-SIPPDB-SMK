<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Gelombang;
use App\Models\Periode;
use Illuminate\Http\Request;

class AdminGelombangController extends Controller
{
    public function index()
    {
        $gelombang = Gelombang::with(['periode'])->withCount('pendaftarans')->orderBy('created_at', 'asc')->get();
        $periodes = Periode::where('is_active', true)->get();

        // Calculate stats
        $totalGelombang = $gelombang->count();
        $sedangAktif = $gelombang->filter(function ($g) {
            return $g->is_active && $g->isBerlaku();
        })->count();

        $totalKuota = $gelombang->sum('kuota');
        $totalPendaftar = $gelombang->sum('pendaftarans_count');
        $sisaKuota = $totalKuota - $totalPendaftar;

        return view('admin.gelombang.index', compact('gelombang', 'periodes', 'totalGelombang', 'sedangAktif', 'totalKuota', 'sisaKuota'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'periode_id' => 'required|exists:periodes,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tahun_ajaran' => 'required|string',
            'kuota' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Gelombang::create($validated);

        return redirect()->back()->with('success', 'Gelombang berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $gelombang = Gelombang::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'periode_id' => 'required|exists:periodes,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tahun_ajaran' => 'required|string',
            'kuota' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $gelombang->update($validated);

        return redirect()->back()->with('success', 'Gelombang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $gelombang = Gelombang::findOrFail($id);
        $gelombang->delete();

        return redirect()->back()->with('success', 'Gelombang berhasil dihapus');
    }
}

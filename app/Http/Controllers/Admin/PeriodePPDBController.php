<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodePPDB;
use Illuminate\Http\Request;

class PeriodePPDBController extends Controller
{
    public function index()
    {
        // Mengambil semua periode dengan menghitung jumlah pendaftar
        $periodeppdb = PeriodePPDB::withCount('pendaftarans')->get();

        return view('adminpanel.periodeppdb.index', compact('periodeppdb'));
    }

    public function create()
    {
        return view('adminpanel.periodeppdb.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(PeriodePPDB::rules());
        PeriodePPDB::create($validated);
        $notification = [
            'message' => 'Data jurusan berhasil ditambahkan',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.periodeppdb')->with($notification);
    }

    public function edit(string $id)
    {
        $periodeppdb = PeriodePPDB::find($id);
        return view('adminpanel.periodeppdb.edit', compact('periodeppdb'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate(PeriodePPDB::rules());

        PeriodePPDB::where('id', $id)->update($validated);


        $notification = array(
            'message' => 'Data berhasil diperbaharui',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.periodeppdb')->with($notification);
    }

    public function destroy(string $id)
    {
        $periode = PeriodePPDB::findOrFail($id);
        $periode->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.periodeppdb')->with($notification);
    }
}

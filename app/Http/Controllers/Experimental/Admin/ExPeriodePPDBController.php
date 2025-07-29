<?php

namespace App\Http\Controllers\Experimental\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeriodePPDB;
use Illuminate\Http\Request;

class ExPeriodePPDBController extends Controller
{
      //PERIODEPPDB CONTROLLER CRUD
      public function index()
      {
          $periodeppdb = PeriodePPDB::all();
  
          return view('experimental.admin.periodeppdb.index', compact('periodeppdb'));
      }
  
      public function create()
      {
          return view('experimental.admin.periodeppdb.create');
      }
  
      public function store(Request $request)
      {
          $validated = $request->validate(PeriodePPDB::rules());
          PeriodePPDB::create($validated);
          $notification = [
              'message' => 'Data jurusan berhasil ditambahkan',
              'alert-type' => 'success',
          ];
          return redirect()->route('experimental.gelombangppdb')->with($notification);
      }
  
      public function edit(string $id)
      {
          $periodeppdb = PeriodePPDB::find($id);
          return view('experimental.admin.periodeppdb.edit', compact('periodeppdb'));
      }
  
      public function update(Request $request,string $id)
      {
          $validated = $request->validate(PeriodePPDB::rules());
  
          PeriodePPDB::where('id', $id)->update($validated);
  
          
          $notification = array(
              'message' => 'Data berhasil diperbaharui',
              'alert-type' => 'success'
          );
  
          return redirect()->route('experimental.gelombangppdb')->with($notification);
      }
  
      public function destroy(string $id)
      {
          $periode = PeriodePPDB::findOrFail($id);
          $periode->delete();
  
          $notification = array(
              'message' => 'Data berhasil dihapus',
              'alert-type' => 'success'
          );
  
          return redirect()->route('experimental.gelombangppdb')->with($notification);
      }
}

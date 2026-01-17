<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan['jurusan'] = Jurusan::all();
        return view("admin.jurusan.index", $jurusan);
    }

    public function getJurusan(){
        $jurusan = Jurusan::query();
       
      
    }

    public function create()
    {
        return view("admin.jurusan.create");
    }

    public function store(Request $request)
    {

        $validated = $request->validate(Jurusan::rules());
        Jurusan::create($validated);
        $notification = [
            'message' => 'Data jurusan berhasil ditambahkan',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.jurusan')->with($notification);
    }

    public function edit(string $id)
    {
        $data['jurusan'] = Jurusan::find($id);
        return view("admin.jurusan.edit", $data);
    }

    public function update(string $id, Request $request)
    {
        $validated = $request->validate(Jurusan::rules());
        Jurusan::where('id', $id)->update($validated);

        $notification = array(
            'message' => 'Data berhasil diperbaharui',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.jurusan')->with($notification);
    }

    public function destroy(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        $notification = array(
            'message' => 'Data berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.jurusan')->with($notification);
    }
}

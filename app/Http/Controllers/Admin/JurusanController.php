<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $title = "Data jurusan";
        $jurusans = Jurusan::all();

        return view('admin.jurusan.index', compact(
            'title',
            'jurusans'
        ));
    }


    public function create()
    {
        // $jurusan = Jurusan::find($id);
        $view = view('admin.jurusan.create')->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|string|regex:/^[a-zA-Z_]+$/u|unique:jurusans',

        ]);

        try {
            Jurusan::create([
                'nama' => $request->nama,
                'kode' => $request->kode,

            ]);

            return redirect()->route('admin.jurusan.index')->with(['msg' => 'Berhasil Menambah Data', 'class' => 'success']);
        } catch (\Exception $e) {
            return back()
                ->withErrors(['msg' => 'Gagal Menambah Data: ' . $e->getMessage()]);
        }
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $jurusan = Jurusan::find($id);
        $view = view('admin.jurusan.edit', compact('jurusan'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }


    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::find($id);
        $request->validate([
            'nama' => 'required',

        ]);

        try {
            $jurusan->update([
                'nama' => $request->nama,

            ]);

            return redirect()->route('admin.jurusan.index')->with(['msg' => 'Berhasil mengubah Data', 'class' => 'success']);
        } catch (\Exception $e) {
            return back()
                ->withErrors(['msg' => 'Gagal mengubah Data: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        Jurusan::where("id", $id)->delete();
        return back()->with(['msg' => 'Berhasil Menghapus Jurusan', 'class' => 'success']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Penetapan;
use Illuminate\Http\Request;

class PenetapanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Penetapan';
        $dataPenetapan = Penetapan::all();

        return view('admin.penetapan.index', compact(
            'title',
            'dataPenetapan',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $title = 'Tambah Penetapan';
        $kategori = Kategori::all();
        return view('admin.penetapan.create', compact(
            'title',
            'kategori',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_standar'  => 'required|unique:penetapans',
            'tgl_penetapan'  => 'required',
            'kategori_id'  => 'required',
            'file_standar'  => 'required|file|mimes:pdf',
        ]);


        if ($request->hasFile('file_standar')) {
            $file_standar = date('His') . "." . $request->file('file_standar')->getClientOriginalExtension();
        } else {
            $file_standar = null;
        }

        try {
            $data = [
                'nama_standar' => $request->nama_standar,
                'tgl_penetapan' => $request->tgl_penetapan,
                'kategori_id' => $request->kategori_id,
                'user_id' => auth()->user()->id,
                'file_standar' => $file_standar,
            ];
            $simpan = Penetapan::create($data);
            // dd($simpan);
            if ($simpan) {
                if ($request->hasFile('file_standar')) {
                    $folderPath = 'public/uploads/penetapan/';
                    $request->file('file_standar')->storeAs($folderPath, $file_standar);
                }
                return redirect()->route('admin.penetapan.index')->with(['success' => 'Data berhasil disimpan!']);
            }
        } catch (\Throwable $e) {
            //throw $e;
            dd($e->getMessage());
            return Redirect::back()->with(['warning' => 'Data gagal disimpan!' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

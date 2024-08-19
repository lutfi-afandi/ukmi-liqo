<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $progja = Laporan::findOrFail($id);
        $title = "Program Kerja " . $progja->user->name;
        // dd($progja->user->name);

        return view('admin.laporan.progja.index', compact(
            'title',
            'progja',
        ));
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'konf_progja'   => 'required'
        ];

        // $data = new Laporan();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah status Progja', 'class' => 'alert-danger']);
        }

        $data = Laporan::findOrFail($id);
        if ($request->ket_progja) {
            $data->ket_progja = $request->ket_progja;
        }
        $data->konf_progja = $request->konf_progja;
        $data->tgl_konf_progja = date('Y-m-d H:i:s');
        $data->save();

        return back()->with(['msgs' => 'Berhasil mengubah status Progja', 'class' => 'alert-success']);
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

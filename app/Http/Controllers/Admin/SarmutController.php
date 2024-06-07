<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SarmutController extends Controller
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
        $sarmut = Laporan::findOrFail($id);
        $title = "Sasaran Mutu " . $sarmut->user->name;
        // dd($sarmut->user->name);

        return view('admin.laporan.sarmut.index', compact(
            'title',
            'sarmut',
        ));
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
        $rules = [
            'konf_sarmut'   => 'required'
        ];

        $data = new Laporan();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah status Sasaran Mutu', 'class' => 'alert-danger']);
        }

        $data = Laporan::findOrFail($id);
        if ($request->ket_sarmut) {
            $data->ket_sarmut = $request->ket_sarmut;
        }
        $data->konf_sarmut = $request->konf_sarmut;
        $data->tgl_konf_sarmut = date('Y-m-d H:i:s');
        $data->save();

        return back()->with(['msgs' => 'Berhasil mengubah status Sasaran Mutu', 'class' => 'alert-success']);
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

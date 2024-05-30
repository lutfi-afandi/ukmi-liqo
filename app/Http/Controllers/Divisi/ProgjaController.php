<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $title = "Program Kerja";
        $user = User::find(Auth::user()->id);
        $periode = Periode::where('status', 1)->first();
        $periode_id = $periode->id;
        $periode_aktif = $periode->tahun;

        $laporan = Laporan::getLaporan($user->id, $periode_id);
        // dd($laporan->name);
        return view('divisi.laporan.progja.index', compact(
            'title',
            'laporan',
            'user',
            'periode'
        ));
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
        // dd($request);
        $name = Auth::user()->name;
        $progja = $request->file('progja');

        $rules = [
            'progja'   => 'required'
        ];

        $data = new Laporan();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah Progja', 'class' => 'alert-danger']);
        }
        $data->user_id = $request->user_id;
        $data->periode_id = $request->periode_id;
        $data->konf_progja = 'belum';
        $data->progja = "Progja_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $progja->getClientOriginalExtension();
        $request->file('progja')->storeAs('public/uploads/progja', $data->progja);


        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengunnggah Progja', 'class' => 'alert-success']);
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Laporan";
        $user = User::where('level', 'divisi')->get();
        $periode = Periode::all();
        // $periode_aktif = $periode->id;
        $laporans = Laporan::withAll();
        // dd($periode);
        return view('admin.laporan.index', compact(
            'title',
            'user',
            'laporans',
            'periode',
            // 'periode_aktif'
        ));
    }

    public function tampil(Request $request)
    {
        $title = "Laporan";
        $periode_aktif = $request->periode_id;
        $user = User::where('level', 'divisi')->get();
        $periode = Periode::where('id', $periode_aktif)->first();

        $laporans = Laporan::all();
        // dd($laporans->where('user_id', 4)
        //     ->where('periode_id', $periode_aktif)
        //     ->first()->triwulan1->first());

        $view =  view('admin.laporan.table', compact(
            'title',
            'user',
            'periode',
            'periode_aktif',
            'laporans'
        ))->render();

        return response()->json([
            'success' => true,
            'periode'   => $periode->tahun,
            'html' => $view
        ]);
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

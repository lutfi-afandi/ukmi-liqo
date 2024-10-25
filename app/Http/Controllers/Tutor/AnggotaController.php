<?php

namespace App\Http\Controllers\tutor;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\AnggotaKelompok;
use App\Models\Kelompok;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{

    public function show($id)
    {
        $title = "Data Kelompok";
        $kelompok = Kelompok::find($id);
        $anggotas = AnggotaKelompok::with('anggota')
            ->where('kelompok_id', $id)
            ->get();

        return view('tutor.anggota.index', compact(
            'title',
            'kelompok',
            'anggotas'
        ));
    }
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

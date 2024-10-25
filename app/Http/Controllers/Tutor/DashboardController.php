<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\Pertemuan;
use App\Models\Tutor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Dashboard Tutor";
        $user = auth()->user();

        $tutor = Tutor::where('username', $user->username)->first();

        $kelompoks = Kelompok::where('tutor_id', $tutor->id)->get();
        $pertemuans = Pertemuan::with('pesertapertemuan.anggota')
            ->whereHas('kelompok', function ($query) use ($tutor) {
                $query->where('tutor_id', $tutor->id);
            })->orderBy('tgl', 'desc')
            ->get();


        // foreach ($pertemuans as $p) {
        //     echo $p . ", ";
        // }
        return view('tutor.dashboard.index', compact(
            'title',
            'tutor',
            'kelompoks',
            'pertemuans',
            // 'user'
        ));
    }


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

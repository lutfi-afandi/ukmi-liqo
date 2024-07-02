<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function index(Request $request)
    {
        $periode = Periode::orderBy('tahun', 'desc')->get();
        $divisis = User::where('level', 'divisi')->get();

        if (isset($request->user_id) && isset($request->periode_id)) {
            $user_id = $request->user_id;
            $pemilik = User::where('id', $user_id)->first();
            $periode_id = $request->periode_id;
            // dd($pemilik->name);
            $laporan = Laporan::getAll($user_id, $periode_id);
        } else {
            $user_id = false;
            $periode_id = false;
            $laporan = null;
            $pemilik = null;
        }
        // dd($laporan->triwulan1->first()->konf, $laporan->id);
        return view('admin.upload.index', compact(
            'periode',
            'divisis',
            'user_id',
            'periode_id',
            'laporan',
            'pemilik'
        ));
    }


    public function search(Request $request)
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

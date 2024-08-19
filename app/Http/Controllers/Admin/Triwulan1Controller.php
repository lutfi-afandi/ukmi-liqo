<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Triwulan1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Triwulan1Controller extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $triwulan1 = Triwulan1::with('laporan.user')->findOrFail($id);
        $user = $triwulan1->laporan->user;
        $title = "Laporan Triwulan 1 " . $user->name;

        return view('admin.laporan.triwulan1.index', compact(
            'title',
            'user',
            'triwulan1',
        ));
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'konf'   => 'required'
        ];

        // $data = new Triwulan1();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah status Laporan Triwulan 1', 'class' => 'alert-danger']);
        }

        $data = Triwulan1::findOrFail($id);
        if ($request->ket) {
            $data->ket = $request->ket;
        }
        $data->konf = $request->konf;
        if ($request->konf == 'diterima') {
            $data->tgl_konf = date('Y-m-d H:i:s');
        }
        $data->save();

        return back()->with(['msgs' => 'Berhasil mengubah status Laporan Triwulan 1', 'class' => 'alert-success']);
    }


    public function destroy($id)
    {
        //
    }
}

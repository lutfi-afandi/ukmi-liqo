<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Triwulan2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Triwulan2Controller extends Controller
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
        $triwulan2 = Triwulan2::with('laporan.user')->findOrFail($id);
        $user = $triwulan2->laporan->user;
        $title = "Laporan Triwulan 2 " . $user->name;

        return view('admin.laporan.triwulan2.index', compact(
            'title',
            'user',
            'triwulan2',
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

        $data = new Triwulan2();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah status Laporan Triwulan 2', 'class' => 'alert-danger']);
        }

        $data = Triwulan2::findOrFail($id);
        if ($request->ket) {
            $data->ket = $request->ket;
        }
        $data->konf = $request->konf;
        if ($request->konf == 'diterima') {
            $data->tgl_konf = date('Y-m-d H:i:s');
        }
        $data->save();

        return back()->with(['msgs' => 'Berhasil mengubah status Laporan Triwulan 2', 'class' => 'alert-success']);
    }


    public function destroy($id)
    {
        //
    }
}

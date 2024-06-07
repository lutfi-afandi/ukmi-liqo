<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Periode;
use App\Models\RiwayatTriwulan3;
use App\Models\Triwulan3;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Triwulan3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Laporan Triwulan 3";
        $user = User::find(Auth::user()->id);
        $periode = Periode::where('status', 1)->first();
        $periode_id = $periode->id;
        $periode_aktif = $periode->tahun;

        $laporan = Laporan::getAll($user->id, $periode_id);
        // $laporan = Laporan::where(['user_id' => $user->id, 'periode_id' => $periode_id])->first();
        $triwulan3 = $laporan->triwulan3->first();
        // dd($triwulan3);
        return view('divisi.laporan.triwulan3.index', compact(
            'title',
            'laporan',
            'user',
            'periode',
            'triwulan3'
        ));
    }

    public function riwayat($id)
    {
        $riwayats = RiwayatTriwulan3::where('triwulan3_id', $id)->orderBy('tgl_upload', 'desc')->get();

        $view =  view('divisi.laporan.triwulan3.riwayat', compact(
            'riwayats'
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function create()
    {
    }


    public function store(Request $request)
    {
        $file_tw3 = $request->file('file_tw3');

        $rules = [
            'file_tw3'   => 'required'
        ];

        $data = new Triwulan3();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah Laporan Triwulan 3', 'class' => 'alert-danger']);
        }
        $data->laporan_id = $request->laporan_id;
        $data->konf = 'belum';
        $data->tgl_upload = date('Y-m-d H:i:s');
        $data->file_tw3 = "Laporan Triwulan 3_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $file_tw3->getClientOriginalExtension();
        $request->file('file_tw3')->storeAs('public/uploads/file_tw3', $data->file_tw3);


        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengunggah Laporan Triwulan 3', 'class' => 'alert-success']);
    }

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
        $file_tw3 = $request->file('file_tw3');

        $rules = [
            'file_tw3'   => 'required'
        ];

        $data = Triwulan3::findOrFail($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Laporan Triwulan 3', 'class' => 'alert-danger']);
        }

        // Path file lama
        $oldFilePath = 'public/uploads/file_tw3/' . $data->file_tw3;

        // Hapus file lama jika ada
        if (Storage::exists($oldFilePath)) {
            Storage::delete($oldFilePath);
        }

        // Simpan file baru
        $newFileName = "Laporan Triwulan 3_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $file_tw3->getClientOriginalExtension();
        $newFilePath = $file_tw3->storeAs('public/uploads/file_tw3', $newFileName);

        // Update data
        $data->konf = 'belum';
        $data->tgl_upload = now(); // Menggunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
        $data->file_tw3 = $newFileName;

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengubah Laporan Triwulan 3', 'class' => 'alert-success']);
    }

    public function reupload(Request $request, $id)
    {
        // dd();

        $file_tw3 = $request->file('file_tw3');

        $rules = [
            'file_tw3'   => 'required'
        ];

        $dataTriwulan3 = Triwulan3::findOrFail($id);
        $dataRiwayat = new RiwayatTriwulan3();

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Sasaran Mutu', 'class' => 'alert-danger']);
        }

        $dataRiwayat->triwulan3_id = $id;
        $dataRiwayat->file_tw3 = $dataTriwulan3->file_tw3;
        $dataRiwayat->ket = $dataTriwulan3->ket;
        $dataRiwayat->tgl_upload = $dataTriwulan3->tgl_upload;
        $dataRiwayat->save();

        // Simpan file baru
        $newFileName = "Triwulan3 revisi_usr_" . $dataTriwulan3->user_id . "_prd_" . $dataTriwulan3->periode_id . "-" . date('His') . "." . $file_tw3->getClientOriginalExtension();
        $newFilePath = $file_tw3->storeAs('public/uploads/file_tw3', $newFileName);

        $dataTriwulan3->file_tw3 = $newFileName;
        $dataTriwulan3->konf = 'belum';
        $dataTriwulan3->ket = null;
        $dataTriwulan3->tgl_upload = now();
        $dataTriwulan3->tgl_konf = null;

        $dataTriwulan3->save();

        return back()->with(['msgs' => 'Berhasil Mengubah Laporan Triwulan 3', 'class' => 'alert-success']);
    }

    public function destroy($id)
    {
        //
    }
}

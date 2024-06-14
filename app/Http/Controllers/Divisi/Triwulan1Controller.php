<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Periode;
use App\Models\RiwayatTriwulan1;
use App\Models\Triwulan1;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Triwulan1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Laporan Triwulan 1";
        $user = User::find(Auth::user()->id);
        $periode = Periode::where('status', 1)->first();
        $periode_id = $periode->id;
        $periode_aktif = $periode->tahun;

        $laporan = Laporan::getAll($user->id, $periode_id);
        // $laporan = Laporan::where(['user_id' => $user->id, 'periode_id' => $periode_id])->first();
        $triwulan1 = $laporan->triwulan1->first();
        // dd($triwulan1->id);
        return view('divisi.laporan.triwulan1.index', compact(
            'title',
            'laporan',
            'user',
            'periode',
            'triwulan1'
        ));
    }

    public function riwayat($id)
    {
        $riwayats = RiwayatTriwulan1::where('triwulan1_id', $id)->orderBy('tgl_upload', 'desc')->get();

        $view =  view('divisi.laporan.triwulan1.riwayat', compact(
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
        $file_tw1 = $request->file('file_tw1');

        $rules = [
            'file_tw1'   => 'required'
        ];

        $data = new Triwulan1();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah Laporan Triwulan 1', 'class' => 'alert-danger']);
        }
        $data->laporan_id = $request->laporan_id;
        $data->konf = 'belum';
        $data->tgl_upload = date('Y-m-d H:i:s');
        $data->file_tw1 = "TW1_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $file_tw1->getClientOriginalExtension();
        $request->file('file_tw1')->storeAs('public/uploads/file_tw1', $data->file_tw1);


        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengunggah Laporan Triwulan 1', 'class' => 'alert-success']);
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
        $file_tw1 = $request->file('file_tw1');

        $rules = [
            'file_tw1'   => 'required'
        ];

        $data = Triwulan1::findOrFail($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Laporan Triwulan 1', 'class' => 'alert-danger']);
        }

        // Path file lama
        $oldFilePath = 'public/uploads/file_tw1/' . $data->file_tw1;

        // Hapus file lama jika ada
        if (Storage::exists($oldFilePath)) {
            Storage::delete($oldFilePath);
        }

        // Simpan file baru
        $newFileName = "Laporan Triwulan 1 revised_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $file_tw1->getClientOriginalExtension();
        $newFilePath = $file_tw1->storeAs('public/uploads/file_tw1', $newFileName);

        // Update data
        $data->konf = 'belum';
        $data->tgl_upload = now(); // Menggunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
        $data->file_tw1 = $newFileName;

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengubah Laporan Triwulan 1', 'class' => 'alert-success']);
    }

    public function reupload(Request $request, $id)
    {
        // dd();

        $file_tw1 = $request->file('file_tw1');

        $rules = [
            'file_tw1'   => 'required'
        ];

        $dataTriwulan1 = Triwulan1::findOrFail($id);
        $dataRiwayat = new RiwayatTriwulan1();

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Sasaran Mutu', 'class' => 'alert-danger']);
        }

        $dataRiwayat->triwulan1_id = $id;
        $dataRiwayat->file_tw1 = $dataTriwulan1->file_tw1;
        $dataRiwayat->ket = $dataTriwulan1->ket;
        $dataRiwayat->tgl_upload = $dataTriwulan1->tgl_upload;
        $dataRiwayat->save();

        // Simpan file baru
        $newFileName = "Triwulan1 revisi_usr_" . $dataTriwulan1->user_id . "_prd_" . $dataTriwulan1->periode_id . "-" . date('His') . "." . $file_tw1->getClientOriginalExtension();
        $newFilePath = $file_tw1->storeAs('public/uploads/file_tw1', $newFileName);

        $dataTriwulan1->file_tw1 = $newFileName;
        $dataTriwulan1->konf = 'belum';
        $dataTriwulan1->ket = null;
        $dataTriwulan1->tgl_upload = now();
        $dataTriwulan1->tgl_konf = null;

        $dataTriwulan1->save();

        return back()->with(['msgs' => 'Berhasil Mengubah Laporan Triwulan 1', 'class' => 'alert-success']);
    }

    public function destroy($id)
    {
        //
    }
}

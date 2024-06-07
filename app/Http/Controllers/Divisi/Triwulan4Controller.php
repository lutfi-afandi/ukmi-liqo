<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Periode;
use App\Models\RiwayatTriwulan4;
use App\Models\Triwulan4;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Triwulan4Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Laporan Triwulan 4";
        $user = User::find(Auth::user()->id);
        $periode = Periode::where('status', 1)->first();
        $periode_id = $periode->id;
        $periode_aktif = $periode->tahun;

        $laporan = Laporan::getAll($user->id, $periode_id);
        // $laporan = Laporan::where(['user_id' => $user->id, 'periode_id' => $periode_id])->first();
        $triwulan4 = $laporan->triwulan4->first();
        // dd($triwulan4->id);
        return view('divisi.laporan.triwulan4.index', compact(
            'title',
            'laporan',
            'user',
            'periode',
            'triwulan4'
        ));
    }

    public function riwayat($id)
    {
        $riwayats = RiwayatTriwulan4::where('triwulan4_id', $id)->orderBy('tgl_upload', 'desc')->get();

        $view =  view('divisi.laporan.triwulan4.riwayat', compact(
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
        $file_tw4 = $request->file('file_tw4');

        $rules = [
            'file_tw4'   => 'required'
        ];

        $data = new Triwulan4();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah Laporan Triwulan 4', 'class' => 'alert-danger']);
        }
        $data->laporan_id = $request->laporan_id;
        $data->konf = 'belum';
        $data->tgl_upload = date('Y-m-d H:i:s');
        $data->file_tw4 = "Laporan Triwulan 4_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $file_tw4->getClientOriginalExtension();
        $request->file('file_tw4')->storeAs('public/uploads/file_tw4', $data->file_tw4);


        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengunggah Laporan Triwulan 4', 'class' => 'alert-success']);
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
        $file_tw4 = $request->file('file_tw4');

        $rules = [
            'file_tw4'   => 'required'
        ];

        $data = Triwulan4::findOrFail($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Laporan Triwulan 4', 'class' => 'alert-danger']);
        }

        // Path file lama
        $oldFilePath = 'public/uploads/file_tw4/' . $data->file_tw4;

        // Hapus file lama jika ada
        if (Storage::exists($oldFilePath)) {
            Storage::delete($oldFilePath);
        }

        // Simpan file baru
        $newFileName = "Laporan Triwulan 4_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $file_tw4->getClientOriginalExtension();
        $newFilePath = $file_tw4->storeAs('public/uploads/file_tw4', $newFileName);

        // Update data
        $data->konf = 'belum';
        $data->tgl_upload = now(); // Menggunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
        $data->file_tw4 = $newFileName;

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengubah Laporan Triwulan 4', 'class' => 'alert-success']);
    }

    public function reupload(Request $request, $id)
    {
        // dd();

        $file_tw4 = $request->file('file_tw4');

        $rules = [
            'file_tw4'   => 'required'
        ];

        $dataTriwulan4 = Triwulan4::findOrFail($id);
        $dataRiwayat = new RiwayatTriwulan4();

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Sasaran Mutu', 'class' => 'alert-danger']);
        }

        $dataRiwayat->triwulan4_id = $id;
        $dataRiwayat->file_tw4 = $dataTriwulan4->file_tw4;
        $dataRiwayat->ket = $dataTriwulan4->ket;
        $dataRiwayat->tgl_upload = $dataTriwulan4->tgl_upload;
        $dataRiwayat->save();

        // Simpan file baru
        $newFileName = "Triwulan4 revisi_usr_" . $dataTriwulan4->user_id . "_prd_" . $dataTriwulan4->periode_id . "-" . date('His') . "." . $file_tw4->getClientOriginalExtension();
        $newFilePath = $file_tw4->storeAs('public/uploads/file_tw4', $newFileName);

        $dataTriwulan4->file_tw4 = $newFileName;
        $dataTriwulan4->konf = 'belum';
        $dataTriwulan4->ket = null;
        $dataTriwulan4->tgl_upload = now();
        $dataTriwulan4->tgl_konf = null;

        $dataTriwulan4->save();

        return back()->with(['msgs' => 'Berhasil Mengubah Laporan Triwulan 4', 'class' => 'alert-success']);
    }

    public function destroy($id)
    {
        //
    }
}

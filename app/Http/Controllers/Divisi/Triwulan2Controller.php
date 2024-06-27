<?php

namespace App\Http\Controllers\Divisi;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Periode;
use App\Models\RiwayatTriwulan2;
use App\Models\Triwulan2;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Triwulan2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $syarat = (new Helper())->syarat();
        if (empty($syarat['tw1'])) {
            return redirect()->route('divisi.dashboard.index');
        }
        
        $title = "Laporan Triwulan 2";
        $user = User::find(Auth::user()->id);
        $periode = Periode::where('status', 1)->first();
        $periode_id = $periode->id;
        $periode_aktif = $periode->tahun;

        $laporan = Laporan::getAll($user->id, $periode_id);
        // $laporan = Laporan::where(['user_id' => $user->id, 'periode_id' => $periode_id])->first();
        $triwulan2 = $laporan->triwulan2->first();
        // dd($triwulan2->id);
        return view('divisi.laporan.triwulan2.index', compact(
            'title',
            'laporan',
            'user',
            'periode',
            'triwulan2'
        ));
    }

    public function riwayat($id)
    {
        $riwayats = RiwayatTriwulan2::where('triwulan2_id', $id)->orderBy('tgl_upload', 'desc')->get();

        $view =  view('divisi.laporan.triwulan2.riwayat', compact(
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
        $file_tw2 = $request->file('file_tw2');

        $rules = [
            'file_tw2'   => 'required'
        ];

        $data = new Triwulan2();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah Laporan Triwulan 2', 'class' => 'alert-danger']);
        }
        $data->laporan_id = $request->laporan_id;
        $data->konf = 'belum';
        $data->tgl_upload = date('Y-m-d H:i:s');
        $data->file_tw2 = "Laporan Triwulan 2_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $file_tw2->getClientOriginalExtension();
        $request->file('file_tw2')->storeAs('public/uploads/file_tw2', $data->file_tw2);


        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengunggah Laporan Triwulan 2', 'class' => 'alert-success']);
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
        $file_tw2 = $request->file('file_tw2');

        $rules = [
            'file_tw2'   => 'required'
        ];

        $data = Triwulan2::findOrFail($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Laporan Triwulan 2', 'class' => 'alert-danger']);
        }

        // Path file lama
        $oldFilePath = 'public/uploads/file_tw2/' . $data->file_tw2;

        // Hapus file lama jika ada
        if (Storage::exists($oldFilePath)) {
            Storage::delete($oldFilePath);
        }

        // Simpan file baru
        $newFileName = "Laporan Triwulan 2_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $file_tw2->getClientOriginalExtension();
        $newFilePath = $file_tw2->storeAs('public/uploads/file_tw2', $newFileName);

        // Update data
        $data->konf = 'belum';
        $data->tgl_upload = now(); // Menggunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
        $data->file_tw2 = $newFileName;

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengubah Laporan Triwulan 2', 'class' => 'alert-success']);
    }

    public function reupload(Request $request, $id)
    {
        // dd();

        $file_tw2 = $request->file('file_tw2');

        $rules = [
            'file_tw2'   => 'required'
        ];

        $dataTriwulan2 = Triwulan2::findOrFail($id);
        $dataRiwayat = new RiwayatTriwulan2();

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Sasaran Mutu', 'class' => 'alert-danger']);
        }

        $dataRiwayat->triwulan2_id = $id;
        $dataRiwayat->file_tw2 = $dataTriwulan2->file_tw2;
        $dataRiwayat->ket = $dataTriwulan2->ket;
        $dataRiwayat->tgl_upload = $dataTriwulan2->tgl_upload;
        $dataRiwayat->save();

        // Simpan file baru
        $newFileName = "Triwulan2 revisi_usr_" . $dataTriwulan2->user_id . "_prd_" . $dataTriwulan2->periode_id . "-" . date('His') . "." . $file_tw2->getClientOriginalExtension();
        $newFilePath = $file_tw2->storeAs('public/uploads/file_tw2', $newFileName);

        $dataTriwulan2->file_tw2 = $newFileName;
        $dataTriwulan2->konf = 'belum';
        $dataTriwulan2->ket = null;
        $dataTriwulan2->tgl_upload = now();
        $dataTriwulan2->tgl_konf = null;

        $dataTriwulan2->save();

        return back()->with(['msgs' => 'Berhasil Mengubah Laporan Triwulan 2', 'class' => 'alert-success']);
    }

    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Divisi;

use App\Helpers\Helper;
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
    private function gdriveConvertToPreviewUrl($url)
    {
        // Cek apakah URL adalah URL Google Drive yang valid
        if (preg_match('/https:\/\/drive\.google\.com\/file\/d\/([^\/]+)\/view/', $url, $matches)) {
            $fileId = $matches[1];
            return "https://drive.google.com/file/d/{$fileId}/preview";
        }

        // Kembalikan URL asli jika tidak cocok
        return $url;
    }

    public function index()
    {
        $syarat = (new Helper())->syarat();
        // dd($syarat);
        if ($syarat['sarmut'] == null) {
            return redirect()->route('divisi.dashboard.index');
        }

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
        // dd($riwayats->count(), $id);
        $view =  view('divisi.laporan.triwulan1.riwayat', compact(
            'riwayats'
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }


    public function store(Request $request)
    {
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
        $data->file_tw1 = $this->gdriveConvertToPreviewUrl($request->file_tw1);


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
        $rules = [
            'file_tw1'   => 'required'
        ];

        $data = Triwulan1::where('laporan_id', $id)->firstOrFail();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Laporan Triwulan 1', 'class' => 'alert-danger']);
        }


        // Simpan file baru
        $newFileName = $this->gdriveConvertToPreviewUrl($request->file_tw1);
        // Update data
        $data->konf = 'belum';
        $data->tgl_upload = now(); // Menggunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
        $data->file_tw1 = $newFileName;

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengubah Laporan Triwulan 1', 'class' => 'alert-success']);
    }

    public function reupload(Request $request, $id)
    {
        $rules = [
            'file_tw1'   => 'required'
        ];

        $dataTriwulan1 = Triwulan1::where('laporan_id', $id)->firstOrFail();
        $dataRiwayat = new RiwayatTriwulan1();

        $validator = Validator::make($request->all(), $rules);
        // dd($validator->fails());

        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah laporan evaluasi', 'class' => 'alert-danger']);
        }

        $dataRiwayat->triwulan1_id = $dataTriwulan1->id;
        $dataRiwayat->file_tw1 = $dataTriwulan1->file_tw1;
        $dataRiwayat->ket = $dataTriwulan1->ket;
        $dataRiwayat->tgl_upload = $dataTriwulan1->tgl_upload;
        $dataRiwayat->save();

        // Simpan file baru
        // dd($dataRiwayat);
        $newFileName = $this->gdriveConvertToPreviewUrl($request->file_tw1);

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

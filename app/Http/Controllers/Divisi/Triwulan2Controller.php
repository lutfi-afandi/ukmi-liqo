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
        // dd($riwayats->count(), $id);
        $view =  view('divisi.laporan.triwulan2.riwayat', compact(
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
        $data->file_tw2 = $this->gdriveConvertToPreviewUrl($request->file_tw2);


        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengunggah Laporan Triwulan 2', 'class' => 'alert-success']);
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'file_tw2'   => 'required'
        ];

        $data = Triwulan2::where('laporan_id', $id)->firstOrFail();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Laporan Triwulan 2', 'class' => 'alert-danger']);
        }


        // Simpan file baru
        $newFileName = $this->gdriveConvertToPreviewUrl($request->file_tw2);
        // Update data
        $data->konf = 'belum';
        $data->tgl_upload = now(); // Menggunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
        $data->file_tw2 = $newFileName;

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengubah Laporan Triwulan 2', 'class' => 'alert-success']);
    }

    public function reupload(Request $request, $id)
    {
        $rules = [
            'file_tw2'   => 'required'
        ];

        $dataTriwulan2 = Triwulan2::where('laporan_id', $id)->firstOrFail();
        $dataRiwayat = new RiwayatTriwulan2();

        $validator = Validator::make($request->all(), $rules);
        // dd($validator->fails());

        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah laporan evaluasi', 'class' => 'alert-danger']);
        }

        $dataRiwayat->triwulan2_id = $dataTriwulan2->id;
        $dataRiwayat->file_tw2 = $dataTriwulan2->file_tw2;
        $dataRiwayat->ket = $dataTriwulan2->ket;
        $dataRiwayat->tgl_upload = $dataTriwulan2->tgl_upload;
        $dataRiwayat->save();

        // Simpan file baru
        // dd($dataRiwayat);
        $newFileName = $this->gdriveConvertToPreviewUrl($request->file_tw2);

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

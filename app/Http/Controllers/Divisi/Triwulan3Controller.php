<?php

namespace App\Http\Controllers\Divisi;

use App\Helpers\Helper;
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
        if (empty($syarat['tw2'])) {
            return redirect()->route('divisi.dashboard.index');
        }
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
        $data->file_tw3 =  $this->gdriveConvertToPreviewUrl($request->file_tw3);


        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengunggah Laporan Triwulan 3', 'class' => 'alert-success']);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'file_tw3'   => 'required'
        ];

        $data = Triwulan3::findOrFail($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Laporan Triwulan 3', 'class' => 'alert-danger']);
        }

        // Simpan file baru
        $newFileName =  $this->gdriveConvertToPreviewUrl($request->file_tw3);
        // Update data
        $data->konf = 'belum';
        $data->tgl_upload = now(); // Menggunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
        $data->file_tw3 = $newFileName;

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengubah Laporan Triwulan 3', 'class' => 'alert-success']);
    }

    public function reupload(Request $request, $id)
    {
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
        $newFileName =  $this->gdriveConvertToPreviewUrl($request->file_tw3);

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

<?php

namespace App\Http\Controllers\Divisi;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Periode;
use App\Models\RiwayatSarmut;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SarmutController extends Controller
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
        if (empty($syarat['progja'])) {
            return redirect()->route('divisi.dashboard.index');
        }

        $title = "Sasaran Mutu";
        $user = User::find(Auth::user()->id);
        $periode = Periode::where('status', 1)->first();
        $periode_id = $periode->id;
        $periode_aktif = $periode->tahun;


        $laporan = Laporan::getAll($user->id, $periode_id);
        // $laporan = Laporan::getLaporan($user->id, $periode_id);
        // dd($laporan);
        return view('divisi.laporan.sarmut.index', compact(
            'title',
            'laporan',
            'user',
            'periode'
        ));
    }

    public function riwayat($id)
    {
        $riwayats = RiwayatSarmut::where('laporan_id', $id)->orderBy('tgl_upload', 'desc')->get();

        $view =  view('divisi.laporan.sarmut.riwayat', compact(
            'riwayats'
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function create()
    {
        //
    }


    public function update(Request $request, $id)
    {

        $rules = [
            'sarmut'   => 'required'
        ];

        $data = Laporan::findOrFail($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah Sasaran Mutu', 'class' => 'alert-danger']);
        }

        $data->konf_sarmut = 'belum';
        $data->tgl_upload_sarmut = date('Y-m-d H:i:s');
        $data->sarmut = $this->gdriveConvertToPreviewUrl($request->sarmut);

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengunnggah Sasaran Mutu', 'class' => 'alert-success']);
    }

    public function update_sarmut(Request $request, $id)
    {
        $sarmut = $request->file('sarmut');

        $rules = [
            'sarmut'   => 'required'
        ];

        $data = Laporan::findOrFail($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Sasaran mutu', 'class' => 'alert-danger']);
        }

        // Update data
        $data->konf_sarmut = 'belum';
        $data->tgl_upload_sarmut = now(); // Menggunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
        $data->sarmut = $this->gdriveConvertToPreviewUrl($request->sarmut);

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengubah Sasaran mutu', 'class' => 'alert-success']);
    }

    public function reupload(Request $request, $id)
    {
        $rules = [
            'sarmut'   => 'required'
        ];

        $dataSarmut = Laporan::findOrFail($id);
        $dataRiwayat = new RiwayatSarmut();

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Sasaran Mutu', 'class' => 'alert-danger']);
        }

        $dataRiwayat->laporan_id = $id;
        $dataRiwayat->sarmut = $dataSarmut->sarmut;
        $dataRiwayat->ket = $dataSarmut->ket_sarmut;
        $dataRiwayat->tgl_upload = $dataSarmut->tgl_upload_sarmut;
        $dataRiwayat->save();


        $dataSarmut->sarmut = $this->gdriveConvertToPreviewUrl($request->sarmut);
        $dataSarmut->konf_sarmut = 'belum';
        $dataSarmut->ket_sarmut = null;
        $dataSarmut->tgl_upload_sarmut = now();
        $dataSarmut->tgl_konf_sarmut = null;

        $dataSarmut->save();

        return back()->with(['msgs' => 'Berhasil Mengubah Progja', 'class' => 'alert-success']);
    }


    public function destroy($id)
    {
        //
    }
}

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
        $sarmut = $request->file('sarmut');

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
        $data->sarmut = "Sasaran Mutu_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $sarmut->getClientOriginalExtension();
        $request->file('sarmut')->storeAs('public/uploads/sarmut', $data->sarmut);


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

        // Path file lama
        $oldFilePath = 'public/uploads/sarmut/' . $data->sarmut;

        // Hapus file lama jika ada
        if (Storage::exists($oldFilePath)) {
            Storage::delete($oldFilePath);
        }

        // Simpan file baru
        $newFileName = "Sasaran mutu_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $sarmut->getClientOriginalExtension();
        $newFilePath = $sarmut->storeAs('public/uploads/sarmut', $newFileName);

        // Update data
        $data->konf_sarmut = 'belum';
        $data->tgl_upload_sarmut = now(); // Menggunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
        $data->sarmut = $newFileName;

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengubah Sasaran mutu', 'class' => 'alert-success']);
    }

    public function reupload(Request $request, $id)
    {
        // dd();

        $sarmut = $request->file('sarmut');

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

        // Simpan file baru
        $newFileName = "Sarmut_usr_" . $dataSarmut->user_id . "_prd_" . $dataSarmut->periode_id . "-" . date('His') . "." . $sarmut->getClientOriginalExtension();
        $newFilePath = $sarmut->storeAs('public/uploads/sarmut', $newFileName);

        $dataSarmut->sarmut = $newFileName;
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

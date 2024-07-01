<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Periode;
use App\Models\RiwayatProgja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProgjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        $title = "Program Kerja";
        $user = User::find(Auth::user()->id);
        $periode = Periode::where('status', 1)->first();
        $periode_id = $periode->id;
        $periode_aktif = $periode->tahun;

        // $laporan = Laporan::getLaporan($user->id, $periode_id);
        $laporan = Laporan::getAll($user->id, $periode_id);
        // dd($laporan);

        return view('divisi.laporan.progja.index', compact(
            'title',
            'laporan',
            'user',
            'periode',
        ));
    }

    public function riwayat($id)
    {
        $riwayats = RiwayatProgja::where('laporan_id', $id)->orderBy('tgl_upload', 'desc')->get();

        $view =  view('divisi.laporan.progja.riwayat', compact(
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $name = Auth::user()->name;
        // $progja = $request->file('progja');

        $rules = [
            'progja'   => 'required'
        ];

        $data = new Laporan();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah Progja', 'class' => 'alert-danger']);
        }
        $data->user_id = $request->user_id;
        $data->periode_id = $request->periode_id;
        $data->konf_progja = 'belum';
        $data->tgl_upload_progja = date('Y-m-d H:i:s');
        $data->progja = $this->gdriveConvertToPreviewUrl($request->progja);
        // $data->progja = "Progja_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $progja->getClientOriginalExtension();
        // $request->file('progja')->storeAs('public/uploads/progja', $data->progja);


        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengunggah Progja', 'class' => 'alert-success']);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'progja'   => 'required'
        ];

        $data = Laporan::findOrFail($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Progja', 'class' => 'alert-danger']);
        }

        // Update data
        $data->konf_progja = 'belum';
        $data->tgl_upload_progja = now(); // Menggunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
        $data->progja = $this->gdriveConvertToPreviewUrl($request->progja);

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengubah Progja', 'class' => 'alert-success']);
    }

    public function reupload(Request $request, $id)
    {

        $rules = [
            'progja'   => 'required'
        ];

        $dataProgja = Laporan::findOrFail($id);
        $dataRiwayat = new RiwayatProgja();

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Progja', 'class' => 'alert-danger']);
        }

        $dataRiwayat->laporan_id = $id;
        $dataRiwayat->progja = $dataProgja->progja;
        $dataRiwayat->ket = $dataProgja->ket_progja;
        $dataRiwayat->tgl_upload = $dataProgja->tgl_upload_progja;
        $dataRiwayat->save();

        $dataProgja->progja = $this->gdriveConvertToPreviewUrl($request->progja);;
        $dataProgja->konf_progja = 'belum';
        $dataProgja->ket_progja = null;
        $dataProgja->tgl_upload_progja = now();
        $dataProgja->tgl_konf_progja = null;

        $dataProgja->save();

        return back()->with(['msgs' => 'Berhasil Mengubah Progja', 'class' => 'alert-success']);
    }


    public function destroy($id)
    {
        //
    }
}

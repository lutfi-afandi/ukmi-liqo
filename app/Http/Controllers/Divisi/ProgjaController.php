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
        $progja = $request->file('progja');

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
        $data->progja = "Progja_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $progja->getClientOriginalExtension();
        $request->file('progja')->storeAs('public/uploads/progja', $data->progja);


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
        $progja = $request->file('progja');

        $rules = [
            'progja'   => 'required'
        ];

        $data = Laporan::findOrFail($id);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal mengubah Progja', 'class' => 'alert-danger']);
        }

        // Path file lama
        $oldFilePath = 'public/uploads/progja/' . $data->progja;

        // Hapus file lama jika ada
        if (Storage::exists($oldFilePath)) {
            Storage::delete($oldFilePath);
        }

        // Simpan file baru
        $newFileName = "Progja_usr_" . $data->user_id . "_prd_" . $data->periode_id . "-" . date('His') . "." . $progja->getClientOriginalExtension();
        $newFilePath = $progja->storeAs('public/uploads/progja', $newFileName);

        // Update data
        $data->konf_progja = 'belum';
        $data->tgl_upload_progja = now(); // Menggunakan helper now() untuk mendapatkan tanggal dan waktu saat ini
        $data->progja = $newFileName;

        $data->save();
        return back()->with(['msgs' => 'Berhasil Mengubah Progja', 'class' => 'alert-success']);
    }

    public function reupload(Request $request, $id)
    {
        // dd();

        $progja = $request->file('progja');

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

        // Simpan file baru
        $newFileName = "Progja_usr_" . $dataProgja->user_id . "_prd_" . $dataProgja->periode_id . "-" . date('His') . "." . $progja->getClientOriginalExtension();
        $newFilePath = $progja->storeAs('public/uploads/progja', $newFileName);

        $dataProgja->progja = $newFileName;
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

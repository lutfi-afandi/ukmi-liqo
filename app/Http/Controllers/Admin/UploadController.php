<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Periode;
use App\Models\Triwulan1;
use App\Models\Triwulan2;
use App\Models\Triwulan3;
use App\Models\Triwulan4;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
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

    public function index(Request $request)
    {
        $periode = Periode::orderBy('tahun', 'desc')->get();
        $divisis = User::where('level', 'divisi')->get();

        if (isset($request->user_id) && isset($request->periode_id)) {
            $user_id = $request->user_id;
            $pemilik = User::where('id', $user_id)->first();
            $periode_id = $request->periode_id;
            // dd($pemilik->name);
            $laporan = Laporan::getAll($user_id, $periode_id);
        } else {
            $user_id = false;
            $periode_id = false;
            $laporan = null;
            $pemilik = null;
        }
        // dd($laporan->triwulan1->first()->konf, $laporan->id);
        return view('admin.upload.index', compact(
            'periode',
            'divisis',
            'user_id',
            'periode_id',
            'laporan',
            'pemilik'
        ));
    }

    public function uploadProgja(Request $request)
    {
        $title = "Upload Progja";
        $user_id = $request->input('user_id');
        $periode_id = $request->input('periode_id');
        $laporan = Laporan::getAll($user_id, $periode_id);

        // dd($user_id, $periode_id, $laporan);
        $view = view('admin.upload.progja', compact(
            'laporan',
            'title',
            'user_id',
            'periode_id',
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function saveProgja(Request $request)
    {
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
        $data->progja = $this->gdriveConvertToPreviewUrl($request->progja);
        $data->konf_progja = $request->konf_progja;
        $data->tgl_upload_progja = now();
        $data->save();

        return back()->with(['msgs' => 'Berhasil Mengunggah Progja', 'class' => 'alert-success']);
    }

    public function uploadSarmut(Request $request)
    {
        $title = "Upload Sasaran Mutu";
        $laporan_id = $request->input('laporan_id');
        $laporan = Laporan::findOrFail($laporan_id);

        // dd($user_id, $periode_id, $laporan);
        $view = view('admin.upload.sarmut', compact(
            'laporan',
            'title',
            'laporan_id',
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function simpanSarmut(Request $request)
    {
        // dd($request->)
        $rules = [
            'sarmut'   => 'required'
        ];

        $data = Laporan::find($request->laporan_id);
        // dd($data);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah Sasaran Mutu', 'class' => 'alert-danger']);
        }
        $data->id = $request->laporan_id;
        $data->sarmut = $this->gdriveConvertToPreviewUrl($request->sarmut);
        $data->konf_sarmut = $request->konf_sarmut;
        $data->tgl_upload_sarmut = now();
        $data->save();

        return back()->with(['msgs' => 'Berhasil Mengunggah Sasaran Mutu', 'class' => 'alert-success']);
    }

    public function uploadTw1(Request $request)
    {
        $title = "Upload Evaluasi Triwulan 1";
        $laporan = Laporan::findOrFail($request->input('laporan_id'));
        $triwulan1 = $laporan->triwulan1->first();

        $view = view('admin.upload.triwulan1', compact(
            'laporan',
            'triwulan1',
            'title',
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function simpanTw1(Request $request)
    {
        $rules = [
            'file_tw1'   => 'required'
        ];

        $laporan = Laporan::find($request->laporan_id);
        if ($request->id == null) {
            $data = new Triwulan1();
        } else {
            $data = Triwulan1::findOrFail($request->id);
        }
        // dd($data);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah evaluasi triwulan 1', 'class' => 'alert-danger']);
        }
        $data->laporan_id = $laporan->id;
        $data->file_tw1 = $this->gdriveConvertToPreviewUrl($request->file_tw1);
        $data->konf = $request->konf;
        $data->tgl_upload = now();
        $data->save();

        return back()->with(['msgs' => 'Berhasil Mengunggah evaluasi triwulan 1', 'class' => 'alert-success']);
    }

    public function uploadTw2(Request $request)
    {
        $title = "Upload Evaluasi Triwulan 2";
        $laporan = Laporan::findOrFail($request->input('laporan_id'));
        $triwulan2 = $laporan->triwulan2->first();

        $view = view('admin.upload.triwulan2', compact(
            'laporan',
            'triwulan2',
            'title',
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function simpanTw2(Request $request)
    {
        $rules = [
            'file_tw2'   => 'required'
        ];

        $laporan = Laporan::find($request->laporan_id);
        if ($request->id == null) {
            $data = new Triwulan2();
        } else {
            $data = Triwulan2::findOrFail($request->id);
        }
        // dd($data);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah evaluasi triwulan 2', 'class' => 'alert-danger']);
        }
        $data->laporan_id = $laporan->id;
        $data->file_tw2 = $this->gdriveConvertToPreviewUrl($request->file_tw2);
        $data->konf = $request->konf;
        $data->tgl_upload = now();
        $data->save();

        return back()->with(['msgs' => 'Berhasil Mengunggah evaluasi triwulan 2', 'class' => 'alert-success']);
    }

    public function uploadTw3(Request $request)
    {
        $title = "Upload Evaluasi Triwulan 3";
        $laporan = Laporan::findOrFail($request->input('laporan_id'));
        $triwulan3 = $laporan->triwulan3->first();

        $view = view('admin.upload.triwulan3', compact(
            'laporan',
            'triwulan3',
            'title',
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function simpanTw3(Request $request)
    {
        $rules = [
            'file_tw3'   => 'required'
        ];

        $laporan = Laporan::find($request->laporan_id);
        if ($request->id == null) {
            $data = new Triwulan3();
        } else {
            $data = Triwulan3::findOrFail($request->id);
        }
        // dd($data);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah evaluasi triwulan 3', 'class' => 'alert-danger']);
        }
        $data->laporan_id = $laporan->id;
        $data->file_tw3 = $this->gdriveConvertToPreviewUrl($request->file_tw3);
        $data->konf = $request->konf;
        $data->tgl_upload = now();
        $data->save();

        return back()->with(['msgs' => 'Berhasil Mengunggah evaluasi triwulan 3', 'class' => 'alert-success']);
    }

    public function uploadTw4(Request $request)
    {
        $title = "Upload Evaluasi Triwulan 4";
        $laporan = Laporan::findOrFail($request->input('laporan_id'));
        $triwulan4 = $laporan->triwulan4->first();

        $view = view('admin.upload.triwulan4', compact(
            'laporan',
            'triwulan4',
            'title',
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function simpanTw4(Request $request)
    {
        $rules = [
            'file_tw4'   => 'required'
        ];

        $laporan = Laporan::find($request->laporan_id);
        if ($request->id == null) {
            $data = new Triwulan4();
        } else {
            $data = Triwulan4::findOrFail($request->id);
        }
        // dd($data);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah evaluasi triwulan 4', 'class' => 'alert-danger']);
        }
        $data->laporan_id = $laporan->id;
        $data->file_tw4 = $this->gdriveConvertToPreviewUrl($request->file_tw4);
        $data->konf = $request->konf;
        $data->tgl_upload = now();
        $data->save();

        return back()->with(['msgs' => 'Berhasil Mengunggah evaluasi triwulan 4', 'class' => 'alert-success']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berkas;
use App\Models\BerkasLpm;
use App\Models\Kategori;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BerkasController extends Controller
{
    public function index()
    {
        $berkaslpm = BerkasLpm::with('kategori', 'periode')->get();
        return view('admin.berkas.index', compact(
            'berkaslpm',
        ));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $tahun_ini = date('Y');
        $periode = Periode::orderBy('tahun', 'desc')->get();
        return view('admin.berkas.create', compact(
            'kategori',
            'tahun_ini',
            'periode'
        ));
    }


    public function store(Request $request)
    {
        // Validasi input
        $file =   $request->file('file');
        $dir = 'public/uploads/file_berkas';


        $request->validate([
            'nama_berkas' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'periode_id' => 'required|integer',
            'file' => 'required|mimes:pdf', // file harus PDF dan maksimal 2MB
        ]);

        // Logika penyimpanan berkas
        $data = new BerkasLpm();
        $data->nama_berkas = $request->nama_berkas;
        $data->kategori_id = $request->kategori_id;
        $data->periode_id = $request->periode_id;
        $data->file = $data->nama_berkas . date('H-i-s') . "." . $file->getClientOriginalExtension();

        $request->file('file')->storeAs($dir, $data->file);
        $data->save();
        // Redirect ke halaman yang sesuai setelah penyimpanan
        return redirect()->route('admin.berkas.index')->with(['msgs' => 'Berkas berhasil diupload!', 'class' => 'success']);
    }

    private function convertToPreviewUrl($url)
    {
        // Cek apakah URL adalah URL Google Drive yang valid
        if (preg_match('/https:\/\/drive\.google\.com\/file\/d\/([^\/]+)\/view/', $url, $matches)) {
            $fileId = $matches[1];
            return "https://drive.google.com/file/d/{$fileId}/preview";
        }

        // Kembalikan URL asli jika tidak cocok
        return $url;
    }


    public function show($id)
    {
        $berkas = BerkasLpm::findOrFail($id);
        $view = view('admin.berkas.delete', compact('berkas'))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $berkas = BerkasLpm::findOrFail($id);
        $dir = 'public/uploads/file_berkas/';
        $file_berkas = $dir . $berkas->file;

        // Hapus file lama jika ada
        if (Storage::exists($file_berkas)) {
            Storage::delete($file_berkas);
        }

        $berkas->delete();
        return redirect()->route('admin.berkas.index')->with(['msgs' => 'Berkas berhasil dihapus!', 'class' => 'info']);
    }
}

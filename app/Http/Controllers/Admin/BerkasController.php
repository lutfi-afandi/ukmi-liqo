<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Periode;
use Illuminate\Http\Request;

class BerkasController extends Controller
{


    public function index()
    {
        return view('admin.berkas.index');
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
        $request->validate([
            'nama_berkas' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'periode_id' => 'required|integer',
            'file' => 'required|mimes:pdf|max:2048', // file harus PDF dan maksimal 2MB
        ]);

        // Logika penyimpanan berkas, misalnya:
        // $path = $request->file('file')->store('berkas', 'public');

        // Redirect ke halaman yang sesuai setelah penyimpanan
        return redirect()->route('admin.berkas.index')->with('success', 'Berkas berhasil diupload');
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
        //
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
        //
    }
}

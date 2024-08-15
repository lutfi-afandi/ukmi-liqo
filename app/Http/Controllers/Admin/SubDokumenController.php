<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubDokumenController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        // dd($request->all());
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_subdok' => 'required|string|max:255',
            'file_subdok' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            $errorMessages = $validator->errors()->all();
            $msgs = implode(' ', $errorMessages);
            return redirect()->back()->with([
                'msgs' => 'Terjadi kesalahan saat menyimpan dokumen. ' . $msgs,
                'class' => 'danger'
            ]);
        }

        // Proses penyimpanan dengan transaksi
        try {
            DB::transaction(function () use ($request) {
                $subdok = new SubDokumen();
                $subdok->dokumen_id = $request->dokumen_id;
                $subdok->nama_subdok = $request->input('nama_subdok');
                $subdok->file_subdok = $this->gdriveConvertToPreviewUrl($request->input('file_subdok'));
                $subdok->save();
            });

            // Jika penyimpanan berhasil
            return redirect()->back()->with([
                'msgs' => 'Dokumen berhasil disimpan.',
                'class' => 'success'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan selama transaksi
            return redirect()->back()->with([
                'msgs' => 'Terjadi kesalahan saat menyimpan dokumen.',
                'class' => 'danger'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub_dokumen = SubDokumen::findOrFail($id);

        $view = view('admin.subdokumen.delete', compact('sub_dokumen'))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub_dokumen = SubDokumen::findOrFail($id);

        $view = view('admin.subdokumen.edit', compact('sub_dokumen'))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
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
        $validator = Validator::make($request->all(), [
            'nama_subdok' => 'required|string|max:255',
            'file_subdok' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            $errorMessages = $validator->errors()->all();
            $msgs = implode(' ', $errorMessages);
            return redirect()->back()->with([
                'msgs' => 'Terjadi kesalahan saat menyimpan dokumen. ' . $msgs,
                'class' => 'danger'
            ]);
        }

        // Proses penyimpanan dengan transaksi
        try {
            DB::transaction(function () use ($request, $id) {
                $subdok = SubDokumen::findOrFail($id);
                $subdok->nama_subdok = $request->input('nama_subdok');
                $subdok->file_subdok = $this->gdriveConvertToPreviewUrl($request->input('file_subdok'));
                $subdok->save();
            });

            // Jika penyimpanan berhasil
            return redirect()->back()->with([
                'msgs' => 'Dokumen berhasil dibuah.',
                'class' => 'success'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan selama transaksi
            return redirect()->back()->with([
                'msgs' => 'Terjadi kesalahan saat mengubah dokumen.',
                'class' => 'danger'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub_dokumen = SubDokumen::findOrFail($id);

        $sub_dokumen->delete();
        return redirect()->back()->with(['msgs' => 'Dokumen berhasil dihapus!', 'class' => 'info']);
    }
}

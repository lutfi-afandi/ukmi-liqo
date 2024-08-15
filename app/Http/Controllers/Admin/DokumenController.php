<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\SubDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Dokumen';
        $dokumens = Dokumen::with('sub_dokumen')->get();

        return view('admin.dokumen.index', compact(
            'title',
            'dokumens'
        ));
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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Proses penyimpanan dengan transaksi
        try {
            DB::transaction(function () use ($request) {
                $dokumen = new Dokumen();
                $dokumen->nama_dokumen = $request->input('nama_dokumen');
                $dokumen->save();
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
        // $dokumen = Dokumen::find(decrypt($id));
        $dokumen = Dokumen::with('sub_dokumen')->where('id', decrypt($id))->first();
        // dd($dokumen->sub_dokumen->isEmpty());

        $sub_dokumens = SubDokumen::with('dokumen')->where('dokumen_id', decrypt($id))->get();
        // dd($sub_dokumens->isEmpty());
        $title = 'Sub Dokumen : ' . $dokumen->nama_dokumen;
        return view('admin.subdokumen.index', compact(
            'title',
            'dokumen',
            'sub_dokumens'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $view = view('admin.dokumen.delete', compact('dokumen'))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function ubah($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $view = view('admin.dokumen.edit', compact('dokumen'))->render();

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
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_dokumen' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // dd($request);
        // Proses penyimpanan dengan transaksi
        try {
            DB::transaction(function () use ($request, $id) {
                $dokumen = Dokumen::findOrFail($id);
                $dokumen->nama_dokumen = $request->input('nama_dokumen');
                $dokumen->save();
            });

            // Jika penyimpanan berhasil
            return redirect()->back()->with([
                'msgs' => 'Dokumen berhasil diubah.',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);


        $dokumen->delete();
        return redirect()->route('admin.dokumen.index')->with(['msgs' => 'Dokumen berhasil dihapus!', 'class' => 'info']);
    }
}

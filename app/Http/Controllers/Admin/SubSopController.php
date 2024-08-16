<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubSop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SubSopController extends Controller
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
        $validator = Validator::make($request->all(), [
            'nama_subsop' => 'required|string|max:255',
            'file_subsop' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            $errorMessages = $validator->errors()->all();
            $msgs = implode(' ', $errorMessages);
            return redirect()->back()->with([
                'msgs' => 'Terjadi kesalahan saat menyimpan SOP. ' . $msgs,
                'class' => 'danger'
            ]);
        }

        // Proses penyimpanan dengan transaksi
        try {
            DB::transaction(function () use ($request) {
                $subsop = new SubSop();
                $subsop->sop_id = $request->sop_id;
                $subsop->nama_subsop = $request->input('nama_subsop');
                $subsop->file_subsop = $this->gdriveConvertToPreviewUrl($request->input('file_subsop'));
                $subsop->save();
            });

            // Jika penyimpanan berhasil
            return redirect()->back()->with([
                'msgs' => 'SOP berhasil disimpan.',
                'class' => 'success'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan selama transaksi
            return redirect()->back()->with([
                'msgs' => 'Terjadi kesalahan saat menyimpan sop. ' . $e,
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
        $subsop = SubSop::findOrFail($id);

        $view = view('admin.subsop.delete', compact('subsop'))->render();

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
        $subsop = SubSop::findOrFail($id);

        $view = view('admin.subsop.edit', compact('subsop'))->render();

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
            'nama_subsop' => 'required|string|max:255',
            'file_subsop' => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            $errorMessages = $validator->errors()->all();
            $msgs = implode(' ', $errorMessages);
            return redirect()->back()->with([
                'msgs' => 'Terjadi kesalahan saat menyimpan sop. ' . $msgs,
                'class' => 'danger'
            ]);
        }

        // Proses penyimpanan dengan transaksi
        try {
            DB::transaction(function () use ($request, $id) {
                $subsop = SubSop::findOrFail($id);
                $subsop->nama_subsop = $request->input('nama_subsop');
                $subsop->file_subsop = $this->gdriveConvertToPreviewUrl($request->input('file_subsop'));
                $subsop->save();
            });

            // Jika penyimpanan berhasil
            return redirect()->back()->with([
                'msgs' => 'SOP berhasil dibuah.',
                'class' => 'success'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan selama transaksi
            return redirect()->back()->with([
                'msgs' => 'Terjadi kesalahan saat mengubah sop.',
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
        $sub_sop = SubSop::findOrFail($id);

        $sub_sop->delete();
        return redirect()->back()->with(['msgs' => 'SOP berhasil dihapus!', 'class' => 'info']);
    }
}

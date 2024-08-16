<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sop;
use App\Models\SubSop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'SOP';
        $sops = Sop::with('sub_sop')->get();

        return view('admin.sop.index', compact(
            'title',
            'sops'
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
        $validator = Validator::make($request->all(), [
            'nama_sop' => 'required|string|max:255',
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
                $sop = new Sop();
                $sop->nama_sop = $request->input('nama_sop');
                $sop->save();
            });

            // Jika penyimpanan berhasil
            return redirect()->back()->with([
                'msgs' => 'Sop berhasil disimpan.',
                'class' => 'success'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan selama transaksi
            return redirect()->back()->with([
                'msgs' => 'Terjadi kesalahan saat menyimpan sop.',
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
        // $sop = Sop::find(decrypt($id));
        $sop = Sop::with('sub_sop')->where('id', decrypt($id))->first();
        // dd($sop->sub_sop->isEmpty());

        $subsops = SubSop::with('sop')->where('sop_id', decrypt($id))->get();
        // dd($sub_sops->isEmpty());
        $title = '' . $sop->nama_sop;
        return view('admin.subsop.index', compact(
            'title',
            'sop',
            'subsops'
        ));
    }

    public function ubah($id)
    {
        $sop = Sop::findOrFail($id);
        $view = view('admin.sop.edit', compact('sop'))->render();

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
        $sop = Sop::findOrFail($id);
        $view = view('admin.sop.delete', compact('sop'))->render();

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
            'nama_sop' => 'required|string|max:255',
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
                $sop = Sop::findOrFail($id);
                $sop->nama_sop = $request->input('nama_sop');
                $sop->save();
            });

            // Jika penyimpanan berhasil
            return redirect()->back()->with([
                'msgs' => 'Sop berhasil diubah.',
                'class' => 'success'
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan selama transaksi
            return redirect()->back()->with([
                'msgs' => 'Terjadi kesalahan saat menyimpan sop.',
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
        $sop = Sop::findOrFail($id);

        $sop->delete();
        return redirect()->route('admin.sop.index')->with(['msgs' => 'Sop berhasil dihapus!', 'class' => 'info']);
    }
}

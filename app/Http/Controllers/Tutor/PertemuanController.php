<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Models\Pertemuan;
use App\Models\PesertaPertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PertemuanController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kelompok_id' => 'required|exists:kelompoks,id',
            'tempat' => 'nullable|string|max:255',
            'tgl' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            // Simpan data pertemuan
            $pertemuan = Pertemuan::create([
                'kelompok_id' => $request->kelompok_id,
                'tempat' => $request->tempat,
                'tgl' => $request->tgl,
                'status' => 1,
            ]);

            DB::commit();

            // Redirect ke halaman detail pertemuan
            return response()->json(['redirect' => route('tutor.pertemuan.show', $pertemuan->id)], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data.'], 500);
        }
    }

    public function show($id)
    {
        $pertemuan = Pertemuan::findOrFail($id);
        $title = 'Pertemuan Kelompok ' . $pertemuan->kelompok->kode;
        $pesertas = PesertaPertemuan::with('anggota', 'pertemuan')
            ->where("pertemuan_id", $id)
            ->get();

        // dd($pertemuans[0]->kelompok->rombel->count());
        return view('tutor.pertemuan.index', compact(
            'title',
            'pertemuan',
            'pesertas',
            // 'user'
        ));
    }


    public function ubahstatus($id)
    {
        $pertemuan = Pertemuan::find($id);

        if ($pertemuan->status == 1) {
            $pertemuan->status = 0;
        } else {
            // 
            $pertemuan->status = 1;
        }
        $pertemuan->save();

        return redirect()->back()->with('info', 'Status diupdate');
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

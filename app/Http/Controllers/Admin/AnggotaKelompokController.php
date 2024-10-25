<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\AnggotaKelompok;
use App\Models\Kelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaKelompokController extends Controller
{

    public function show($id)
    {
        // Ambil kelompok berdasarkan ID
        $id_kelompok = $id;
        $kelompok = Kelompok::with('tutor')->findOrFail($id);


        $rombels = AnggotaKelompok::with('anggota')->where('kelompok_id', $id_kelompok)->get();
        // dd($rombels[0]->anggota);
        $anggotas_tanpa_kelompok = Anggota::whereDoesntHave('rombel')
            ->where('jenis_kelamin', $kelompok->tutor->jenis_kelamin)
            ->orderBy('npm', 'asc')->get();
        // dd($anggotas, Anggota::whereHas('rombel')->get()->rombel);
        return view('admin.rombel.index', compact(
            'id_kelompok',
            'kelompok',
            'rombels',
            'anggotas_tanpa_kelompok',
        ));
    }

    public function addAnggota(Request $request, $id)
    {
        $kelompok = Kelompok::findOrFail($id);

        DB::transaction(function () use ($request, $kelompok) {
            // Loop melalui anggota yang dipilih dan update kelompok$kelompok_id mereka
            foreach ($request->anggota_id as $anggota_id) {
                AnggotaKelompok::create([
                    'kelompok_id' => $kelompok->id,
                    'anggota_id' => $anggota_id,
                ]);
            }
        });

        return redirect()->route('admin.anggota-kelompok.show', $kelompok->id)->with('success', 'Anggota berhasil ditambahkan ke kelompok.');
    }



    // Di RombelController
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        // dd($ids);
        // Validasi ID
        if (is_array($ids)) {
            AnggotaKelompok::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
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

    public function store(Request $request)
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
        $kelompok = AnggotaKelompok::findOrFail($id);
        // dd($kelompok);
        DB::beginTransaction();
        try {
            $kelompok->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Anggota berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus Anggota.');
        }
    }
}

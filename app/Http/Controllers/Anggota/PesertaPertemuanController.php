<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Pertemuan;
use App\Models\PesertaPertemuan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesertaPertemuanController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail(auth()->user()->id);
        $anggota = Anggota::where('npm', $user->username)->first();
        $pertemuan = Pertemuan::findOrFail($id);

        return view('anggota.peserta-pertemuan.create', compact(
            'anggota',
            'pertemuan',
        ));
    }

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
        // dd($request->all());
        $request->validate([
            'jam_kehadiran' => 'required',
            'sholat_wajib' => 'required|integer',
            'tilawah_quran' => 'required|integer',
            'sholat_jamaah' => 'required|integer',
            'qiyamull_lail' => 'required|integer',
            'sholat_dhuha' => 'required|integer',
            'sholat_rawatib' => 'required|integer',
            'dzikir' => 'required|integer',
            'istighfar' => 'required|integer',
            'shaum_sunnah' => 'required|integer',
            'almatsurat' => 'required|integer',
            'baca_buku_islam' => 'required|integer',
            'riyadhoh' => 'required|integer',
        ]);

        DB::beginTransaction();

        try {
            $mutabaah = new PesertaPertemuan();

            $mutabaah->pertemuan_id = $request->pertemuan_id;
            $mutabaah->anggota_id = $request->anggota_id;
            $mutabaah->jam_kehadiran = $request->jam_kehadiran;
            $mutabaah->sholat_wajib = $request->sholat_wajib;
            $mutabaah->tilawah_quran = $request->tilawah_quran;
            $mutabaah->sholat_jamaah = $request->sholat_jamaah;
            $mutabaah->qiyamull_lail = $request->qiyamull_lail;
            $mutabaah->sholat_dhuha = $request->sholat_dhuha;
            $mutabaah->sholat_rawatib = $request->sholat_rawatib;
            $mutabaah->dzikir = $request->dzikir;
            $mutabaah->istighfar = $request->istighfar;
            $mutabaah->shaum_sunnah = $request->shaum_sunnah;
            $mutabaah->almatsurat = $request->almatsurat;
            $mutabaah->baca_buku_islam = $request->baca_buku_islam;
            $mutabaah->riyadhoh = $request->riyadhoh;
            $mutabaah->save();

            DB::commit();
            return redirect()->route('anggota.dashboard.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])->withInput();
        }
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

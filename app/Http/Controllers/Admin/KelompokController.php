<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Data Kelompok";
        $tutors = Tutor::all();
        return view('admin.kelompok.index', compact(
            'title',
            'tutors',
        ));
    }

    public function data()
    {
        $kelompoks = Kelompok::with('anggota')->get();
        $view = view('admin.kelompok.tabel', compact('kelompoks'));

        return response()->json([
            'success' => true,
            'html'  => $view,
        ]);
    }

    public function generateKodeKelompok($jenisKelamin, $tahunDibentuk)
    {
        // Awalan kode berdasarkan tahun dan jenis kelamin
        $tahun = substr($tahunDibentuk, 2); // Ambil 2 digit terakhir dari tahun
        $kodeJenisKelamin = (strtolower($jenisKelamin) == 'laki-laki') ? 'L' : 'P';

        // Hitung jumlah kelompok yang sudah ada berdasarkan tahun dan jenis kelamin
        $jumlahKelompok = Kelompok::where('tahun_dibentuk', $tahunDibentuk)
            ->whereHas('tutor', function ($query) use ($jenisKelamin) {
                $query->where('jenis_kelamin', $jenisKelamin);
            })
            ->count();

        // Format nomor urut 4 digit
        $nomorUrut = str_pad($jumlahKelompok + 1, 4, '0', STR_PAD_LEFT);

        // Gabungkan kode akhir: 'LQ-24L-0001'
        return response()->json([
            'succes'    => true,
            'data'  => "LQ-{$tahun}{$kodeJenisKelamin}-{$nomorUrut}"
        ]);
    }

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
        // Lakukan validasi
        $validator = Validator::make($request->all(), [
            'kode' => 'required|unique:kelompoks,kode',
            'tutor_id' => 'required|exists:tutors,id',
            'tahun_dibentuk' => 'required|integer|min:2015',
        ]);

        // Jika validasi gagal, kembalikan respon error
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Mulai transaksi database
        DB::beginTransaction();
        try {
            // Simpan data kelompok ke database
            $kelompok = new Kelompok();
            $kelompok->kode = $request->kode;
            $kelompok->tutor_id = $request->tutor_id;
            $kelompok->tahun_dibentuk = $request->tahun_dibentuk;
            $kelompok->save();

            // Commit transaksi jika tidak ada error
            DB::commit();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Rollback jika ada error
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan, data gagal disimpan'], 500);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

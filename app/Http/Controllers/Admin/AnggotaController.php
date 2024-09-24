<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Data anggota";
        $anggotas = Anggota::with('jurusan')
            ->orderBy('nama', 'asc')
            ->get();

        // dd($anggotas[0]->jurusan);
        return view('admin.anggota.index', compact(
            'title',
            'anggotas'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah anggota";
        $jurusans = Jurusan::orderBy('nama', 'asc')->get();
        return view('admin.anggota.create', compact(
            'title',
            'jurusans'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'npm' => 'required|string|unique:anggotas',
            'level' => 'nullable',
            'jenis_kelamin' => 'required',
            'jurusan_id' => 'required',
            'tahun_masuk' => 'required',
            'no_telepon' => 'nullable',
            // 'password' => 'required|string|min:6',
        ]);

        try {
            DB::beginTransaction();
            $anggota = Anggota::create([
                'nama' => $request->nama,
                'npm' => $request->npm,
                'level' => 'anggota',
                'no_telepon' => $request->no_telepon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tahun_masuk' => $request->tahun_masuk,
                'jurusan_id' => $request->jurusan_id,
                // 'password' => bcrypt($request->password),
            ]);
            User::create([
                'name' => $anggota->nama,
                'username' => $anggota->npm,
                'level' => 'anggota',
                'no_telepon' => $anggota->no_telepon,
                'jenis_kelamin' => $anggota->jenis_kelamin,
                'password' => bcrypt($anggota->npm),
            ]);
            // Jika semua berhasil, commit transaksi
            DB::commit();

            return redirect()->route('admin.anggota.index')->with(['msg' => 'Berhasil Menambah Data', 'class' => 'alert-success']);
        } catch (\Exception $e) {
            // Jika ada error, rollback transaksi
            DB::rollBack();
            return back()
                ->withErrors(['msg' => 'Gagal Menambah Data: ' . $e->getMessage()]);
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
        $title = "Edit anggota";
        $jurusans = Jurusan::orderBy('nama', 'asc')->get();
        $anggota = Anggota::findOrFail($id);
        return view('admin.anggota.edit', compact(
            'title',
            'anggota',
            'jurusans'
        ));
    }


    public function update(Request $request, $id)
    {
        $anggota = Anggota::find($id);
        $request->validate([
            'nama' => 'required',
            'npm' => 'required|string|unique:anggotas,npm,' . $anggota->id, // Abaikan NPM yang sedang diupdate
            'level' => 'nullable',
            'jenis_kelamin' => 'required',
            'jurusan_id' => 'required',
            'tahun_masuk' => 'required',
            'no_telepon' => 'nullable',
        ]);

        try {
            DB::beginTransaction();

            // Update data anggota
            $anggota->update([
                'nama' => $request->nama,
                'no_telepon' => $request->no_telepon,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tahun_masuk' => $request->tahun_masuk,
                'jurusan_id' => $request->jurusan_id,
                // 'password' => bcrypt($request->password), // Jika password juga diperbarui
            ]);

            // Update data user
            $user = User::where('username', $anggota->npm)->firstOrFail();
            $user->update([
                'name' => $anggota->nama,
                'no_telepon' => $anggota->no_telepon,
                'jenis_kelamin' => $anggota->jenis_kelamin,
            ]);

            DB::commit();
            return redirect()->route('admin.anggota.index')->with(['msg' => 'Berhasil Mengupdate Data', 'class' => 'alert-success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['msg' => 'Gagal Mengupdate Data: ' . $e->getMessage()]);
        }
    }

    public function reset($id)
    {
        $anggota = Anggota::findOrFail($id);
        $user = User::where('username', $anggota->npm)->first();
        $view = view('admin.anggota.reset', compact('user'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function reset_password($id)
    {
        $user = User::findOrFail($id);
        // $user = User::where('username', $anggota->username)->first();
        $user->password = bcrypt('yuk_liqo123');
        $user->save();
        return redirect()->route('admin.anggota.index')->with(['msg' => 'Berhasil Mereset Password ' . $user->name, 'class' => 'alert-success']);
    }

    public function destroy($id)
    {
        try {
            // Mulai transaksi
            DB::beginTransaction();

            // Cari anggota berdasarkan id
            $anggota = Anggota::findOrFail($id);

            // Hapus user berdasarkan npm dari anggota
            User::where('username', $anggota->npm)->delete();

            // Hapus anggota
            $anggota->delete();

            // Commit transaksi jika berhasil
            DB::commit();

            return back()->with(['msg' => 'Berhasil Menghapus Anggota', 'class' => 'alert-success']);
        } catch (\Exception $e) {
            // Rollback jika ada kesalahan
            DB::rollBack();

            return back()->withErrors(['msg' => 'Gagal Menghapus Data: ' . $e->getMessage()]);
        }
    }
}

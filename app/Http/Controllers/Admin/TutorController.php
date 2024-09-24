<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Data Tutors";
        $tutors = Tutor::all();

        // dd($users);
        return view('admin.tutor.index', compact(
            'title',
            'tutors'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Tutor";
        return view('admin.tutor.create', compact(
            'title',
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
            'username' => 'required|string|regex:/^[a-zA-Z_]+$/u|unique:users',
            'level' => 'nullable',
            'jenis_kelamin' => 'required',
            'no_telepon' => 'nullable',
            'password' => 'required|string|min:6',
        ]);

        try {
            $tutor = Tutor::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'level' => 'tutor',
                'no_telepon' => $request->no_telepon,
                'jenis_kelamin' => $request->jenis_kelamin,
                // 'password' => bcrypt($request->password),
            ]);
            User::create([
                'name' => $tutor->nama,
                'username' => $tutor->username,
                'level' => 'tutor',
                'no_telepon' => $tutor->no_telepon,
                'jenis_kelamin' => $tutor->jenis_kelamin,
                'password' => bcrypt($tutor->password),
            ]);

            return redirect()->route('admin.tutor.index')->with(['msg' => 'Berhasil Menambah Data', 'class' => 'alert-success']);
        } catch (\Exception $e) {
            return back()
                ->withInput($request->except('password'))
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
        $tutor = Tutor::find($id);
        $view = view('admin.tutor.edit', compact('tutor'))->render();
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
        $nama = $request->nama;
        $jenis_kelamin = $request->jenis_kelamin;
        $no_telepon = $request->no_telepon;
        // $level = $request->level;

        $rules = [
            'nama'    => 'required',
            'no_telepon'    => 'required',
            'jenis_kelamin'    => 'required',
            // 'level'  => 'required',
        ];

        $tutor = Tutor::findOrFail($id);
        $user = User::where('username', $tutor->username)->first();
        // dd($user);
        $validator = Validator::make($request->all(), $rules);
        // dd($validator->fails());s
        if ($validator->fails()) {
            return redirect()->route('admin.tutor.index')->withErrors($validator);
        } else {
            $tutor->nama = $nama;
            $tutor->no_telepon = $no_telepon;
            $tutor->jenis_kelamin = $jenis_kelamin;
            // $tutor->level = $level;
            $tutor->save();

            // user
            $user->name = $tutor->nama;
            $user->no_telepon = $tutor->no_telepon;
            $user->save();
            // $user->no_telepon = $tutor->no_telepon;
            return redirect()->route('admin.tutor.index')->with(['msg' => 'Berhasil Mengubah User', 'class' => 'alert-success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function reset($id)
    {
        $tutor = Tutor::findOrFail($id);
        $user = User::where('username', $tutor->username)->first();
        $view = view('admin.tutor.reset', compact('user'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function reset_password($id)
    {
        $user = User::findOrFail($id);
        // $user = User::where('username', $tutor->username)->first();
        $user->password = bcrypt('yuk_liqo123');
        $user->save();
        return redirect()->route('admin.tutor.index')->with(['msg' => 'Berhasil Mereset Password ' . $user->name, 'class' => 'alert-success']);
    }

    public function destroy($id)
    {
        try {
            // Mulai transaksi
            DB::beginTransaction();

            // Cari tutor berdasarkan id
            $tutor = Tutor::findOrFail($id);

            // Hapus user berdasarkan npm dari tutor
            User::where('username', $tutor->username)->delete();

            // Hapus tutor
            $tutor->delete();

            // Commit transaksi jika berhasil
            DB::commit();

            return back()->with(['msg' => 'Berhasil Menghapus Tutor', 'class' => 'success']);
        } catch (\Exception $e) {
            // Rollback jika ada kesalahan
            DB::rollBack();

            return back()->withErrors(['msg' => 'Gagal Menghapus Data: ' . $e->getMessage()]);
        }
    }
}

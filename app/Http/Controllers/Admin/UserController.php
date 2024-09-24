<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Data User";
        $users = User::where('level', '=', 'admin')->get();

        // dd($users);
        return view('admin.user.index', compact(
            'title',
            'users'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah User";
        return view('admin.user.create', compact(
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
            'name' => 'required',
            'username' => 'required|string|regex:/^[a-zA-Z_]+$/u|unique:users',
            'level' => 'nullable',
            'no_telepon' => 'nullable',
            'password' => 'required|string|min:6',
        ]);

        try {
            DB::beginTransaction();
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'level' => 'admin',
                'no_telepon' => $request->no_telepon,
                'password' => bcrypt($request->password),
            ]);
            DB::commit();
            return redirect()->route('admin.user.index')->with(['msg' => 'Berhasil Menambah Data', 'class' => 'alert-success']);
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
    public function show($id) {}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $view = view('admin.user.edit', compact('user'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
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
        $name = $request->name;
        $no_telepon = $request->no_telepon;
        // $level = $request->level;

        $rules = [
            'name'    => 'required',
            // 'level'  => 'required',
        ];

        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), $rules);
        // dd($validator->fails());s
        if ($validator->fails()) {
            return redirect()->route('admin.user.index')->withErrors($validator);
        } else {
            $user->name = $name;
            $user->no_telepon = $no_telepon;
            // $user->level = $level;
            $user->save();
            return redirect()->route('admin.user.index')->with(['msg' => 'Berhasil Mengubah User', 'class' => 'alert-success']);
        }
    }

    public function reset($id)
    {
        $user = User::findOrFail($id);
        $view = view('admin.user.reset', compact('user'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function reset_password($id)
    {
        $user = User::findOrFail($id);
        $user->password = bcrypt('yuk_liqo123');
        $user->save();
        return redirect()->route('admin.user.index')->with(['msg' => 'Berhasil Mereset Password ' . $user->name, 'class' => 'alert-success']);
    }

    public function destroy($id)
    {

        User::where("id", $id)->delete();
        return back()->with(['msg' => 'Berhasil Menghapus User', 'class' => 'success']);
    }
}

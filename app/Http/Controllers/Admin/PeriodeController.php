<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Data Periode";

        $dataPeriode = Periode::orderBy('tahun', 'desc')->get();
        return view('admin.periode.index', compact(
            'title',
            'dataPeriode'
        ));
    }

    public function data()
    {
        $dataPeriode = Periode::orderBy('tahun', 'desc')->get();
        // dd($dataPeriode);
        $view = view('admin.periode.data', compact('dataPeriode'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
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
        $tahun = $request->tahun;

        $rules = [
            'tahun'   => 'required|unique:periodes,tahun'
        ];

        $data = new Periode();
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withInput()->with(['msgs' => 'Gagal Menambah Periode', 'class' => 'alert-danger']);
        }
        $data->tahun = $tahun;
        $data->save();
        return back()->with(['msgs' => 'Berhasil Menambah Periode', 'class' => 'alert-success']);
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
        Periode::query()->update(['status' => 0]);
        $periode = Periode::findOrFail($id);
        $periode->status = 1;
        $periode->save();
        return back()->with(['msg' => 'Berhasil Mengubah Periode Aktif', 'class' => 'alert-success']);
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function index()
    {
        $periode = Periode::orderBy('tahun', 'desc')->get();
        $divisis = User::where('level', 'divisi')->get();
        return view('admin.upload.index', compact(
            'periode',
            'divisis'
        ));
    }


    public function search(Request $request)
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
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
        //
    }
}

<?php

namespace App\Http\Controllers\Divisi;

use App\Http\Controllers\Controller;
use App\Models\BerkasLpm;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    public function index()
    {
        $berkaslpm = BerkasLpm::with('kategori', 'periode')->get();
        return view('divisi.berkas.index', compact(
            'berkaslpm',
        ));
    }
}

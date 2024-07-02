<?php

use App\Http\Controllers\Admin\BerkasController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PenetapanController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\ProgjaController as AdminProgjaController;
use App\Http\Controllers\Admin\SarmutController as AdminSarmutController;
use App\Http\Controllers\Admin\Triwulan1Controller as AdminTriwulan1Controller;
use App\Http\Controllers\Admin\Triwulan2Controller as AdminTriwulan2Controller;
use App\Http\Controllers\Admin\Triwulan3Controller as AdminTriwulan3Controller;
use App\Http\Controllers\Admin\Triwulan4Controller as AdminTriwulan4Controller;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Divisi\BerkasController as DivisiBerkasController;
use App\Http\Controllers\Divisi\DashboardController;
use App\Http\Controllers\Divisi\LaporanController as DivisiLaporanController;
use App\Http\Controllers\Divisi\PenetapanController as DivisiPenetapanController;
use App\Http\Controllers\Divisi\ProgjaController;
use App\Http\Controllers\Divisi\SarmutController;
use App\Http\Controllers\Divisi\Triwulan1Controller;
use App\Http\Controllers\Divisi\Triwulan2Controller;
use App\Http\Controllers\Divisi\Triwulan3Controller;
use App\Http\Controllers\Divisi\Triwulan4Controller;

Route::middleware(['is_admin'])->group(function () {
    Route::resource('/admin/user', UserController::class)->names('admin.user');
    Route::get('/admin/user/reset/{id}', [UserController::class, 'reset'])->name('admin.user.reset');
    Route::put('/admin/user/reset_password/{id}', [UserController::class, 'reset_password'])->name('admin.user.reset_password');
    Route::resource('/kategori', KategoriController::class)->names('admin.kategori');
});

// lpm
Route::middleware(['is_auditor'])->group(function () {
    Route::resource('/kategori', KategoriController::class)->names('admin.kategori');
    Route::resource('/penetapan', PenetapanController::class)->names('admin.penetapan');
    Route::resource('/periode', PeriodeController::class)->names('admin.periode');
    // Route::get('/periodes/data', [PeriodeController::class, 'data'])->name('admin.periodes.data');


    Route::resource('/laporan', LaporanController::class)->names('admin.laporan');
    Route::post('/laporan/tampil', [LaporanController::class, 'tampil'])->name('admin.laporan.tampil');
    Route::resource('/progja', AdminProgjaController::class)->names('admin.progja');
    Route::resource('/sarmut', AdminSarmutController::class)->names('admin.sarmut');
    Route::resource('/triwulan1', AdminTriwulan1Controller::class)->names('admin.triwulan1');
    Route::resource('/triwulan2', AdminTriwulan2Controller::class)->names('admin.triwulan2');
    Route::resource('/triwulan3', AdminTriwulan3Controller::class)->names('admin.triwulan3');
    Route::resource('/triwulan4', AdminTriwulan4Controller::class)->names('admin.triwulan4');

    Route::resource('/berkas', BerkasController::class)->names('admin.berkas');
    Route::resource('/upload', UploadController::class)->names('admin.upload');
    Route::post('/upload/search', [UploadController::class, 'search'])->name('admin.upload.search');
});

// divisi
Route::middleware(['is_auditee'])->group(function () {
    Route::resource('/divisi/penetapan', DivisiPenetapanController::class)->names('divisi.penetapan');
    Route::resource('/divisi/dashboards', DashboardController::class)->names('divisi.dashboard');
    Route::resource('/divisi/laporan', DivisiLaporanController::class)->names('divisi.laporan');

    Route::resource('/divisi/progja', ProgjaController::class)->names('divisi.progja');
    Route::get('/divisi/progja/riwayat/{id}', [ProgjaController::class, 'riwayat'])->name('divisi.progja.riwayat');
    Route::put('/divisi/progja/reupload/{progja}', [ProgjaController::class, 'reupload'])->name('divisi.progja.reupload');

    Route::resource('/divisi/sarmut', SarmutController::class)->names('divisi.sarmut');
    Route::get('/divisi/sarmut/riwayat/{id}', [SarmutController::class, 'riwayat'])->name('divisi.sarmut.riwayat');
    Route::put('/divisi/sarmut/reupload/{sarmut}', [SarmutController::class, 'reupload'])->name('divisi.sarmut.reupload');
    Route::put('/divisi/sarmut/update_sarmut/{sarmut}', [SarmutController::class, 'update_sarmut'])->name('divisi.sarmut.update_sarmut');

    Route::resource('/divisi/triwulan1', Triwulan1Controller::class)->names('divisi.triwulan1');
    Route::get('/divisi/triwulan1/riwayat/{id}', [Triwulan1Controller::class, 'riwayat'])->name('divisi.triwulan1.riwayat');
    Route::put('/divisi/triwulan1/reupload/{triwulan1}', [Triwulan1Controller::class, 'reupload'])->name('divisi.triwulan1.reupload');

    Route::resource('/divisi/triwulan2', Triwulan2Controller::class)->names('divisi.triwulan2');
    Route::get('/divisi/triwulan2/riwayat/{id}', [Triwulan2Controller::class, 'riwayat'])->name('divisi.triwulan2.riwayat');
    Route::put('/divisi/triwulan2/reupload/{triwulan2}', [Triwulan2Controller::class, 'reupload'])->name('divisi.triwulan2.reupload');

    Route::resource('/divisi/triwulan3', Triwulan3Controller::class)->names('divisi.triwulan3');
    Route::get('/divisi/triwulan3/riwayat/{id}', [Triwulan3Controller::class, 'riwayat'])->name('divisi.triwulan3.riwayat');
    Route::put('/divisi/triwulan3/reupload/{triwulan3}', [Triwulan3Controller::class, 'reupload'])->name('divisi.triwulan3.reupload');

    Route::resource('/divisi/triwulan4', Triwulan4Controller::class)->names('divisi.triwulan4');
    Route::get('/divisi/triwulan4/riwayat/{id}', [Triwulan4Controller::class, 'riwayat'])->name('divisi.triwulan4.riwayat');
    Route::put('/divisi/triwulan4/reupload/{triwulan4}', [Triwulan4Controller::class, 'reupload'])->name('divisi.triwulan4.reupload');

    Route::resource('/divisi/berkas', DivisiBerkasController::class)->names('divisi.berkas');
});

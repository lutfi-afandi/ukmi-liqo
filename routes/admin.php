<?php

use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PenetapanController;
use App\Http\Controllers\Admin\PeriodeController;
use App\Http\Controllers\Admin\ProgjaController as AdminProgjaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Divisi\DashboardController;
use App\Http\Controllers\Divisi\LaporanController as DivisiLaporanController;
use App\Http\Controllers\Divisi\PenetapanController as DivisiPenetapanController;
use App\Http\Controllers\Divisi\ProgjaController;

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
    Route::resource('/progja', AdminProgjaController::class)->names('admin.progja');
});

// Auditee
Route::middleware(['is_auditee'])->group(function () {
    Route::resource('/divisi/penetapan', DivisiPenetapanController::class)->names('divisi.penetapan');
    Route::resource('/divisi/dashboards', DashboardController::class)->names('divisi.dashboard');
    Route::resource('/divisi/laporan', DivisiLaporanController::class)->names('divisi.laporan');
    Route::resource('/divisi/progja', ProgjaController::class)->names('divisi.progja');
});

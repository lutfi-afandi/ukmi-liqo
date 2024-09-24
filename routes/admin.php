<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelompokController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Anggota\DashboardController as AnggotaDashboardController;
use App\Http\Controllers\Tutor\DashboardController;
use App\Http\Controllers\Admin\TutorController;

Route::middleware(['is_admin'])->group(function () {
    Route::resource('/admin/user', UserController::class)->names('admin.user');
    Route::get('/admin/user/reset/{id}', [UserController::class, 'reset'])->name('admin.user.reset');
    Route::put('/admin/user/reset_password/{id}', [UserController::class, 'reset_password'])->name('admin.user.reset_password');

    Route::resource('/admin/tutor', TutorController::class)->names('admin.tutor');
    Route::get('/admin/tutor/reset/{id}', [TutorController::class, 'reset'])->name('admin.tutor.reset');
    Route::put('/admin/tutor/reset_password/{id}', [TutorController::class, 'reset_password'])->name('admin.tutor.reset_password');

    Route::resource('/admin/jurusan', JurusanController::class)->names('admin.jurusan');

    Route::resource('/admin/anggota', AnggotaController::class)->names('admin.anggota');
    Route::get('/admin/anggota/reset/{id}', [AnggotaController::class, 'reset'])->name('admin.anggota.reset');
    Route::put('/admin/anggota/reset_password/{id}', [AnggotaController::class, 'reset_password'])->name('admin.anggota.reset_password');

    Route::get('/admin/kelompok/generate-kode/{jk}/{tahun}', [KelompokController::class, 'generateKodeKelompok'])->name('admin.kelompok.generate-kode');
    Route::get('/admin/kelompok/data', [KelompokController::class, 'data'])->name('admin.kelompok.data');
    Route::resource('/admin/kelompok', KelompokController::class)->names('admin.kelompok');
});

// lpm
Route::middleware(['is_tutor'])->group(function () {
    Route::resource('/tutor/dasboard', DashboardController::class)->names('tutor.dashboard');
});

// divisi
Route::middleware(['is_anggota'])->group(function () {
    Route::resource('/anggota/dasboard', AnggotaDashboardController::class)->names('anggota.dashboard');
});

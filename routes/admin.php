<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\AnggotaKelompokController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelompokController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Anggota\DashboardController as AnggotaDashboardController;
use App\Http\Controllers\Tutor\DashboardController;
use App\Http\Controllers\Admin\TutorController;
use App\Http\Controllers\anggota\PesertaPertemuan;
use App\Http\Controllers\Anggota\PesertaPertemuanController;
use App\Http\Controllers\tutor\AnggotaController as TutorAnggotaController;
use App\Http\Controllers\Tutor\PertemuanController;
use App\Models\AnggotaKelompok;

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

    Route::post('/admin/anggota-kelompok/{id}/add_anggota', [AnggotaKelompokController::class, 'addAnggota'])->name('admin.anggota-kelompok.add_anggota');
    Route::delete('/admin/anggota-kelompok/hapus', [AnggotaKelompokController::class, 'bulkDelete'])->name('admin.anggota-kelompok.hapus');
    Route::resource('/admin/anggota-kelompok', AnggotaKelompokController::class)->names('admin.anggota-kelompok');
});

// lpm
Route::middleware(['is_tutor'])->group(function () {
    Route::resource('/tutor/dashboard', DashboardController::class)->names('tutor.dashboard');

    Route::resource('/tutor/pertemuan', PertemuanController::class)->names('tutor.pertemuan');
    Route::get('/tutor/pertemuan/ubahstatus/{id}', [PertemuanController::class, 'ubahstatus'])->name('tutor.pertemuan.ubahstatus');
    Route::resource('/tutor/anggota', TutorAnggotaController::class)->names('tutor.anggota');
});

// divisi
Route::middleware(['is_anggota'])->group(function () {
    Route::resource('/anggota/dashboard', AnggotaDashboardController::class)->names('anggota.dashboard');
    Route::resource('/anggota/peserta-pertemuan', PesertaPertemuanController::class)->names('anggota.peserta-pertemuan');
});

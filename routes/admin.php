<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Anggota\DashboardController as AnggotaDashboardController;
use App\Http\Controllers\Tutor\DashboardController;

Route::middleware(['is_admin'])->group(function () {
    Route::resource('/admin/user', UserController::class)->names('admin.user');
    Route::get('/admin/user/reset/{id}', [UserController::class, 'reset'])->name('admin.user.reset');
    Route::put('/admin/user/reset_password/{id}', [UserController::class, 'reset_password'])->name('admin.user.reset_password');
});

// lpm
Route::middleware(['is_tutor'])->group(function () {
    Route::resource('/tutor/dasboard', DashboardController::class)->names('tutor.dashboard');
});

// divisi
Route::middleware(['is_anggota'])->group(function () {
    Route::resource('/anggota/dasboard', AnggotaDashboardController::class)->names('anggota.dashboard');
});

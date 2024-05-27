<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    return "Cache cleared successfully";
});
Route::get('/not-found', function () {
    return view('not-found');
});

Route::get('/', function () {
    return redirect('login');
});

Route::get('/perbarui-password', [HomeController::class, 'perbarui_password'])->middleware(['auth'])->name('perbarui_password');
Route::post('/perbarui-password/updatepw', [HomeController::class, 'updatepw'])->middleware(['auth'])->name('perbaruipassword_new');
Route::resource('/dashboard', HomeController::class)->middleware(['auth'])->names('home');

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';

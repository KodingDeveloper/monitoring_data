<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\PublicController::class, 'index']);

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pegawai/export', [\App\Http\Controllers\PegawaiController::class, 'export'])->middleware(['auth', 'verified'])->name('pegawai.export');
Route::resource('/pegawai', \App\Http\Controllers\PegawaiController::class);//->middleware(['auth', 'verified'])
Route::post('/pegawai/import', [\App\Http\Controllers\PegawaiController::class, 'import'])->middleware(['auth', 'verified'])->name('pegawai.import');
Route::post('/tmp/import', [\App\Http\Controllers\PegawaiController::class, 'importTmp'])->middleware(['auth', 'verified'])->name('pegawai.importTmp');
Route::resource('/monitoring', \App\Http\Controllers\MonitoringController::class);//->middleware(['auth', 'verified']);

//Route::get('/pegawai', [\App\Http\Controllers\PegawaiController::class, 'index'])->middleware(['auth', 'verified'])->name('pegawai.index');
//Route::get('/pegawai/create', [\App\Http\Controllers\PegawaiController::class, 'create'])->middleware(['auth', 'verified'])->name('pegawai.create');
//Route::post('/pegawai/store', [\App\Http\Controllers\PegawaiController::class, 'store'])->middleware(['auth', 'verified'])->name('pegawai.store');
//Route::get('/pegawai/{id}/edit', [\App\Http\Controllers\PegawaiController::class, 'edit'])->middleware(['auth', 'verified'])->name('pegawai.edit');
//Route::put('/pegawai/{id}/update', [\App\Http\Controllers\PegawaiController::class, 'update'])->middleware(['auth', 'verified'])->name('pegawai.update');
//Route::delete('/pegawai/{id}', [\App\Http\Controllers\PegawaiController::class, 'destroy'])->middleware(['auth', 'verified'])->name('pegawai.destroy');

require __DIR__.'/auth.php';

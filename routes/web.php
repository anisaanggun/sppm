<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DataMesinController;
use App\Http\Controllers\DataPerawatanController;
use App\Http\Controllers\DataPerbaikanController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanMesinController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/dologin', [AuthController::class, 'dologin'])->name('dologin');

Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::post('/daftar-proses', [AuthController::class, 'daftar_proses'])->name('daftar-proses');

Route::get('/admin', [AdminController::class, 'index']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/beranda', [BerandaController::class, 'index']);
    Route::get('/jadwal', [JadwalController::class, 'index']);
    Route::get('/data-mesin', [DataMesinController::class, 'index'])->name('data-mesin.index');
    Route::resource('/data-mesin', DataMesinController::class);
    Route::post('/data-mesin/store', [DataMesinController::class, 'store'])->name('data-mesin.store');
    Route::get('/data-mesin/{id}/edit', [DataMesinController::class, 'edit'])->name('data-mesin.edit');
    Route::put('/data-mesin/{id}', [DataMesinController::class, 'update'])->name('data-mesin.update');
    Route::get('/data-perawatan', [DataPerawatanController::class, 'index']);
    Route::get('/data-perawatan/create', [DataPerawatanController::class, 'create'])->name('data-perawatan.create');
    Route::post('/data-perawatan/store', [DataPerawatanController::class, 'store'])->name('data-perawatan.store');
    Route::get('/data-perawatan/{id}/edit', [DataPerawatanController::class, 'edit'])->name('data-perawatan.edit');
    Route::put('/data-perawatan/{id}', [DataPerawatanController::class, 'update'])->name('data-perawatan.update');
    Route::get('/data-perbaikan', [DataPerbaikanController::class, 'index']);
    Route::get('/data-perbaikan/create', [DataPerbaikanController::class, 'create'])->name('data-perbaikan.create');
    Route::post('/data-perbaikan/store', [DataPerbaikanController::class, 'store'])->name('data-perbaikan.store');
    Route::get('/data-perbaikan/{id}/edit', [DataPerbaikanController::class, 'edit'])->name('data-perbaikan.edit');
    Route::put('/data-perbaikan/{id}', [DataPerbaikanController::class, 'update'])->name('data-perbaikan.update');
    Route::get('/laporan-mesin', [LaporanMesinController::class, 'index']);
    Route::post('/laporan-mesin/store', [LaporanMesinController::class, 'store'])->name('laporan-mesin.store');
    Route::get('/admin/create', [DataMesinController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [DataMesinController::class, 'store'])->name('admin.store');
});

Route::resource('/admin/data-mesin', \App\Http\Controllers\DataMesinController::class);

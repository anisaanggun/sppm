<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DataMesinController;
use App\Http\Controllers\DataPerawatanController;
use App\Http\Controllers\DataPerbaikanController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\TeknisiController;
use Illuminate\Support\Facades\Route;

//  jika user belum login
// Route::group(['middleware' => 'guest'], function() {
//     Route::get('/login', [AuthController::class, 'login'])->name('login');
//     Route::post('/login-proses', [AuthController::class, 'dologin'])->name('dologin');
// });

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/dologin', [AuthController::class, 'dologin'])->name('dologin');


    Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');
    Route::post('/daftar-proses', [AuthController::class, 'daftar_proses'])->name('daftar-proses');

    Route::get('/admin', [AdminController::class, 'index']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// untuk admin dan pegawai
// Route::group(['middleware' => ['auth', 'checkrole:1,2']], function() {
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::get('/redirect', [RedirectController::class, 'cek']);
// });


// untuk admin
// Route::group(['middleware' => ['auth', 'checkrole:1']], function() {
//     Route::get('/admin', [AdminController::class, 'index']);
// });

// untuk teknisi
// Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
//     Route::get('/teknisi', [TeknisiController::class, 'index']);

// });

// untuk customer
// Route::group(['middleware' => ['auth', 'checkrole:3']], function() {
//     Route::get('/customer', [CustomerController::class, 'index']);

// });

Route::group(['middleware' => ['auth']], function () {
    Route::get('/beranda', [BerandaController::class, 'index']);
    Route::get('/jadwal', [JadwalController::class, 'index']);
    Route::get('/data-mesin', [DataMesinController::class, 'index'])->name('data-mesin.index');
    Route::resource('/data-mesin', DataMesinController::class);
    Route::post('/data-mesin/store', [DataMesinController::class, 'store'])->name('data-mesin.store');
    Route::get('/data-mesin/{id}/edit', [DataMesinController::class, 'edit'])->name('data-mesin.edit');
    Route::put('/data-mesin/{id}', [DataMesinController::class, 'update'])->name('data-mesin.update');
    Route::get('/data-perawatan', [DataPerawatanController::class, 'index']);
    Route::get('/data-perbaikan', [DataPerbaikanController::class, 'index']);
    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/admin/create', [DataMesinController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [DataMesinController::class, 'store'])->name('admin.store');
});

Route::resource('/admin/data-mesin', \App\Http\Controllers\DataMesinController::class);

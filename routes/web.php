<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DataMesinController;
use App\Http\Controllers\DataPerawatanController;
use App\Http\Controllers\DataPerbaikanController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanMesinController;
use App\Http\Controllers\LaporanPerawatanController;
use App\Http\Controllers\LaporanPerbaikanController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Http\Controllers\SendEmailController;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/dologin', [AuthController::class, 'dologin'])->name('dologin');

Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::post('/daftar-proses', [AuthController::class, 'daftar_proses'])->name('daftar-proses');

Route::get('/admin', [AdminController::class, 'index']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda.index');
    Route::post('/beranda/store', [BerandaController::class, 'store'])->name('beranda.store');

    // Route::resource('/jadwal', JadwalController::class);
    // Route::get('/calendar', [JadwalController::class, 'index']);
    // Route::get('/events', [JadwalController::class, 'getEvents']);
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/jadwal/events', [JadwalController::class, 'getEvents'])->name('jadwal.events');


    Route::resource('/data-mesin', DataMesinController::class);
    Route::get('/data-mesin/{id}', [DataMesinController::class, 'show'])->name('data-mesin.show');

    Route::resource('/data-perawatan', DataPerawatanController::class);
    Route::resource('/data-perbaikan', DataPerbaikanController::class);

    Route::get('/laporan', [LaporanMesinController::class, 'index']);
    Route::get('/laporan-mesin', [LaporanMesinController::class, 'index'])->name('laporan-mesin.index');
    Route::post('/laporan-mesin/store', [LaporanMesinController::class, 'store'])->name('laporan-mesin.store');

    Route::get('/laporan-perawatan', [LaporanPerawatanController::class, 'index'])->name('laporan-perawatan.index');
    Route::post('/laporan-perawatan/store', [LaporanPerawatanController::class, 'store'])->name('laporan-perawatan.store');

    Route::get('/laporan-perbaikan', [LaporanPerbaikanController::class, 'index'])->name('laporan-perbaikan.index');
    Route::post('/laporan-perbaikan/store', [LaporanPerbaikanController::class, 'store'])->name('laporan-perbaikan.store');

    Route::resource('/brand', BrandController::class);
    Route::resource('/profil', ProfilController::class);

    Route::get('/send-email',function(){
        $data = [
            'name' => 'Anisa Anggun',
            'body' => 'Testing Kirim Email'
        ];

        Mail::to('anisaanggun81471@gmail.com')->send(new SendEmail($data));

        dd("Email Berhasil dikirim.");
    });

    Route::get('/send-email', [SendEmailController::class, 'index'])->name('kirim-email');

    Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');


});

// Route::resource('/admin/data-mesin', \App\Http\Controllers\DataMesinController::class);

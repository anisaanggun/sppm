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
use App\Mail\PerawatanSelesaiMail;
use App\Mail\perawatandoneEmail;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\DataTeknisiController;

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


    Route::resource('/data-mesin', DataMesinController::class)->except(['show']);
    Route::resource('/data-mesin_admin', DataMesinController::class)->except(['show']);
    Route::get('datamesin/{id}/detail', [DataMesinController::class, 'detail'])->name('data-mesin.detail');
    // Route::get('/data-mesin/{id}', [DataMesinController::class, 'show'])->name('data-mesin.show');
    // Route::get('/download-qr/{id}', [DataMesinController::class, 'downloadQr'])->name('download.qr');
    Route::get('data-mesin/download-qr/{id}', [DataMesinController::class, 'downloadQr'])->name('data-mesin.downloadQr');
    Route::get('/data-mesin/export_excel', [DataMesinController::class, 'export_excel'])->name('data-mesin.export_excel');

    Route::resource('/data-perawatan', DataPerawatanController::class)->except(['show']);
    Route::resource('data-perawatan-admin', DataPerawatanController::class)->except(['show']);
    Route::get('/data-perawatan/export_excel', [DataPerawatanController::class, 'export_excel'])->name('data-perawatan.export_excel');

    Route::resource('/data-perbaikan', DataPerbaikanController::class)->except(['show']);
    Route::get('/data-perbaikan/export_excel', [DataPerbaikanController::class, 'export_excel'])->name('data-perbaikan.export_excel');

    Route::get('/laporan', [LaporanMesinController::class, 'index']);
    Route::get('/laporan-mesin', [LaporanMesinController::class, 'index'])->name('laporan-mesin.index');
    Route::post('/laporan-mesin/store', [LaporanMesinController::class, 'store'])->name('laporan-mesin.store');

    Route::get('/laporan-perawatan', [LaporanPerawatanController::class, 'index'])->name('laporan-perawatan.index');
    Route::post('/laporan-perawatan/store', [LaporanPerawatanController::class, 'store'])->name('laporan-perawatan.store');

    Route::get('/laporan-perbaikan', [LaporanPerbaikanController::class, 'index'])->name('laporan-perbaikan.index');
    Route::post('/laporan-perbaikan/store', [LaporanPerbaikanController::class, 'store'])->name('laporan-perbaikan.store');

    Route::resource('/brand', BrandController::class);
    Route::resource('/profil', ProfilController::class);

    Route::resource('/pelanggan', DataPelangganController::class)->except(['show']);
    Route::resource('/pelanggan_admin', DataPelangganController::class)->except(['show']);
    Route::get('/pelanggan/export_excel', [DataPelangganController::class, 'export_excel'])->name('pelanggan.export_excel');

    Route::resource('/teknisi', DataTeknisiController::class)->except(['show']);
    Route::get('/teknisi/export_excel', [DataTeknisiController::class, 'export_excel'])->name('teknisi.export_excel');


    // Route::get('/send-email',function(){
    //     $data = [
    //         'name' => 'Anisa Anggun',
    //         'body' => 'Testing Kirim Email'
    //     ];

    //     Mail::to('anisaanggun81471@gmail.com')->send(new SendEmail($data));

    //     dd("Email Berhasil dikirim.");
    // });

    // Route::get('/send-email', [SendEmailController::class, 'index'])->name('kirim-email');
    // Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');

    Route::get('/mail/send', function () {
        $data = [
            'subject' => 'Testing Kirim Email',
            'title' => 'Testing Kirim Email',
            'body' => 'Ini adalah email uji coba dari Tutorial Laravel: Send Email Via SMTP GMAIL @ qadrLabs.com'
        ];

        Mail::to('anschill006@gmail.com')->send(new perawatandoneEmail($data));
    });

    Route::get('/test-email', function () {
        $data = [
            'subject' => 'Test Email',
            'title' => 'Test Email Title',
            'body' => 'This is a test email body.'
        ];

        Mail::to('anschill006@gmail.com')->send(new PerawatanSelesaiMail($data));

        return 'Email sent!';
    });


});

// Route::resource('/admin/data-mesin', \App\Http\Controllers\DataMesinController::class);

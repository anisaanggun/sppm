
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\DataController;

//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'dologin']);

});

// untuk admin dan pegawai
Route::group(['middleware' => ['auth', 'checkrole:1,2']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/redirect', [RedirectController::class, 'cek']);
});


// untuk admin
Route::group(['middleware' => ['auth', 'checkrole:1']], function() {
    Route::get('/admin', [AdminController::class, 'index']);
});

// untuk teknisi
Route::group(['middleware' => ['auth', 'checkrole:2']], function() {
    Route::get('/teknisi', [TeknisiController::class, 'index']);

});

// untuk customer
Route::group(['middleware' => ['auth', 'checkrole:3']], function() {
    Route::get('/customer', [CustomerController::class, 'index']);

});




Route::group(['middleware' => ['auth']], function(){
    Route::get('/beranda', [BerandaController::class, 'index']);
    Route::get('/jadwal', [JadwalController::class, 'index']);
});

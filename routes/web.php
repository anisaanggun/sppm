<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\CustomerController;

//  jika user belum login
Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'dologin']);

});

// untuk superadmin dan pegawai
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
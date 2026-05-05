<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\WelcomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/tentang', [WelcomeController::class, 'tentang'])->name('tentang');

Route::group(['prefix' => 'rekomendasi'], function () {
    Route::get('/', [RekomendasiController::class, 'index'])->name('rekomendasi');
    Route::post('/store', [RekomendasiController::class, 'store'])->name('store');
    Route::get('/hasil', [RekomendasiController::class, 'hasil'])->name('hasil');
    Route::get('/detail/{id}', [RekomendasiController::class, 'detail'])->name('detail');
});


// Login route 
Route::get('/masuk', [AuthController::class, 'index'])->name('login');
Route::post('/masuk', [AuthController::class, 'store'])->name('login.store');
Route::get('/lupa-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/lupa-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('/keluar', [AuthController::class, 'logout'])->name('logout');

// sementara TANPA middleware dan auth controller, nanti ditambahkan setelah auth selesai dibuat
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
        Route::get('/', [PerusahaanController::class, 'index'])->name('index');
        Route::post('/list', [PerusahaanController::class, 'list'])->name('list');
        Route::get('/show_ajax/{id}', [PerusahaanController::class, 'show_ajax'])->name('show_ajax');
        Route::get('/create_ajax', [PerusahaanController::class, 'create_ajax'])->name('create_ajax');
        Route::post('/store_ajax', [PerusahaanController::class, 'store_ajax'])->name('store_ajax');
        Route::get('/edit_ajax/{id}', [PerusahaanController::class, 'edit_ajax'])->name('edit_ajax');
        Route::put('/update_ajax/{id}', [PerusahaanController::class, 'update_ajax'])->name('update_ajax');
        Route::get('/delete_ajax/{id}', [PerusahaanController::class, 'delete_ajax'])->name('delete_ajax');
        Route::post('/destroy_ajax/{id}', [PerusahaanController::class, 'destroy_ajax'])->name('destroy_ajax');
    });

    Route::prefix('lowongan')->name('lowongan.')->group(function () {
        Route::get('/', [LowonganController::class, 'index'])->name('index');
        Route::post('/list', [LowonganController::class, 'list'])->name('list');
        Route::get('/create_ajax', [LowonganController::class, 'create_ajax'])->name('create_ajax');
        Route::post('/store_ajax', [LowonganController::class, 'store_ajax'])->name('store_ajax');
        Route::get('/edit_ajax/{id}', [LowonganController::class, 'edit_ajax'])->name('edit_ajax');
        Route::put('/update_ajax/{id}', [LowonganController::class, 'update_ajax'])->name('update_ajax');
        Route::delete('/delete_ajax/{id}', [LowonganController::class, 'delete_ajax'])->name('delete_ajax');
    });

    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::post('/update', [AdminController::class, 'profil_update'])->name('update');
        Route::post('/change_password', [AdminController::class, 'profil_changePassword'])->name('change_password');
        Route::post('/update_picture', [AdminController::class, 'profil_updatePicture'])->name('update_picture');
    });
});

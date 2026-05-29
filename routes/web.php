<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PengukuranController;

// Autentikasi
Auth::routes();

// Route untuk halaman utama
Route::get('/', [AnakController::class, 'index'])->name('home');
Route::permanentRedirect('/home', '/');
Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

// Route untuk halaman anak
Route::get('/create', [AnakController::class, 'create'])->name('anak.create');
Route::post('/', [AnakController::class, 'store'])->name('anak.store');
Route::get('/{anak}/edit', [AnakController::class, 'edit'])->name('anak.edit');
Route::put('/{anak}', [AnakController::class, 'update'])->name('anak.update');
Route::delete('/{anak}', [AnakController::class, 'destroy'])->name('anak.destroy');

// Route untuk halaman artikel
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index')->middleware('is_admin');
Route::get('/artikel/create', [ArtikelController::class, 'create'])->name('artikel.create')->middleware('is_admin');
Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store')->middleware('is_admin');
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get('/artikel/{artikel}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit')->middleware('is_admin');
Route::put('/artikel/{artikel}', [ArtikelController::class, 'update'])->name('artikel.update')->middleware('is_admin');
Route::delete('/artikel/{artikel}', [ArtikelController::class, 'destroy'])->name('artikel.destroy')->middleware('is_admin');

// Route untuk halaman jadwal
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
Route::get('/adminjadwal', [JadwalController::class, 'adminJadwal'])->name('admin.jadwal')->middleware('is_admin');

// Route untuk halaman FAQ
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/adminfaq', [FaqController::class, 'adminFAQ'])->name('admin.faq')->middleware('is_admin');

// Route untuk halaman pengukuran
Route::get('/{anak}/pengukuran', [PengukuranController::class, 'index'])->name('pengukuran.index');
Route::get('/{anak}/pengukuran/create', [PengukuranController::class, 'create'])->name('pengukuran.create');
Route::post('/{anak}/pengukuran/', [PengukuranController::class, 'store'])->name('pengukuran.store');
Route::get('/{anak}/pengukuran/{pengukuran}/edit', [PengukuranController::class, 'edit'])->name('pengukuran.edit');
Route::put('/{anak}/pengukuran/{pengukuran}', [PengukuranController::class, 'update'])->name('pengukuran.update');
Route::get('/{anak}/pengukuran/hasil', [PengukuranController::class, 'hasil'])->name('pengukuran.hasil');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/faq', [App\Http\Controllers\FaqController::class, 'index'])->name('faq');
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{artikel}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

Route::get('/adminfaq', [App\Http\Controllers\FaqController::class, 'adminFAQ'])->name('admin.faq')->middleware('is_admin');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/artikel', [App\Http\Controllers\ArtikelController::class, 'index'])->name('artikel.index')->middleware('is_admin');
Route::get('/artikel/create', [App\Http\Controllers\ArtikelController::class, 'create'])->name('artikel.create')->middleware('is_admin');
Route::post('/artikel', [App\Http\Controllers\ArtikelController::class, 'store'])->name('artikel.store')->middleware('is_admin');
Route::get('/artikel/{artikel}', [App\Http\Controllers\ArtikelController::class, 'show'])->name('artikel.show');
Route::get('/artikel/{artikel}/edit', [App\Http\Controllers\ArtikelController::class, 'edit'])->name('artikel.edit')->middleware('is_admin');
Route::put('/artikel/{artikel}', [App\Http\Controllers\ArtikelController::class, 'update'])->name('artikel.update')->middleware('is_admin');
Route::delete('/artikel/{artikel}', [App\Http\Controllers\ArtikelController::class, 'destroy'])->name('artikel.destroy')->middleware('is_admin');
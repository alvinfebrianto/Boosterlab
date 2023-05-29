<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('artikel', ArtikelController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
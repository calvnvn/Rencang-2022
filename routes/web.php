<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Website Rencang
|--------------------------------------------------------------------------
|
| Semua halaman bersifat statis, jadi cukup Route::view tanpa controller.
| Konvensi: nama route = slug URL, nama view = resources/views/pages/{slug}.
| URL tidak dikenal otomatis menampilkan resources/views/errors/404.blade.php.
|
*/

Route::view('/', 'pages.home', ['title' => 'Rencang'])->name('home');

Route::view('/what-we-do', 'pages.what-we-do', ['title' => 'Rencang - What We Do'])->name('what-we-do');
Route::view('/who-we-are', 'pages.who-we-are', ['title' => 'Rencang - Who We Are'])->name('who-we-are');
Route::view('/event', 'pages.event', ['title' => 'Rencang - Event'])->name('event');

// Halaman program (arsip kegiatan Generasi 13 & 14).
Route::view('/gedurasi', 'pages.gedurasi', ['title' => 'Rencang - Gedurasi'])->name('gedurasi');
Route::view('/sentera', 'pages.sentera', ['title' => 'Rencang - Sentera'])->name('sentera');
Route::view('/sharing-caring-helping', 'pages.sharing-caring-helping', ['title' => 'Rencang - SCH'])->name('sharing-caring-helping');
Route::view('/rencang-cepat-tanggap', 'pages.rencang-cepat-tanggap', ['title' => 'Rencang - RCT'])->name('rencang-cepat-tanggap');
Route::view('/keakraban', 'pages.keakraban', ['title' => 'Rencang - Keakraban'])->name('keakraban');

Route::view('/soon', 'pages.coming-soon', ['title' => 'Coming Soon'])->name('coming-soon');

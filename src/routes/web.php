<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/compte', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

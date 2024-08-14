<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('home');})->name('home');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('auth.loginForm');
    Route::post('/login', 'login')->name('auth.login');
    Route::get('/logout', 'logout')->name('auth.logout');
});

Route::resource('user', UserController::class);

<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('home');})->name('home');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('auth.loginform');
    Route::post('/login', 'login')->name('auth.login');
    Route::get('/logout', 'logout')->name('auth.logout');
});

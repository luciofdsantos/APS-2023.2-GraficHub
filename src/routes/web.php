<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('auth.loginForm');
    Route::post('/login', 'login')->name('auth.login');
    Route::get('/logout', 'logout')->name('auth.logout');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user/create', 'create')->name('user.create');
    Route::post('/user', 'store')->name('user.store');
    Route::get('/user/{apelido}', 'showPerfil')->name('user.perfil');
    Route::get('/user/{apelido}/edit', 'edit')->name('user.edit');
    Route::put('/user/{apelido}', 'update')->name('user.update');
});

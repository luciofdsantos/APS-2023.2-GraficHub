<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/seguindo', 'personalizado')->middleware(Authenticate::class)->name('home.personalizado');
});

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
    Route::post('/user/{id}', 'updateDisponibility')->name('user.updateDisp');
    Route::post('/user/follow/{id}', 'follow')->name('user.follow');
    Route::post('/user/unfollow/{id}', 'unfollow')->name('user.unfollow');
    Route::get('/user/{apelido}/seguidores', 'seguidores')->middleware(Authenticate::class)->name('user.seguidores');
    Route::get('/user/{apelido}/seguindo', 'seguindo')->middleware(Authenticate::class)->name('user.seguindo');
});

Route::controller(ProjectController::class)->group(function () {
    Route::get('/project/create', 'create')->name('project.create');
    Route::post('/project', 'store')->name('project.store');
    Route::get('/project/{id}', 'show')->name('project.show');
    Route::get('/project/{id}/edit', 'edit')->name('project.edit');
    Route::put('/project/{id}', 'update')->name('project.update');
    Route::delete('/project/{id}', 'destroy')->name('project.delete');
    Route::get('/project/favoritar/{id}', 'favoritar')->middleware(Authenticate::class)->name('project.favoritar');
    Route::get('/project/desfavoritar/{id}', 'desfavoritar')->middleware(Authenticate::class)->name('project.desfavoritar');
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/seguindo', 'personalizado')->name('home.personalizado');
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
    Route::get('/user/{apelido}/seguidores', 'seguidores')->name('user.seguidores');
    Route::get('/user/{apelido}/seguindo', 'seguindo')->name('user.seguindo');
});

Route::controller(ProjectController::class)->group(function () {
    Route::get('/project/create', 'create')->name('project.create');
    Route::post('/project', 'store')->name('project.store');
    Route::get('/project/{id}', 'show')->name('project.show');
    Route::get('/project/{id}/edit', 'edit')->name('project.edit');
    Route::put('/project/{id}', 'update')->name('project.update');
    Route::delete('/project/{id}', 'destroy')->name('project.delete');
    Route::post('/project/favoritar/{id}', 'favoritar')->name('project.favoritar');
    Route::post('/project/desfavoritar/{id}', 'desfavoritar')->name('project.desfavoritar');
});

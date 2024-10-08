<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/seguindo', 'personalizado')->middleware(Authenticate::class)->name('home.personalizado');
    Route::get('/busca', 'busca')->name('home.busca');
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
    Route::get('/user/follow/{apelido}/{id}', 'follow')->middleware(Authenticate::class)->name('user.follow');
    Route::get('/user/unfollow/{apelido}/{id}', 'unfollow')->middleware(Authenticate::class)->name('user.unfollow');
    Route::get('/user/{apelido}/favoritos', 'favoritos')->middleware(Authenticate::class)->name('user.favoritos');
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
    Route::get('/project/curtir/{id}', 'curtir')->middleware(Authenticate::class)->name('project.curtir');
    Route::get('/project/descurtir/{id}', 'descurtir')->middleware(Authenticate::class)->name('project.descurtir');
    Route::get('/project/favorito/{id}', 'favorito')->name('project.favorito');
    Route::get('/project/curtido/{id}', 'curtido')->name('project.curtido');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('/project/comment', 'store')->name('comment.store');
    Route::delete('/project/comment/{comment_id}', 'destroy')->name('comment.delete');
});

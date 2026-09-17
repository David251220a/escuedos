<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\GrupoUsuarioController;

Route::get('/', [WebController::class, 'index'])->name('web.index');
Route::get('/institucional', [WebController::class, 'institucional'])->name('web.institucional');
Route::get('/noticias', [WebController::class, 'noticias'])->name('web.noticias');
Route::get('/noticias/{noticia:slug}', [WebController::class,'noticia'])->name('web.noticia');
Route::get('/docentes', [WebController::class, 'docentes'])->name('web.docentes');

Route::get('/logout', [LoginController::class, 'logout']);

Auth::routes(['register' => false]);

Route::group([
    'middleware' => 'auth',
    'prefix' => 'portal',
], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/noticias', [NoticiaController::class, 'index'])->name('noticia.index');
    Route::get('/noticias/create', [NoticiaController::class, 'create'])->name('noticia.create');
    Route::post('/noticias/create', [NoticiaController::class, 'store'])->name('noticia.store');
    Route::get('/noticias/{noticia}/edit', [NoticiaController::class, 'edit'])->name('noticia.edit');
    Route::post('/noticias/{noticia}/edit', [NoticiaController::class, 'update'])->name('noticia.update');
    Route::get('/noticias/{noticia}/ver', [NoticiaController::class, 'show'])->name('noticia.show');

    Route::resource('/users', UsuarioController::class)->names('user');
    Route::resource('/roles', GrupoUsuarioController::class)->names('role');
    Route::get('/permiso-crear', [GrupoUsuarioController::class, 'permiso_crear'])->name('role.permiso_crear');
    Route::post('/permiso-crear', [GrupoUsuarioController::class, 'permiso_crear_post'])->name('role.permiso_crear_post');

    Route::resource('/docentes', DocenteController::class)->except(['show'])->names('docente');


});

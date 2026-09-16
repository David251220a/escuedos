<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->name('web.index');
Route::get('/institucional', [WebController::class, 'institucional'])->name('web.institucional');
Route::get('/noticias', [WebController::class, 'noticias'])->name('web.noticias');
Route::get('/noticias/{noticia}', [WebController::class, 'noticia'])->name('web.noticia');
Route::get('/docentes', [WebController::class, 'docentes'])->name('web.docentes');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

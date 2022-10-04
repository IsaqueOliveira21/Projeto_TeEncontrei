<?php

use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'formLogin'])->name('user.login');
Route::post('/login', [UserController::class, 'postLogin'])->name('user.postLogin');
Route::get('/naoAutorizado', [UserController::class, 'naoAutorizado'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/administracao/restrita', [UserController::class, 'administracaoRestrita'])->middleware('auth')->name('administracao.restrita');

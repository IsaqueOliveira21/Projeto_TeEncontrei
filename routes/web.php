<?php

use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'formLogin'])->name('user.login');
Route::post('/login', [UserController::class, 'postLogin'])->name('user.postLogin');
Route::get('/naoAutorizado', [UserController::class, 'naoAutorizado'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/administracao/restrita', [UserController::class, 'administracaoRestrita'])->middleware('auth')->name('administracao.restrita');

Route::prefix('usuario')->controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('index', 'index')->name('user.index');
    Route::get('', 'create')->name('user.create');
    Route::post('', 'store')->name('user.store');
    Route::get('edit/{user?}', 'edit')->name('user.edit');
    Route::put('{user?}', 'update')->name('user.update');
    Route::get('redefinirSenha/{user}', 'redefinirSenha')->name('user.redefinir.senha');
    Route::get('delete', 'delete')->name('user.delete');
});

Route::prefix('instituicao')->controller(InstituicaoController::class)->middleware('auth')->group(function () {
    Route::get('index', 'index')->name('instituicao.index');
});

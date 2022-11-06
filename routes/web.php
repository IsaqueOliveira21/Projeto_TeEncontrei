<?php

use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesabrigadoController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\InstituicaoController;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'formLogin'])->name('user.login');
Route::post('/login', [UserController::class, 'postLogin'])->name('user.postLogin');
Route::get('/naoAutorizado', [UserController::class, 'naoAutorizado'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');

Route::prefix('administracao')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'administracao'])->name('administracao.dashboard');

    Route::prefix('usuario')->controller(UserController::class)->group(function () {
        Route::get('index', 'index')->name('user.index');
        Route::get('', 'create')->name('user.create');
        Route::post('', 'store')->name('user.store');
        Route::get('edit/{user?}', 'edit')->name('user.edit');
        Route::put('{user?}', 'update')->name('user.update');
        Route::get('redefinirSenha/{user}', 'redefinirSenha')->name('user.redefinir.senha');
        Route::get('delete', 'delete')->name('user.delete');
    });

    Route::prefix('instituicao')->controller(InstituicaoController::class)->group(function () {
        Route::get('index', 'index')->name('instituicao.index');
        Route::get('edit/{instituicao}', 'edit')->name('instituicao.edit');
        Route::get('/{instituicao?}', 'buscarEndereco')->name('instituicao.buscarEndereco');
        Route::post('store', 'store')->name('instituicao.store');
        Route::put('update/{instituicao}', 'update')->name('instituicao.update');
    });

    Route::prefix('endereco')->controller(EnderecoController::class)->group(function() {
        Route::post('buscarEndereco/{instituicao?}', 'buscarEnderecoInstituicao')->name('endereco.buscarEndereco');
        Route::post('store/{instituicao?}', 'storeInstituicao')->name('endereco.store');
        Route::get('index', 'index')->name('endereco.index');
        Route::get('edit/{endereco}', 'edit')->name('endereco.edit');
        Route::put('update/{endereco}', 'update')->name('endereco.update');
        Route::get('delete', 'delete')->name('endereco.delete');
    });
});

Route::prefix('instituicao')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'instituicao'])->name('instituicao.dashboard');

    Route::prefix('colaborador')->controller(ColaboradorController::class)->group(function () {
        Route::get('index', 'index')->name('colaborador.index');
        Route::middleware('CheckCargoColaborador')->group(function () {
            Route::get('buscarEndereco/{colaborador?}', 'buscarEndereco')->name('colaborador.buscarEndereco');
            Route::post('buscarEnderecoPost/{colaborador?}', 'buscarEnderecoPost')->name('colaborador.buscarEndereco.post');
            Route::post('buscarEnderecoStore/{colaborador?}', 'buscarEnderecoStore')->name('colaborador.buscarEndereco.store');
            Route::post('store', 'store')->name('colaborador.store');
            Route::get('edit/{colaborador}', 'edit')->name('colaborador.edit');
            Route::put('update/{colaborador}', 'update')->name('colaborador.update');
            Route::get('status/{colaborador}', 'status')->name('colaborador.status');
        });
    });

    Route::prefix('desabrigado')->controller(DesabrigadoController::class)->group(function () {
        Route::get('index', 'index')->name('desabrigado.index');
        Route::get('create', 'create')->name('desabrigado.create');
        Route::post('store', 'store')->name('desabrigado.store');
        Route::get('edit/{desabrigado}', 'edit')->name('desabrigado.edit');
        Route::put('update/{desabrigado}', 'update')->name('desabrigado.update');
        Route::get('delete', 'delete')->name('desabrigado.delete');
    });

    Route::prefix('visita')->controller(ColaboradorController::class)->group(function () {
        Route::get('index', 'index')->name('visita.index');
        Route::get('create', 'create')->name('visita.create');
    });
});

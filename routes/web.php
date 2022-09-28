<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return 'Utilizando Rotas melhor!';
});

Route::get('/um/dois/tres', function(){
    return 'Um/Dois/Três';
});

Route::get('parametro/{nome?}', function($nome = null){
    return !is_null($nome) ? "olá $nome" : "olá visitante";
});

Route::get('/login/{email}/{password}', [UserController::class, 'login']);

// Route::get('/user/store/{name}/{last_name}/{email}/{password?}', [UserController::class, 'store']);
Route::get('/user/store', [UserController::class, 'store']);

Route::get('/user/update/{user}', [UserController::class, 'update']);

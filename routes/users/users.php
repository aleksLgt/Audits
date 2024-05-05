<?php

use App\Http\ApiV1\Modules\Users\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('', [UsersController::class, 'search'])->name('Пользователи|Список всех пользователей');
Route::get('{id}', [UsersController::class, 'get'])->name('Пользователи|Информация о пользователе')->whereNumber('id');
Route::post('', [UsersController::class, 'create'])->name('Пользователи|Создать пользователя');
Route::put('{id}', [UsersController::class, 'update'])->name('Пользователи|Обновить информацию о пользователе')->whereNumber('id');

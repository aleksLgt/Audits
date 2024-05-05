<?php

use App\Http\ApiV1\Modules\Audits\Controllers\AuditsController;

Route::post('', [AuditsController::class, 'create'])->name('Аудиты|Создать аудит');
Route::get('{id}', [AuditsController::class, 'get'])->name('Аудиты|Информация о аудите')->whereNumber('id');
Route::get('', [AuditsController::class, 'search'])->name('Аудиты|Список всех аудитов');
Route::put('{id}', [AuditsController::class, 'update'])->name('Аудиты|Обновить информацию о аудите')->whereNumber('id');
Route::delete('{id}', [AuditsController::class, 'delete'])->name('Аудиты|Удалить аудит')->whereNumber('id');

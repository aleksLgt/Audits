<?php

use App\Http\ApiV1\Modules\AuditBlocks\Controllers\AuditBlocksController;

Route::post('', [AuditBlocksController::class, 'create'])->name('Блоки аудита|Создать блок аудита');
Route::get('{id}', [AuditBlocksController::class, 'get'])->name('Блоки аудита|Информация о блоке аудита')->whereNumber('id');
Route::get('', [AuditBlocksController::class, 'search'])->name('Блоки аудита|Список всех блоков аудита');
Route::put('{id}', [AuditBlocksController::class, 'update'])->name('Блоки аудита|Обновить информацию о блоке аудита')->whereNumber('id');
Route::delete('{id}', [AuditBlocksController::class, 'delete'])->name('Блоки аудита|Удалить блок аудита')->whereNumber('id');

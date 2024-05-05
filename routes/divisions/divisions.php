<?php

use App\Http\ApiV1\Modules\Divisions\Controllers\DivisionsController;

Route::post('', [DivisionsController::class, 'create'])->name('Подразделения|Создать подразделение');
Route::get('{id}', [DivisionsController::class, 'get'])->name('Подразделения|Информация о подразделении')->whereNumber('id');
Route::get('', [DivisionsController::class, 'search'])->name('Подразделения|Список всех подразделений');
Route::put('{id}', [DivisionsController::class, 'update'])->name('Подразделения|Обновить информацию о подразделении')->whereNumber('id');
Route::delete('{id}', [DivisionsController::class, 'delete'])->name('Подразделения|Удалить подразделение')->whereNumber('id');
Route::get('report', [DivisionsController::class, 'report'])->name('Подразделения|Отчет по подразделениям');

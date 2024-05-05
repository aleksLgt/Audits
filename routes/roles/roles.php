<?php

use App\Http\ApiV1\Modules\Users\Controllers\RolesController;

Route::get('', [RolesController::class, 'search'])->name('Роли|Список всех ролей');
Route::post('{id}/permissions', [RolesController::class, 'addPermissions'])->name('Роли|Выдать роли права на действия')->whereNumber('id');

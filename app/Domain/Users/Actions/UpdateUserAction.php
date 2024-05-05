<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;
use App\Domain\Users\Models\RoleUser;
use Illuminate\Support\Facades\DB;
use Throwable;

class UpdateUserAction
{
    /**
     * @throws Throwable
     */
    public function execute(array $requestData, int $userId): void
    {
        if (isset($requestData['password'])) {
            $requestData['password'] = bcrypt($requestData['password']);
        }
        DB::transaction(function () use ($requestData, $userId) {
            User::find($userId)->update($requestData);
            RoleUser::whereUserId($userId)->delete();
            if (isset($requestData['roles'])) {
                foreach ($requestData['roles'] as $roleId) {
                    User::find($userId)->roles()->attach($roleId);
                }
            }
        });
    }
}

<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\Role;
use Illuminate\Support\Facades\DB;

class AddPermissionsAction
{
    /**
     * @throws \Throwable
     */
    public function execute(array $requestData, int $roleId): void
    {
        DB::transaction(function () use ($requestData, $roleId) {
            foreach ($requestData['permissions'] as $permissionId) {
                Role::find($roleId)->permissions()->attach($permissionId);
            }
        });
    }
}

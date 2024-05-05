<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class CreateUserAction
{
    /**
     * @throws Throwable
     */
    public function execute(array $data): void
    {
        $data['password'] = bcrypt($data['password']);
        DB::transaction(function () use ($data) {
            $user = User::create($data);
            foreach ($data['roles'] as $roleId) {
                $user->roles()->attach($roleId);
            }
        });
    }
}

<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;

class GetUserAction
{
    public function execute(int $userId): array
    {
        return User::whereId($userId)
            ->with('roles')
            ->get()
            ->toArray();
    }
}

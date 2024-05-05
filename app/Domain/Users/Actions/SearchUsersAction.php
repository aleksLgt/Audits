<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\User;

class SearchUsersAction
{
    public function execute(): array
    {
        return User::select(['id', 'name', 'post', 'created_at', 'updated_at'])
            ->with('roles')
            ->get()
            ->toArray();
    }
}

<?php

namespace App\Domain\Users\Actions;

use App\Domain\Users\Models\Role;

class SearchRolesAction
{
    public function execute(): array
    {
        return Role::get()->toArray();
    }
}

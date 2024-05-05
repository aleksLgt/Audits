<?php

namespace App\Domain\Divisions\Actions;

use App\Domain\Divisions\Models\Division;

class SearchDivisionsAction
{
    public function execute(): array
    {
        return Division::get()->toArray();
    }
}

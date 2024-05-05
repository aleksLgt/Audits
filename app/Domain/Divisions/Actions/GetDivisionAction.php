<?php

namespace App\Domain\Divisions\Actions;

use App\Domain\Divisions\Models\Division;

class GetDivisionAction
{
    public function execute(int $divisionId): array
    {
        return Division::whereId($divisionId)->get()->toArray();
    }
}

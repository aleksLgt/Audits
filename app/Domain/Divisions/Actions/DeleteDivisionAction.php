<?php

namespace App\Domain\Divisions\Actions;

use App\Domain\Divisions\Models\Division;

class DeleteDivisionAction
{
    public function execute(int $divisionId): void
    {
        Division::destroy($divisionId);
    }
}

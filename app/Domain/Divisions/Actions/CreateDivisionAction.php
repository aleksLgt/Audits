<?php

namespace App\Domain\Divisions\Actions;

use App\Domain\Divisions\Models\Division;

class CreateDivisionAction
{
    public function execute(array $data): array
    {
        return Division::create($data)->toArray();
    }
}

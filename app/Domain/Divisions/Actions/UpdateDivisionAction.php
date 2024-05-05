<?php

namespace App\Domain\Divisions\Actions;

use App\Domain\Divisions\Models\Division;

class UpdateDivisionAction
{
    public function execute(array $data, int $id): array
    {
        Division::find($id)->update($data);

        return Division::find($id)->toArray();
    }
}

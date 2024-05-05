<?php

namespace App\Domain\Audits\Actions;

use App\Domain\Audits\Models\Audit;
use App\Domain\Audits\Models\AuditQuestionAnswer;

class DeleteAuditAction
{
    public function execute(int $id): void
    {
        AuditQuestionAnswer::whereAuditId($id)->delete();
        Audit::find($id)->delete();
    }
}

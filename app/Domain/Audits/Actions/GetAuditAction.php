<?php

namespace App\Domain\Audits\Actions;

use App\Domain\Audits\Models\Audit;

class GetAuditAction
{
    public function execute(int $id): array
    {
        return Audit::whereId($id)
            ->with('division')
            ->with('user')
            ->with('auditQuestionAnswers')
            ->with('auditQuestionAnswers.question')
            ->with('auditQuestionAnswers.answer')
            ->get()
            ->toArray();
    }
}

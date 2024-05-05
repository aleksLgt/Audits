<?php

namespace App\Domain\Audits\Actions;

use App\Domain\Audits\Models\Audit;

class SearchAuditsAction
{
    public function execute(): array
    {
        return Audit::with('division')
            ->with('user')
            ->with('auditQuestionAnswers')
            ->with('auditQuestionAnswers.question')
            ->with('auditQuestionAnswers.answer')
            ->get()
            ->toArray();
    }
}

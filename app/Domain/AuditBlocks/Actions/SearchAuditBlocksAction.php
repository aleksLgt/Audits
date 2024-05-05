<?php

namespace App\Domain\AuditBlocks\Actions;

use App\Domain\AuditBlocks\Models\AuditBlock;

class SearchAuditBlocksAction
{
    public function execute(): array
    {
        return AuditBlock::with([
                'auditBlockQuestions',
                'auditBlockQuestions.auditBlockQuestionAnswers'
            ])
            ->get()
            ->toArray();
    }
}

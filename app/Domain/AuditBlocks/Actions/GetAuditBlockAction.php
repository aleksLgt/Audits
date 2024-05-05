<?php

namespace App\Domain\AuditBlocks\Actions;

use App\Domain\AuditBlocks\Models\AuditBlock;

class GetAuditBlockAction
{
    public function execute(int $id): array
    {
        return AuditBlock::whereId($id)
            ->with([
                'auditBlockQuestions',
                'auditBlockQuestions.auditBlockQuestionAnswers'
            ])
            ->get()
            ->toArray();
    }
}

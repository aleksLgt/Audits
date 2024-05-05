<?php

namespace App\Domain\AuditBlocks\Actions;

use App\Domain\AuditBlocks\Models\AuditBlock;
use App\Domain\AuditBlocks\Models\AuditBlockQuestion;
use App\Domain\AuditBlocks\Models\AuditBlockQuestionAnswer;

class DeleteAuditBlockAction
{
    public function execute(int $id): void
    {
        $questions = AuditBlockQuestion::whereAuditBlockId($id)->get();
        $questionIds = $questions->pluck('id')->toArray();

        AuditBlockQuestionAnswer::whereIn('audit_block_question_id', $questionIds)->delete();
        AuditBlockQuestion::whereIn('id', $questionIds)->delete();
        AuditBlock::destroy($id);
    }
}

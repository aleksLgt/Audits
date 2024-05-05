<?php

namespace App\Domain\AuditBlocks\Actions;

use App\Domain\AuditBlocks\Models\AuditBlock;
use App\Domain\AuditBlocks\Models\AuditBlockQuestion;
use App\Domain\AuditBlocks\Models\AuditBlockQuestionAnswer;

class CreateAuditBlockAction
{
    public function execute(array $data): array
    {
        $questions = $data['questions'] ?? [];
        unset($data['questions']);

        $auditBlock = AuditBlock::create($data);

        foreach ($questions as $question) {
            $answers = $question['answers'] ?? [];
            unset($question['answers']);

            $question = AuditBlockQuestion::create(array_merge($question, ['audit_block_id' => $auditBlock->id]));

            foreach ($answers as $answer) {
                AuditBlockQuestionAnswer::create(array_merge($answer, ['audit_block_question_id' => $question->id]));
            }
        }

        return $auditBlock->whereId($auditBlock->id)
            ->with('auditBlockQuestions')
            ->with('auditBlockQuestions.auditBlockQuestionAnswers')
            ->get()
            ->toArray();
    }
}

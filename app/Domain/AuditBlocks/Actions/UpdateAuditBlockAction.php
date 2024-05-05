<?php

namespace App\Domain\AuditBlocks\Actions;

use App\Domain\AuditBlocks\Models\AuditBlock;
use App\Domain\AuditBlocks\Models\AuditBlockQuestion;
use App\Domain\AuditBlocks\Models\AuditBlockQuestionAnswer;

class UpdateAuditBlockAction
{
    public function execute(int $id, array $data): array
    {
        AuditBlock::find($id)->update($data);
        $questionIds = AuditBlockQuestion::whereAuditBlockId($id)->get()->pluck('id')->toArray();

        AuditBlockQuestionAnswer::whereIn('audit_block_question_id', $questionIds)->delete();
        AuditBlockQuestion::whereIn('id', $questionIds)->delete();

        $questions = $data['questions'] ?? [];
        unset($data['questions']);

        foreach ($questions as $question) {
            $answers = $question['answers'] ?? [];
            unset($question['answers']);

            $question = AuditBlockQuestion::updateOrCreate(array_merge($question, ['audit_block_id' => $id]));

            foreach ($answers as $answer) {
                AuditBlockQuestionAnswer::updateOrCreate(array_merge($answer, ['audit_block_question_id' => $question->id]));
            }
        }

        return AuditBlock::whereId($id)
            ->with('auditBlockQuestions')
            ->with('auditBlockQuestions.auditBlockQuestionAnswers')
            ->get()
            ->toArray();
    }
}

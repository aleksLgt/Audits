<?php

namespace App\Domain\Divisions\Actions;

use App\Domain\AuditBlocks\Models\AuditBlockQuestion;
use App\Domain\AuditBlocks\Models\AuditBlockQuestionAnswer;
use App\Domain\Audits\Models\AuditQuestionAnswer;
use App\Domain\Divisions\Models\Division;
use Arr;

class GetReportByDivisionsAction
{
    public function execute(): array
    {
        $divisions = Division::query()->with('audits')->get();
        $auditBlockQuestions = AuditBlockQuestion::all()->groupBy('audit_block_id')->toArray();

        foreach ($divisions as $division) {
            $division->audit_blocks = $auditBlockQuestions;
            $divisionAuditIds = $division->audits()->pluck('id')->toArray();
            $divisionAuditQuestionsWithAnswers = AuditQuestionAnswer::all()->whereIn('audit_id', $divisionAuditIds)->groupBy('question_id')->toArray();

            foreach ($divisionAuditQuestionsWithAnswers as $questionId => $divisionAuditQuestionsWithAnswer) {
                $answers = AuditBlockQuestionAnswer::whereIn('id', \Arr::pluck($divisionAuditQuestionsWithAnswer, 'answer_id'))->get()->keyBy('id')->toArray();
                $countPositiveAnswers = 0;
                $countAnswers = count($divisionAuditQuestionsWithAnswer);

                foreach ($divisionAuditQuestionsWithAnswer as $value) {
                    if ($answers[$value['answer_id']]['name'] == 'Да') {
                        $countPositiveAnswers++;
                    }
                }

                foreach ($division->audit_blocks as $auditBlockId => $audit_block) {

                    foreach ($audit_block as $key => $question) {
                        if (isset($question['id']) && $question['id'] == $questionId) {
                            $auditBlockArray = $division->audit_blocks;
                            $auditBlockArray[$auditBlockId][$key]['average_score'] = round($countPositiveAnswers / $countAnswers, 2);
                            $division->audit_blocks = $auditBlockArray;
                        }
                    }
                }
            }
        }

        return $divisions->toArray();
    }
}
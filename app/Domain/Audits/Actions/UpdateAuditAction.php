<?php

namespace App\Domain\Audits\Actions;

use App\Domain\Audits\Models\Audit;
use App\Domain\Audits\Models\AuditQuestionAnswer;

class UpdateAuditAction
{
    public function execute(int $id, array $data): array
    {
        $answers = $data['answers'] ?? [];
        unset($data['answers']);

        $audit = Audit::whereId($id)->update($data);
        AuditQuestionAnswer::whereAuditId($id)->delete();

        if (!empty($answers)) {
            foreach($answers as $answer) {
                AuditQuestionAnswer::create(array_merge($answer, ['audit_id' => $id]));
            }
        }

        return Audit::whereId($id)->toArray();
    }
}

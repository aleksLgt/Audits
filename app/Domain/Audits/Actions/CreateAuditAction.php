<?php

namespace App\Domain\Audits\Actions;

use App\Domain\Audits\Models\Audit;
use App\Domain\Audits\Models\AuditQuestionAnswer;

class CreateAuditAction
{
    public function execute(array $data): array
    {
        $data['user_id'] = auth()->user()->id;
        $audit = Audit::create($data);

        if (!empty($data['answers'])) {
            foreach($data['answers'] as $answer) {
                AuditQuestionAnswer::create(array_merge($answer, ['audit_id' => $audit->id]));
            }
        }

        return $audit->toArray();
    }
}

<?php

namespace App\Http\ApiV1\Modules\Audits\Requests;

use App\Domain\AuditBlocks\Models\AuditBlockQuestion;
use App\Domain\AuditBlocks\Models\AuditBlockQuestionAnswer;
use App\Domain\Audits\Models\Audit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAuditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'  =>  [
                'required',
                'string',
                Rule::unique((new Audit())->getTable(), 'name')
            ],
            'division_id'   =>  [
                'required',
                'integer',
                Rule::exists('divisions', 'id')
            ],
            'planned_date_start' =>  [
                'required',
                'string',
                'date_format:Y-m-d'
            ],
            'planned_date_end' =>  [
                'required',
                'string',
                'date_format:Y-m-d'
            ],
            'answers'   =>  [
                'array'
            ],
            'answers.*.question_id'   =>  [
                'integer',
                Rule::exists((new AuditBlockQuestion())->getTable(), 'id'),
            ],
            'answers.*.answer_id' =>  [
                'integer',
                Rule::exists((new AuditBlockQuestionAnswer())->getTable(), 'id'),
            ],
        ];
    }
}

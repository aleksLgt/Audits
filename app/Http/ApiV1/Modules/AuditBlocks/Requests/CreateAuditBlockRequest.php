<?php

namespace App\Http\ApiV1\Modules\AuditBlocks\Requests;

use App\Domain\AuditBlocks\Models\AuditBlock;
use App\Domain\AuditBlocks\Models\AuditBlockQuestion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAuditBlockRequest extends FormRequest
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
                Rule::unique((new AuditBlock())->getTable(), 'name'),
            ],
            'questions' =>  [
                'sometimes', 'array'
            ],
            'questions.*.name'  =>  [
                'required',
                'string',
            ],
            'questions.*.is_answer_required'  =>  [
                'boolean',
            ],
            'questions.*.answers'   =>  [
                'sometimes',
                'array'
            ],
            'questions.*.answers.*.name'    =>  [
                'required',
                'string'
            ]
        ];
    }
}

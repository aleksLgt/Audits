<?php

namespace App\Http\ApiV1\Modules\Divisions\Requests;

use App\Domain\Divisions\Models\Division;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateDivisionRequest extends FormRequest
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
                Rule::unique((new Division())->getTable(), 'name'),
            ]
        ];
    }
}

<?php

namespace App\Http\ApiV1\Modules\Users\Requests;

use App\Domain\Users\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddPermissionsRequest extends FormRequest
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
            'permissions'   =>  [
                'required',
                'array'
            ],
            'permissions.*' =>  [
                'integer',
                Rule::exists((new Permission())->getTable(), 'id'),
                'distinct'
            ]
        ];
    }
}

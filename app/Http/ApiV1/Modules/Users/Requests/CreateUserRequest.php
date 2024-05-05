<?php

namespace App\Http\ApiV1\Modules\Users\Requests;

use App\Domain\Users\Data\Role\Enums\ShiftEnum;
use App\Domain\Users\Models\Role;
use App\Domain\Users\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class CreateUserRequest extends FormRequest
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
            'login' =>  [
                'required',
                'string',
                Rule::unique((new User())->getTable(), 'login'),
            ],
            'name' =>  [
                'required',
                'string',
            ],
            'email' =>  [
                'required',
                'string',
                'email',
                Rule::unique((new User())->getTable(), 'email'),
            ],
            'post'  =>  [
                'required',
                'string'
            ],
            'shift'  =>  [
                'required',
                new Enum(ShiftEnum::class)
            ],
            'roles' =>  [
                'required',
                'array'
            ],
            'roles.*'   =>  [
                'integer',
                'distinct',
                Rule::exists((new Role())->getTable(), 'id'),
            ],
            'password'  =>  [
                'required',
                'string'
            ]
        ];
    }
}

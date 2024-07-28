<?php

namespace App\Http\Requests\API\Seguridad\User;

use App\Classes\ApiFormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

final class UpdateCurrentPasswordRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        return [
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (! Hash::check($value, $this->user()->password)) {
                        $fail(__('The current password is incorrect.'));
                    }
                },
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                Rule::notIn([$this->current_password]),
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'current_password.required' => __('The current password field is required.'),
            'password.required' => __('The password field is required.'),
            'password.min' => __('The password must be at least :min characters.'),
            'password.confirmed' => __('The password confirmation does not match.'),
            'password.not_in' => __('The new password cannot be the same as the current password.'),
        ];
    }
}

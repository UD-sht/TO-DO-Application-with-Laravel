<?php

namespace App\Request\ChangePassword;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'current_password' => [
                'required',
                'string',
                'min:8',
            ],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'different:current_password',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[\W_]/',
            ],
            'confirm_password' => [
                'required',
                'string',
                'same:new_password',
            ],
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'The current password is required.',
            'current_password.min' => 'The current password must be at least 8 characters long.',
            'new_password.required' => 'The new password is required.',
            'new_password.min' => 'The new password must be at least 8 characters long.',
            'new_password.different' => 'The new password must be different from the current password.',
            'new_password.regex' => 'The new password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'confirm_password.required' => 'The confirm password is required.',
            'confirm_password.same' => 'The confirm password does not match the new password.',
        ];
    }
}

<?php

namespace App\Request\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "user_code" => "required|min:4",
            'user_password' => 'required_if:change_password,1|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
            'retype_user_password'=>'required_if:change_password,1|same:user_password',
            "full_name" => "required|string|min:3",
            'mobile_number'=>"required|digits:10|unique:sec_users,mobile_number",
            'email_address'=>"required|email|unique:sec_users,email_address",
        ];
    }

    public function messages()
    {
        return [
            'user_password.min'=>'User password must be at least 8 characters long.',
            'user_password.regex'=>'User password must contain letters and numbers.',
            'retype_user_password.same'=>'Retype password must match with user password.',
        ];
    }
}

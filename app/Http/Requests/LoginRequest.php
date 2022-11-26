<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        $rules = [
            'email' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6','max:10'],
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',
        ];
        return $messages;

    }
}

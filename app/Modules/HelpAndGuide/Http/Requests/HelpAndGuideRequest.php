<?php

namespace App\Modules\HelpAndGuide\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HelpAndGuideRequest extends FormRequest
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
            'link' => ['required','url'],
            'description' => ['required'],
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'link.required' => 'Link is required.',
            'link.url' => 'Link must be a valid URL.',
            'description.required' => 'Description is required.',
        ];
        return $messages;

    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAvatarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => ['required', 'regex:/^https:\/\/i\.imgur\.com\/[a-zA-Z0-9]+(\.jpg|\.jpeg|\.png|\.gif)$/i'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'avatar.required' => 'Please insert an image',
            'avatar.regex' => 'Please provide a valid Imgur direct image URL (e.g., https://i.imgur.com/.png)',
        ];
    }
}

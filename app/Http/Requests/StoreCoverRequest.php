<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreCoverRequest extends FormRequest
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
            'cover' => [
                'nullable',
                // 'regex:/^https:\/\/i\.imgur\.com\/[a-zA-Z0-9]+(\.jpg|\.jpeg|\.png|\.gif)$/i',
                'regex:/^https:\/\/w\.wallhaven\.cc\/full\/[a-zA-Z0-9]{2}\/wallhaven-[a-zA-Z0-9]+(\.jpg|\.jpeg|\.png|\.gif)$/i'
            ],
            'show_cover' => 'required|boolean',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'cover.required' => 'Please insert an image',
            'cover.regex' => 'Please provide a valid Imgur direct image URL (e.g., https://i.imgur.com/.png)',
            'show_cover.required' => 'Please select if you want to show the cover or not',
        ];
    }
}

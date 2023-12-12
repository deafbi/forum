<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopicRequest extends FormRequest
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
            'title' => 'required|string|max:255|regex:/^[\x00-\x7F]*$/',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|min:1|max:3000|regex:/^[\x00-\x7F]*$/',
            'tags' => 'nullable|exists:tags,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'title.string' => 'A title must be a string',
            'title.max' => 'A title must be at most 255 characters',
            'title.regex' => 'A title must be ASCII characters',
            'category_id.required' => 'A category is required',
            'category_id.exists' => 'The category does not exist',
            'tags.exists' => 'The tag does not exist',
            'content.required' => 'A content is required',
            'content.min' => 'A content must be at least 1 character',
            'content.max' => 'A content must be at most 1000 characters',
            'content.regex' => 'A content must be ASCII characters',
            'user_id.required' => 'A user is required',
            'user_id.exists' => 'The user does not exist',
        ];
    }
}

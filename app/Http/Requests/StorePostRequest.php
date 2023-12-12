<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'content' => 'required|min:1|max:3500|regex:/^[\x00-\x7F]*$/',
            // 'user_id' => 'required|exists:users,id',
            // 'topic_id' => 'required|exists:topics,id',
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
            'content.required' => 'A content is required',
            'content.min' => 'A content must be at least 1 character',
            'content.max' => 'A content must be at most 1000 characters',
            'content.regex' => 'A content must be ASCII characters',
            'user_id.required' => 'A user is required',
            'user_id.exists' => 'A user must exist',
            'topic_id.required' => 'A topic is required',
            'topic_id.exists' => 'A topic must exist',
        ];
    }
}
